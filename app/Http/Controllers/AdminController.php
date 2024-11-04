<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AdminController extends Controller
{
    public function index(){
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
    public function getRevenue(Request $request){

    }
}
