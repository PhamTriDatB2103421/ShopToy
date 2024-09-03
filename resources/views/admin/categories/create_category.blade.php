@extends('admin_layout')
@section('title')
<title>Thêm danh mục sản phẩm</title>
@endsection
@section('admin_content')
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Thêm Danh mục</h4>
                <div class="ms-auto text-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Admin</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Add_Category
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
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form class="form-horizontal" method="POST" action="{{ route('admin.store_category') }}">
                        @csrf
                        <div class="card-body">
                            <h4 class="card-title">Thêm Danh mục</h4>
                            @if(session('message'))
                                <div class="alert alert-danger">
                                    {{ session('message') }}
                                </div>
                            @endif
                            <div class="form-group row">
                                <label for="name" class="col-sm-3 text-end control-label col-form-label">Tên danh mục</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên danh mục" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="description" class="col-sm-3 text-end control-label col-form-label">Giới thiệu</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="description" name="description" placeholder="Nhập giới thiệu" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="parent_category_id" class="col-sm-3 text-end control-label col-form-label">Danh mục cha</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="parent_category_id" name="parent_category_id" placeholder="Nhập ID danh mục cha" />
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
