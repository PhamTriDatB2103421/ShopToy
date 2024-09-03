@extends('admin_layout')
@section('title')
<title>Tất cả danh mục</title>
@endsection
@section('admin_content')
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Danh sách Danh mục</h4>
                <div class="ms-auto text-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Admin</a></li>
                            <li class="breadcrumb-item active" aria-current="page">All_categories</li>
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
                        <h5 class="card-title">Danh sách danh mục</h5>
                        @if(session('message'))
                            <div class="alert alert-danger">
                                {{ session('message') }}
                            </div>
                        @endif
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Tên danh mục</th>
                                        <th>Giới thiệu danh mục</th>
                                        <th>Danh mục cha</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $category->Name }}</td>
                                        <td>{{ $category->Description }}</td>
                                        <td>{{ $category->Parent_category_id }}</td>
                                        <td class="action-buttons">
                                            <a class="edit-button" href="{{ route('admin.edit_category', ['id' => $category->CategoryId]) }}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a class="delete-button" href="{{ route('admin.remove_category', ['id' => $category->CategoryId]) }}">
                                                <i class="fa fa-times" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Tên danh mục</th>
                                        <th>Giới thiệu danh mục</th>
                                        <th>Danh mục cha</th>
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
