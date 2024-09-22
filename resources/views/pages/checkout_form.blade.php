@extends('user_layout')
@section('title')
    <title>Thanh toán</title>
@endsection
@section('cart')
    @foreach ($cartItems as $item)
        @php
            $product = $item->product;
            $productName = $product ? $product->Name : 'Unknown Product';
            $productPrice = $product ? $product->Price : 0;
            $imageUrl =
                $product && $product->images && $product->images->isNotEmpty()
                    ? $product->images->first()->ImageUrl
                    : 'path/to/default/image.jpg';
            $quantity = $item->Quantity ?? 0;
            $totalPrice = $productPrice * $quantity;
        @endphp
        <div class="product-widget">
            <div class="product-img">
                <img src="{{ asset('storage/' . $imageUrl) }}" alt="{{ $productName }}">
            </div>
            <div class="product-body">
                <h3 class="product-name"><a href="#">{{ $productName }}</a></h3>
                <h4 class="product-price">
                    <span class="qty">{{ $quantity }}x</span>{{ number_format($totalPrice, 0, ',', '.') }}đ
                </h4>
            </div>
            <button class="delete" data-cart-item-id="{{ $item->CartItemId }}"><i class="fa fa-close"></i></button>
        </div>
    @endforeach
@endsection
@section('user_content')
    <!-- BREADCRUMB -->
    <div id="breadcrumb" class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="breadcrumb-header">Thanh toán</h3>
                    <ul class="breadcrumb-tree">
                        <li><a href="{{ url('/') }}">Trang chủ</a></li>
                        <li class="active">Thanh toán</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- /BREADCRUMB -->
    <!-- SECTION -->
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <!-- Billing Details -->
                    <div class="billing-details">
                        <div class="section-title">
                            <h3 class="title">Thông tin thanh toán</h3>
                        </div>
                        <form action="{{ route('order.submit', ['cartId' => $cartId]) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input class="input" type="text" id="coupon_code" name="coupon_code"
                                    placeholder="Nhập mã giảm giá">
                                <button type="button" id="apply_coupon" class="btn btn-primary">Áp dụng</button>
                                <div id="coupon_message"></div>
                            </div>
                            <div class="form-group">
                                <input class="input" type="text" name="fullname" placeholder="Tên"
                                    value="{{ Session::get('FullName') }}" required>
                            </div>
                            <div class="form-group">
                                <input class="input" type="email" name="email" placeholder="Email"
                                    value="{{ Session::get('Email') }}" required>
                            </div>
                            <div class="form-group">
                                <input class="input" type="text" name="address" placeholder="Địa chỉ"
                                    value="{{ $address ?? '' }}" required>
                            </div>
                            <div class="form-group">
                                <input class="input" type="tel" name="tel" placeholder="Số điện thoại"
                                    value="{{ Session::get('PhoneNumber') }}" required>
                            </div>
                            <!-- Shipping Details -->
                            <!-- Order notes -->
                            <div class="order-notes">
                                <textarea class="input" name="order_notes" placeholder="Ghi chú đơn hàng"></textarea>
                            </div>
                            <!-- /Order notes -->

                            <!-- Submit Button -->
                            <button type="submit" class="primary-btn order-submit">Đặt hàng</button>
                        </form>
                    </div>
                </div>
                <!-- Order Details -->
                <div class="col-md-5 order-details">
                    <div class="section-title text-center">
                        <h3 class="title">Chi tiết đơn hàng</h3>
                    </div>
                    <div class="order-summary">
                        <div class="order-col">
                            <div><strong>SẢN PHẨM</strong></div>
                            <div><strong>TỔNG</strong></div>
                        </div>
                        <div class="order-products">
                            @foreach ($cartItems as $cartItem)
                                <div class="order-col">
                                    <div>{{ $cartItem->Quantity }}x {{ $cartItem->product->Name }}</div>
                                    <div>{{ number_format($cartItem->product->Price * $cartItem->Quantity, 0, ',', '.') }}
                                        VNĐ</div>
                                </div>
                            @endforeach
                        </div>
                        <div class="order-col">
                            <div>Vận chuyển</div>
                            <div><strong>MIỄN PHÍ</strong></div>
                        </div>
                        <div class="order-col">
                            <div><strong>TỔNG CỘNG</strong></div>
                            <div><strong
                                    class="order-total">{{ number_format(
                                        $cartItems->sum(function ($cartItem) {
                                            return $cartItem->product->Price * $cartItem->Quantity;
                                        }),
                                        0,
                                        ',',
                                        '.',
                                    ) }}
                                    VNĐ</strong></div>
                        </div>
                    </div>
                    <!-- Removed duplicate form tag -->
                </div>
            </div>
        </div>
        <!-- /SECTION -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const applyCouponButton = document.getElementById('apply_coupon');
                const couponCodeInput = document.getElementById('coupon_code');
                const couponMessage = document.getElementById('coupon_message');
                const totalElement = document.querySelector(
                    '.order-total'); // Assuming you have a class 'order-total' to show the total

                applyCouponButton.addEventListener('click', function() {
                    const couponCode = couponCodeInput.value.trim();

                    if (!couponCode) {
                        couponMessage.textContent = 'Vui lòng nhập mã giảm giá.';
                        couponMessage.style.color = 'red';
                        return;
                    }

                    // Gửi yêu cầu AJAX đến server để kiểm tra mã giảm giá
                    fetch('{{ route('order.apply_coupon') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                coupon_code: couponCode
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                couponMessage.textContent = 'Mã giảm giá đã được áp dụng.';
                                couponMessage.style.color = 'green';

                                // Cập nhật tổng số tiền
                                totalElement.textContent = data.new_total;
                            } else {
                                couponMessage.textContent = data.error;
                                couponMessage.style.color = 'red';
                            }
                        })
                        .catch(error => {
                            couponMessage.textContent = 'Đã xảy ra lỗi. Vui lòng thử lại.' + error;
                            couponMessage.style.color = 'red';
                        });
                });
            });
        </script>
    @endsection
