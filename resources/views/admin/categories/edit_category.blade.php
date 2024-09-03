@extends('admin_layout')
@section('title')
<title>Chỉnh sửa danh mục</title>
@endsection
@section('admin_content')
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Chỉnh sửa Danh mục</h4>
                <div class="ms-auto text-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Admin</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Edit_Category
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
                    <form class="form-horizontal" method="POST" action="{{ route('admin.update_category', ['id' => $category->CategoryId]) }}">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <h4 class="card-title">Chỉnh sửa Danh mục</h4>
                            @if(session('message'))
                                <div class="alert alert-danger">
                                    {{ session('message') }}
                                </div>
                            @endif
                            <div class="form-group row">
                                <label for="name" class="col-sm-3 text-end control-label col-form-label">Tên danh mục</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên danh mục" value="{{ $category->Name }}" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="description" class="col-sm-3 text-end control-label col-form-label">Giới thiệu</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="description" name="description" placeholder="Nhập giới thiệu" value="{{ $category->Description }}" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="parent_category_id" class="col-sm-3 text-end control-label col-form-label">Danh mục cha</label>
                                <div class="col-sm-9">
                                    <select class="form-select" id="parent_category_id" name="parent_category_id">
                                        <option value="" selected>Không có</option>
                                        @foreach ($categories as $parent)
                                            <option value="{{ $parent->CategoryId }}">{{ $parent->Name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="border-top">
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
