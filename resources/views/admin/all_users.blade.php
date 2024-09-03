@extends('admin_layout')
@section('title')
<title>Danh sách tài khoản</title>
@endsection
@section('admin_content')

          <!-- Page wrapper  -->
      <!-- ============================================================== -->
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
                      All_Users
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
          <!-- ============================================================== -->
          <!-- Start Page Content -->
          <!-- ============================================================== -->
          <div class="row">
            <div class="col-12">

              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Danh sách Users</h5>
                  @if(session('message'))
                  <div class="alert alert-danger">
                      {{ session('message') }}
                  </div>
                 @endif
                  <div class="table-responsive">
                    <table id="zero_config" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>UserName</th>
                          <th>Email</th>
                          <th>Họ và tên</th>
                          <th>Số điện thoại</th>
                          <th>Địa chỉ</th>
                          <th>Quyền</th>
                          <th>Hành động</th> <!-- Thêm tiêu đề cột cho các nút -->
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($all_users as $users)
                        <tr>
                            <td>{{ $users->Username }}</td>
                            <td>{{ $users->Email }}</td>
                            <td>{{ $users->FullName }}</td>
                            <td>{{ $users->PhoneNumber }}</td>
                            <td>{{ $users->Address }}</td>
                            <td>{{ $users->Role }}</td>
                            <td class="action-buttons">
                                <a class="edit-button" href="{{ route('admin.edit_user', ['email' => $users->Email]) }}">
                                    <i class="fas fa-edit"></i>
                                </a>

                              <a class="delete-button" href="{{ route('admin.remove_user', ['email' => $users->Email]) }}">
                                <i class="fa fa-times" aria-hidden="true"></i>
                              </a>

                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                      <tfoot>
                        <tr>
                            <th>UserName</th>
                            <th>Email</th>
                            <th>Họ và tên</th>
                            <th>Số điện thoại</th>
                            <th>Địa chỉ</th>
                            <th>Quyền</th>
                            <th>Hành động</th>> <!-- Thêm tiêu đề cột cho các nút -->
                        </tr>
                      </tfoot>
                    </table>
                  </div>

                </div>
              </div>
              <!-- ============================================================== -->
              <!-- End PAge Content -->
              <!-- ============================================================== -->
              <!-- ============================================================== -->
              <!-- Right sidebar -->
              <!-- ============================================================== -->
              <!-- .right-sidebar -->
              <!-- ============================================================== -->
              <!-- End Right sidebar -->
              <!-- ============================================================== -->
            </div>


@endsection
