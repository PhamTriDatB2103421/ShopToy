<?php
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;

class RecommendHelper {
    public function recommendWithHotSaling() {
        // Đề xuất các sản phẩm bán chạy nhất (Hot Saling)
        // Lấy danh sách sản phẩm bán chạy nhất từ bảng SanPham dựa trên số lượng bán ra
        $hotSalingProducts = Product::orderBy('so_luong_da_ban', 'desc') // Giả sử cột 'so_luong_da_ban' lưu số lượng đã bán
                                    ->take(5) // Lấy top 5 sản phẩm bán chạy nhất
                                    ->get();

        return $hotSalingProducts; // Trả về danh sách sản phẩm bán chạy nhất
    }

    public function recommendWithOrder() {
        // Tìm đơn hàng gần nhất của người dùng dựa trên UserId từ session
        $order_rcm = Order::where('UserId', session('UserId')) // Giả sử bạn đang dùng bảng 'DonHang'
                            ->orderBy('created_at', 'desc') // Lấy đơn hàng mới nhất
                            ->first();

        // Nếu không có đơn hàng, đề xuất sản phẩm bán chạy nhất
        if (!$order_rcm) {
            $rcm = $this->recommendWithHotSaling();
            return $rcm;
        } else {
            // Đề xuất sản phẩm dựa trên đơn hàng đã có
            $recommendedProducts = $this->recommendProductsBasedOnOrder($order_rcm);
            return $recommendedProducts;
        }
    }

    protected function recommendProductsBasedOnOrder($order) {
        // Đề xuất sản phẩm dựa trên lịch sử đơn hàng của người dùng
        // Lấy các sản phẩm mà người dùng đã mua trong đơn hàng (thông qua bảng chi tiết đơn hàng)
        $purchasedProductIds = $order->chiTietDonHangs->pluck('SanPhamId')->toArray(); // Giả sử 'chiTietDonHangs' là quan hệ tới bảng chi tiết đơn hàng

        // Lấy danh mục của các sản phẩm mà người dùng đã mua
        $purchasedCategories = Product::whereIn('id', $purchasedProductIds)
                                      ->pluck('DanhMucId') // Giả sử sản phẩm có liên kết tới bảng danh mục qua cột 'DanhMucId'
                                      ->toArray();

        // Đề xuất các sản phẩm khác trong cùng danh mục mà người dùng đã mua
        $recommendedProducts = Product::whereIn('DanhMucId', $purchasedCategories)
                                      ->whereNotIn('id', $purchasedProductIds) // Không đề xuất lại sản phẩm đã mua
                                      ->take(5) // Lấy tối đa 5 sản phẩm
                                      ->get();

        return $recommendedProducts; // Trả về danh sách sản phẩm đề xuất
    }



}
