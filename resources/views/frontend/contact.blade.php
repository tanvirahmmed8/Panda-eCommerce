@extends('layouts.frontendmaster')
@section('title') Contact Us @endsection
@section('content')
 <!-- breadcrumb_section - start
            ================================================== -->
            <div class="breadcrumb_section">
                <div class="container">
                    <ul class="breadcrumb_nav ul_li">
                        <li><a href="{{ route('index') }}">Home</a></li>
                        <li>Contact Us</li>
                    </ul>
                </div>
            </div>
            <!-- breadcrumb_section - end
            ================================================== -->

            <!-- contact_section - start
            ================================================== -->
            <div class="map_section">
                <iframe src="{{ setting('location_map') }}" allowfullscreen>
                </iframe>
            </div>
            <!-- contact_section - end
            ================================================== -->

            <!-- contact_section - start
            ================================================== -->
            <section class="contact_section section_space">
                <div class="container">
                    <div class="row">
                        <div class="col col-lg-6">
                            <div class="contact_info_wrap">
                                <h3 class="contact_title">Address <span>Information</span></h3>
                                <div class="decoration_image">
                                    <img src="{{ asset('frontend') }}/images/leaf.png" alt="image_not_found">
                                </div>
                                <p>{{ setting('address_information') }}</p>
                                <div class="row">
                                    <div class="col col-md-6">
                                        <div class="contact_info_list">
                                            {{-- <h4 class="list_title">Colourbar U.S.A</h4> --}}
                                            <ul class="ul_li_block">
                                                <li>{{ setting('contact_address') }}</li>
                                                {{-- <li>Shopping Complex</li> --}}
                                                {{-- <li>Open  Closes 8:30PM </li> --}}
                                                <li>{{ setting('contact_email') }}</li>
                                                <li>{{ setting('contact_number') }}</li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="col col-md-6">
                                        {{-- <div class="contact_info_list">
                                            <h4 class="list_title">USA Exchanger</h4>
                                            <ul class="ul_li_block">
                                                <li>Dhaka In Twin Tower Concord </li>
                                                <li>Shopping Complex</li>
                                                <li>Open  Closes 8:30PM </li>
                                                <li>yourinfo@gmail.com</li>
                                                <li>(1200)-0989-568-331</li>
                                            </ul>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col col-lg-6">
                            <div class="contact_info_wrap">
                                <h3 class="contact_title">Get In Touch <span>Inform Us</span></h3>
                                <div class="decoration_image">
                                    <img src="{{ asset('frontend') }}/images/leaf.png" alt="image_not_found">
                                </div>
                                <p>{{ setting('get_in_touch') }}</p>
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <form action="{{ route('contact.post') }}" method="POST">
                                    @csrf
                                    <div class="form_item">
                                        <input id="contact-form-name" type="text" name="name" placeholder="Your Name">
                                        @error('name')
                                            <div class=" text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col col-md-6 col-sm-6">
                                            <div class="form_item">
                                            <input id="contact-form-email" type="email" name="email" placeholder="Your Email">
                                            @error('email')
                                                <div class=" text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        </div>
                                        <div class="col col-md-6 col-sm-6">
                                            <div class="form_item">
                                                <input type="text" name="subject" placeholder="Your Subject">
                                                @error('subject')
                                                    <div class=" text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form_item">
                                        <textarea id="contact-form-message" name="message" placeholder="Message"></textarea>
                                        @error('message')
                                            <div class=" text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn_dark">Send Message</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- contact_section - end
            ================================================== -->

@endsection
