<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @yield('title')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}" />

    <!-- Slick -->
    <link type="text/css" rel="stylesheet" href="{{ asset('frontend/css/slick.css') }}" />
    <link type="text/css" rel="stylesheet" href="{{ asset('frontend/css/slick-theme.css') }}" />

    <!-- nouislider -->
    <link type="text/css" rel="stylesheet" href="{{ asset('frontend/css/nouislider.min.css') }}" />

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css') }}">

    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="{{ asset('frontend/css/style.css') }}" />
    <!--Start of Fchat.vn-->
    <script type="text/javascript" src="https://cdn.fchat.vn/assets/embed/webchat.js?id=66f2ef22e7629d5de041a934" async="async"></script><!--End of Fchat.vn-->
</head>
<style>
    /* Style for dropdown menu */
    .dropdown-menu {
        background-color: #ffffff;
        /* White background for dropdown */
        border: 1px solid #dee2e6;
        /* Light border around the dropdown */
        border-radius: 0.375rem;
        /* Rounded corners */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        /* Drop shadow for a floating effect */
        padding: 0;
        /* Remove padding inside the dropdown */
        min-width: 200px;
        /* Minimum width for the dropdown */
    }

    /* Style for dropdown items */
    .dropdown-item {
        display: block;
        /* Ensure items are block-level elements */
        padding: 0.75rem 1.25rem;
        /* Padding around the items */
        color: #000000;
        /* Black text color */
        text-decoration: none;
        /* Remove underline from links */
        font-size: 1rem;
        /* Font size */
        border-bottom: 1px solid #dee2e6;
        /* Border between items */
        transition: background-color 0.3s ease;
        /* Smooth background color change */
    }

    /* Style for the last dropdown item */
    .dropdown-item:last-child {
        border-bottom: none;
        /* Remove border from the last item */
    }

    /* Style for dropdown items on hover */
    .dropdown-item:hover {
        background-color: #f8f9fa;
        /* Light gray background on hover */
        color: #000000;
        /* Black text color on hover */
    }

    /* Optional: Style for dropdown items on active/focus */
    .dropdown-item:active,
    .dropdown-item:focus {
        background-color: #e9ecef;
        /* Slightly darker gray for active/focus state */
        color: #000000;
        /* Black text color */
    }
</style>

