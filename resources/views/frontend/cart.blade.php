@extends('layouts.frontendmaster')

@section('content')
 <!-- breadcrumb_section - start
================================================== -->
<div class="breadcrumb_section">
    <div class="container">
        <ul class="breadcrumb_nav ul_li">
            <li><a href="index.html">Home</a></li>
            <li>Cart</li>
        </ul>
    </div>
</div>
<!-- breadcrumb_section - end
================================================== -->
@if (cartcount() == 0)
<!-- empty_cart_section - start
================================================== -->
<section class="empty_cart_section section_space">
    <div class="container">
        <div class="empty_cart_content text-center">
            @if (Session::has('success'))
            <div class="row">
                <div class="col-4"></div>
                <div class="col-4">
                    <div class="alert alert-success text-center">
                        <p>{{ Session::get('success') }}</p>
                    </div>
                </div>
                <div class="col-4"></div>
            </div>
            @endif
        </div>
        <div class="empty_cart_content text-center">
            <span class="cart_icon">
                <i class="icon icon-ShoppingCart"></i>
            </span>
            <h3>There are no more items in your cart</h3>
            <a class="btn btn_secondary" href="{{ route('index') }}"><i class="far fa-chevron-left"></i> Continue shopping </a>
        </div>
    </div>
</section>
<!-- empty_cart_section - end
================================================== -->
@else
<!-- cart_section - start
================================================== -->
<section class="cart_section section_space">
   @livewire('cart.show')
</section>
<!-- cart_section - end
================================================== -->
@endif

@endsection
