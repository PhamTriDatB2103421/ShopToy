<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        $newUser = User::where('updated_at', '>=', Carbon::now()->subDays(90))
            ->orderBy('updated_at', 'desc')->count();
        $totalUser = User::all()->count();
        $totalCart = Cart::all()->count();
        $totalOrder = Order::all()->count();

        return view('admin.index', [
            'newUser' => $newUser,
            'totalUser' => $totalUser,
            'totalCart' => $totalCart,
            'totalOrder' => $totalOrder,
        ]);
    }

    public function getRevenue(Request $request)
    {
        $month = $request->input('month');
        $year = $request->input('year');

        // Kiểm tra xem tháng và năm có hợp lệ không
        if (is_null($month) || is_null($year)) {
            return redirect()->back()->with('error', 'Vui lòng chọn cả tháng và năm!');
        }
        $newUser = User::where('updated_at', '>=', Carbon::now()->subDays(90))
            ->orderBy('updated_at', 'desc')->count();
        $totalUser = User::all()->count();
        $totalCart = Cart::all()->count();
        $totalOrder = Order::all()->count();
        // Tính tổng doanh thu cho tháng và năm đã chọn
        $totalRevenue = Order::whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->sum('TotalAmount');

        return view('admin.index', [
            'totalRevenue' => $totalRevenue,
            'month' => $month,
            'yeards' => $year,
            'newUser' => $newUser,
            'totalUser' => $totalUser,
            'totalCart' => $totalCart,
            'totalOrder' => $totalOrder,
        ]);
    }
}
