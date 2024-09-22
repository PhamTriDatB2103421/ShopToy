<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index() {
        $products = Product::with('category')->get();
        return view('admin.products.all_products', [
            'products' => $products,
        ]);
    }
    public function create() {
        $categories = Category::all();
        return view('admin.products.form', [
            'categories' => $categories,
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,CategoryId',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = new Product();
        $product->Name = $request->input('name');
        $product->Description = $request->input('description');
        $product->Price = $request->input('price');
        $product->Stock = $request->input('stock');
        $product->CategoryId = $request->input('category_id');
        $product->save();

        // Xử lý hình ảnh mới
        if ($request->hasFile('images')) {
            $imageIndex = 1;  // Bắt đầu từ số 1
            $datePrefix = now()->format('Ymd');  // Tiền tố là ngày hiện tại

            foreach ($request->file('images') as $image) {
                $filename = $datePrefix . '_' . $product->ProductId . '_' . $imageIndex . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('product_images', $filename, 'public');

                $productImage = new ProductImage();
                $productImage->ProductId = $product->ProductId;
                $productImage->ImageUrl = $path;
                $productImage->save();

                $imageIndex++;
            }
        }

        return redirect()->route('admin.all_products')->with('message', 'Sản phẩm đã được thêm thành công');
    }


    public function edit($id) {
        $product = Product::find($id);
        $images = ProductImage::where('ProductId', $id)->get();
        $categories = Category::all();
        if (!$product) {
            return redirect()->route('admin.all_products')->with('message', 'Sản phẩm không tồn tại');
        }
        return view('admin.products.form', [
            'product' => $product,
            'images' => $images,
            'categories' => $categories,
        ]);
    }




    public function update(Request $request, $id) {
        $product = Product::find($id);
        if (!$product) {
            return redirect()->route('admin.all_products')->with('message', 'Sản phẩm không tồn tại');
        }

        $product->Name = $request->input('name');
        $product->Description = $request->input('description');
        $product->Price = $request->input('price');
        $product->Stock = $request->input('stock');
        $product->CategoryId = $request->input('category_id');
        $product->save();

        // Xử lý hình ảnh hiện tại
        if ($request->has('existing_images')) {
            $existingImages = $request->input('existing_images');
            ProductImage::where('ProductId', $product->ProductId)
                ->whereNotIn('ImageUrl', array_map(function($url) {
                    return str_replace(asset('storage/'), '', $url);
                }, $existingImages))
                ->delete();
        } else {
            ProductImage::where('ProductId', $product->ProductId)->delete();
        }

        // Xử lý hình ảnh mới
        if ($request->hasFile('images')) {
            $imageIndex = ProductImage::where('ProductId', $product->ProductId)->count() + 1;
            $datePrefix = now()->format('Ymd');

            foreach ($request->file('images') as $image) {
                $filename = $datePrefix . '_' . $product->ProductId . '_' . $imageIndex . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('product_images', $filename, 'public');

                $productImage = new ProductImage();
                $productImage->ProductId = $product->ProductId;
                $productImage->ImageUrl = $path;
                $productImage->save();

                $imageIndex++;
            }
        }

        return redirect()->route('admin.all_products')->with('message', 'Sản phẩm đã được cập nhật thành công');
    }


    public function destroy($id) {
        $product = Product::find($id);
        if (!$product) {
            return redirect()->route('admin.all_products')->with('message', 'Sản phẩm không tồn tại');
        }

        // Xóa hình ảnh liên quan
        foreach ($product->images as $image) {
            $imageUrl = $image->ImageUrl;

            if (!empty($imageUrl)) {
                // Xóa hình ảnh khỏi storage
                Storage::disk('public')->delete($imageUrl);
            }

            // Xóa bản ghi hình ảnh
            $image->delete();
        }

        // Xóa sản phẩm
        $product->delete();

        return redirect()->route('admin.all_products')->with('message', 'Sản phẩm đã được xóa thành công');
    }

}