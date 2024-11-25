<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $search_value = $request->input('search_val');

        $products = Product::where('Name', 'like', '%'.$search_value.'%')->with('images')->get();

        if ($products->isEmpty()) {
            $products = Product::where('Description', 'like', '%'.$search_value.'%')->with('images')->get();
        }

        if ($products->isEmpty()) {
            $categoryIds = Category::where('Name', 'like', '%'.$search_value.'%')->pluck('CategoryId');
            if ($categoryIds->isEmpty()) {
                if ($products->isEmpty()) {
                    $cart = Cart::where('UserId', Auth::id())->first();
                    $cartItems = $cart ? $cart->cartItems()->with('product')->get() : collect([]);

                    return view('pages.empty', [
                        'cartItems' => $cartItems,
                    ]);
                }
            }
            $products = Product::where('CategoryId', $categoryIds)->with('images')->get();
        }

        $categories = Category::withCount('products')->get();

        $cart = Cart::where('UserId', Auth::id())->first();
        $cartItems = $cart ? $cart->cartItems()->with('product')->get() : collect([]);

        return view('pages.product', [
            'products' => $products,
            'categories' => $categories,
            'cartItems' => $cartItems,
        ]);
    }
}
