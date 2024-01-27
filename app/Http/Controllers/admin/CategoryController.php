<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use App\Models\TempImage;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;



class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::latest();
        if (!empty($request->get('keyword'))) {
            $categories = $categories->where('name', 'like', '%' . $request->get('keyword') . '%');
        }
        $categories = $categories->paginate(10);

        $data['categories'] = $categories;
        return view('admin.category.list', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        // Kiểm tra và xác thực dữ liệu từ form sử dụng Validator
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:categories',
        ]);

        // Kiểm tra xem điều kiện kiểm tra của Validator đã được vượt qua hay không
        if ($validator->passes()) {
            // Tạo một đối tượng Category mới và gán giá trị từ dữ liệu nhận được từ form
            $category = new Category();
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->status = $request->status;
            $category->showHome = $request->showHome;

            // Lưu đối tượng Category mới vào cơ sở dữ liệu
            $category->save();

            // Kiểm tra xem có dữ liệu hình ảnh tạm thời (temp image) được gửi lên hay không
            if (!empty($request->image_id)) {
                // Lấy đối tượng TempImage từ cơ sở dữ liệu bằng id được truyền từ form
                $tempImage = TempImage::find($request->image_id);

                // Xác định phần mở rộng của tệp hình ảnh tạm thời
                $ext = explode('.', $tempImage->name);
                $ext = last($ext);

                // Tạo tên mới cho hình ảnh dựa trên id của Category và phần mở rộng của tệp hình ảnh tạm thời
                $newImageName = $category->id . '.' . $ext;

                // Sao chép hình ảnh từ thư mục tạm thời đến thư mục lưu trữ chính
                $sPath = public_path() . '/temp/' . $tempImage->name;
                $dPath = public_path() . '/uploads/category/' . $newImageName;
                File::copy($sPath, $dPath);

                // Tạo hình ảnh thumbnail và lưu vào thư mục chứa các hình ảnh thumbnail
                $dPath = public_path() . '/uploads/category/thumb/' . $newImageName;
                $img = Image::make($sPath);
                $img->fit(450, 600, function ($constraint) {
                    $constraint->upsize();
                });
                $img->save($dPath);

                // Lưu tên hình ảnh vào trường 'image' của đối tượng Category và cập nhật lại cơ sở dữ liệu
                $category->image = $newImageName;
                $category->save();
            }

            // Tạo một flash message thông báo thành công
            session()->flash('success', 'Category added successfully');

            // Trả về một phản hồi JSON cho client với trạng thái thành công và thông báo
            return response()->json([
                'status' => true,
                'message' => 'Category added successfully'
            ]);
        } else {
            // Nếu có lỗi xảy ra trong quá trình kiểm tra Validator, trả về một phản hồi JSON với trạng thái lỗi và danh sách các lỗi
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }


    public function edit($categoryId, Request $request)
    {
        $category = Category::find($categoryId);
        if (empty($category)) {
            return redirect()->route('categories.index');
        }
        return view('admin.category.edit', compact('category'));
    }

    public function update($categoryId, Request $request)
    {
        $category = Category::find($categoryId);
        if (empty($category)) {
            session()->flash('error', 'Category not found');
            return response()->json([
                'status' => false,
                'notFound' => true,
                'message' => "Category not found"
            ]);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:categories,slug,' . $category->id . ',id',
        ]);

        // ...
        if ($validator->passes()) {
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->status = $request->status;
            $category->showHome = $request->showHome; // Kiểm tra xác nhận dữ liệu trước khi lưu
            $category->save(); // Lưu category mới vào cơ sở dữ liệu
            $oldImage = $category->image;
            //Save Imageß
            if (!empty($request->image_id)) {
                $tempImage = TempImage::find($request->image_id);
                $ext = explode('.', $tempImage->name);
                $ext = last($ext);

                $newImageName = $category->id . '-' . time() . '.' . $ext;
                $sPath = public_path() . '/temp/' . $tempImage->name;
                $dPath = public_path() . '/uploads/category/' . $newImageName;
                File::copy($sPath, $dPath);

                //Generate Image Thumbnail
                $dPath = public_path() . '/uploads/category/thumb/' . $newImageName;
                $img = Image::make($sPath);
                //$img->resize(450, 600);
                $img->fit(450, 600, function ($constraint) {
                    $constraint->upsize();
                });
                $img->save($dPath);

                $category->image = $newImageName;
                $category->save();

                // Delete Old Images Here
                File::delete(public_path() . '/uploads/category/thumb/' . $oldImage);
                File::delete(public_path() . '/uploads/category/' . $oldImage);
            }

            // Flash message
            session()->flash('success', 'Category updated successfully');

            return response()->json([
                'status' => true,
                'message' => 'Category updated successfully'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function destroy($categoryId, Request $request)
    {
        $category = Category::find($categoryId);

        if (empty($category)) {
            session()->flash('error', 'Category not found');
            return response()->json([
                'status' => true,
                'message' => 'Category not found'
            ]);
        }

        File::delete(public_path() . '/uploads/category/thumb/' . $category->image);
        File::delete(public_path() . '/uploads/category/' . $category->image);

        $category->delete();
        // Flash message
        session()->flash('success', 'Category deleted successfully');
        return response()->json([
            'status' => true,
            'message' => 'Category delete successfully'
        ]);
    }
}
