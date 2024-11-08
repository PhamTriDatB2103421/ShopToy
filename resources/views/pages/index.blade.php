@extends('user_layout')
@section('title')
    <title>Trang chủ</title>
@endsection
@section('cart')
    @foreach ($cartItems as $item)
        @php
            $product = $item->product;
            $productName = $product ? $product->Name : 'Unknown Product';
            $productPrice = $product ? $product->Price : 0;
            $imageUrl =
                $product && $product->images && $product->images->isNotEmpty()
                    ? $product->images->first()->ImageUrl
                    : 'path/to/default/image.jpg';
            $quantity = $item->Quantity ?? 0;
            $totalPrice = $productPrice * $quantity;
        @endphp
        <div class="product-widget">
            <div class="product-img">
                <img src="{{ asset('storage/' . $imageUrl) }}" alt="{{ $productName }}">
            </div>
            <div class="product-body">
                <h3 class="product-name"><a href="{{ route('product_detail', $product->ProductId) }}">{{ $productName }}</a>
                </h3>
                <h4 class="product-price">
                    <span class="qty">{{ $quantity }}x</span>{{ number_format($totalPrice, 0, ',', '.') }}đ
                </h4>
            </div>
            <button class="delete" data-cart-item-id="{{ $item->CartItemId }}"><i class="fa fa-close"></i></button>
        </div>
    @endforeach
@endsection
@section('user_content')
    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                <!-- section title -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">Sản phẩm mới</h3>
                    </div>
                </div>
                <!-- /section title -->
                @php
                    $rcm = new \App\Helper\RecommendHelper();
                    $rcm = $rcm->recommendWithOrder();
                @endphp

                <!-- Products tab & slick -->
                <div class="col-md-12">
                    <div class="row">
                        <div class="products-tabs">
                            <!-- tab -->
                            <div id="tab1" class="tab-pane active">
                                <div class="products-slick" data-nav="#slick-nav-1">
                                    @foreach ($recent_products as $product)
                                        <!-- product -->
                                        @php
                                            $image = $product->images->first();
                                        @endphp
                                        <div class="product">
                                            <a href="{{ URL::to('/product') . '/' . $product->ProductId }}">
                                                <div class="product-img">
                                                    <img src="{{ $image ? asset('storage/' . $image->ImageUrl) : 'default_image_url' }}"
                                                        alt="{{ $product->Name }}">
                                                    <div class="product-label">
                                                        <span class="new">NEW</span>
                                                    </div>
                                                </div>
                                                <div class="product-body">
                                                    <p class="product-category">{{ $product->category->Name }}</p>
                                                    <h3 class="product-name"><a
                                                            href="{{ URL::to('/product') . '/' . $product->ProductId }}">{{ $product->Name }}</a>
                                                    </h3>
                                                    <h4 class="product-price">
                                                        {{ number_format($product->Price, 0, ',', '.') }}đ</h4>
                                                </div>
                                                <div class="add-to-cart">
                                                    <button class="add-to-cart-btn"
                                                        data-product-id="{{ $product->ProductId }}"><i
                                                            class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</button>
                                                </div>
                                            </a>
                                        </div>
                                        <!-- /product -->
                                    @endforeach
                                </div>
                                <div id="slick-nav-1" class="products-slick-nav"></div>
                            </div>
                            <!-- /tab -->
                        </div>
                    </div>
                </div>


            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- HOT DEAL SECTION -->
    <div id="hot-deal" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="hot-deal">
                        <ul class="hot-deal-countdown">
                            <li>
                                <div>
                                    <h3>02</h3>
                                    <span>Days</span>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <h3>10</h3>
                                    <span>Hours</span>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <h3>34</h3>
                                    <span>Mins</span>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <h3>60</h3>
                                    <span>Secs</span>
                                </div>
                            </li>
                        </ul>
                        <h2 class="text-uppercase">Voucher giảm giá<br>Dành riêng cho khách hàng mới</h2>
                        <p>Giảm giá lên đến 50%</p>
                        <a class="primary-btn cta-btn" href="{{ asset('/login') }}">Nhấp vào đây!!!</a>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /HOT DEAL SECTION -->

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                <!-- section title -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">Hàng bán chạy</h3>
                    </div>
                </div>
                <!-- /section title -->

                <!-- Products tab & slick -->
                <div class="col-md-12">
                    <div class="row">
                        <div class="products-tabs">
                            <!-- tab -->
                            <div id="tab1" class="tab-pane active">
                                <div class="products-slick" data-nav="#slick-nav-1">
                                    @foreach ($rcm as $product)
                                        <!-- product -->
                                        @php
                                            $image = $product->images->first();
                                        @endphp
                                        <div class="product">
                                            <a href="{{ URL::to('/product') . '/' . $product->ProductId }}">
                                                <div class="product-img">
                                                    <img src="{{ $image ? asset('storage/' . $image->ImageUrl) : 'default_image_url' }}"
                                                        alt="{{ $product->Name }}">
                                                    <div class="product-label">
                                                        <span class="new">NEW</span>
                                                    </div>
                                                </div>
                                                <div class="product-body">
                                                    <p class="product-category">{{ $product->category->Name }}</p>
                                                    <h3 class="product-name"><a
                                                            href="{{ URL::to('/product') . '/' . $product->ProductId }}">{{ $product->Name }}</a>
                                                    </h3>
                                                    <h4 class="product-price">
                                                        {{ number_format($product->Price, 0, ',', '.') }}đ</h4>
                                                </div>
                                                <div class="add-to-cart">
                                                    <button class="add-to-cart-btn"
                                                        data-product-id="{{ $product->ProductId }}"><i
                                                            class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</button>
                                                </div>
                                            </a>
                                        </div>
                                        <!-- /product -->
                                    @endforeach
                                </div>
                                <div id="slick-nav-1" class="products-slick-nav"></div>
                            </div>
                            <!-- /tab -->
                        </div>
                    </div>
                </div>
                <!-- /Products tab & slick -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- NEWSLETTER -->
    <div id="newsletter" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="newsletter">
                        <p>Đăng ký ngay để nhận<strong> THÔNG TIN MỚI</strong></p>
                        <form>
                            <input class="input" type="email" placeholder="Nhập email của bạn">
                            <button class="newsletter-btn"><i class="fa fa-envelope"></i> Đăng ký</button>
                        </form>
                        <ul class="newsletter-follow">
                            <li>
                                <a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /NEWSLETTER -->
@endsection
