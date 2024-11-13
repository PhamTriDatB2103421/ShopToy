@extends('admin_layout')
@section('title')
    <title>Trang chủ</title>
@endsection
@section('admin_content')
    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">Dashboard</h4>
                    <div class="ms-auto text-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Library
                                </li>
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
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="row">
                                        <!-- Thông tin user -->
                                        <div class="col-6">
                                            <div class="bg-dark p-10 text-white text-center">
                                                <i class="mdi mdi-account fs-3 mb-1 font-16"></i>
                                                <h5 class="mb-0 mt-1">{{ $totalUser }}</h5>
                                                <small class="font-light">Tất cả user</small>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="bg-dark p-10 text-white text-center">
                                                <i class="mdi mdi-plus fs-3 font-16"></i>
                                                <h5 class="mb-0 mt-1">{{ $newUser }}</h5>
                                                <small class="font-light">User mới</small>
                                            </div>
                                        </div>
                                        <div class="col-6 mt-3">
                                            <div class="bg-dark p-10 text-white text-center">
                                                <i class="mdi mdi-cart fs-3 mb-1 font-16"></i>
                                                <h5 class="mb-0 mt-1">{{ $totalCart }}</h5>
                                                <small class="font-light">Được lưu trong giỏ hàng</small>
                                            </div>
                                        </div>
                                        <div class="col-6 mt-3">
                                            <div class="bg-dark p-10 text-white text-center">
                                                <i class="mdi mdi-tag fs-3 mb-1 font-16"></i>
                                                <h5 class="mb-0 mt-1">{{ $totalOrder }}</h5>
                                                <small class="font-light">Tổng các đơn đã đặt</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Thêm hàng thẻ form với bảng lịch -->
                                <div class="col-lg-9 mt-4">
                                    <form method="POST" action="{{ route('revenue') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="month-picker">Chọn tháng để xem doanh thu:</label>
                                            <select id="month-picker" name="month" class="form-control" required>
                                                <option value="">-- Chọn tháng --</option>
                                                @for ($i = 1; $i <= 12; $i++)
                                                    <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}">
                                                        {{ 'Tháng ' . $i }}</option>
                                                @endfor
                                            </select>
                                            <select id="year-picker" name="year" class="form-control mt-2" required>
                                                <option value="">-- Chọn năm --</option>
                                                @for ($year = date('Y'); $year >= date('Y') - 10; $year--)
                                                    <option value="{{ $year }}">{{ $year }}</option>
                                                @endfor
                                            </select>
                                            <button type="submit" class="btn btn-primary mt-2">Hiển thị doanh thu</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-lg-9 mt-4">
                                    <!-- Hiển thị doanh thu nếu đã tính toán -->
                                    @if (isset($totalRevenue))
                                        <div class="row mt-4">
                                            <div class="col-12">
                                                <div class="bg-success p-10 text-white text-center">
                                                    <h5 class="mb-0 mt-1">Doanh thu tháng
                                                        {{ $month }}/{{ $yeards }}:</h5>
                                                    <h3 class="font-weight-bold">
                                                        {{ number_format($totalRevenue, 0, ',', '.') }} VNĐ</h3>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
