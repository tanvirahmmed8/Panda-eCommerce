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
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d193595.9147703055!2d-74.11976314309273!3d40.69740344223377!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew+York%2C+NY%2C+USA!5e0!3m2!1sen!2sbd!4v1547528325671" allowfullscreen>
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
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                <div class="row">
                                    <div class="col col-md-6">
                                        <div class="contact_info_list">
                                            <h4 class="list_title">Colourbar U.S.A</h4>
                                            <ul class="ul_li_block">
                                                <li>Dhaka In Twin Tower Concord </li>
                                                <li>Shopping Complex</li>
                                                <li>Open  Closes 8:30PM </li>
                                                <li>yourinfo@gmail.com</li>
                                                <li>(1200)-0989-568-331</li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="col col-md-6">
                                        <div class="contact_info_list">
                                            <h4 class="list_title">USA Exchanger</h4>
                                            <ul class="ul_li_block">
                                                <li>Dhaka In Twin Tower Concord </li>
                                                <li>Shopping Complex</li>
                                                <li>Open  Closes 8:30PM </li>
                                                <li>yourinfo@gmail.com</li>
                                                <li>(1200)-0989-568-331</li>
                                            </ul>
                                        </div>
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
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
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
