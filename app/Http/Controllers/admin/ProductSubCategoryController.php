<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ProductSubCategoryController extends Controller
{
    public function index(Request $request)
    {
        if (!empty($request->category_id)) {
            $subCategories = SubCategory::where('category_id', $request->category_id)
                ->orderBy('name', 'ASC')
                ->get();

            // Gán kết quả truy vấn cho biến $subCategories

            return response()->json([
                'status' => true,
                'subCategories' => $subCategories // Trả về mảng các subCategories
            ]);
        } else {
            return response()->json([
                'status' => true,
                'subCategories' => [] // Trả về mảng các subCategories
            ]);
        }
    }
}
