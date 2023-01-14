@extends('layouts.master')
@section('title') Brand @endsection
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Brand</a></li>
    </ol>
</div>

<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Brand Edit</h4>
            </div>
            <div class="card-body">
                <div class="basic-form">
                    @if (session('success'))
                        <div class="alert alert-success">
                           {{ session('success') }}
                        </div>
                    @endif
                    <form action="{{ route('brand.update', ['brand' => $brand->id]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="mb-3">
                            <label for="brand_logo" class="form-label">Current Brand Logo</label><br>
                            <img width="300" src="{{ asset('dashboard/uplaods/brand_logo') }}/{{ $brand->brand_logo }}" alt="image not found">
                        </div>
                        <div class="mb-3 input-primary">
                            <label for="brand_logo" class="form-label">Brand Logo</label>
                            <input type="file" name="brand_logo" id="brand_logo" class="form-control">
                            {{-- <p class="custom-file-label">Choose file</p> --}}
                            @error('brand_logo')
                            <div class=" text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 input-primary">
                            <label for="brand_link" class="form-label">Brand Link</label>
                            <input type="url" name="brand_link" id="brand_link" class="form-control" value="{{ $brand->brand_link }}">
                            {{-- <small id="helpId" class=" text-info">If you want to Change!</small> --}}
                            @error('brand_link')
                            <p class=" text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Brand Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
