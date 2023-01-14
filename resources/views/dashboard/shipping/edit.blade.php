@extends('layouts.master')
@section('title') Shipping @endsection
@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Shipping</a></li>
        </ol>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Shipping Edit</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form action="{{ route('shipping.update', ['shipping' => $shipping->id]) }}" method="post">
                            @csrf
                            @method('PATCH')
                            <div class="mb-3">
                              <label class="form-label">Shipping Type</label>
                              <input type="text" name="shipping" class="form-control" value="{{ $shipping->shipping }}">
                              @error('shipping') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Shipping Charge</label>
                              <input type="number" name="shipping_value" class="form-control" value="{{ $shipping->shipping_value }}">
                              @error('shipping_value') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <button class="btn btn-primary" type="submit">Update Shipping</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
