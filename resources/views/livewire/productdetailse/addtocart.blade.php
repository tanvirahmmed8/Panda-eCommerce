<div>
    <div class="item_attribute">
        <div class="row">
            <div class="col col-md-6">
                <div class="select_option clearfix">
                    <h4 class="input_title">Size *</h4>
                    <select class="form-select" wire:model="size_dropdown">
                        <option selected>Choose A Option</option>
                        @foreach ($available_sizes as $size)
                            <option value="{{ $size->sizeid->id }}">{{ $size->sizeid->size }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col col-md-6">
                <div class="select_option clearfix">
                    <h4 class="input_title">Color *</h4>
                    <select class="form-select" wire:model="color_dropdown">
                        @if ($available_colors)
                        <option>Choose A Option</option>
                            @foreach ($available_colors as $color)
                                <option value="{{ $color->id }}">{{  $color->colorid->color_name }}</option>
                            @endforeach
                        @else
                        <option data-display="- Please select -">Choose A Option</option>
                        @endif
                    </select>
                </div>
            </div>
        </div>
    </div>
    <p>Available Stock: {{ $stock }}</p><br>
    <div class="quantity_wrap">
        <div class="quantity_input">
            <div class="{{ $count_show }}">
                <button wire:click="decrement" class="input_number_decrement">
                    <i class="fal fa-minus"></i>
                </button>
                <input class="input_numberq" readonly type="text" value="{{ $count }}">
                <button wire:click="increment" class="input_number_increment">
                    <i class="fal fa-plus"></i>
                </button>
            </div>
        </div>
        <div class="total_price" id="total_p">Total: ${{ $total_price }}</div>
    </div>
    @if (session()->has('cart_success'))
        <div class="alert alert-success">
            {{ session('cart_success') }}
        </div>
    @endif
    @if (session()->has('cart_error'))
        <div class="alert alert-danger">
            {{ session('cart_error') }}
        </div>
    @endif
    <ul class="default_btns_group ul_li">
        @auth
            <li><a class="btn btn_primary addtocart_btn {{ $count_show }}" wire:click="addtocartbtn">Add To Cart</a></li>
        @else
        <!-- Button trigger modal -->
            <button type="button" class="btn btn_primary addtocart_btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Add To Cart
            </button>
        @endauth
    </ul>
    <h1>{{ $test }}</h1>
</div>

@section('script_b')
<script>
     @if(session('cart_success'))
    $(document).ready(function() {
        Swal.fire(
            'Congratulations!',
            '{{ session("cart_success") }}',
            'success'
            )
        });
    @endif
</script>
@endsection
