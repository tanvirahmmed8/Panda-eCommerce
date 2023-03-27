<div>
    <div class="cart_sidebar">
        @php
        $subtotalg = 0;

        @endphp
        <button type="button" class="close_btn"><i class="fal fa-times"></i></button>
       @if ($cartgs->count() > 0)
         <ul class="cart_items_list ul_li_block mb_30 clearfix">
             @foreach ($cartgs as $cartg)
                 <li>
                     <div class="item_image">
                         <img src="{{ asset('dashboard/uplaods/product_thumbnail') }}/{{ $cartg->productrel->thumbnail }}" alt="image_not_found">
                     </div>
                     <div class="item_content">
                         <h4 class="item_title">{{ $cartg->productrel->name }}</h4>
                     </div>
                     @php
                         $subtotalg += cart_total($cartg->product_id, $cartg->quantity);
                     @endphp
                      @if ($cartg->productrel->discounted_price)
                      <span class="remove_btn">{{ currency() }}{{ $cartg->quantity * $cartg->productrel->discounted_price }}</span>
                      @else
                      <span class="remove_btn">{{ currency() }}{{ $cartg->quantity * $cartg->productrel->regular_price }}</span>
                      @endif
                     {{-- <button type="button" class="remove_btn"><i class="fal fa-trash-alt">{{ $cartg->quantity }} </i></button> --}}
                 </li>
             @endforeach

         </ul>

         <ul class="total_price ul_li_block mb_30 clearfix">
             <li>
                 <span>Subtotal:</span>
                 <span>{{ currency() }}{{ ceil($subtotalg) }}</span>
             </li>
         </ul>

       @else
        <ul class="btns_group ul_li_block mb-5 clearfix">
            <div class="empty_cart_content text-center">
                <span class="cart_icon">
                    <i class="icon icon-ShoppingCart"></i>
                </span>
                <h3>There are no more items in your cart</h3>
                <a class="btn btn_secondary" href="{{ route('shop') }}"><i class="far fa-chevron-left"></i> Continue shopping </a>
            </div>
        </ul>
       @endif
       <ul class="btns_group ul_li_block clearfix">
        <li><a class="btn btn_primary" href="{{ route('cart') }}">View Cart</a></li>
        {{-- <li><a class="btn btn_secondary" href="checkout.html">Checkout</a></li> --}}
        </ul>
    </div>
    <div class="cart_overlay"></div>
</div>
