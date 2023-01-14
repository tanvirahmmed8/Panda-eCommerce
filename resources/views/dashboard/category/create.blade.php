@extends('layouts.master')
@section('title') Category Create @endsection
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Category Create</a></li>
    </ol>
</div>

<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Category Create</h4>
            </div>
            <div class="card-body">
                <div class="basic-form">
                    @if (session('success'))
                        <div class="alert alert-success">
                           {{ session('success') }}
                        </div>
                    @endif
                    <form action="{{ route('category.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="category_name" class="form-label">Category Name</label>
                            <input type="text" name="category_name" id="category_name" class="form-control">
                            @error('category_name')
                            <p class=" text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="category_slug" class="form-label">Category Slug</label>
                            <input type="text" name="category_slug" id="category_slug" class="form-control">
                            <small id="helpId" class=" text-info">If you want to Change!</small>
                            @error('category_slug')
                            <p class=" text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="category_photo" class="form-label">Category Photo</label>
                            <input type="file" name="category_photo" id="category_photo" class="form-control">
                            {{-- <p class="custom-file-label">Choose file</p> --}}
                            @error('category_photo')
                            <p class=" text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Category Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
