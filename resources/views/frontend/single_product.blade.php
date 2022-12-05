@extends('layouts.frontendmaster')

@section('content')
<!-- breadcrumb_section - start
            ================================================== -->
            <div class="breadcrumb_section">
                <div class="container">
                    <ul class="breadcrumb_nav ul_li">
                        <li><a href="{{ route('index') }}">Home</a></li>
                        <li>Product Details</li>
                    </ul>
                </div>
            </div>
            <!-- breadcrumb_section - end
            ================================================== -->

            <!-- product_details - start
            ================================================== -->
            <section class="product_details section_space pb-0">
                <div class="container">
                    <div class="row">
                        <div class="col col-lg-6">
                            <div class="product_details_image">
                                <div class="details_image_carousel">
                                    <div class="slider_item">
                                        <img src="{{ asset('dashboard/uplaods/product_thumbnail') }}/{{ $product->thumbnail }}" alt="image_not_found">
                                    </div>
                                    <div class="slider_item">
                                        <img src="{{ asset('frontend') }}/images/details/product_details_img_2.png" alt="image_not_found">
                                    </div>
                                    <div class="slider_item">
                                        <img src="{{ asset('frontend') }}/images/details/product_details_img_3.png" alt="image_not_found">
                                    </div>
                                    <div class="slider_item">
                                        <img src="{{ asset('frontend') }}/images/details/product_details_img_4.png" alt="image_not_found">
                                    </div>
                                    <div class="slider_item">
                                        <img src="{{ asset('frontend') }}/images/details/product_details_img_1.png" alt="image_not_found">
                                    </div>
                                    <div class="slider_item">
                                        <img src="{{ asset('frontend') }}/images/details/product_details_img_2.png" alt="image_not_found">
                                    </div>
                                    <div class="slider_item">
                                        <img src="{{ asset('frontend') }}/images/details/product_details_img_3.png" alt="image_not_found">
                                    </div>
                                    <div class="slider_item">
                                        <img src="{{ asset('frontend') }}/images/details/product_details_img_4.png" alt="image_not_found">
                                    </div>
                                </div>

                                <div class="details_image_carousel_nav">
                                    <div class="slider_item">
                                        <img src="{{ asset('dashboard/uplaods/product_thumbnail') }}/{{ $product->thumbnail }}" alt="image_not_found">
                                    </div>
                                    <div class="slider_item">
                                        <img src="{{ asset('frontend') }}/images/details/product_details_img_2.png" alt="image_not_found">
                                    </div>
                                    <div class="slider_item">
                                        <img src="{{ asset('frontend') }}/images/details/product_details_img_3.png" alt="image_not_found">
                                    </div>
                                    <div class="slider_item">
                                        <img src="{{ asset('frontend') }}/images/details/product_details_img_4.png" alt="image_not_found">
                                    </div>
                                    <div class="slider_item">
                                        <img src="{{ asset('frontend') }}/images/details/product_details_img_1.png" alt="image_not_found">
                                    </div>
                                    <div class="slider_item">
                                        <img src="{{ asset('frontend') }}/images/details/product_details_img_2.png" alt="image_not_found">
                                    </div>
                                    <div class="slider_item">
                                        <img src="{{ asset('frontend') }}/images/details/product_details_img_3.png" alt="image_not_found">
                                    </div>
                                    <div class="slider_item">
                                        <img src="{{ asset('frontend') }}/images/details/product_details_img_4.png" alt="image_not_found">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="product_details_content">
                                <h2 class="item_title">{{ $product->name }}</h2>
                                <p>{{ $product->short_description }}</p>
                                <div class="item_review">
                                    <ul class="rating_star ul_li">
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star"></i></li>
                                        <li><i class="fas fa-star-half-alt"></i></li>
                                    </ul>
                                    <span class="review_value">3 Rating(s)</span>
                                </div>

                                <div class="item_price">
                                    @if ($product->discounted_price)
                                        <span class="product_price">${{ $product->discounted_price }}</span>
                                        <del>${{ $product->regular_price }}</del>
                                    @else
                                        <span class="product_price">${{ $product->regular_price }}</span>
                                    @endif
                                </div>
                                <hr>
                                @livewire('productdetailse.addtocart', ['product_id' => $product->id])
                                <hr>
                            </div>
                        </div>
                    </div>

                    <div class="details_information_tab">
                        <ul class="tabs_nav nav ul_li" role=tablist>
                            <li>
                                <button class="active" data-bs-toggle="tab" data-bs-target="#description_tab" type="button" role="tab" aria-controls="description_tab" aria-selected="true">
                                Description
                                </button>
                            </li>
                            <li>
                                <button data-bs-toggle="tab" data-bs-target="#additional_information_tab" type="button" role="tab" aria-controls="additional_information_tab" aria-selected="false">
                                Additional information
                                </button>
                            </li>
                            <li>
                                <button data-bs-toggle="tab" data-bs-target="#reviews_tab" type="button" role="tab" aria-controls="reviews_tab" aria-selected="false">
                                Reviews(2)
                                </button>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="description_tab" role="tabpanel">
                               <p> {!! $product->description !!} </p>
                            </div>

                            <div class="tab-pane fade" id="additional_information_tab" role="tabpanel">
                                    {{-- {{ html_entity_decode($product->additional_information) }} --}}
                                    {!! $product->additional_information !!}
                            </div>

                            <div class="tab-pane fade" id="reviews_tab" role="tabpanel">
                                <div class="average_area">
                                    <div class="row align-items-center">
                                        <div class="col-md-12 order-last">
                                            <div class="average_rating_text">
                                                <ul class="rating_star ul_li_center">
                                                    <li><i class="fas fa-star"></i></li>
                                                    <li><i class="fas fa-star"></i></li>
                                                    <li><i class="fas fa-star"></i></li>
                                                    <li><i class="fas fa-star"></i></li>
                                                </ul>
                                                <p class="mb-0">
                                                Average Star Rating: <span>4 out of 5</span> (2 vote)
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="customer_reviews">
                                    <h4 class="reviews_tab_title">2 reviews for this product</h4>
                                    <div class="customer_review_item clearfix">
                                        <div class="customer_image">
                                            <img src="{{ asset('frontend') }}/images/team/team_1.jpg" alt="image_not_found">
                                        </div>
                                        <div class="customer_content">
                                            <div class="customer_info">
                                                <ul class="rating_star ul_li">
                                                    <li><i class="fas fa-star"></i></li>
                                                    <li><i class="fas fa-star"></i></li>
                                                    <li><i class="fas fa-star"></i></li>
                                                    <li><i class="fas fa-star"></i></li>
                                                    <li><i class="fas fa-star-half-alt"></i></li>
                                                </ul>
                                                <h4 class="customer_name">Aonathor troet</h4>
                                                <span class="comment_date">JUNE 2, 2021</span>
                                            </div>
                                            <p class="mb-0">Nice Product, I got one in black. Goes with anything!</p>
                                        </div>
                                    </div>

                                    <div class="customer_review_item clearfix">
                                        <div class="customer_image">
                                            <img src="{{ asset('frontend') }}/images/team/team_2.jpg" alt="image_not_found">
                                        </div>
                                        <div class="customer_content">
                                            <div class="customer_info">
                                                <ul class="rating_star ul_li">
                                                    <li><i class="fas fa-star"></i></li>
                                                    <li><i class="fas fa-star"></i></li>
                                                    <li><i class="fas fa-star"></i></li>
                                                    <li><i class="fas fa-star"></i></li>
                                                    <li><i class="fas fa-star-half-alt"></i></li>
                                                </ul>
                                                <h4 class="customer_name">Danial obrain</h4>
                                                <span class="comment_date">JUNE 2, 2021</span>
                                            </div>
                                            <p class="mb-0">
                                            Great product quality, Great Design and Great Service.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="customer_review_form">
                                    <h4 class="reviews_tab_title">Add a review</h4>
                                    <form action="#">
                                        <div class="form_item">
                                            <input type="text" name="name" placeholder="Your name*">
                                        </div>
                                        <div class="form_item">
                                            <input type="email" name="email" placeholder="Your Email*">
                                        </div>
                                        <div class="your_ratings">
                                            <h5>Your Ratings:</h5>
                                            <button type="button"><i class="fal fa-star"></i></button>
                                            <button type="button"><i class="fal fa-star"></i></button>
                                            <button type="button"><i class="fal fa-star"></i></button>
                                            <button type="button"><i class="fal fa-star"></i></button>
                                            <button type="button"><i class="fal fa-star"></i></button>
                                        </div>
                                        <div class="form_item">
                                            <textarea name="comment" placeholder="Your Review*"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn_primary">Submit Now</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- product_details - end
            ================================================== -->

