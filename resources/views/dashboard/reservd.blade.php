@extends('layouts.master')

@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Profile</a></li>
        </ol>
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Profile Edit</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        ------
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
