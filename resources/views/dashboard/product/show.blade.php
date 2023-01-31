@extends('layouts.master')
@section('title') Product @endsection
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Product</a></li>
    </ol>
</div>
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card mb-3" >
            <div class="row g-0">
              <div class="col-md-4">
                <img src="{{ asset('dashboard/uplaods/product_thumbnail') }}/{{ $product->thumbnail }}" class="img-fluid rounded-start" alt="...">
                <div class="text-center">
                    <a href="{{ route('vendor.applyforpromotion', $product->id) }}" class="ml-2 btn btn-sm btn-warning">Apply for Banner/Promotion</a>
                    <p><h5 class="d-inline">Note:</h5> It's Paid</p>
                </div>
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title">{{ $product->name }}</h5>
                  <h5> Code: #{{ $product->id }}</h5>
                  <p class="card-text"><h5>short_description:</h5>{{ $product->short_description }}</p>
                  <p class="card-text"><h5>created_at:</h5><small class="text-muted">{{ $product->created_at->diffForHumans() }}</small></p>
                </div>
              </div>
            </div>
            <div class="row">
            <div class="card-body">
                <p><h5 class="d-inline">category:</h5> {{ $product->categoryid->category_name }}</p>
                <p><h5 class="d-inline">purchase_price:</h5> {{ $product->purchase_price }}</p>
                <p><h5 class="d-inline">regular_price:</h5> {{ $product->regular_price }}</p>
                <p><h5 class="d-inline">discounted_price:</h5> {{ $product->discounted_price }}</p>
                <p><h5 class="d-inline">description:</h5> {{ $product->description }}</p>
                <p><h5 class="d-inline">additional_information:</h5> {{ $product->additional_information }}</p>
                <p><h5 class="d-inline">Last Update:</h5> {{ $product->updated_at }}</p>
            </div>
            </div>
          </div>
    </div>

</div>
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header d-sm-flex d-block pb-0 border-0">
                <div class="mr-auto pr-3 mb-sm-0 mb-3">
                    <h4 class="text-black fs-20">Product View and Click</h4>
                </div>
            </div>
            <div class="card-body pt-0 pb-0">
               <div class="table-responsive text-center">
                <table class="table table-primary">
                    <thead>
                        <tr>
                            <th scope="col">View Today</th>
                            <th scope="col">View Last 7 days</th>
                            <th scope="col">View Last 30 days</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="">
                            <td>{{ $today->count() }}</td>
                            <td>{{ $last_7_days->count() }}</td>
                            <td>{{ $last_30_days->count() }}</td>
                        </tr>
                    </tbody>
                </table>
               </div>

            </div>
        </div>
    </div>
</div>
@endsection