<!-- related_products_section - start
================================================== -->
<section class="related_products_section section_space">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="best-selling-products related-product-area">
                    <div class="sec-title-link">
                        <h3>Related products</h3>
                        <div class="view-all"><a href="#">View all<i class="fal fa-long-arrow-right"></i></a></div>
                    </div>
                    <div class="product-area clearfix">
                        @foreach ($related_product as $product)
                            @include('frontend.components.products.grid')
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- related_products_section - end
================================================== -->


<!-- modal_section - end
================================================== -->
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 550px">
    <div class="modal-content">
        <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Welcome! Please Login to continue.</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            {{-- ================== --}}
            <div class="register_wrap" style="padding: 20px 20px;">
            <div class="">
                <form action="{{ route('customer.login.modal') }}" method="POST">
                    @csrf
                    <div class="">
                        <h4 class="">Email Address*</h4>
                        <div class="form_item">
                            <label for=""><i class="fas fa-envelope"></i></label>
                            <input id="" type="email" name="email" placeholder="Email Address">
                        </div>
                    </div>

                    <div class="">
                        <h4 class="">Password*</h4>
                        <div class="form_item">
                            <label for=""><i class="fas fa-lock"></i></label>
                            <input id="" type="password" name="password" placeholder="Password">
                        </div>
                        <div class="form_item">
                            <a style="height: 0px; border:none;" href="{{ route('password.request') }}">Forgot Password?</a>
                        </div>
                    </div>
                    <div class="">
                        <button type="submit" class="btn btn_primary">Sign In</button>
                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal" style="background-color: #ffc107;
                        border-color: #ffc107;">Close</button>
                    </div>
                </form>
            </div>
            </div>
            {{-- ================== --}}
        </div>
    </div>
    </div>
</div>
<!-- modal_section - end
================================================== -->


@endsection

@push('script')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
     @if(session('success'))
        $(document).ready(function() {
            const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
            })

            Toast.fire({
            icon: 'success',
            title: "{{ session('success') }}"
            })
        });
    @endif

    @if(session('loginerr'))
        $(document).ready(function() {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "{{ session('loginerr') }}"
                })
        });
    @endif

    @if ($errors->any())
            Swal.fire({
            icon: 'error',
            html:
            '<h4><div class="alert alert-danger"><ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div></h4>',
            showCloseButton: true,
            showCancelButton: true,
            });
    @endif
</script>
@endpush
