<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Carbon\Carbon;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class WebController extends Controller
{
    public function index(){

        $recent_Products = Product::where('updated_at', '>=', Carbon::now()->subDays(20))
                                  ->orderBy('updated_at', 'desc')
                                  ->with('images')
                                  ->get();

        $categories = Category::all();
        $cart = Cart::where('UserId', Auth::id())->first();
        $cartItems = $cart ? $cart->cartItems()->with('product')->get() : collect([]);

        return view('pages.index', [
            'recent_products' => $recent_Products,
            'categories' => $categories,
            'cartItems' => $cartItems,
        ]);
    }
    public function product(){
        // Lấy tất cả sản phẩm cùng với hình ảnh liên quan
        $products = Product::with('images')->get();

        // Lấy tất cả danh mục
        $categories = Category::withCount('products')->get();
        $cart = Cart::where('UserId', Auth::id())->first();
        $cartItems = $cart ? $cart->cartItems()->with('product')->get() : collect([]);

        return view('pages.product', [
            'products' => $products,
            'categories' => $categories,
            'cartItems' => $cartItems,
        ]);
    }

    public function product_detail($id) {
        // Lấy danh sách sản phẩm với hình ảnh
        $products = Product::with('images')->get();

        // Lấy chi tiết sản phẩm với hình ảnh và đánh giá
        $product_detail = Product::with(['images', 'reviews.user'])->find($id);

        // Tính điểm đánh giá trung bình
        $average_rating = $product_detail->reviews->avg('Rating') ?? 0;

        // Đếm số lượng đánh giá theo sao
        $ratings_count = $product_detail->reviews->groupBy('Rating')->map(function ($reviews) {
            return $reviews->count();
        });

        // Đảm bảo có giá trị cho tất cả các sao từ 1 đến 5
        for ($i = 1; $i <= 5; $i++) {
            if (!isset($ratings_count[$i])) {
                $ratings_count[$i] = 0;
            }
        }
        foreach ($product_detail->reviews as $review) {
            $review->created_at = \Carbon\Carbon::parse($review->created_at);
        }
        $cart = Cart::where('UserId', Auth::id())->first();
        $cartItems = $cart ? $cart->cartItems()->with('product')->get() : collect([]);
        return view('pages.product_detail', [
            'products' => $products,
            'product_detail' => $product_detail,
            'average_rating' => $average_rating,
            'ratings_count' => $ratings_count,
            'cartItems' => $cartItems,
        ]);
    }
    public function storeReview(Request $request, $id) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'comment' => 'required|string',
            'rating' => 'required|integer|between:1,5',
        ]);
        if (!Auth::check()) {
            return redirect()->route('login')->with('message', 'Vui lòng đăng nhập để gửi đánh giá.');
        }
        $review = new Review();
        $review->ProductId = $id;
        $review->UserId = Auth::id(); // Assuming user is logged in
        $review->Rating = $request->input('rating');
        $review->Comment = $request->input('comment');
        $review->save();

        return redirect()->back()->with('message', 'Bạn đã đánh giá cho sản phẩm!');
    }




}
