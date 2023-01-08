@extends('layouts.master')

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
                            <h3 class="text-white">{{ currency() }}{{ round($total_sell - $total_earn) }}</h3>
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
    <div class="row justify-content-center">
        <div class="class="col-lg-12"">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Team List</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                    <th>SL NO.</th>
                                    <th>NAME</th>
                                    <th>Email</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($teams as $team)

                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{ $team->name }}</td>
                                        <td>{{ $team->email }}</td>
                                        <td>{{ $team->created_at->diffForHumans() }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="#" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                                                <a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>

                                @empty
                                <tr>
                                    <td colspan="50" class=" text-center text-danger">No data to show!</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{-- </div> --}}
@endsection
