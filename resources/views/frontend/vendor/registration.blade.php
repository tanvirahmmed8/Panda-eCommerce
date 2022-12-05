@extends('layouts.frontendmaster')

@section('content')
<!-- breadcrumb_section - start
================================================== -->
<div class="breadcrumb_section">
    <div class="container">
        <ul class="breadcrumb_nav ul_li">
            <li><a href="{{ route('index') }}">Home</a></li>
            <li>Vendor Register</li>
        </ul>
    </div>
</div>
<!-- breadcrumb_section - end
================================================== -->

<!-- register_section - start
================================================== -->
<section class="register_section section_space">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <ul class="nav register_tabnav ul_li_center" role="tablist">
                    <li role="presentation">
                        <button class="active" data-bs-toggle="tab" data-bs-target="#signup_tab" type="button" role="tab" aria-controls="signup_tab" aria-selected="false">Vendor Register</button>
                    </li>
                </ul>

                <!-- register_section - start
                ================================================== -->

                <div class="text-center">
                    <h4>If you already have an account, <a href="{{ route('vendor.login') }}">Login here</a></h4>
                </div>
                <div class="register_wrap tab-content">
                    <div class="tab-pane fade show active" id="signup_tab" role="tabpanel">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success">
                               {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('vendor.registration.post') }}" method="POST">
                            @csrf
                            <div class="form_item_wrap">
                                <h3 class="input_title">Name*</h3>
                                <div class="form_item">
                                    <label for=""><i class="fas fa-user"></i></label>
                                    <input id="" type="text" name="name" placeholder="Name">
                                </div>
                            </div>

                            <div class="form_item_wrap">
                                <h3 class="input_title">Password*</h3>
                                <div class="form_item">
                                    <label for="password_input2"><i class="fas fa-lock"></i></label>
                                    <input id="password_input2" type="password" name="password" placeholder="Password">
                                </div>
                            </div>

                            <div class="form_item_wrap">
                                <h3 class="input_title">Confirm Password*</h3>
                                <div class="form_item">
                                    <label for="password_input2"><i class="fas fa-lock"></i></label>
                                    <input id="password_input2" type="password" name="password_confirmation" placeholder="Confirm Password">
                                </div>
                            </div>

                            <div class="form_item_wrap">
                                <h3 class="input_title">Email*</h3>
                                <div class="form_item">
                                    <label for="email_input"><i class="fas fa-envelope"></i></label>
                                    <input id="email_input" type="email" name="email" placeholder="Email">
                                </div>
                            </div>
                            <div class="form_item_wrap">
                                <h3 class="input_title">Phone Number*</h3>
                                <div class="form_item">
                                    <label for="email_input"><i class="fas fa-phone"></i></label>
                                    <input id="email_input" type="tel" name="phone_number" placeholder="Phone Number">
                                </div>
                            </div>
                            <div class="form_item_wrap">
                                <button type="submit" class="btn btn_secondary">Register</button>
                            </div>
                            <div class="form_item_wrap text-center">
                                If you already have an account, <a href="{{ route('vendor.login') }}">Login here</a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- register_section - end
                ================================================== -->

            </div>
        </div>
    </div>
</section>

@endsection
