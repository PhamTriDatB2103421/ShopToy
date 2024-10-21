<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="robots" content="noindex,nofollow" />
    @yield('title')
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" href="{{ asset('frontend/img/logo.png') }}" />
    <!-- Custom CSS -->
    <link href="{{ asset('Backend/assets/libs/flot/css/float-chart.css') }}" rel="stylesheet" />
    <link href="{{ asset('Backend/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="{{ asset('Backend/dist/css/style.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('Backend/assets/custom_css.css') }}" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="{{ asset('Backend/assets/extra-libs/multicheck/multicheck.css') }}">
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin5">
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="{{ url('admin/index') }}">
                        <!-- Logo icon -->
                        <b class="logo-icon ps-2">
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="{{ asset('frontend/img/logo.png') }}" alt="homepage" class="light-logo"
                                style="" width="120px" />
                        </b>
                    </a>

                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                            class="ti-menu ti-close"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-start me-auto">
                        <li class="nav-item d-none d-lg-block">
                            <a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)"
                                data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a>
                        </li>
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        <li class="nav-item search-box">
                            <a class="nav-link waves-effect waves-dark" href="javascript:void(0)"><i
                                    class="mdi mdi-magnify fs-4"></i></a>
                            <form class="app-search position-absolute">
                                <input type="text" class="form-control" placeholder="Search &amp; enter" />
                                <a class="srh-btn"><i class="mdi mdi-window-close"></i></a>
                            </form>
                        </li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-end">
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="
                    nav-link
                    dropdown-toggle
                    text-muted
                    waves-effect waves-dark
                    pro-pic
                  "
                                href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <img src="{{ asset('Backend/assets/images/users/1.jpg') }}" alt="user"
                                    class="rounded-circle" width="31" />
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end user-dd animated"
                                aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('info_user', session('UserId')) }}"><i
                                        class="mdi mdi-account me-1 ms-1"></i>Thông tin cá nhân</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ url('/') }}"><i
                                    class="fas fa-sync"></i>Chuyển sang giao diện shop</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ url('logout') }}"><i
                                        class="fa fa-power-off me-1 ms-1"></i> Logout</a>
                                <div class="dropdown-divider"></div>

                            </ul>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin5">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav" class="pt-4">
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="{{ url('admin/index') }}" aria-expanded="false"><i
                                    class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                                aria-expanded="false"><i class="fa fa-user"></i><span
                                    class="hide-menu">Users</span></a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item">
                                    <a href="{{ url('admin/all_users') }}" class="sidebar-link"><i
                                            class="fa fa-users"></i><span class="hide-menu">Danh sách Users</span></a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ url('admin/add_user') }}" class="sidebar-link"><i
                                            class="fa fa-user-plus"></i><span class="hide-menu">Thêm User</span></a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                                aria-expanded="false"><i class="fas fa-bars"></i><span class="hide-menu">Danh mục sản
                                    phẩm</span></a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item">
                                    <a href="{{ url('admin/categories') }}" class="sidebar-link"><i
                                            class="fas fa-bars"></i></i><span class="hide-menu">Danh sách danh
                                            mục</span></a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ url('admin/categories/create') }}" class="sidebar-link"><i
                                            class="fas fa-plus"></i><span class="hide-menu">Thêm danh mục</span></a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                                aria-expanded="false">
                                <i class="fas fa-gamepad"></i>
                                <span class="hide-menu">Sản phẩm</span>
                            </a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item">
                                    <a href="{{ url('admin/all_products') }}" class="sidebar-link">
                                        <i class="fas fa-gamepad"></i>
                                        <span class="hide-menu">Danh sách sản phẩm</span>
                                    </a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ url('admin/add_product') }}" class="sidebar-link">
                                        <i class="fa fa-plus"></i>
                                        <span class="hide-menu">Thêm sản phẩm</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                                aria-expanded="false"><i class="mdi mdi-tag-multiple"></i><span
                                    class="hide-menu">Danh sách mã giảm giá</span></a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item">
                                    <a href="{{ url('admin/discount') }}" class="sidebar-link"><i
                                            class="mdi mdi-tag-multiple"></i></i><span class="hide-menu">Danh sách
                                            mã</span></a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ url('admin/discount/add') }}" class="sidebar-link"><i
                                            class="mdi mdi-tag-plus"></i><span class="hide-menu">Thêm mã</span></a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)"
                                aria-expanded="false"><i class="fas fa-shopping-bag"></i><span
                                    class="hide-menu">Danh sách đơn hàng</span></a>
                            <ul aria-expanded="false" class="collapse first-level">
                                <li class="sidebar-item">
                                    <a href="{{ url('admin/order/list') }}" class="sidebar-link"><i
                                            class="fas fa-shopping-cart"></i></i><span class="hide-menu">Danh sách đơn</span></a>
                                </li>
                                <li class="sidebar-item">
                                    <a href="{{ url('admin/order/reveneu') }}" class="sidebar-link"><i
                                            class="fas fa-chart-pie"></i><span class="hide-menu">Thống kê danh thu</span></a>
                                </li>
                            </ul>
                        </li>


                    </ul>
                </nav>

            </div>

        </aside>

        @yield('admin_content')


        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('.delete-button').forEach(button => {
                    button.addEventListener('click', function(event) {
                        if (!confirm('Bạn có chắc chắn muốn xóa chứ?')) {
                            event.preventDefault();
                        }
                    });
                });
            });
        </script>
        <!-- ============================================================== -->
        <script src="{{ asset('Backend/assets/libs/jquery/dist/jquery.min.js') }}"></script>
        <!-- Bootstrap tether Core JavaScript -->
        <script src="{{ asset('Backend/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('Backend/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
        <script src="{{ asset('Backend/assets/extra-libs/sparkline/sparkline.js') }}"></script>
        <!--Wave Effects -->
        <script src="{{ asset('Backend/dist/js/waves.js') }}"></script>
        <!--Menu sidebar -->
        <script src="{{ asset('Backend/dist/js/sidebarmenu.js') }}"></script>
        <!--Custom JavaScript -->
        <script src="{{ asset('Backend/dist/js/custom.min.js') }}"></script>
        <script src="{{ asset('Backend/assets/custom_js.js') }}"></script>


        <script src="{{ asset('Backend/assets/libs/flot/excanvas.js') }}"></script>
        <script src="{{ asset('Backend/assets/libs/flot/jquery.flot.js') }}"></script>
        <script src="{{ asset('Backend/assets/libs/flot/jquery.flot.pie.js') }}"></script>
        <script src="{{ asset('Backend/assets/libs/flot/jquery.flot.time.js') }}"></script>
        <script src="{{ asset('Backend/assets/libs/flot/jquery.flot.stack.js') }}"></script>
        <script src="{{ asset('Backend/assets/libs/flot/jquery.flot.crosshair.js') }}"></script>
        <script src="{{ asset('Backend/assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js') }}"></script>
        <script src="{{ asset('Backend/dist/js/pages/chart/chart-page-init.js') }}"></script>
        <script src="{{ asset('Backend/assets/extra-libs/DataTables/datatables.min.js') }}"></script>
        <script>
            /****************************************
             *       Basic Table                   *
             ****************************************/
            $(document).ready(function() {
                $('#zero_config').DataTable({
                    "language": {
                        "decimal": "",
                        "emptyTable": "Không có dữ liệu trong bảng",
                        "info": "Hiển thị _START_ đến _END_ trong _TOTAL_ mục",
                        "infoEmpty": "Hiển thị 0 đến 0 của 0 mục",
                        "infoFiltered": "(lọc từ _MAX_ tổng số mục)",
                        "infoPostFix": "",
                        "thousands": ",",
                        "lengthMenu": "Hiển thị _MENU_ mục",
                        "loadingRecords": "Đang tải...",
                        "processing": "Đang xử lý...",
                        "search": "Tìm kiếm:",
                        "zeroRecords": "Không tìm thấy kết quả",
                        "paginate": {
                            "first": "Đầu tiên",
                            "last": "Cuối cùng",
                            "next": "Tiếp theo",
                            "previous": "Trước đó"
                        },
                        "aria": {
                            "sortAscending": ": sắp xếp tăng dần",
                            "sortDescending": ": sắp xếp giảm dần"
                        }
                    }
                });
            });
        </script>
</body>

</html>
