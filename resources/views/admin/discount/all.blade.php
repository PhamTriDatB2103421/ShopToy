@extends('admin_layout')
@section('title')
<title>Mã giảm giá</title>
@endsection
@section('admin_content')

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Danh sách Mã giảm giá</h4>
                <div class="ms-auto text-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Admin</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Mã giảm giá</li>
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
                        <h5 class="card-title">Danh sách mã</h5>
                        @if(session('message'))
                            <div class="alert alert-danger">
                                {{ session('message') }}
                            </div>
                        @endif
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Mã giảm giá</th>
                                        <th>Giới thiệu mã</th>
                                        <th>Dạng mã</th>
                                        <th>Giá trị giảm</th>
                                        <th>Ngày bất đầu</th>
                                        <th>Ngày kết thúc</th>
                                        <th>Sản Phẩm</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($discounts as $discount)
                                    <tr>
                                        <td>{{ $discount->DiscountCode }}</td>
                                        <td>{{ $discount->Description }}</td>
                                        <td>{{ $discount->DiscountType }}</td>
                                        <td>{{ $discount->DiscountValue }}</td>

                                        <td>{{ $discount->StartDate }}</td>
                                        <td>{{ $discount->EndDate }}</td>
                                        <td><a href="{{ URL::to('admin/discount/product/').'/'.$discount->DiscountId }}">
                                            <i class="mdi mdi-eye"></i>
                                        </a></td>
                                        <td class="action-buttons">
                                            <a class="edit-button" href="{{ URL::to('/admin/discount/edit').'/'.$discount->DiscountId }}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.destroy_discount', $discount->DiscountId) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fa fa-times" aria-hidden="true"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Mã giảm giá</th>
                                        <th>Giới thiệu mã</th>
                                        <th>Dạng mã</th>
                                        <th>Giá trị giảm</th>
                                        <th>Ngày bất đầu</th>
                                        <th>Ngày kết thúc</th>
                                        <th>Sản Phẩm</th>
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
