@extends('layouts.frontendmaster')

@section('content')

<!-- slider_section - start
================================================== -->
<section class="slider_section">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 offset-lg-3">
                <div class="main_slider" data-slick='{"arrows": false}'>
                    <div class="slider_item set-bg-image" data-background="{{ asset('frontend') }}/images/slider/slide-2.jpg">
                        <div class="slider_content">
                            <h3 class="small_title" data-animation="fadeInUp2" data-delay=".2s">Clothing</h3>
                            <h4 class="big_title" data-animation="fadeInUp2" data-delay=".4s">Smart blood  <span>Pressure monitor</span></h4>
                            <p data-animation="fadeInUp2" data-delay=".6s">The best gadgets collection 2021</p>
                            <div class="item_price" data-animation="fadeInUp2" data-delay=".6s">
                                <del>$430.00</del>
                                <span class="sale_price">$350.00</span>
                            </div>
                            <a class="btn btn_primary" href="shop_details.html" data-animation="fadeInUp2" data-delay=".8s">Start Buying</a>
                        </div>
                    </div>
                    <div class="slider_item set-bg-image" data-background="{{ asset('frontend') }}/images/slider/slide-3.jpg">
                        <div class="slider_content">
                            <h3 class="small_title" data-animation="fadeInUp2" data-delay=".2s">Clothing</h3>
                            <h4 class="big_title" data-animation="fadeInUp2" data-delay=".4s">Smart blood  <span>Pressure monitor</span></h4>
                            <p data-animation="fadeInUp2" data-delay=".6s">The best gadgets collection 2021</p>
                            <div class="item_price" data-animation="fadeInUp2" data-delay=".6s">
                                <del>$430.00</del>
                                <span class="sale_price">$350.00</span>
                            </div>
                            <a class="btn btn_primary" href="shop_details.html" data-animation="fadeInUp2" data-delay=".8s">Start Buying</a>
                        </div>
                    </div>
                    <div class="slider_item set-bg-image" data-background="{{ asset('frontend') }}/images/slider/slide-1.jpg">
                        <div class="slider_content">
                            <h3 class="small_title" data-animation="fadeInUp2" data-delay=".2s">Clothing</h3>
                            <h4 class="big_title" data-animation="fadeInUp2" data-delay=".4s">Smart blood  <span>Pressure monitor</span></h4>
                            <p data-animation="fadeInUp2" data-delay=".6s">The best gadgets collection 2021</p>
                            <div class="item_price" data-animation="fadeInUp2" data-delay=".6s">
                                <del>$430.00</del>
                                <span class="sale_price">$350.00</span>
                            </div>
                            <a class="btn btn_primary" href="shop_details.html" data-animation="fadeInUp2" data-delay=".8s">Start Buying</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- slider_section - end
================================================== -->

