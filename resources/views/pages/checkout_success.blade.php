@extends('user_layout')

@section('title')
    <title>Đặt hàng thành công</title>
@endsection

@section('user_content')
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="order-confirmation">
                        <div class="section-title text-center">
                            <h3 class="title">Cảm ơn bạn đã đặt hàng!</h3>
                        </div>
                        <p>Đơn hàng của bạn đã được đặt thành công. Chúng tôi sẽ xử lý và giao hàng đến bạn trong thời gian sớm nhất.</p>
                        <p>Mã đơn hàng của bạn là: <strong>{{ $order->OrderId }}</strong></p>
                        <!-- Hiển thị chi tiết đơn hàng -->
                        <div class="order-details">
                            <h4>Chi tiết đơn hàng:</h4>
                            @foreach ($order->orderItems as $item)
                                <div>{{ $item->Quantity }}x {{ $item->product->Name }} - {{ number_format($item->UnitPrice * $item->Quantity, 0, ',', '.') }} VNĐ</div>
                            @endforeach
                            <div><strong>Tổng cộng:</strong> {{ number_format($order->TotalAmount, 0, ',', '.') }} VNĐ</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
