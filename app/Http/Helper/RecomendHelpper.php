<?php
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;

class RecommendHelper {
    public function recommendWithHotSaling() {

        $hotSalingProducts = Product::orderBy('so_luong_da_ban', 'desc')
            ->with('images')->take(5)->get();

        return $hotSalingProducts;
    }

    public function recommendWithOrder() {
        $order_rcm = Order::where('UserId', session('UserId'))->orderBy('created_at', 'desc')->first();
        if (!$order_rcm) {
            $rcm = $this->recommendWithHotSaling();
            return $rcm;
        } else {
            $recommendedProducts = $this->recommendProductsBasedOnOrder($order_rcm);
            return $recommendedProducts;
        }
    }

    protected function recommendProductsBasedOnOrder($order) {
        $purchasedProductIds = $order->chiTietDonHangs->pluck('ProductId')->toArray();
        $purchasedCategories = Product::whereIn('ProductId', $purchasedProductIds)
            ->pluck('CatagoryId')
            ->toArray();
        $recommendedProducts = Product::whereIn('CatagoryId', $purchasedCategories)
            ->whereNotIn('ProductId', $purchasedProductIds)
            ->with('images')
            ->take(5)
            ->get();
        return $recommendedProducts;
    }



}
