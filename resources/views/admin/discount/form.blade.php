@extends('admin_layout')
@section('title')
    <title>{{ isset($discount) ? 'Cập nhật mã' : 'Thêm mới mã' }}</title>
@endsection

@section('admin_content')
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">{{ isset($discount) ? 'Cập nhật mã' : 'Thêm mã' }}</h4>
                    <div class="ms-auto text-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Admin</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    {{ isset($discount) ? 'Cập nhật mã' : 'Thêm mã' }}</li>
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
                        <form class="form-horizontal" method="POST" enctype="multipart/form-data"
                            action="{{ isset($discount) ? route('admin.edit_exce_discount', $discount->DiscountId) : route('admin.store_discount') }}">
                            @csrf
                            <div class="card-body">
                                <h4 class="card-title">{{ isset($discount) ? 'Cập nhật' : 'Thêm mới' }}</h4>
                                @if (session('message'))
                                    <div class="alert alert-success">
                                        {{ session('message') }}
                                    </div>
                                @endif
                                <div class="form-group row">
                                    <label for="name" class="col-sm-3 text-end control-label col-form-label">Mã giảm
                                        giá</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="name" name="DiscountCode"
                                            value="{{ old('DiscountCode', $discount->DiscountCode ?? '') }}"
                                            placeholder="Nhập tên mã giảm" />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="description" class="col-sm-3 text-end control-label col-form-label">Mô
                                        tả</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" id="description" name="Description" placeholder="Nhập mô tả mã">{{ old('description', $discount->Description ?? '') }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="price"
                                        class="col-sm-3 text-end control-label col-form-label">Dạng</label>
                                    <div class="col-sm-9">
                                        <select class="form-select" id="category_id" name="DiscountType">
                                            <option value="Fixed Amount"
                                                {{ isset($discount) && old('DiscountType', $discount->DiscountType) == 'Fixed Amount' ? 'selected' : '' }}>
                                                Fixed Amount
                                            </option>
                                            <option value="Percentage"
                                                {{ isset($discount) && old('DiscountType', $discount->DiscountType) == 'Percentage' ? 'selected' : '' }}>
                                                Percentage
                                            </option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="stock" class="col-sm-3 text-end control-label col-form-label">Giá trị
                                        giảm</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" id="stock" name="DiscountValue"
                                            value="{{ old('DiscountValue', $discount->DiscountValue ?? '') }}"
                                            placeholder="Nhập số lượng mã giảm" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="stock" class="col-sm-3 text-end control-label col-form-label">Ngày bắt
                                        đầu</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control" id="start_date" name="StartDate"
                                            value="{{ old('StartDate', $discount->StartDate ?? '') }}"
                                            placeholder="Nhập ngày bắt đầu" />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="stock" class="col-sm-3 text-end control-label col-form-label">Ngày kết
                                        thúc</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control" id="end_date" name="EndDate"
                                            value="{{ old('EndDate', $discount->EndDate ?? '') }}"
                                            placeholder="Nhập ngày kết thúc" />
                                    </div>
                                </div>


                                <div class="border-top">
                                    <div class="card-body">
                                        <button type="submit"
                                            class="btn btn-primary">{{ isset($discount) ? 'Cập nhật' : 'Thêm mới' }}</button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.remove-image').forEach(function(button) {
                button.addEventListener('click', function() {
                    this.closest('.input-group').remove();
                });
            });
        });
    </script>
@endsection
