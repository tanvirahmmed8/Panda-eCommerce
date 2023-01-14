@extends('layouts.master')
@section('title') Product Image @endsection
@push('stylesheet')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<!-- Summernote -->
<link href="{{ asset('dashboard') }}/vendor/summernote/summernote.css" rel="stylesheet">
@endpush
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Product Image</a></li>
    </ol>
</div>
<div class="row">
    <div class="col-md-6 col-lg-6">
        <div class="card mb-3" style="max-width: 540px;">
            <div class="row g-0">
              <div class="col-md-4">
                <img src="{{ asset('dashboard/uplaods/product_thumbnail') }}/{{ $product->thumbnail }}" class="img-fluid rounded-start" alt="...">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title">{{ $product->name }}</h5>
                  <p class="card-text">{{ Str::limit($product->short_description, 100, '...') }}</p>
                  <p class="card-text"><small class="text-muted">{{ $product->created_at->diffForHumans() }}</small></p>
                </div>
              </div>
            </div>
          </div>
    </div>
    <div class="col-md-6 col-lg-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Product Image</h4>
            </div>
            <div class="card-body">
                <div class="basic-form">
                    @if ($product->product_image->count() < 6)
                    <form action="{{ route('product.image.post', $product->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" name="image" id="image" class="form-control">
                            @error('image')
                            <p class=" text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Add Image</button>
                    </form>
                    @else
                    <div class="text-danger">
                        You can't Add More then 5 Images!
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Image List</h4>
                <div class="table-responsive">
                    <table class="table table-primary">
                        <thead>
                            <tr>
                                <th scope="col">Image</th>
                                <th scope="col">Created at</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($product->product_image as $product_image)
                             <tr>
                                 <td>
                                    <img src="{{ asset('dashboard/uplaods/product_thumbnail') }}/{{ $product_image->image }}" class="img-fluid" width="100" alt="...">
                                 </td>
                                 <td>{{ $product_image->created_at->diffForHumans() }}</td>
                                 <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $product_image->id }}">
                                        Edit
                                    </button>
                                    {{-- <a href="" class="btn btn-primary"></a> --}}
                                    <a href="{{ route('product.image.delete', $product_image->id) }}" class="btn btn-danger">Delete</a>
                                 </td>
                             </tr>
                           @endforeach
                        </tbody>
                    </table>
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
