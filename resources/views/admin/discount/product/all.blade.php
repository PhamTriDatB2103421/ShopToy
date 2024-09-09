@extends('admin_layout')
@section('title')
    <title>Danh sách sản phẩm được giảm giá của {{ $discount->DiscountCode }}</title>
@endsection

@section('admin_content')
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Danh sách sản phẩm giảm giá của {{ $discount->DiscountCode }}</h4>
                <div class="ms-auto text-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Admin</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Danh sách sản phẩm giảm giá</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Danh sách sản phẩm</h5>
                        <a href="{{ url('/discount/product/add') }}">Thêm sản phẩm</a>
                        @if(session('message'))
                            <div class="alert alert-danger">
                                {{ session('message') }}
                            </div>
                        @endif
                        @if ($products->isEmpty())
                            <p>Không có sản phẩm nào với mã giảm giá này.</p>
                            <a href="{{ url('/discount/product/add') }}">Thêm sản phẩm</a>
                        @else
                            <div class="table-responsive">
                                <table
                                id="zero_config"
                                class="table table-striped table-bordered"
                              >
                                    <thead>
                                        <tr>
                                            <th>Mã giảm giá</th>
                                            <th>Tên sản phẩm</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                            <tr>
                                                <td>{{ $discount->DiscountCode }}</td>
                                                <td>{{ $product->Name }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Mã giảm giá</th>
                                            <th>Tên sản phẩm</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