<!-- policy_section - start
================================================== -->
<section class="policy_section">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="policy-wrap">
                    @foreach ($policeis as $policy)
                        <div class="policy_item">
                            <div class="item_icon">
                                <i class="{{ $policy->policy_icon }}"></i>
                            </div>
                            <div class="item_content">
                                <h3 class="item_title">{{ $policy->policy_name }}</h3>
                                <p>
                                    {{ $policy->policy_text }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</section>
<!-- policy_section - end
================================================== -->


<!-- products-with-sidebar-section - start
================================================== -->
<section class="products-with-sidebar-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 order-lg-3">
                <div class="best-selling-products">
                    <div class="sec-title-link">
                        <h3>Best selling</h3>
                        <div class="view-all"><a href="{{ route('shop') }}">View all<i class="fal fa-long-arrow-right"></i></a></div>
                    </div>
                    <div class="product-area clearfix">
                        @foreach ($products as $product)
                            @include('frontend.components.products.grid')
                        @endforeach
                    </div>
                </div>

                <div class="top_category_wrap">
                    <div class="sec-title-link">
                        <h3>Top categories</h3>
                    </div>
                    <div class="top_category_carousel2" data-slick='{"dots": false}'>
                        @foreach ($topcats as $category)
                            <div class="slider_item">
                                <div class="category_boxed">
                                    <a href="{{ route('search.category', $category->id) }}">
                                            <span class="item_image">
                                                <img src="{{ asset('dashboard/uplaods/category_photo') }}/{{ $category->category_photo }}" alt="image_not_found">
                                            </span>
                                        <span class="item_title">{{ $category->category_name }}</span>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="carousel_nav carousel-nav-top-right">
                        <button type="button" class="tc_left_arrow"><i class="fal fa-long-arrow-alt-left"></i></button>
                        <button type="button" class="tc_right_arrow"><i class="fal fa-long-arrow-alt-right"></i></button>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 order-lg-9">
                <div class="product-sidebar">
                    <div class="widget latest_product_carousel">
                        <div class="title_wrap">
                            <h3 class="area_title">Latest Products</h3>
                            <div class="carousel_nav">
                                <button type="button" class="vs4i_left_arrow"><i class="fal fa-angle-left"></i></button>
                                <button type="button" class="vs4i_right_arrow"><i class="fal fa-angle-right"></i></button>
                            </div>
                        </div>
                        <div class="vertical_slider_4item" data-slick='{"dots": false}'>
                            @foreach ($latest_products as $latest_product)
                                <div class="slider_item">
                                    <div class="small_product_layout">
                                        <a class="item_image" href="{{ route('single.product', $latest_product->id) }}">
                                            <img src="{{ asset('dashboard/uplaods/product_thumbnail') }}/{{ $latest_product->thumbnail }}" alt="image_not_found">
                                        </a>
                                        <div class="item_content">
                                            <h3 class="item_title">
                                                <a href="{{ route('single.product', $latest_product->id) }}"><abbr title="{{ $latest_product->name }}">{{ Str::limit($latest_product->name, 10, '...') }}</abbr></a>
                                            </h3>
                                            @php
                                                $lat_avg = number_format(rating($latest_product->id));
                                            @endphp
                                            <ul class="rating_star ul_li">
                                                <li>
                                                    @for ($i = 1; $i <= $lat_avg; $i++)
                                                    <i class="fas fa-star full"></i>
                                                    @endfor
                                                    @for ($j = $lat_avg+1; $j <= 5; $j++)
                                                    <i class="fa fa-star"></i>
                                                    @endfor
                                                </li>
                                            </ul>
                                            <div class="item_price">
                                                @if ($latest_product->discounted_price)
                                                <span>${{ $latest_product->discounted_price }}</span>
                                                <del>${{ $latest_product->regular_price }}</del>
                                                @else
                                                <span>${{ $latest_product->regular_price }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @foreach ($random as $item)
                        <div class="widget product-add">
                            <div class="product-img">
                                <img src="{{ asset('dashboard/uplaods/product_thumbnail') }}/{{ $item->thumbnail }}" alt>
                            </div>
                            <div class="details">
                                <h4>{{ $item->name }}</h4>
                                <p>{{ Str::limit($item->short_description, 60, '...') }}</p>
                                <a class="btn btn_primary" href="{{ route('single.product', $item->id) }}" >Start Buying</a>
                            </div>
                        </div>
                    @endforeach
                    <div class="widget audio-widget">
                        <h5>Category <span>{{ $categories->count() }}</span></h5>
                        <ul>
                            @foreach ($categories as $category)
                                <li><a href="{{ route('search.category', $category->id) }}">{{ $category->category_name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end container  -->
</section>
<!-- products-with-sidebar-section - end
================================================== -->


<!-- promotion_section - start
================================================== -->
<section class="promotion_section">
    <div class="container">
        <div class="row promotion_banner_wrap">
            <div class="col col-lg-6">
                <div class="promotion_banner">
                    <div class="item_image">
                        <img src="{{ asset('frontend') }}/images/promotion/banner_img_1.png" alt>
                    </div>
                    <div class="item_content">
                        <h3 class="item_title">Protective sleeves <span>combo.</span></h3>
                        <p>It is a long established fact that a reader will be distracted</p>
                        <a class="btn btn_primary" href="shop_details.html">Shop Now</a>
                    </div>
                </div>
            </div>

            <div class="col col-lg-6">
                <div class="promotion_banner">
                    <div class="item_image">
                        <img src="{{ asset('frontend') }}/images/promotion/banner_img_2.png" alt>
                    </div>
                    <div class="item_content">
                        <h3 class="item_title">Nutrillet blender <span>combo.</span></h3>
                        <p>
                            It is a long established fact that a reader will be distracted
                        </p>
                        <a class="btn btn_primary" href="shop_details.html">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- promotion_section - end
================================================== -->

<!-- new_arrivals_section - start
================================================== -->
<section class="new_arrivals_section section_space">
    <div class="container">
        <div class="sec-title-link">
            <h3>New Arrivals</h3>
        </div>

        <div class="row newarrivals_products">
            <div class="col col-lg-5">
                <div class="deals_product_layout1">
                    <div class="bg_area">
                        <h3 class="item_title">Best <span>Product</span> Deals</h3>
                        <p>
                            Get a 20% Cashback when buying TWS Product From SoundPro Audio Technology.
                        </p>
                        <a class="btn btn_primary" href="shop_details.html">Shop Now</a>
                    </div>
                </div>
            </div>

            <div class="col col-lg-7">
                <div class="new-arrivals-grids clearfix">

                    @foreach ($new_products as $product)
                        <div class="grid">
                            <div class="product-pic">
                                <img src="{{ asset('dashboard/uplaods/product_thumbnail') }}/{{ $product->thumbnail }}" alt>
                                @if ($product->discounted_price)
                                <span class="theme-badge-2">{{ round(100-(($product->discounted_price/$product->regular_price)*100), 2) }}% off</span>
                                @endif
                                @if ($inventories->where('product_id', $product->id)->sum('quantity') < 1)
                                <span class="theme-badge" style="left:70%;">out</span>
                                @endif
                            </div>
                            <div class="details">
                                <h4><a href="{{ route('single.product', $product->id) }}">{{ Str::limit($product->name, 16, '...') }}</a></h4>
                                <p><a href="{{ route('single.product', $product->id) }}">{{ Str::limit($product->short_description, 60, '...') }}</a></p>
                                <span class="price">
                                    @if ($product->discounted_price)
                                        <ins>
                                            <span class="woocommerce-Price-amount amount">
                                                <bdi>
                                                    <span class="woocommerce-Price-currencySymbol">$</span>{{ $product->discounted_price }}
                                                </bdi>
                                            </span>
                                        </ins>
                                        <del aria-hidden="true">
                                            <span class="woocommerce-Price-amount amount">
                                                <bdi>
                                                    <span class="woocommerce-Price-currencySymbol">$</span>{{ $product->regular_price }}
                                                </bdi>
                                            </span>
                                        </del>
                                    @else
                                        <ins>
                                            <span class="woocommerce-Price-amount amount">
                                                <bdi>
                                                    <span class="woocommerce-Price-currencySymbol">$</span>{{ $product->regular_price }}
                                                </bdi>
                                            </span>
                                        </ins>
                                    @endif
                                </span>
                                <div class="add-cart-area">
                                    <form action="{{ route('single.product', $product->id) }}">
                                        <button type="submit" class="add-to-cart">Details</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    @endforeach

                </div>
            </div>
        </div>
    </div>
</section>
<!-- new_arrivals_section - end
================================================== -->

<!-- brand_section - start
================================================== -->
<div class="brand_section pb-0">
    <div class="container">
        <div class="brand_carousel">
            @foreach ($brands as $brand)
                <div class="slider_item">
                    <a class="product_brand_logo" href="{{ $brand->brand_link }}">
                        <img src="{{ asset('dashboard/uplaods/brand_logo') }}/{{ $brand->brand_logo }}" alt="image_not_found">
                        <img src="{{ asset('dashboard/uplaods/brand_logo') }}/{{ $brand->brand_logo }}" alt="image_not_found">
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- brand_section - end
================================================== -->

<!-- recently_viewed_products_section - start
================================================== -->
<section class="viewed_products_section section_space">
    <div class="container">

        <div class="sec-title-link mb-0">
            <h3>Recently Viewed Products</h3>
        </div>

        <div class="viewed_products_wrap arrows_topright">
            <div class="viewed_products_carousel recently_viewed row" data-slick='{"dots": false}'>
                @foreach ($resently_view_products as $resently_view_product)
                    <div class="slider_item col">
                        <div class="viewed_product_item">
                            <div class="item_image">
                                <img src="{{ asset('dashboard/uplaods/product_thumbnail') }}/{{ $resently_view_product->product_rel->thumbnail }}" alt="image_not_found">
                            </div>
                            <div class="item_content">
                                <h3 class="item_title"><a href="{{ route('single.product', $resently_view_product->product_rel->id) }}">{{ Str::limit($resently_view_product->product_rel->name, 10, '...') }}</a></h3>
                                <div class="ul_li_block">
                                    {{ Str::limit($resently_view_product->product_rel->short_description, 60, '...') }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="carousel_nav">
                <button type="button" class="vpc_left_arrow"><i class="fal fa-long-arrow-alt-left"></i></button>
                <button type="button" class="vpc_right_arrow"><i class="fal fa-long-arrow-alt-right"></i></button>
            </div>
        </div>
    </div>
</section>
<!-- recently_viewed_products_section - end
================================================== -->


<!-- suggest_products_section - start
================================================== -->
@if ($suggest_products->count() > 0)
    <section class="viewed_products_section section_space">
        <div class="container">

            <div class="sec-title-link mb-0">
                <h3>Suggest Products</h3>
            </div>

            <div class="viewed_products_wrap arrows_topright">
                <div class="viewed_products_carousel suggest_products row" data-slick='{"dots": false}'>
                    @foreach ($suggest_products as $suggest_product)
                        <div class="slider_item col">
                            <div class="viewed_product_item">
                                <div class="item_image">
                                    <img src="{{ asset('dashboard/uplaods/product_thumbnail') }}/{{ $suggest_product->thumbnail }}" alt="image_not_found">
                                </div>
                                <div class="item_content">
                                    <h3 class="item_title"><a href="{{ route('single.product', $suggest_product->id) }}">{{ Str::limit($suggest_product->name, 10, '...') }}</a></h3>
                                    <div class="ul_li_block">
                                        {{ Str::limit($suggest_product->short_description, 60, '...') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="carousel_nav">
                    <button type="button" class="left_arrow"><i class="fal fa-long-arrow-alt-left"></i></button>
                    <button type="button" class="right_arrow"><i class="fal fa-long-arrow-alt-right"></i></button>
                </div>
            </div>
        </div>
    </section>
@endif
<!-- suggest_products_section - end
================================================== -->

@endsection
