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
            // Nếu đã có sản phẩm, tăng số lượng lên 1
            $cartItem->Quantity++;
            $cartItem->save();
        } else {
            // Nếu chưa có sản phẩm, thêm mới
            CartItem::create([
                'CartId' => $cart->CartId,
                'ProductId' => $productId,
                'Quantity' => 1
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

    public function removeFromCart(Request $request)
    {
        $productId = $request->input('product_id');

        // Lấy giỏ hàng của user
        $cart = Cart::where('UserId', Auth::id())->first();

        if ($cart) {
            // Tìm sản phẩm trong giỏ hàng
            $cartItem = $cart->cartItems()->where('ProductId', $productId)->first();

            if ($cartItem) {
                // Xóa sản phẩm khỏi giỏ hàng
                $cartItem->delete();

                // Cập nhật session
                $cartItems = $cart->cartItems()->with('product')->get();
                session(['cart' => $cartItems]);

                return redirect()->back()->with('success', 'Đã xóa.');
            }
        }

        return redirect()->back()->with('error', 'Product not found in cart.');
    }
}


