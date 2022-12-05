@extends('layouts.master')

@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Coupon</a></li>
        </ol>
    </div>

    <div class="row">
        <div class="col-md-4 col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add Coupon</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <form action="{{ route('coupon.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                              <label for="coupon_code" class="form-label">Coupon Code</label>
                              <input type="text" name="coupon_code" id="coupon_code" class="form-control" value="{{ Str::upper(Str::random(6)) }}">
                              @error('coupon_code')
                                 <div class="text-danger">{{ $message }}</div>
                              @enderror
                            </div>
                            <div class="mb-3">
                              <label for="type" class="form-label">Type</label>
                                <select class="form-select form-control" name="type" id="type">
                                    <option selected disabled>Select one</option>
                                    <option value="flatdiscount">Flat Discount(৳)</option>
                                    <option value="percentage">Percentage(%)</option>
                                </select>
                                @error('type')
                                 <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="discount_value" class="form-label">Discount Value(% or ৳)</label>
                                <input type="number" step="0.01" name="discount_value" id="discount_value" class="form-control" placeholder="">
                                @error('discount_value')
                                 <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="minimum_purchase_amount" class="form-label">Minimum Purchase Amount</label>
                                <input type="number" step="0.01" name="minimum_purchase_amount" id="minimum_purchase_amount" class="form-control" placeholder="Minimum Purchase">
                                @error('minimum_purchase_amount')
                                 <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="maximum_discount_value" class="form-label">Maximum Discount Value(Optional)</label>
                                <input type="number" step="0.01" name="maximum_discount_value" id="maximum_discount_value" class="form-control" placeholder="Maximum Discount Value">
                            </div>
                            <button type="submit" class="btn btn-primary">Add Coupon</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8 col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Coupon List</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-primary">
                            <thead>
                                <tr>
                                    <th>Coupon Code</th>
                                    {{-- <th>Type</th> --}}
                                    <th>Discount</th>
                                    <th>Min Purchase</th>
                                    <th>Max Discount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($coupons as $coupon)
                                    <tr>
                                        <td>{{ $coupon->coupon_code }}</td>
                                        {{-- <td>{{ $coupon->type }}</td> --}}
                                        <td>{{ $coupon->discount_value }} {{ ($coupon->type == 'percentage') ? '%':'৳' }}</td>
                                        <td>{{ $coupon->minimum_purchase_amount.'৳' }}</td>
                                        <td>{{ $coupon->maximum_discount_value.'৳' }}</td>
                                    </tr>
                                @empty

                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
