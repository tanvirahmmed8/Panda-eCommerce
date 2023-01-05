@extends('layouts.master')

@push('stylesheet')
<!-- Datatable -->
<link href="{{ asset('dashboard') }}/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Product List</a></li>
    </ol>
</div>

    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Product List</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="table table-responsive-md">
                            <thead>
                                <tr>
                                    <th>Product Photo</th>
                                    <th>NAME</th>
                                    <th>Category</th>
                                    <th>regular_price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $product)
                                    <tr>
                                        <td>
                                            @if ($product->thumbnail)
                                                <img src="{{ asset('dashboard/uplaods/product_thumbnail') }}/{{ $product->thumbnail }}"
                                                    width="100" class="img-fluid rounded-circle" alt="">
                                            @else
                                                <img src="{{ Avatar::create(Str::upper($product->name))->toBase64() }}"
                                                    width="100" alt="">
                                            @endif
                                        </td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->categoryid->category_name }}</td>
                                        <td>{{ $product->regular_price }}</td>
                                        <td>
                                            <a href="{{ route('inventory', $product->id) }}" class="btn btn-sm btn-secondary">Add Inventory</a>
                                            <a href="{{ route('product.edit', $product->id) }}" class="btn btn-sm btn-success">Edit</a>
                                            <form action="{{ route('product.destroy',  $product->id) }}" method="post" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>

                                @empty
                                <tr>
                                    <td colspan="50" class=" text-center text-danger">No data to show!</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
 <!-- Datatable -->
 <script src="{{ asset('dashboard') }}/vendor/datatables/js/jquery.dataTables.min.js"></script>
 <script src="{{ asset('dashboard') }}/js/plugins-init/datatables.init.js"></script>
@endpush
