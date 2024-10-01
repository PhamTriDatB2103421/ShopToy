@extends('admin_layout')
@section('title')
    <title>Danh sách sản phẩm trong đơn hàng</title>
@endsection
@section('admin_content')
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">Đơn hàng</h4>
                    <div class="ms-auto text-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Admin</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Danh sách sản phẩm trong đơn hàng
                                    {{ $order->OrderId }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Thông tin đơn hàng</h5>
                            @if (session('message'))
                                <div class="alert alert-success">
                                    {{ session('message') }}
                                </div>
                            @endif
                            <div class="table-responsive">
                                <table id="noen" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Mã Đơn Hàng</th>
                                            <th>Tên khách hàng</th>
                                            <th>Trạng thái vận chuyển</th>
                                            <th>Trạng thái thanh toán</th>
                                            <th>Tổng tiền</th>
                                            <th>Địa chỉ giao hàng</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $order->OrderId }}</td>
                                            <td>{{ $order->user->FullName }}</td>

                                            <!-- Combobox cho Order Status -->
                                            <td>
                                                <select name="OrderStatus" form="orderForm_{{ $order->OrderId }}">
                                                    <option value="Pending"
                                                        {{ $order->OrderStatus == 'Pending' ? 'selected' : '' }}>Pending
                                                    </option>
                                                    <option value="Processing"
                                                        {{ $order->OrderStatus == 'Processing' ? 'selected' : '' }}>Shipped
                                                    </option>
                                                    <option value="Delivered"
                                                        {{ $order->OrderStatus == 'Delivered' ? 'selected' : '' }}>Delivered
                                                    </option>
                                                    <option value="Cancelled"
                                                        {{ $order->OrderStatus == 'Cancelled' ? 'selected' : '' }}>Cancelled
                                                    </option>
                                                </select>
                                            </td>

                                            <!-- Combobox cho Payment Status -->
                                            <td>
                                                <select name="PaymentStatus" form="orderForm_{{ $order->OrderId }}">
                                                    <option value="Pending"
                                                        {{ $order->PaymentStatus == 'Pending' ? 'selected' : '' }}>Pending
                                                    </option>
                                                    <option value="Paid"
                                                        {{ $order->PaymentStatus == 'Paid' ? 'selected' : '' }}>Paid
                                                    </option>
                                                    <option value="Refunded"
                                                        {{ $order->PaymentStatus == 'Refunded' ? 'selected' : '' }}>Pending
                                                    </option>
                                                </select>
                                            </td>

                                            <td>{{ $order->TotalAmount }}</td>
                                            <td>{{ $order->ShippingAddress }}</td>

                                            <td class="action-buttons">
                                                <!-- Form để submit -->
                                                <form id="orderForm_{{ $order->OrderId }}"
                                                    action="{{ URL::to('/admin/order/ad_edit') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="OrderId" value="{{ $order->OrderId }}">
                                                    <!-- Nút chỉnh sửa -->
                                                    <button type="submit" style="border: 0px; justify-content: center; align-content: center;" class="edit-button">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                                <h5 class="card-title" style="color: red;">Danh sách Sản phẩm của đơn hàng
                                    {{ $order->OrderId }}</h5>

                                <table id="zero_config" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Tên sản phẩm</th>
                                            <th>Số lượng</th>
                                            <th>Giá</th>
                                            <th>Tổng tiền</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orderItems as $orderItem)
                                            <tr>
                                                <td>{{ $orderItem->Product->Name }}</td>

                                                <!-- Số lượng có thể chỉnh sửa -->
                                                <td>
                                                    <input type="number" name="Quantity"
                                                        value="{{ $orderItem->Quantity }}"
                                                        form="editForm_{{ $orderItem->OrderItemId }}"
                                                        onchange="updateTotalPrice(this, {{ $orderItem->UnitPrice }}, 'totalPrice_{{ $orderItem->OrderItemId }}')">
                                                </td>

                                                <!-- Hiển thị đơn giá mà không chỉnh sửa -->
                                                <td>{{ $orderItem->UnitPrice }}</td>

                                                <!-- Hiển thị tổng tiền và cập nhật khi số lượng thay đổi -->
                                                <td id="totalPrice_{{ $orderItem->OrderItemId }}">
                                                    {{ $orderItem->TotalPrice }}</td>

                                                <td class="action-buttons"
                                                    style="display: flex;
                                                           flex-direction: row;
                                                           justify-content: center;">
                                                    <!-- Form để submit thông tin chỉnh sửa -->
                                                    <form id="editForm_{{ $orderItem->OrderItemId }}"
                                                        action="{{ URL::to('/admin/order/orderitem/edit') }}"
                                                        method="post">
                                                        @csrf
                                                        <input type="hidden" name="OrderItemId"
                                                            value="{{ $orderItem->OrderItemId }}">
                                                        <!-- Nút chỉnh sửa -->
                                                        <button type="submit" style="border: 0px; justify-content: center; align-content: center;" class="edit-button">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                    </form>

                                                    <!-- Nút xóa -->
                                                    <a href="{{ URL::to('/admin/order/orderitem/remove') . '/' . $orderItem->OrderItemId }}"
                                                        class="edit-button">
                                                        <i class="fa fa-times" style="color: red;" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach

                                        <!-- JavaScript để cập nhật tổng tiền -->
                                        <script>
                                            function updateTotalPrice(quantityInput, unitPrice, totalPriceId) {
                                                let quantity = quantityInput.value;
                                                let totalPrice = quantity * unitPrice;

                                                // Cập nhật tổng tiền
                                                document.getElementById(totalPriceId).textContent = totalPrice.toFixed(0); // Hiển thị tổng tiền mới
                                            }
                                        </script>


                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Tên sản phẩm</th>
                                            <th>Số lượng</th>
                                            <th>Tổng tiền</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
