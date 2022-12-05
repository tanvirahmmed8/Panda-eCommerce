@extends('layouts.frontendmaster')

@section('content')
<!-- breadcrumb_section - start
================================================== -->
<div class="breadcrumb_section">
    <div class="container">
        <ul class="breadcrumb_nav ul_li">
            <li><a href="{{ route('index') }}">Home</a></li>
            <li>Vendor Login</li>
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
                        <button class="active" data-bs-toggle="tab" data-bs-target="#signup_tab" type="button" role="tab" aria-controls="signup_tab" aria-selected="false">Vendor Login</button>
                    </li>
                </ul>

                <!-- register_section - start
                ================================================== -->

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

                        <form action="{{ route('vendor.login.post') }}" method="POST">
                            @csrf
                            <div class="form_item_wrap">
                                <h3 class="input_title">Email Address*</h3>
                                <div class="form_item">
                                    <label for="username_input"><i class="fas fa-envelope"></i></label>
                                    <input id="username_input" type="email" name="email" placeholder="Email Address">
                                </div>
                            </div>

                            <div class="form_item_wrap">
                                <h3 class="input_title">Password*</h3>
                                <div class="form_item">
                                    <label for="password_input"><i class="fas fa-lock"></i></label>
                                    <input id="password_input" type="password" name="password" placeholder="Password">
                                </div>
                                <div class="form_item">
                                    <a href="{{ route('password.request') }}">Forgot Password? </a>
                                    <a href="{{ route('vendor.registration') }}"> Register here</a>
                                </div>
                                {{-- <div class="checkbox_item">
                                    <input id="remember_checkbox" type="checkbox">
                                    <label for="remember_checkbox">Remember Me</label>
                                </div> --}}
                            </div>

                            <div class="form_item_wrap">
                                <button type="submit" class="btn btn_primary">Sign In</button>
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
