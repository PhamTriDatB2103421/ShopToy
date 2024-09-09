<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use App\Models\Discount;
use App\Models\ProductDiscount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class DiscountController extends Controller
{
    public function all() {
        $discounts = Discount::all();
        return view('admin.discount.all',[
            'discounts' => $discounts,
        ]);
    }
    public function edit($id){
        $discount = Discount::find($id);
        return view('admin.discount.form',[
            'discount'=>$discount,
        ]);
    }
    public function updateDiscount(Request $request, $id)
    {
        DB::table('discounts')
            ->where('DiscountId', $id)
            ->update([
                'DiscountCode' => $request->input('DiscountCode'),
                'Description' => $request->input('Description'),
                'DiscountType' => $request->input('DiscountType'),
                'DiscountValue' => $request->input('DiscountValue'),
                'StartDate' => $request->input('StartDate'),
                'EndDate' => $request->input('EndDate'),
                'IsActive' => $request->input('IsActive', 1),
            ]);

        return redirect()->route('admin.all_discount')->with('message', 'Cập nhật thành công!');
    }
    public function add(){
        return view('admin.discount.form');
    }
    public function store(Request $request)
    {
        $request->validate([
            'DiscountCode' => 'required|string|max:255',
            'Description' => 'nullable|string',
            'DiscountType' => 'required|string',
            'DiscountValue' => 'required|numeric',
            'StartDate' => 'required|date',
            'EndDate' => 'required|date',
        ]);

        Discount::create([
            'DiscountCode' => $request->input('DiscountCode'),
            'Description' => $request->input('Description'),
            'DiscountType' => $request->input('DiscountType'),
            'DiscountValue' => $request->input('DiscountValue'),
            'StartDate' => $request->input('StartDate'),
            'EndDate' => $request->input('EndDate'),
        ]);

        return redirect()->route('admin.all_discount')->with('message', 'Mã giảm giá đã được thêm thành công.');
    }
    public function destroy($id)
    {
        // Tìm mã giảm giá theo ID
        $discount = Discount::find($id);

        // Kiểm tra nếu mã giảm giá tồn tại
        if ($discount) {
            // Xóa mã giảm giá
            $discount->delete();

            // Redirect về trang danh sách mã giảm giá với thông báo thành công
            return redirect()->route('admin.all_discount')->with('message', 'Mã giảm giá đã được xóa thành công!');
        } else {
            // Redirect về trang danh sách mã giảm giá với thông báo lỗi nếu mã giảm giá không tồn tại
            return redirect()->route('admin.all_discount')->with('error', 'Mã giảm giá không tồn tại!');
        }
    }
    public function product($id)
    {
        $discount = Discount::find($id);
        $products = $discount ? $discount->getProductsByDiscountId($id) : collect(); // Trả về tập hợp rỗng nếu không tìm thấy discount

        return view('admin.discount.product.all', [
            'products' => $products,
            'discount' => $discount,
        ]);
    }
    public function destroy_products($discountId, $productId)
    {
        $productDiscount = ProductDiscount::where('ProductId', $productId)
        ->where('DiscountId', $discountId)
        ->first();

        if ($productDiscount) {
        $productDiscount->delete();
        return redirect()->back()->with('message', 'Product discount removed successfully.');
        } else {
        return redirect()->back()->with('message', 'Product discount not found.');
        }
    }


}
