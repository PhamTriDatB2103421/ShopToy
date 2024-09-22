<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1); // Lấy số lượng từ request, nếu không có thì mặc định là 1
        $userId = Auth::id(); // Lấy ID người dùng hiện tại

        // Kiểm tra xem sản phẩm có tồn tại không
        $product = Product::with('images')->find($productId);
        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Product not found.']);
        }

        // Kiểm tra xem người dùng đã có giỏ hàng chưa
        $cart = Cart::where('UserId', $userId)->first();
        if (!$cart) {
            $cart = Cart::create(['UserId' => $userId]);
        }

        // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
        $cartItem = CartItem::where('CartId', $cart->CartId)
                            ->where('ProductId', $productId)
                            ->first();

        if ($cartItem) {
            // Nếu đã có sản phẩm, tăng số lượng thêm số lượng được gửi lên
            $cartItem->Quantity += $quantity;
            $cartItem->save();
        } else {
            // Nếu chưa có sản phẩm, thêm mới
            CartItem::create([
                'CartId' => $cart->CartId,
                'ProductId' => $productId,
                'Quantity' => $quantity
            ]);
        }

        // Cập nhật giỏ hàng trong session
        $this->updateCartSession($userId);

        // Trả về thông tin sản phẩm bao gồm hình ảnh
        return response()->json([
            'success' => true,
            'product' => $product
        ]);
    }




    private function updateCartSession($userId)
    {
        $cart = Cart::where('UserId', $userId)->first();
        $cartItems = $cart ? $cart->cartItems : collect([]);
        Session::put('cart', $cartItems);
    }

    public function remove(Request $request) {
        $cartItemId = $request->input('cart_item_id');
        $cartItem = CartItem::find($cartItemId);

        if ($cartItem) {
            $cartItem->delete();
            if(Session(key: 'cart')){
                $request->session()->forget('cart'); // Xóa tất cả session
            }
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Item not found']);
    }

}
