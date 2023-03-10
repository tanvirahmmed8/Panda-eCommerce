@extends('layouts.master')
@section('title') Logo Upload @endsection
@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Logo Upload</a></li>
        </ol>
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Logo Upload</h4>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                           {{ session('success') }}
                        </div>
                    @endif
                    <form action="{{ route('setting.logo.update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="basic-form">
                            @foreach ($logos as $logo)
                            <div class="mb-3">
                                <img src="{{ asset('dashboard/uplaods/logo') }}/{{ $logo->logo_value }}" alt=""><br>
                                <label for="{{ $logo->logo_key }}" class="form-label">{{ Str::title(Str::replace('_', ' ', $logo->logo_key)) }}</label>
                                <input type="file" name="{{ $logo->logo_key }}" id="{{ $logo->logo_key }}" class="form-control">
                            </div>
                            @endforeach
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Upload</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

