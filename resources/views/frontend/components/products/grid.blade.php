<div class="grid clearfix">
    <div class="product-pic">
        <img src="{{ asset('dashboard/uplaods/product_thumbnail') }}/{{ $product->thumbnail }}" alt="">
        @if ($product->discounted_price)
        <span class="theme-badge-2">{{ round(100-(($product->discounted_price/$product->regular_price)*100), 2) }}% off</span>
        @endif
        @if (stock($product) < 1)
        <span class="theme-badge" style="left:70%;">out</span>
        @endif
    </div>
    <div class="details">
        <h4><a href="{{ route('single.product', $product->id) }}">{{ Str::limit($product->name, 15, '...') }}</a></h4>
        <p><a href="{{ route('single.product', $product->id) }}">{{ Str::limit($product->short_description, 60, '...') }} </a></p>
        @php
            $avg = number_format(rating($product));
        @endphp
        <div class="rating">
            @for ($i = 1; $i <= $avg; $i++)
            <i class="fas fa-star full"></i>
            @endfor
            @for ($j = $avg+1; $j <= 5; $j++)
            <i class="fa fa-star"></i>
            @endfor
        </div>
        <span class="price">
            @if ($product->discounted_price)
                <ins>
                    <span class="woocommerce-Price-amount amount">
                        <bdi>
                            <span class="woocommerce-Price-currencySymbol">{{ currency() }}</span>{{ $product->discounted_price }}
                        </bdi>
                    </span>
                </ins>
                <del aria-hidden="true">
                    <span class="woocommerce-Price-amount amount">
                        <bdi>
                            <span class="woocommerce-Price-currencySymbol">{{ currency() }}</span>{{ $product->regular_price }}
                        </bdi>
                    </span>
                </del>
            @else
                <ins>
                    <span class="woocommerce-Price-amount amount">
                        <bdi>
                            <span class="woocommerce-Price-currencySymbol">{{ currency() }}</span>{{ $product->regular_price }}
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
