@extends('layouts.master')

@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Brand</a></li>
    </ol>
</div>

<div class="row justify-content-center">
    <div class="col-md-5 col-lg-6">
        <div class="card pt-5" style="width: 18rem;">
            <img src="{{ asset('dashboard/uplaods/brand_logo') }}/{{ $brand->brand_logo }}" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">Brand Link</h5>
              <p class="card-text">{{ $brand->brand_link }}</p>
              <p class="card-title">Status: <span class="badge badge-info">{{ $brand->status }}</span></p>
              <a target="_blank" href="{{ $brand->brand_link }}" class="btn btn-primary">Visit Link</a>
              <a href="{{ route('brand.index') }}" class="btn btn-primary">Brand List</a>
            </div>
          </div>
    </div>
</div>
@endsection
