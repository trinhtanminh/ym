<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\CustomerAddress;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        // Lấy thông tin sản phẩm và các hình ảnh của sản phẩm
        $product = Product::with('product_images')->find($request->id);

        // Kiểm tra xem sản phẩm có tồn tại hay không
        if ($product == null) {
            return response()->json([
                'status' => false,
                'message' => 'Product not found'
            ]);
        }

        // Kiểm tra xem giỏ hàng có sản phẩm nào hay không
        if (Cart::count() > 0) {
            // Giỏ hàng đã có sản phẩm

            // Lấy nội dung hiện tại của giỏ hàng
            $cartContent = Cart::content();
            $productAlreadyExist = false;

            // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng chưa
            foreach ($cartContent as $item) {
                if ($item->id == $product->id) {
                    $productAlreadyExist = true;
                }
            }

            // Nếu sản phẩm chưa tồn tại trong giỏ hàng
            if ($productAlreadyExist == false) {
                // Thêm sản phẩm vào giỏ hàng
                Cart::add($product->id, $product->title, 1, $product->price, ['productImage' => (!empty($product->product_images)) ? $product->product_images->first() : '']);
                $status = true;
                $message = '<strong>' . $product->title . ' </strong> Đã thêm vào giỏ hàng của bạn thành công.';
                session()->flash('success', $message);
            } else {
                // Nếu sản phẩm đã tồn tại trong giỏ hàng
                $status = false;
                $message = $product->title . ' Đã thêm vào giỏ hàng.';
            }
        } else {
            // Giỏ hàng chưa có sản phẩm, thêm sản phẩm vào giỏ hàng
            Cart::add($product->id, $product->title, 1, $product->price, ['productImage' => (!empty($product->product_images)) ? $product->product_images->first() : '']);
            $status = true;
            $message = '<strong>' . $product->title . ' </strong> Đã thêm vào giỏ hàng của bạn thành công.';
            session()->flash('success', $message);
        }

        // Trả về kết quả dưới dạng JSON
        return response()->json([
            'status' => $status,
            'message' => $message
        ]);
        //Cart::add('293ad', 'Product 1', 1, 9.99);
    }


    public function cart()
    {
        $cartContent = Cart::content();
        $data['cartContent'] = $cartContent;
        return view('front.cart', $data);
    }

    public function updateCart(Request $request)
    {
        $rowId = $request->rowId;
        $qty = $request->qty;

        $itemInfo = Cart::get($rowId);

        $product = Product::find($itemInfo->id);
        // Check qty available in stock

        if ($product->track_qty == 'Yes') {
            if ($qty <= $product->qty) {
                Cart::update($rowId, $qty);
                $message = 'Cart updata successfully';
                $status = true;
                session()->flash('success', $message);
            } else {
                $message = 'Requested qty(' . $qty . ') not available in stock.';
                $status = false;
                session()->flash('error', $message);
            }
        } else {
            Cart::update($rowId, $qty);
            $message = 'Cart updata successfully';
            $status = true;
            session()->flash('success', $message);
        }


        return response()->json([
            'status' => $status,
            'message' => $message
        ]);
    }

    public function deleteItem(Request $request)
    {
        $rowId = $request->rowId; // Lấy rowId từ request

        // Kiểm tra xem mục có tồn tại trong giỏ hàng không
        if (!Cart::get($rowId)) {
            $errorMessage = 'Không tìm thấy sản phẩm trong giỏ hàng.';
            session()->flash('error', $errorMessage);
            return response()->json([
                'status' => false,
                'message' => $errorMessage
            ]);
        }

        // Sử dụng $rowId để xóa mục khỏi giỏ hàng
        Cart::remove($rowId);

        $message = 'Đã xóa sản phẩm khỏi giỏ hàng thành công.';
        session()->flash('success', $message); // Hiển thị thông báo thành công, không phải lỗi
        return response()->json([
            'status' => true,
            'message' => $message
        ]);
    }

    public function checkout()
    {

        if (Cart::count() == 0) {
            return redirect()->route('front.cart');
        }

        if (Auth::check() == false) {

            if (!session()->has('url.intended')) {
                session(['url.intended' => url()->current()]);
            }
            return redirect()->route('account.login');
        }

        $customerAddress = CustomerAddress::where('user_id', Auth::user()->id)->first();

        session()->forget('url.intended');

        $countries = Country::orderBy('name', 'ASC')->get();

        return view('front.checkout', [
            'countries' => $countries,
            'customerAddress' => $customerAddress
        ]);
    }

    public function processCheckout (Request $request){
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|min:5',
            'last_name' => 'required',
            'email' => 'required|email',
            'country' => 'required',
            'address' => 'required|min:30',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'mobile' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => ' Vui lòng sửa các lỗi.',
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

        $user = Auth::user();

        CustomerAddress::updateOrCreate(
            ['user_id' => $user->id],
            [
                'user_id' => $user->id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'country_id' => $request->country,
                'address' => $request->address,
                'apartment' => $request->apartment,
                'city' => $request->city,
                'state' => $request->state,
                'zip' => $request->zip
            ]
        );

        if ($request->payment_method == 'cod') {
            $shipping = 0;
            $discount = 0;
            $subTotal = Cart::subtotal(2, '.', '');
            $grandTotal = $subTotal + $shipping;

            $order = new Order;
            $order->subtotal = $subTotal;
            $order->shipping = $shipping;
            $order->grand_total = $grandTotal;
            $order->user_id = $user->id;

            $order->first_name = $request->first_name;
            $order->last_name = $request->last_name;
            $order->email = $request->email;
            $order->mobile = $request->mobile;
            $order->address = $request->address;
            $order->apartment = $request->apartment;
            $order->state = $request->state;
            $order->city = $request->city;
            $order->zip = $request->zip;
            $order->notes = $request->notes;
            $order->country_id = $request->country;
            $order->save();

            foreach (Cart::content() as $item) {
                $orderItem = new OrderItem;
                $orderItem->product_id = $item->id;
                $orderItem->order_id = $order->id;
                $orderItem->name = $item->name;
                $orderItem->qty = $item->qty;
                $orderItem->price = $item->price;
                $orderItem->total = $item->price * $item->qty;
                $orderItem->save();
            }
            session()->flash('success', 'CMM');

            Cart::destroy();

            return response()->json([
                'message' => ' Đặt hàng thành công',
                'orderId' => $order->id,
                'status' => true
            ]);

        } else {

        }

    }
    public function thankyou($id)
    {
        return view('front.thanks', [
            'id' => $id
        ]);
    }
}
