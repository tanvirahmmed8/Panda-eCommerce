@extends('layouts.master')
@section('title') Inventory @endsection
@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Inventory</a></li>
        </ol>
    </div>

    <div class="row">
        <div class="col-md-4 col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add Inventory -- {{ $product->name }}</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{ route('addinventory', $product->id) }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="size_id" class="form-label">Size</label>
                                <select class="form-select form-control" name="size_id" id="size_id">
                                    <option selected disabled>Select one</option>
                                    @forelse ($sizes as $size)
                                        <option value="{{ $size->id }}">{{ $size->size }}</option>
                                    @empty

                                    @endforelse
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="color_id" class="form-label">Color</label>
                                <select class="form-select form-control" name="color_id" id="color_id">
                                    <option selected disabled>Select one</option>
                                    @forelse ($colors as $color)
                                        <option value="{{ $color->id }}">{{ $color->color_name }}</option>
                                    @empty
                                        <option disabled>--Null--</option>
                                    @endforelse
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="quantity" class="form-label">Quantity</label>
                                <input type="number" name="quantity" id="quantity" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary">Add Inventory</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8 col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Inventory List -- {{ $product->name }}</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-primary">
                            <thead>
                                <tr>
                                    <th>Color</th>
                                    <th>Size</th>
                                    <th>Quantity</th>
                                    <th>Purchase Value</th>
                                </tr>
                            </thead>
                            @php
                                $total_purchase_value = 0;
                            @endphp
                            <tbody>
                                @forelse ($inventories as $inventory)
                                 <tr>
                                     {{-- <td>{{ $inventory }}</td> --}}
                                     <td>{{ $inventory->colorid->color_name }}</td>
                                     <td>{{  $inventory->sizeid->size }}</td>
                                     <td>{{ $inventory->quantity }}</td>
                                     <td>{{ $inventory->quantity * $product->purchase_price }} TK</td>
                                     @php
                                         $total_purchase_value += ($inventory->quantity * $product->purchase_price);
                                     @endphp
                                 </tr>
                               @empty
                                 <tr>
                                    <td colspan="50" class="text-danger text-center">No data to show!</td>
                                 </tr>
                               @endforelse
                            </tbody>
                            <tfoot>
                                <tr class="table-warning">
                                    <td colspan="3">Total Amount</td>
                                    <td>{{ $total_purchase_value }} TK</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
