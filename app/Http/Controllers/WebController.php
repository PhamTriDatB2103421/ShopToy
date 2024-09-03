<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Carbon\Carbon;

class WebController extends Controller
{
    public function index(){

        $recent_Products = Product::where('updated_at', '>=', Carbon::now()->subDays(7))
                                  ->orderBy('updated_at', 'desc')
                                  ->with('images')
                                  ->get();

        $categories = Category::all();

        return view('pages.index', [
            'recent_products' => $recent_Products,
            'categories' => $categories,
        ]);
    }
    public function product(){
        // Lấy tất cả sản phẩm cùng với hình ảnh liên quan
        $products = Product::with('images')->get();

        // Lấy tất cả danh mục
        $categories = Category::withCount('products')->get();

        return view('pages.product', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    public function product_detail($id) {

    }

}