<body>
    <!-- HEADER -->
    <header>
        <!-- TOP HEADER -->
        <div id="top-header">
            <div class="container">
                <ul class="header-links pull-left">
                    <li><a href="#"><i class="fa fa-phone"></i> +021-95-51-84</a></li>
                    <li><a href="#"><i class="fa fa-envelope-o"></i> email@email.com</a></li>
                    <li><a href="#"><i class="fa fa-map-marker"></i> 1734 Stonecoal Road</a></li>
                </ul>
                <ul class="header-links pull-right">
                    @php
                        $name = session('FullName');
                        $role = session('Role');
                    @endphp
                    @if ($name)
                        @if ($role === 'Admin')
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-user-o"></i> {{ $name }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="userDropdown">
                                    <a class="dropdown-item" style="color: black;"
                                        href="{{ URL::to('user_info') . '/' . session('UserId') }}">Thông tin tài khoản</a>
                                    <a class="dropdown-item" style="color: black;"
                                        href="{{ URL('admin/index') }}">Chuyển sang giao diện quản lý</a>
                                    <a class="dropdown-item" style="color: black;" href="{{ URL('logout') }}">Đăng
                                        xuất</a>
                                </div>

                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-user-o"></i> {{ $name }}
                                </a>
                                <div class="dropdown-menu" aria-labelledby="userDropdown">
                                    <a class="dropdown-item" style="color: black;" href="{{ URL('use_info') }}">Thông
                                        tin tài khoản</a>
                                    <a class="dropdown-item" style="color: black;" href="{{ URL('logout') }}">Đăng
                                        xuất</a>
                                </div>
                            </li>
                        @endif
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ URL('login') }}"><i
                                    class="fa fa-user-o"></i> Đăng Nhập</a></li>
                    @endif
                </ul>
            </div>

            <!-- Đăng xuất form -->
            </ul>
        </div>
        </div>
        <!-- /TOP HEADER -->
        @if (session()->has('success') || session()->has('error') || session()->has('warning') || session()->has('info'))
            <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1100;">
                @if (session()->has('success'))
                    <div class="toast align-items-center text-bg-success border-0 show" role="alert"
                        aria-live="assertive" aria-atomic="true" data-bs-delay="3000">
                        <div class="d-flex">
                            <div class="toast-body">
                                {{ session('success') }}
                            </div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                                aria-label="Close"></button>
                        </div>
                    </div>
                @endif

                @if (session()->has('error'))
                    <div class="toast align-items-center text-bg-danger border-0 show" role="alert"
                        aria-live="assertive" aria-atomic="true" data-bs-delay="3000">
                        <div class="d-flex">
                            <div class="toast-body">
                                {{ session('error') }}
                            </div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto"
                                data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                    </div>
                @endif

                @if (session()->has('warning'))
                    <div class="toast align-items-center text-bg-warning border-0 show" role="alert"
                        aria-live="assertive" aria-atomic="true" data-bs-delay="3000">
                        <div class="d-flex">
                            <div class="toast-body">
                                {{ session('warning') }}
                            </div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto"
                                data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                    </div>
                @endif

                @if (session()->has('info'))
                    <div class="toast align-items-center text-bg-info border-0 show" role="alert"
                        aria-live="assertive" aria-atomic="true" data-bs-delay="3000">
                        <div class="d-flex">
                            <div class="toast-body">
                                {{ session('info') }}
                            </div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto"
                                data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                    </div>
                @endif
            </div>
        @endif

        <!-- MAIN HEADER -->
        <div id="header">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <!-- LOGO -->
                    <div class="col-md-3">
                        <div class="header-logo">
                            <a href="{{ url('/') }}" class="logo">
                                <img src="{{ asset('/frontend/img/logo.png') }}" alt="logo">
                            </a>
                        </div>
                    </div>
                    <!-- /LOGO -->

                    <!-- SEARCH BAR -->
                    <div class="col-md-6">
                        <div class="header-search">
                            <form>
                                @csrf
                                {{-- <select class="input-select" name="category_id">
										<option value="0">Danh mục</option>
                                        @yield('categories')
									</select> --}}
                                <input class="input" placeholder="Search here">
                                <button class="search-btn">Search</button>
                            </form>
                        </div>
                    </div>
                    <!-- /SEARCH BAR -->

                    <!-- ACCOUNT -->
                    <div class="col-md-3 clearfix">
                        <div class="header-ctn">
                            <!-- Wishlist -->
                            <div>
                                <a href="{{ url('') }}">
                                    <i class="fa fa-heart-o"></i>
                                    <span>Yêu thích</span>
                                    <div class="qty">0</div>
                                </a>
                            </div>
                            <!-- /Wishlist -->
                            @php
                                if (Session('UserId')) {
                                    $cart = DB::select('select CartId from Carts where UserId = ' . session('UserId'));
                                    $cartId = $cart ? $cart[0]->CartId : null;
                                } else {
                                    $cartId = null;
                                }
                            @endphp

                            <!-- Cart -->
                            <div class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span>Giỏ hàng</span>
                                    <div class="qty">{{ Session::has('cart') ? Session::get('cart')->count() : 0 }}
                                    </div>
                                </a>
                                <div class="cart-dropdown">
                                    <div class="cart-list">
                                        @if (Session::has('cart') && Session::get('cart')->count() > 0)
                                            @yield('cart')
                                        @else
                                            <p>Your cart is empty.</p>
                                        @endif
                                    </div>
                                    <div class="cart-summary">
                                        <small>{{ Session::has('cart') ? Session::get('cart')->count() . ' Item(s) selected' : '0 Item(s) selected' }}</small>
                                        <h5>SUBTOTAL:
                                            {{ number_format(
                                                Session::has('cart')
                                                    ? Session::get('cart')->sum(function ($item) {
                                                        $product = $item->product ?? null;
                                                        $price = $product ? $product->Price : 0;
                                                        return $price * ($item->Quantity ?? 0);
                                                    })
                                                    : 0,
                                                0,
                                                ',',
                                                '.',
                                            ) }}đ
                                        </h5>
                                    </div>
                                    <div class="cart-btns">
                                        <div></div>
                                        <a href="{{ $cartId ? route('checkout.form', ['id' => $cartId]) : '#' }}">Thanh
                                            toán <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                            </div>


                            <!-- /Cart -->

                            <!-- Menu Toogle -->
                            <div class="menu-toggle">
                                <a href="#">
                                    <i class="fa fa-bars"></i>
                                    <span>Menu</span>
                                </a>
                            </div>
                            <!-- /Menu Toogle -->
                        </div>
                    </div>
                    <!-- /ACCOUNT -->
                </div>
                <!-- row -->
            </div>
            <!-- container -->
        </div>
        <!-- /MAIN HEADER -->
    </header>
    <!-- /HEADER -->

    <!-- NAVIGATION -->
    <nav id="navigation">
        <!-- container -->
        <div class="container">
            <!-- responsive-nav -->
            <div id="responsive-nav">
                <!-- NAV -->
                <ul class="main-nav nav navbar-nav">
                    <li class="active"><a href="{{ url('/') }}">Home</a></li>
                    <li class="active"><a href="{{ url('/product') }}">Sản phẩm</a></li>

                </ul>
                <!-- /NAV -->
            </div>
            <!-- /responsive-nav -->
        </div>
        <!-- /container -->
    </nav>
    <!-- /NAVIGATION -->

    @yield('user_content')


    <footer id="footer">
        <!-- top footer -->
        <div class="section">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">About Us</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                incididunt ut.</p>
                            <ul class="footer-links">
                                <li><a href="#"><i class="fa fa-map-marker"></i>1734 Stonecoal Road</a></li>
                                <li><a href="#"><i class="fa fa-phone"></i>+021-95-51-84</a></li>
                                <li><a href="#"><i class="fa fa-envelope-o"></i>email@email.com</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">Categories</h3>
                            <ul class="footer-links">
                                <li><a href="#">Hot deals</a></li>
                                <li><a href="#">Laptops</a></li>
                                <li><a href="#">Smartphones</a></li>
                                <li><a href="#">Cameras</a></li>
                                <li><a href="#">Accessories</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="clearfix visible-xs"></div>

                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">Information</h3>
                            <ul class="footer-links">
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Contact Us</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Orders and Returns</a></li>
                                <li><a href="#">Terms & Conditions</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">Service</h3>
                            <ul class="footer-links">
                                <li><a href="#">My Account</a></li>
                                <li><a href="#">View Cart</a></li>
                                <li><a href="#">Wishlist</a></li>
                                <li><a href="#">Track My Order</a></li>
                                <li><a href="#">Help</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /top footer -->

        <!-- bottom footer -->
        <div id="bottom-footer" class="section">
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-md-12 text-center">
                        <ul class="footer-payments">
                            <li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
                            <li><a href="#"><i class="fa fa-credit-card"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-paypal"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-discover"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-amex"></i></a></li>
                        </ul>
                        <span class="copyright">
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;
                            <script>
                                document.write(new Date().getFullYear());
                            </script> All rights reserved | This template is made with <i
                                class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com"
                                target="_blank">Colorlib</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </span>
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /bottom footer -->
    </footer>
    <!-- /FOOTER -->
    <script>
        function logout() {
            fetch('{{ route('logout') }}', {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
            }).then(() => {
                window.location.href = '{{ route('login') }}'; // Chuyển hướng sau khi đăng xuất
            });
        }
    </script>

    <!-- jQuery Plugins -->
    <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/slick.min.js') }}"></script>
    <script src="{{ asset('frontend/js/nouislider.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.zoom.min.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var toastElList = [].slice.call(document.querySelectorAll('.toast'))
            var toastList = toastElList.map(function(toastEl) {
                var toast = new bootstrap.Toast(toastEl)
                toast.show()

                toastEl.addEventListener('hidden.bs.toast', function() {
                    toastEl.remove();
                })
            })
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.add-to-cart-btn').click(function() {
                var productId = $(this).data('product-id');
                var quantity = $(this).closest('.product-details').find('input[type="number"]').val() ||
                1; // Lấy số lượng từ input hoặc mặc định là 1

                $.ajax({
                    url: '{{ route('cart.add') }}', // Địa chỉ URL để thêm vào giỏ hàng
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}', // Đảm bảo rằng CSRF token được gửi cùng với yêu cầu
                        product_id: productId,
                        quantity: quantity // Truyền số lượng sản phẩm
                    },
                    success: function(response) {
                        if (response.success) {
                            alert('Đã thêm sản phẩm vào giỏ hàng');
                            // Cập nhật giỏ hàng hiển thị nếu cần
                            location.reload(); // Tải lại trang hoặc cập nhật phần giỏ hàng
                        } else {
                            alert('Vui lòng đăng nhập để thêm sản phẩm vào giỏ hàng');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        alert('Error adding product to cart: ' + error);
                    }
                });
            });
        });

        $(document).ready(function() {
            $('.product-widget .delete').click(function() {
                var cartItemId = $(this).data('cart-item-id'); // Lấy CartItemId từ thuộc tính data

                $.ajax({
                    url: '{{ route('cart.removed') }}', // Địa chỉ URL xử lý việc xóa sản phẩm khỏi giỏ hàng
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}', // CSRF token
                        cart_item_id: cartItemId // Truyền CartItemId để xóa
                    },
                    success: function(response) {
                        if (response.success) {
                            alert('Đã xóa sản phẩm');
                            location.reload(); // Tải lại trang để cập nhật giỏ hàng
                        } else {
                            alert('Có lỗi xảy ra, vui lòng thử lại');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        alert('Lỗi xóa sản phẩm khỏi giỏ hàng: ' + error);
                    }
                });
            });
            });
            //<!--Start of Fchat.vn--><script type="text/javascript" src="https://cdn.fchat.vn/assets/embed/webchat.js?id=66f2954418f03d62bc0a2b12" async="async"></script><!--End of Fchat.vn-->


</body>

</html>
