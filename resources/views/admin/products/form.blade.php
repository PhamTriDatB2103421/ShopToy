@extends('admin_layout')
@section('title')
<title>{{ isset($product) ? 'Cập nhật Sản phẩm' : 'Thêm mới Sản phẩm' }}</title>
@endsection

@section('admin_content')
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">{{ isset($product) ? 'Cập nhật Sản phẩm' : 'Thêm Sản phẩm' }}</h4>
                <div class="ms-auto text-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Admin</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ isset($product) ? 'Cập nhật sản phẩm' : 'Thêm sản phẩm' }}</li>
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
                    <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="{{ isset($product) ? route('admin.update_product', $product->ProductId) : route('admin.store_product') }}">
                        @csrf
                        <div class="card-body">
                            <h4 class="card-title">{{ isset($product) ? 'Cập nhật' : 'Thêm mới' }}</h4>
                            @if(session('message'))
                                <div class="alert alert-success">
                                    {{ session('message') }}
                                </div>
                            @endif
                            <div class="form-group row">
                                <label for="name" class="col-sm-3 text-end control-label col-form-label">Tên sản phẩm</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->Name ?? '') }}" placeholder="Nhập tên sản phẩm" />
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-sm-3 text-end control-label col-form-label">Mô tả</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" id="description" name="description" placeholder="Nhập mô tả sản phẩm">{{ old('description', $product->Description ?? '') }}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="price" class="col-sm-3 text-end control-label col-form-label">Giá</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="price" name="price" value="{{ old('price', $product->Price ?? '') }}" placeholder="Nhập giá sản phẩm" />
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="stock" class="col-sm-3 text-end control-label col-form-label">Số lượng</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="stock" name="stock" value="{{ old('stock', $product->Stock ?? '') }}" placeholder="Nhập số lượng sản phẩm" />
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="category_id" class="col-sm-3 text-end control-label col-form-label">Danh mục</label>
                                <div class="col-sm-9">
                                    <select class="form-select" id="category_id" name="category_id">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->CategoryId }}" {{ (old('category_id', $product->CategoryId ?? '') == $category->CategoryId) ? 'selected' : '' }}>
                                                {{ $category->Name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="images" class="col-sm-3 text-end control-label col-form-label">Hình ảnh</label>
                                <div class="col-sm-9">
                                    @if(isset($images) && count($images) > 0)
                                        @foreach($images as $index => $image)
                                            <div class="input-group mb-3">
                                                <input type="file" name="existing_images[]" class="form-control" placeholder="Tải ảnh lên để thay đổi">
                                                <img src="{{ asset('storage/' . $image->ImageUrl) }}" alt="Product Image" width="100" />
                                                <button class="btn btn-danger remove-image" type="button">Xóa</button>
                                            </div>
                                        @endforeach
                                    @endif
                                    @if(isset($product))
                                        @for($i = 0; $i < (3 - count($images)); $i++)
                                        <input type="file" class="form-control mt-2" name="images[]" />
                                        @endfor
                                    @else
                                        <input type="file" class="form-control mt-2" name="images[]" />
                                        <input type="file" class="form-control mt-2" name="images[]" />
                                        <input type="file" class="form-control mt-2" name="images[]" />
                                    @endif


                                </div>
                            </div>

                        </div>

                        <div class="border-top">
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary">{{ isset($product) ? 'Cập nhật' : 'Thêm mới' }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.remove-image').forEach(function(button) {
            button.addEventListener('click', function () {
                this.closest('.input-group').remove();
            });
        });
    });
</script>
@endsection
