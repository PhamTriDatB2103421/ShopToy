@extends('user_layout')
@section('title')
    <title>Thông tin tài khoản</title>
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
    <div class="user_info-container">
        <!-- Bảng hiển thị thông tin người dùng -->
        <div id="user-info">
            <h2>Thông tin tài khoản</h2>
            <table>
                <tr>
                    <td>Họ tên:</td>
                    <td id="display-name"></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td id="display-email"></td>
                </tr>
                <tr>
                    <td>Số điện thoại:</td>
                    <td id="display-phone"></td>
                </tr>
                <tr>
                    <td>Ngày sinh:</td>
                    <td id="display-birth-date"></td>
                </tr>
                <tr>
                    <td>Địa chỉ:</td>
                    <td id="display-address"></td>
                </tr>
            </table>
            <button id="edit-button">Chỉnh sửa thông tin</button>
        </div>

        <!-- Form chỉnh sửa thông tin (ban đầu ẩn) -->
        <div id="edit-form" style="display: none;">
            <h2>Chỉnh sửa thông tin</h2>
            <form>
                <div class="form-group">
                    <label for="edit-name">Họ tên</label>
                    <input type="text" id="edit-name" name="name" value="" required>
                </div>
                <div class="form-group">
                    <label for="edit-email">Email</label>
                    <input type="email" id="edit-email" name="email" value="" required>
                </div>
                <div class="form-group">
                    <label for="edit-phone">Số điện thoại</label>
                    <input type="tel" id="edit-phone" name="phone" value="" required>
                </div>
                <div class="form-group">
                    <label for="edit-birth-date">Ngày sinh</label>
                    <input type="date" id="edit-birth-date" name="birth-date" value="" required>
                </div>
                <div class="form-group">
                    <label for="edit-address">Địa chỉ</label>
                    <input type="text" id="edit-address" name="address" value="" required>
                </div>
                <div class="button">
                    <button type="button" id="save-button">Lưu thông tin</button>
                    <button type="button" id="cancel-button">Thoát</button>
                </div>
            </form>
        </div>
    </div>
    <!-- xử lý chỉnh sửa thông tin-->
    <script>
        // Hiển thị form chỉnh sửa khi nhấn "Chỉnh sửa thông tin"
        document.getElementById('edit-button').addEventListener('click', function() {
            document.getElementById('user-info').style.display = 'none';
            document.getElementById('edit-form').style.display = 'block';
        });

        // Hàm để lưu thay đổi và cập nhật bảng thông tin
        document.getElementById('save-button').addEventListener('click', function() {
            const name = document.getElementById('edit-name').value;
            const email = document.getElementById('edit-email').value;
            const phone = document.getElementById('edit-phone').value;
            const birthDate = document.getElementById('edit-birth-date').value;
            const address = document.getElementById('edit-address').value;

            // Cập nhật thông tin trong bảng hiển thị
            document.getElementById('display-name').textContent = name;
            document.getElementById('display-email').textContent = email;
            document.getElementById('display-phone').textContent = phone;
            document.getElementById('display-birth-date').textContent = birthDate;
            document.getElementById('display-address').textContent = address;

            // Ẩn form chỉnh sửa và quay lại bảng thông tin
            document.getElementById('edit-form').style.display = 'none';
            document.getElementById('user-info').style.display = 'block';
        });

        // Thoát chỉnh sửa, quay lại bảng thông tin
        document.getElementById('cancel-button').addEventListener('click', function() {
            document.getElementById('edit-form').style.display = 'none';
            document.getElementById('user-info').style.display = 'block';
        });
    </script>
@endsection
