<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function all_categories() {
        $categories = Category::all();
        return view('admin.categories.all_categories', [
            'categories' => $categories,
        ]);
    }

    // Hiển thị form thêm danh mục
    public function create_category() {

        return view('admin.categories.create_category');
    }

    // Xử lý lưu danh mục mới
    public function store_category(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'parent_category_id' => 'nullable|integer|exists:categories,CategoryId',
        ]);

        $category = new Category();
        $category->name = $request->input('name');
        $category->description = $request->input('description');

        // Cập nhật parent_category_id chỉ nếu có giá trị
        $parentCategoryId = $request->input('parent_category_id');
        if ($parentCategoryId !== null) {
            $category->parent_category_id = $parentCategoryId;
        }

        // Lưu thay đổi
        $category->save();

        return redirect()->route('admin.all_categories')->with('message', 'Danh mục đã được thêm thành công');
    }

    // Hiển thị form chỉnh sửa danh mục
    public function edit_category($id) {
        $categories = Category::all();
        $category = Category::find($id);
        if (!$category) {
            return redirect()->route('admin.all_categories')->with('message', 'Danh mục không tồn tại');
        }
        return view('admin.categories.edit_category',
                    [
                        'category' => $category,
                        'categories'=> $categories,
                    ]);
    }

    // Xử lý cập nhật danh mục
    public function update_category(Request $request, $id) {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'parent_category_id' => 'nullable|integer|exists:categories,CategoryId',
        ]);

        // Tìm danh mục theo ID
        $category = Category::find($id);
        if (!$category) {
            return redirect()->route('admin.all_categories')->with('message', 'Danh mục không tồn tại');
        }

        // Cập nhật thông tin danh mục
        $category->name = $request->input('name');
        $category->description = $request->input('description');

        // Cập nhật parent_category_id chỉ nếu có giá trị
        $parentCategoryId = $request->input('parent_category_id');
        if ($parentCategoryId !== null) {
            $category->parent_category_id = $parentCategoryId;
        }

        // Lưu thay đổi
        $category->save();

        // Chuyển hướng và thông báo thành công
        return redirect()->route('admin.all_categories')->with('message', 'Danh mục đã được cập nhật thành công');
    }


    // Xóa danh mục
    public function remove_category($id) {
        $category = Category::find($id);
        if (!$category) {
            return redirect()->route('admin.all_categories')->with('message', 'Danh mục không tồn tại');
        }
        $category->delete();
        return redirect()->route('admin.all_categories')->with('message', 'Danh mục đã được xóa thành công');
    }
}
