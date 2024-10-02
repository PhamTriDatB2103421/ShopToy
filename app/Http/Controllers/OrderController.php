<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Discount;
use App\Models\Shipment;
use App\Models\Payment;

class OrderController extends Controller
{
    public function form($id)
    {
        $cart = Cart::find($id);
        $cartItems = $cart->cartItems()->with('product')->get();
        $userId = Auth::id();
        $address = DB::table('users')->where('UserId', $userId)->value('Address');

        // Tính toán tổng số tiền cho giỏ hàng
        $total = $cartItems->sum(function ($item) {
            return $item->product->Price * $item->Quantity;
        });

        // Lấy mã giảm giá từ session
        $discount = Session::get('discount');

        // Áp dụng giảm giá nếu có
        if ($discount) {
            if ($discount->DiscountType === 'percentage') {
                $total -= $total * ($discount->DiscountValue / 100);
            } elseif ($discount->DiscountType === 'fixed') {
                $total -= $discount->DiscountValue;
            }
            $total = max($total, 0); // Đảm bảo tổng số tiền không âm
        }
        Session::put('cart_ID', $cart->CartId);

        return view('pages.checkout_form', [
            'address' => $address,
            'cartItems' => $cartItems,
            'total' => $total,
            'cartId' => $id, // Thêm biến $cartId vào view
        ]);
    }


    public function submitOrder(Request $request, $cartId)
    {
        // Tìm giỏ hàng dựa trên cartId
        $cart = Cart::with('cartItems.product')->findOrFail($cartId);

        // Tính toán tổng số tiền giỏ hàng
        $totalAmount = $cart->cartItems->sum(function ($item) {
            return $item->product->Price * $item->Quantity;
        });

        // Lấy mã giảm giá từ session và áp dụng nếu có
        $discount = Session::get('discount');
        if ($discount) {
            if ($discount->DiscountType === 'Percentage') {
                $totalAmount -= $totalAmount * ($discount->DiscountValue / 100);
            } elseif ($discount->DiscountType === 'Fixed Amount') {
                $totalAmount -= $discount->DiscountValue;
            }
            $totalAmount = max($totalAmount, 0); // Đảm bảo tổng số tiền không âm
        }

        // Tạo đơn hàng mới
        $order = Order::create([
            'UserId' => Auth::id(),
            'OrderStatus' => 'Pending',
            'TotalAmount' => $totalAmount,
            'PaymentStatus' => 'Pending',
            'ShippingAddress' => $request->input('address'),
        ]);

        // Lưu các sản phẩm trong đơn hàng
        foreach ($cart->cartItems as $item) {
            OrderItem::create([
                'OrderId' => $order->OrderId,
                'ProductId' => $item->ProductId,
                'Quantity' => $item->Quantity,
                'UnitPrice' => $item->product->Price,
            ]);
        }

        // Xóa giỏ hàng sau khi đặt hàng thành công
        $cart->cartItems()->delete();
        $cart->delete();

        // Xóa mã giảm giá khỏi session
        Session::forget('discount');

        // Tạo shipment và payment mặc định sau khi tạo đơn hàng
        Shipment::create([
            'OrderId' => $order->OrderId,
            'TrackingNumber' => 'N/A', // Cần phải cập nhật sau khi có thông tin theo dõi
            'ShippedDate' => null,
            'EstimatedDeliveryDate' => null,
            'DeliveryStatus' => 'Pending',
        ]);

        Payment::create([
            'OrderId' => $order->OrderId,
            'PaymentMethod' => 'Cash on Delivery',
            'PaymentDate' => null,
            'Amount' => $totalAmount,
        ]);
        Session::forget('cart');
        // Chuyển hướng người dùng đến trang thành công với tham số order_id
        return redirect()->route('order.success', ['order_id' => $order->OrderId]);
    }



