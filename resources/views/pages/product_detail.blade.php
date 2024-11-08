@extends('user_layout')
@section('title')
    <title>Sản phẩm</title>
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

    <!-- BREADCRUMB -->
    <div id="breadcrumb" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb-tree">
                        <li><a href="{{ url('/') }}">Trang chủ</a></li>
                        <li><a href="{{ url('product') }}">Tất cả sản phẩm</a></li>
                        <li><a href="#">{{ $product_detail->category->Name }}</a></li>
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
                <!-- Product main img -->
                <div class="col-md-5 col-md-push-2">
                    <div id="product-main-img">
                        @foreach ($product_detail->images as $image)
                            <div class="product-preview">
                                <img src="{{ $image ? asset('storage/' . $image->ImageUrl) : 'default_image_url' }}"
                                    alt="{{ $product_detail->Name }}">
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- /Product main img -->

                <!-- Product thumb imgs -->
                <div class="col-md-2  col-md-pull-5">
                    <div id="product-imgs">
                        @foreach ($product_detail->images as $image)
                            <div class="product-preview">
                                <img src="{{ $image ? asset('storage/' . $image->ImageUrl) : 'default_image_url' }}"
                                    alt="{{ $product_detail->Name }}">
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- /Product thumb imgs -->

                <!-- Product details -->
                <div class="col-md-5">
                    <div class="product-details">
                        <h2 class="product-name">{{ $product_detail->Name }}</h2>
                        <div>
                            <div class="product-rating">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="fa fa-star {{ $i <= $average_rating ? '' : 'fa-star-o' }}"></i>
                                @endfor
                            </div>
                        </div>
                        <div>
                            <h3 class="product-price">{{ number_format($product_detail->Price, 0, ',', '.') }}đ</h3>
                            <span class="product-available">Còn hàng</span>
                        </div>
                        <p>{{ $product_detail->Description }}</p>
                        <div class="add-to-cart">
                            <div class="qty-label">
                                Số lượng
                                <div class="input-number">
                                    <input type="number" id="product-quantity" value="1" min="1">
                                    <span class="qty-up">+</span>
                                    <span class="qty-down">-</span>
                                </div>
                            </div>
                        </div>
                        <div class="add-to-cart">
                            <button class="add-to-cart-btn" data-product-id="{{ $product_detail->ProductId }}"><i
                                    class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng</button>
                        </div>
                        <ul class="product-links">
                            <li>Danh mục:</li>
                            <li><a href="#">{{ $product_detail->category->Name }}</a></li>
                        </ul>


                    </div>
                </div>
                <!-- /Product details -->

                <!-- Product tab -->
                <div class="col-md-12">
                    <div id="product-tab">
                        <!-- product tab nav -->
                        <ul class="tab-nav">
                            <li class="active"><a data-toggle="tab" href="#tab1">Mô tả sản phẩm</a></li>
                            <li><a data-toggle="tab" href="#tab2">Mô tả danh mục</a></li>
                            <li><a data-toggle="tab" href="#tab3">Đánh giá {{ count($product_detail->reviews) }}</a></li>
                        </ul>
                        <!-- /product tab nav -->

                        <!-- product tab content -->
                        <div class="tab-content">
                            <!-- tab1  -->
                            <div id="tab1" class="tab-pane fade in active">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>{{ $product_detail->Description }}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- /tab1  -->

                            <!-- tab2  -->
                            <div id="tab2" class="tab-pane fade in">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>{{ $product_detail->category->Description }}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- /tab2  -->

                            <!-- tab3 -->
                            <div id="tab3" class="tab-pane fade in">
                                <div class="row">
                                    <!-- Rating -->
                                    <div class="col-md-3">
                                        <div id="rating">
                                            <div class="rating-avg">
                                                <span>{{ number_format($average_rating, 1) }}</span>
                                                <div class="rating-stars">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <i
                                                            class="fa fa-star {{ $i <= $average_rating ? '' : 'fa-star-o' }}"></i>
                                                    @endfor
                                                </div>
                                            </div>
                                            <ul class="rating">
                                                @for ($i = 5; $i >= 1; $i--)
                                                    <li>
                                                        <div class="rating-stars">
                                                            @for ($j = 1; $j <= 5; $j++)
                                                                <i
                                                                    class="fa fa-star {{ $j <= $i ? '' : 'fa-star-o' }}"></i>
                                                            @endfor
                                                        </div>
                                                        <div class="rating-progress">
                                                            <div
                                                                style="width: {{ ($ratings_count[$i] / max($product_detail->reviews->count(), 1)) * 100 }}%;">
                                                            </div>
                                                        </div>
                                                        <span class="sum">{{ $ratings_count[$i] }}</span>
                                                    </li>
                                                @endfor
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- /Rating -->

                                    <!-- Reviews -->
                                    <div class="col-md-6">
                                        <div id="reviews">
                                            <ul class="reviews">
                                                @forelse ($product_detail->reviews as $review)
                                                    <li>
                                                        <div class="review-heading">
                                                            <h5 class="name">
                                                                {{ $review->user->FullName ?? 'Người dùng ẩn danh' }}</h5>
                                                            <p class="date">
                                                                {{ \Carbon\Carbon::parse($review->Created_At)->format('d m yy, H:i') }}
                                                            </p>

                                                            <div class="review-rating">
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    <i
                                                                        class="fa fa-star {{ $i <= $review->Rating ? '' : 'fa-star-o' }}"></i>
                                                                @endfor
                                                            </div>
                                                        </div>
                                                        <div class="review-body">
                                                            <p>{{ $review->Comment }}</p>
                                                        </div>
                                                    </li>
                                                @empty
                                                    <li>Chưa có đánh giá</li>
                                                @endforelse
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- /Reviews -->

                                    <!-- Review Form -->
                                    <div class="col-md-3">
                                        <div id="review-form">
                                            <form class="review-form" method="POST"
                                                action="{{ route('product.review', $product_detail->ProductId) }}">
                                                @csrf
                                                <input class="input" type="text" name="name"
                                                    placeholder="Tên của bạn" required>
                                                <input class="input" type="email" name="email" placeholder="Email"
                                                    required>
                                                <textarea class="input" name="comment" placeholder="Nhận xét" required></textarea>
                                                <div class="input-rating">
                                                    <span>Đánh giá: </span>
                                                    <div class="stars">
                                                        @for ($i = 5; $i >= 1; $i--)
                                                            <input id="star{{ $i }}" name="rating"
                                                                value="{{ $i }}" type="radio"><label
                                                                for="star{{ $i }}"></label>
                                                        @endfor
                                                    </div>
                                                </div>
                                                <button class="primary-btn" type="submit">Gửi</button>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- /Review Form -->
                                </div>
                            </div>
                            <!-- /tab3 -->


                        </div>
                        <!-- /product tab content  -->
                    </div>
                </div>
                <!-- /product tab -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- Section -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                <div class="col-md-12">
                    <div class="section-title text-center">
                        <h3 class="title">Gợi ý sản phẩm</h3>
                    </div>
                </div>
                @php
                    $rcm = new \App\Helper\RecommendHelper();
                    $rcm = $rcm->recommendWithOrder();
                @endphp
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
                                                    <div class="product-btns">
                                                        <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span
                                                                class="tooltipp">Thêm vào yêu thích</span></button>
                                                    </div>
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
    <!-- /Section -->

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
