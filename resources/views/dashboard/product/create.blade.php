@extends('layouts.master')
@section('title') Product Create @endsection
@push('stylesheet')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<!-- Summernote -->
<link href="{{ asset('dashboard') }}/vendor/summernote/summernote.css" rel="stylesheet">
@endpush
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Product Create</a></li>
    </ol>
</div>

<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Product Create</h4>
            </div>
            <div class="card-body">
                <div class="basic-form">
                    {{-- @if (session('success'))
                        <div class="alert alert-success">
                           {{ session('success') }}
                        </div>
                    @endif --}}
                    <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control">
                            @error('name')
                            <p class=" text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select name="category_id" id="category_select" class="form-control">
                                <option selected disabled>--Select Category--</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <p class=" text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="purchase_price" class="form-label">Purchase Price</label>
                            <input type="number" step="0.01" name="purchase_price" id="purchase_price" class="form-control">
                            @error('purchase_price')
                            <p class=" text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="regular_price" class="form-label">Regular Price</label>
                            <input type="number" step="0.01" name="regular_price" id="regular_price" class="form-control">
                            @error('regular_price')
                            <p class=" text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="discounted_price" class="form-label">Discounted Price</label>
                            <input type="number" step="0.01" name="discounted_price" id="discounted_price" class="form-control">
                            @error('discounted_price')
                            <p class=" text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" rows="4" class="form-control summernote"></textarea>
                            @error('description')
                            <p class=" text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="short_description" class="form-label">Short Description</label>
                            <textarea name="short_description" id="short_description" rows="4" class="form-control"></textarea>
                            @error('short_description')
                            <p class=" text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="additional_information" class="form-label">Additional Information</label>
                            {{-- <textarea name="additional_information" id="additional_information" rows="4" class="form-control note-codable"></textarea>
                            @error('additional_information')
                            <p class=" text-danger">{{ $message }}</p>
                            @enderror --}}
                            <textarea name="additional_information" id="additional_information" rows="4" class="form-control summernote"></textarea>
                            {{-- <div class="summernote"></div> --}}
                        </div>
                        <div class="mb-3">
                            <label for="thumbnail" class="form-label">Thumbnail</label>
                            <input type="file" name="thumbnail" id="thumbnail" class="form-control">
                            @error('thumbnail')
                            <p class=" text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Add Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <!-- Summernote -->
   <script src="{{ asset('dashboard') }}/vendor/summernote/js/summernote.min.js"></script>
   <!-- Summernote init -->
   <script src="{{ asset('dashboard') }}/js/plugins-init/summernote-init.js"></script>
<script>
    // In your Javascript (external .js resource or <script> tag)
    $(document).ready(function() {
        $('#category_select').select2();
    });

    @if (session('success'))
    $(document).ready(function() {
        const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
        })

        Toast.fire({
        icon: 'success',
        title: "{{ session('success') }}"
        })
    });
    @endif

</script>
@endpush