    public function applyCoupon(Request $request)
    {
        $request->validate([
            'coupon_code' => 'required|string'
        ]);

        $couponCode = $request->input('coupon_code');
        $discount = Discount::where('DiscountCode', $couponCode)
            ->where('IsActive', true)
            ->whereDate('StartDate', '<=', now())
            ->whereDate('EndDate', '>=', now())
            ->first();

        if (!$discount) {
            return response()->json([
                'success' => false,
                'error' => 'Mã giảm giá không hợp lệ hoặc đã hết hạn.'
            ]);
        }

        $userId = Auth::id();
        $cartId = Session::get('cart_ID');

        // Kiểm tra sự tồn tại của giỏ hàng và lấy các mặt hàng trong giỏ hàng
        $cart = Cart::where('UserId', $userId)->where('CartId', $cartId)->first();

        if (!$cart) {
            return response()->json([
                'success' => false,
                'error' => 'Không tìm thấy giỏ hàng.'
            ]);
        }

        $cartItems = $cart->cartItems()->with('product')->get();
        $total = 0;

        foreach ($cartItems as $item) {
            $total += $item->product->Price * $item->Quantity;
        }

        // Áp dụng mã giảm giá
        if ($discount->DiscountType === 'Percentage') {
            $total -= $total * ($discount->DiscountValue / 100);
        } elseif ($discount->DiscountType === 'Fixed Amount') {
            $total -= $discount->DiscountValue;
        }

        $total = max($total, 0);

        Session::put('discount', $discount);
        Session::put('cart_total', $total);

        return response()->json([
            'success' => true,
            'new_total' => number_format($total, 0, ',', '.') . ' VNĐ'
        ]);
    }
    // app/Http/Controllers/OrderController.php

    public function success($orderId)
    {
        $order = Order::with('orderItems.product')->findOrFail($orderId);
        return view('pages.checkout_success', compact('order'));
    }




    public function list(){
        $order = Order::all();
        return view('admin.order.list',[
            'orders' => $order,
        ]);
    }
    public function cancel($id){
        $order= Order::find($id);
        $order->OrderStatus = 'Cancelled';
        $order->save();
        return redirect()->back()->with('message', 'Đã hủy Đơn');
    }
    public function detail($id){
        $order = Order::find($id);
        $OrderItems = OrderItem::where('OrderId' ,$id)->get();
        return view('admin.order.detail',
            [
                'order'=> $order,
                'orderItems' => $OrderItems,
            ]);
    }
    public function ad_edit(Request $request) {
        // Lấy thông tin order từ request
        $orderId = $request->input('OrderId');
        $orderStatus = $request->input('OrderStatus');
        $paymentStatus = $request->input('PaymentStatus');

        // Tìm order theo ID
        $order = Order::find($orderId);

        // Cập nhật status
        if ($order) {
            $order->OrderStatus = $orderStatus;
            $order->PaymentStatus = $paymentStatus;
            $order->save();
        }

        // Điều hướng về trang quản lý đơn hàng
        return redirect()->back()->with('message', 'Cập nhật thành công');
    }
    public function editOrderItem(Request $request) {
        // Lấy thông tin từ request
        $orderItemId = $request->input('OrderItemId');
        $quantity = $request->input('Quantity');

        // Tìm order item theo ID
        $orderItem = OrderItem::find($orderItemId);

        if ($orderItem) {
            // Cập nhật số lượng order item
            $orderItem->Quantity = $quantity;
            $orderItem->save(); // Không cập nhật trực tiếp TotalPrice, MySQL sẽ tự động tính lại

            // Tìm order liên quan đến order item
            $order = $orderItem->order;

            // Tính lại tổng giá của đơn hàng
            $orderTotal = $order->orderItems->sum('TotalPrice');
            $order->TotalAmount = $orderTotal; // Cập nhật tổng giá của đơn hàng
            $order->save();
        }

        // Điều hướng về trang quản lý đơn hàng
        return redirect()->back()->with('message', 'Cập nhật hoàn tất');
    }
    public function removeOrderItem($orderItemId) {
        // Tìm order item theo ID và xóa
        $orderItem = OrderItem::find($orderItemId);
        if ($orderItem) {
            $orderItem->delete();
        }

        // Điều hướng về trang quản lý đơn hàng
        return redirect()->back()->with('message', 'Đã xóa sản phẩm');
    }





}