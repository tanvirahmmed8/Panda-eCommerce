@extends('layouts.master')

@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit</a></li>
    </ol>
</div>

<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Category Edit</h4>
            </div>
            <div class="card-body">
                <div class="basic-form">
                    @if (session('success'))
                        <div class="alert alert-success">
                           {{ session('success') }}
                        </div>
                    @endif
                    <form action="{{ route('category.update', ['category' => $category->id]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="mb-3">
                            <label for="category_name" class="form-label">Category Name</label>
                            <input type="text" name="category_name" id="category_name" class="form-control" value="{{ $category->category_name }}">
                            @error('category_name')
                            <p class=" text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="category_slug" class="form-label">Category Slug</label>
                            <input type="text" name="category_slug" id="category_slug" class="form-control" value="{{ $category->category_slug }}">
                            <small id="helpId" class=" text-info">If you want to Change!</small>
                            @error('category_slug')
                            <p class=" text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="current_photo" class="form-label">Current Photo</label><br>
                            <img id="current_photo" width="100" src="{{ asset('dashboard/uplaods/category_photo') }}/{{ $category->category_photo }}" alt="image not found">
                        </div>
                        <div class="mb-3">
                            <label for="category_photo" class="form-label">Category Photo</label>
                            <input type="file" name="category_photo" id="category_photo" class="form-control">
                            {{-- <p class="custom-file-label">Choose file</p> --}}
                            @error('category_photo')
                            <p class=" text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Category Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
