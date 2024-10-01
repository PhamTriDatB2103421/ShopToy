@extends('admin_layout')
@section('title')
<title>Tất cả đơn hàng</title>
@endsection
@section('admin_content')
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Danh sách đơn hàng</h4>
                <div class="ms-auto text-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Admin</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Danh sách đơn hàng</li>
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
                        <h5 class="card-title">Danh sách đơn hàng</h5>
                        @if(session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                        @endif
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Mã đơn hàng</th>
                                        <th>Tên khách hàng</th>
                                        <th>Trạng thái vận chuyển</th>
                                        <th>Trạng thái thanh toán</th>
                                        <th>Tổng tiền</th>
                                        <th>Địa chỉ giao hàng</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->OrderId }}</td>
                                        <td>{{ $order->user->FullName }}</td>
                                        <td>{{ $order->OrderStatus }}</td>
                                        <td>{{ $order->PaymentStatus }}</td>
                                        <td>{{ $order->TotalAmount }}</td>
                                        <td>{{ $order->ShippingAddress}}</td>
                                        <td class="action-buttons">
                                            <a class="edit-button" href="{{ URL::to('/admin/order/detail') .'/'.$order->OrderId }}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                                <a href="{{ URL::to('/admin/order/cancel').'/'.$order->OrderId }}"  class="btn btn-danger">
                                                    <i class="fa fa-times" aria-hidden="true"></i>
                                                </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Mã đơn hàng</th>
                                        <th>Tên khách hàng</th>
                                        <th>Trạng thái vận chuyển</th>
                                        <th>Trạng thái thanh toán</th>
                                        <th>Tổng tiền</th>
                                        <th>Địa chỉ giao hàng</th>
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
