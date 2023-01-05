@extends('layouts.frontendmaster')
@push('stylesheet')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="{{ asset('frontend') }}/css/woocommerce-2.css">
@endpush

@section('content')
 <!-- breadcrumb_section - start
================================================== -->
<div class="breadcrumb_section">
    <div class="container">
        <ul class="breadcrumb_nav ul_li">
            <li><a href="{{ route('index') }}">Home</a></li>
            <li>Checkout</li>
        </ul>
    </div>
</div>
<!-- breadcrumb_section - end
================================================== -->

 <!-- checkout-section - start
================================================== -->
<section class="checkout-section section_space">
    <div class="container">
        <div class="row">
            <div class="col col-xs-12">
                <div class="woocommerce bg-light p-3">
                <form name="checkout" method="post" class="checkout woocommerce-checkout" action="{{ route('checkoutpost') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="col2-set" id="customer_details">
                        <div class="coll-1">
                            <div class="woocommerce-billing-fields">
                            <h3>Billing Details</h3>
                            <p class="form-row form-row form-row-first validate-required" id="billing_first_name_field">
                                <label for="billing_first_name" class="">Name <abbr class="required" title="required">*</abbr></label>
                                <input type="text" class="input-text " name="customer_name" id="billing_first_name" placeholder="" autocomplete="given-name" value="{{ auth()->user()->name }}" />
                            </p>
                            <p class="form-row form-row form-row-last validate-required validate-email" id="billing_email_field">
                                <label for="billing_email" class="">Email Address <abbr class="required" title="required">*</abbr></label>
                                <input type="email" class="input-text " name="customer_email" id="billing_email" placeholder="" autocomplete="email" value="{{ auth()->user()->email }}" />
                            </p>
                            <div class="clear"></div>
                            {{-- <p class="form-row form-row form-row-first" id="billing_company_field">
                                <label for="billing_company" class="">Company Name</label>
                                <input type="text" class="input-text " name="billing_company" id="billing_company" placeholder="" autocomplete="organization" value="" />
                            </p> --}}

                            <p class="form-row form-row form-row-first validate-required validate-phone" id="billing_phone_field">
                                <label for="billing_phone" class="">Phone <abbr class="required" title="required">*</abbr></label>
                                <input type="tel" class="input-text " name="customer_phone" id="billing_phone" placeholder="" autocomplete="tel" value="{{ auth()->user()->phone_number }}" />
                            </p>
                            <div class="clear"></div>
                            <p class="form-row form-row form-row-first address-field update_totals_on_change validate-required" id="billing_country_field">
                                <label for="billing_country" class="">Country <abbr class="required" title="required">*</abbr></label>
                                <select name="customer_country" id="country" autocomplete="country" class="country_to_state country_select js-select-single">
                                    <option value="">Select a country</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->code }}">{{ $country->name }} {{ $country->emoji }}</option>
                                    @endforeach
                                </select>
                            </p>
                            <p class="form-row form-row form-row-last address-field update_totals_on_change validate-required" id="billing_city_field">
                                <label for="billing_city" class="">City <abbr class="required" title="required">*</abbr></label>
                                <select name="customer_city" id="billing_city" autocomplete="city" class="country_to_state country_select">
                                    {{-- <option value="">Select a City&hellip;</option> --}}
                                </select>
                            </p>
                            <p class="form-row form-row form-row-wide address-field validate-required" id="billing_address_1_field">
                                <label for="billing_address_1" class="">Address <abbr class="required" title="required">*</abbr></label>
                                <input type="text" class="input-text " name="customer_address" id="billing_address_1" placeholder="Street address" autocomplete="address-line1" value="" />
                            </p>
                            </div>
                            <p class="form-row form-row notes" id="order_comments_field">
                                <label for="order_comments" class="">Order Notes</label>
                                <textarea name="order_comments" class="input-text " id="order_comments" placeholder="Notes about your order, e.g. special notes for delivery." rows="2" cols="5"></textarea>
                            </p>
                        </div>
                    </div>
                    <h3 id="order_review_heading">Your order</h3>
                    <div id="order_review" class="woocommerce-checkout-review-order">
                        <table class="shop_table woocommerce-checkout-review-order-table">
                            <tr class="cart-subtotal">
                                <th>Subtotal</th>
                                <td><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">{{ currency() }}</span>{{ session('subtotal') }}</span>
                                </td>
                            </tr>
                            <tr class="cart-subtotal">
                                <th>Discount</th>
                                <td><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol"></span>{{ session('discount_value') }}</span>
                                </td>
                            </tr>
                            <tr class="shipping">
                                <th>Delivery Charge</th>
                                <td data-title="Shipping">
                                    <span class="woocommerce-Price-currencySymbol">{{ currency() }}</span>{{ session('delivery_charge') }}</span>
                                    <input type="hidden" data-index="0" id="shipping_method_0" class="shipping_method" />
                                </td>
                            </tr>
                            <tr class="order-total">
                                <th>Total</th>
                                <td><strong><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">{{ currency() }}</span>{{ session('total_price') }}</span></strong> </td>
                            </tr>
                        </table>
                        <div id="payment" class="woocommerce-checkout-payment py-3 mt-5">
                            <ul class="wc_payment_methods payment_methods methods">
                            <li class="wc_payment_method payment_method_cheque mb-2">
                                <input id="payment_method_cheque" type="radio" class="input-radio" name="payment_method" value="COD" checked='checked' data-order_button_text="" />
                                <!--grop add span for radio button style-->
                                <span class='grop-woo-radio-style'></span>
                                <!--custom change-->
                                <label for="payment_method_cheque">Cash On Delivery</label>
                            </li>
                            <li class="wc_payment_method payment_method_paypal mb-2">
                                <input id="payment_method_ssl" type="radio" class="input-radio" name="payment_method" value="SSL" data-order_button_text="Proceed to SSL Commerz" />
                                <!--grop add span for radio button style-->
                                <span class='grop-woo-radio-style'></span>
                                <!--custom change-->
                                <label for="payment_method_ssl">SSL Commerz</label>
                            </li>
                            <li class="wc_payment_method payment_method_paypal">
                                <input id="payment_method_stripe" type="radio" class="input-radio" name="payment_method" value="stripe" data-order_button_text="Proceed to SSL Commerz" />
                                <!--grop add span for radio button style-->
                                <span class='grop-woo-radio-style'></span>
                                <!--custom change-->
                                <label for="payment_method_stripe">Stripe Payment</label>
                            </li>
                            </ul>
                            <div class="form-row place-order">
                            {{-- <noscript>
                                Since your browser does not support JavaScript, or it is disabled, please ensure you click the <em>Update Totals</em> button before placing your order. You may be charged more than the amount stated above if you fail to do so.
                                <br/>
                                <input type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="Update totals" />
                            </noscript> --}}
                            <button type="submit" class="button alt">Place order</button>
                            {{-- <input type="hidden" id="_wpnonce5" name="_wpnonce" value="783c1934b0" /> --}}
                            {{-- <input type="hidden" name="_wp_http_referer" value="/wp/?page_id=6" /> --}}
                            </div>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
    </section>
    <!-- checkout-section - end
    ================================================== -->

@endsection
@push('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $('.js-select-single').select2({
        placeholder: 'Select a country'
    });
    $('#billing_city').select2({
        placeholder: 'Select country frist'
    });

$(document).ready(function(){
        $('#country').change(function() {
            var billing_country = $(this).val();
            if (billing_country) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type:'POST',
                    url:'/getcitylist',
                    data: {billing_country: billing_country},
                    success: function (data) {
                        $( "#billing_city" ).html(data);
                        //alert(data)
                    }
                });
            } else {
                alert('Please Select a Country!')
            }
        });
    });
</script>
@endpush
