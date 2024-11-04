<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function search(Request $request) {
        $search_value = $request->input('search_val');

        // Tìm sản phẩm theo tên
        $products = Product::where('Name', 'like', '%' . $search_value . '%')->with('images')->get();

        // Nếu không tìm thấy, kiểm tra theo mô tả
        if ($products->isEmpty()) {
            $products = Product::where('Description', 'like', '%' . $search_value . '%')->with('images')->get();
        }

        // Nếu vẫn không tìm thấy, kiểm tra theo tên danh mục
        if ($products->isEmpty()) {
            // Lấy danh mục có tên khớp với $search_value
            $categoryIds = Category::where('Name', 'like', '%' . $search_value . '%')->pluck('id');

            // Tìm sản phẩm theo danh mục
            $products = Product::whereIn('CategoryId', $categoryIds)->with('images')->get();
        }

        // Lấy tất cả danh mục
        $categories = Category::withCount('products')->get();

        // Lấy giỏ hàng của người dùng
        $cart = Cart::where('UserId', Auth::id())->first();
        $cartItems = $cart ? $cart->cartItems()->with('product')->get() : collect([]);

        return view('pages.product', [
            'products' => $products,
            'categories' => $categories,
            'cartItems' => $cartItems,
        ]);
    }

}
