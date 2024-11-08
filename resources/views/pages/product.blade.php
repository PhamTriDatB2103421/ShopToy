@extends('user_layout')
@section('title')
    <title>Tất cả sản phẩm</title>
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
                <h3 class="product-name"><a href="#">{{ $productName }}</a></h3>
                <h4 class="product-price">
                    <span class="qty">{{ $quantity }}x</span>{{ number_format($totalPrice, 0, ',', '.') }}đ
                </h4>
            </div>
            <button class="delete" data-cart-item-id="{{ $item->CartItemId }}"><i class="fa fa-close"></i></button>
        </div>
    @endforeach
@endsection
@section('user_content')
    <div id="breadcrumb" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb-tree">
                        <li><a href="#">Trang chủ</a></li>
                        <li><a href="#">Tất cả sản phẩm</a></li>
                    </ul>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /BREADCRUMB -->

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- ASIDE -->
                <div id="aside" class="col-md-3">
                    <!-- aside Widget -->
                    <div class="aside">
                        <h3 class="aside-title">Gợi ý</h3>
                        @php
                            $rcm = new \App\Helper\RecommendHelper();
                            $rcm = $rcm->recommendWithOrder();
                        @endphp
                        @foreach ($rcm as $product)
                            <div class="product-widget">
                                <div class="product-img">
                                    @php
                                        $image = $product->images->first();
                                    @endphp
                                    <img src="{{ $image ? asset('storage/' . $image->ImageUrl) : 'default_image_url' }}"
                                        alt="">
                                </div>
                                <div class="product-body">
                                    <p class="product-category">{{ $product->category->Name }}</p>
                                    <h3 class="product-name"><a
                                            href="{{ URL::to('/product') . '/' . $product->ProductId }}">{{ $product->Name }}</a>
                                    </h3>
                                    <h4 class="product-price"> {{ number_format($product->Price, 0, ',', '.') }}đ</h4>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <!-- /aside Widget -->
                </div>
                <!-- /ASIDE -->

                <!-- STORE -->
                <div id="store" class="col-md-9">
                    <!-- store top filter -->
                    <div class="store-filter clearfix">
                        <ul class="store-grid">
                            <li class="active"><i class="fa fa-th"></i></li>
                        </ul>
                    </div>
                    <!-- /store top filter -->
                    @php
                        $i = 0;
                    @endphp
                    <!-- store products -->
                    <div class="row">
                        <!-- product -->
                        @foreach ($products as $product)
                            @php
                                $i++;
                                $j = $i % 3;
                                $image = $product->images->first();

                            @endphp
                            <div class="col-md-4 col-xs-6">
                                <a href="{{ URL::to('product') . '/' . $product->ProductId }}">
                                    <div class="product">
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
                                            <h4 class="product-price">{{ number_format($product->Price, 0, ',', '.') }}đ
                                            </h4>
                                        </div>
                                        <div class="add-to-cart">
                                            <button class="add-to-cart-btn" data-product-id="{{ $product->ProductId }}"><i
                                                    class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng</button>
                                        </div>
                                    </div>
                            </div>
                            </a>
                            @if (!$j)
                                <div class="clearfix visible-lg visible-md"></div>
                            @endif
                        @endforeach
                    </div>
                    <!-- /STORE -->
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
                            <p>Đăng ký ngay để nhận <strong>THÔNG BÁO MỚI</strong></p>
                            <form>
                                <input class="input" type="email" placeholder="Nhập email">
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
