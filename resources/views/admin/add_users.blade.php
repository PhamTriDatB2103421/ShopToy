@extends('admin_layout')
@section('title')
    <title>Thêm User</title>
@endsection
@section('admin_content')
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">Danh sách Users</h4>
                    <div class="ms-auto text-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Admin</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Add_User
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
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
                        <form class="form-horizontal" id="editUserForm" method="POST"
                            action="{{ route('admin.save_add_user') }}">
                            @csrf
                            <div class="card-body">
                                <h4 class="card-title">Thêm User</h4>
                                @if ($errors->has('email'))
                                    <div class="alert alert-danger">
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif

                                <div class="form-group row">
                                    <label for="fname"
                                        class="col-sm-3 text-end control-label col-form-label">Username</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="fname" name="username"
                                            placeholder="Nhập Username" />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="lname"
                                        class="col-sm-3 text-end control-label col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control" id="lname" name="email"
                                            placeholder="Nhập email" />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password-edit" class="col-sm-3 text-end control-label col-form-label">Mật
                                        khẩu</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" id="password-edit" name="password"
                                            placeholder="Nhập Password" />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="test_password" class="col-sm-3 text-end control-label col-form-label">Xác
                                        nhận Mật khẩu</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" id="test_password"
                                            name="confirm_password" placeholder="Nhập lại Password" />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="name" class="col-sm-3 text-end control-label col-form-label">Họ và
                                        tên</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Nhập tên" />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="address" class="col-sm-3 text-end control-label col-form-label">Địa
                                        chỉ</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="address" name="address"
                                            placeholder="Nhập địa chỉ" />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="phoneNumber" class="col-sm-3 text-end control-label col-form-label">Số điện
                                        thoại</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="phoneNumber" name="phoneNumber"
                                            placeholder="Nhập số điện thoại" />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-3 text-end control-label col-form-label">Quyền</label>
                                    <div class="col-md-9">
                                        <select class="form-select shadow-none" style="width: 100%; height: 36px"
                                            name="role">
                                            <option value="Admin">Admin</option>
                                            <option value="Customer">Customer</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="border-top">
                                <div class="card-body">
                                    <button type="submit" class="btn btn-primary">Thêm</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
