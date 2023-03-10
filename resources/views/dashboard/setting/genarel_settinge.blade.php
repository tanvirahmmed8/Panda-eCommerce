@extends('layouts.master')
@section('title') Genarel Settings @endsection
@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Genarel Settings</a></li>
        </ol>
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Genarel Settings</h4>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                           {{ session('success') }}
                        </div>
                    @endif
                    <form action="{{ route('setting.genarel.save') }}" method="post">
                        @csrf
                        <div class="basic-form">
                            @foreach ($settings as $setting)
                            <div class="mb-3">
                                <label for="" class="form-label">{{ Str::title(Str::replaceFirst('_', ' ', $setting->setting_key)) }}</label>
                                <input type="text" name="{{ $setting->setting_key }}" id="{{ $setting->setting_key }}" class="form-control" value="{{ $setting->setting_value }}">
                            </div>
                            @endforeach
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Save Settings</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

