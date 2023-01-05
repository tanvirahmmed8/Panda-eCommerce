<div>
    @if ($carts->groupBy('vendor_id')->first() != null)
<!-- cart_section - start
================================================== -->
<section class="cart_section section_space">
    <div class="container">

        <div class="cart_table">
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Total</th>
                        <th class="text-center">Remove</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $subtotal = 0;
                        $error = false;
                        @endphp
                @foreach ($carts as $cart)
                @php
                    if(get_inventory($cart->product_id, $cart->size_id, $cart->color_id) < $cart->quantity){
                        $error = true;
                    }
                @endphp
                    <tr style="background-color: {{ (get_inventory($cart->product_id, $cart->size_id, $cart->color_id) < $cart->quantity) ? 'rgba(255, 84, 68, 0.228)':'' }}">
                        <td>
                            <div class="cart_product">
                                <img src="{{ asset('dashboard/uplaods/product_thumbnail') }}/{{ $cart->productrel->thumbnail }}" alt="image_not_found">
                                <h3><a href="{{ route('single.product', $cart->productrel->id) }}">{{ $cart->productrel->name }} (Color: {{ $cart->color_rel->color_name }} | Size: {{ $cart->size_rel->size }})
                                    <br><br><span class="badge bg-info">{{ $cart->vendor_rel->name }}</span>
                                    @if (get_inventory($cart->product_id, $cart->size_id, $cart->color_id) < $cart->quantity)
                                    <br><span class="badge bg-warning">In Stock: {{ get_inventory($cart->product_id, $cart->size_id, $cart->color_id) }}</span>
                                    @endif
                                </a></h3>

                            </div>
                        </td>
                        @if ($cart->productrel->discounted_price)
                        <td class="text-center"><span class="price_text">${{ $cart->productrel->discounted_price }}</span></td>
                        @else
                        <td class="text-center"><span class="price_text">${{ $cart->productrel->regular_price }}</span></td>
                        @endif
                        <td class="text-center">
                            <form action="#">
                                <div class="quantity_input">
                                    <button type="button" wire:click="decrement({{ $cart->id }})" class="input_number_decrement">
                                        <i class="fal fa-minus"></i>
                                    </button>
                                    <input type="text" wire:keyup="inputValue({{ $cart->id }},$event.target.value)" value="{{ $cart->quantity }}">
                                    <button type="button"  wire:click="increment({{ $cart->id }})" class="input_number_increment">
                                        <i class="fal fa-plus"></i>
                                    </button>
                                </div>
                            </form>
                        </td>
                        <td class="text-center"><span class="price_text">{{ currency() }}
                            {{ cart_total($cart->product_id, $cart->quantity) }}
                            @php
                                $subtotal += cart_total($cart->product_id, $cart->quantity);
                            @endphp
                        </span></td>
                        <td class="text-center"><button type="button" wire:click="cart_delete({{ $cart->id }})" class="remove_btn"><i class="fal fa-trash-alt"></i></button></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="cart_btns_wrap">
            <div class="row">
                <div class="col col-lg-6">
                    <div class="coupon_form form_item mb-0">
                        @php
                            session(['coupon' => $coupon_for_session]);
                            // echo session('coupon');
                        @endphp

                        <input type="text" wire:model="coupon_code" name="coupon" placeholder="Coupon Code..">
                        <button type="submit" wire:click="applycoupon(@if ($carts->groupBy('vendor_id')->first()[0]->vendor_id) {{ $carts->groupBy('vendor_id')->first()[0]->vendor_id }} @else 0 @endif,{{  $subtotal }})" class="btn btn_dark">Apply Coupon</button>

                        <div class="info_icon">
                            <i class="fas fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Your Info Here"></i>
                        </div>
                    </div>
                    <div class="text-danger">{{ $coupon_error }}</div>
                    <div class="text-danger"></div>
                </div>

                <div class="col col-lg-6">
                    <ul class="btns_group ul_li_right">
                        {{-- <li><a class="btn border_black" href="#!">Update Cart</a></li> --}}
                        @if ($error)
                        <li><a class="btn btn_dark" href="#!">Out Of Stock</a></li>
                        @else
                            @if ($delivery_forbutton != 0)
                                <li><a href="{{ route('checkout') }}" class="btn btn_dark" >Porceed To Checkout</a></li>
                            @endif
                        @endif
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col col-lg-6">
                <div class="calculate_shipping">
                    <h3 class="wrap_title">Calculate Shipping <span class="icon"><i class="far fa-arrow-up"></i></span></h3>
                    <div class="select_option clearfix">
                        <select wire:click="delivery($event.target.value)" class="form-select">
                            <option value="0" selected>Select Your Option</option>
                            @foreach ($shippings as $shipping)
                                <option value="{{ $shipping->id }}">{{ $shipping->shipping }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="col col-lg-6">
                <div class="cart_total_table">
                    <h3 class="wrap_title">Cart Totals</h3>
                    <ul class="ul_li_block">
                        <li>
                            <span>Cart Subtotal</span>
                            <span>{{ currency() }}{{ ceil($subtotal) }}</span>
                            @php
                                session(['subtotal' => ceil($subtotal)]);
                            @endphp
                        </li>
                        <li>
                            <span>Delivery Charge</span>
                            <span>{{ currency() }}{{ $delivery_charge }}</span>
                            @php
                                session(['delivery_charge' => $delivery_charge]);
                            @endphp
                        </li>
                        <li>
                            @php
                                if ($discount) {
                                    if($subtotal < $discount->minimum_purchase_amount){
                                        $discount = "";
                                    }
                                }
                            @endphp
                            <span>Discount</span>
                            @if ($discount)
                                @if ($discount->type == "percentage")
                                    <span>{{ $discount->discount_value }}%</span>
                                    @php
                                        session(['discount_value' => $discount->discount_value."%"]);
                                    @endphp
                                @else
                                    <span>{{ currency() }}{{ $discount->discount_value }}</span>
                                    @php
                                        session(['discount_value' => currency().$discount->discount_value]);
                                    @endphp
                                @endif
                            @else
                                <span>0</span>
                                @php
                                    session(['discount_value' => 0]);
                                @endphp
                            @endif
                        </li>
                        <li>
                            <span>Order Total</span>
                            <span class="total_price">{{ currency() }}{{ ceil(ordertotal($discount, $subtotal, $delivery_charge)) }}</span>
                            @php
                                session(['total_price' => ceil(ordertotal($discount, $subtotal, $delivery_charge))]);
                            @endphp
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- cart_section - end
================================================== -->
    @else
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
            <a class="btn btn_secondary" href="{{ route('shop') }}"><i class="far fa-chevron-left"></i> Continue shopping </a>
        </div>
    </div>
</section>
<!-- empty_cart_section - end
================================================== -->
    @endif

</div>
