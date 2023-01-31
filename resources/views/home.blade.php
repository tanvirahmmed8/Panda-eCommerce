@extends('layouts.master')
@section('title') Home @endsection
@section('content')
{{-- <div class="container"> --}}
    <div class="row">
        <div class="col-xl-3 col-lg-6 col-sm-6">
            <div class="widget-stat card bg-danger">
                <div class="card-body  p-4">
                    <div class="media">
                        <span class="mr-3">
                            <i class="flaticon-381-calendar-1"></i>
                        </span>
                        <div class="media-body text-white text-right">
                            @php
                                $total_sell = $invoices->sum('total_price')-$invoices->sum('delivery_charge');
                            @endphp
                            <p class="mb-1">Total Sell</p>
                            <h3 class="text-white">{{ currency() }}{{ $total_sell }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-sm-6">
            <div class="widget-stat card bg-success">
                <div class="card-body p-4">
                    <div class="media">
                        <span class="mr-3">
                            <i class="flaticon-381-diamond"></i>
                        </span>
                        <div class="media-body text-white text-right">
                            <p class="mb-1">Earning</p>
                            <h3 class="text-white">{{ currency() }}{{ round(($total_sell - $total_earn)-($total_sell*5/100)) }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-sm-6">
            <div class="widget-stat card bg-info">
                <div class="card-body p-4">
                    <div class="media">
                        <span class="mr-3">
                            <i class="flaticon-381-heart"></i>
                        </span>
                        <div class="media-body text-white text-right">
                            <p class="mb-1">Total Patient</p>
                            <h3 class="text-white">a</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-sm-6">
            <div class="widget-stat card bg-primary">
                <div class="card-body p-4">
                    <div class="media">
                        <span class="mr-3">
                            <i class="flaticon-381-user-7"></i>
                        </span>
                        <div class="media-body text-white text-right">
                            <p class="mb-1">Chef</p>
                            <h3 class="text-white">a</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

{{-- </div> --}}
@endsection
