@extends('layouts.master')
@section('title') Trash @endsection
@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Trash</a></li>
        </ol>
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Product List</h4>
                </div>
                <div class="card-body">
                    .<div class="table-responsive">
                        <table class="table table-primary">
                            <thead>
                                <tr>
                                    <th>Product Photo</th>
                                    <th>NAME</th>
                                    <th>Category</th>
                                    <th>Delete Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach ($trash_products as $trash_product)
                                 <tr>
                                    <td>
                                        @if ($trash_product->thumbnail)
                                            <img src="{{ asset('dashboard/uplaods/product_thumbnail') }}/{{ $trash_product->thumbnail }}"
                                                width="100" class="img-fluid rounded-circle" alt="">
                                        @else
                                            <img src="{{ Avatar::create(Str::upper($trash_product->name))->toBase64() }}"
                                                width="100" alt="">
                                        @endif
                                    </td>
                                     <td>{{ $trash_product->name }}</td>
                                     <td>{{ $trash_product->categoryid->category_name }}</td>
                                     <td>{{ $trash_product->deleted_at->diffforhumans() }}</td>
                                     <td><a href="{{ route('restore', ['product' => $trash_product->id]) }}" class="btn btn-sm btn-secondary">Restore</a></td>
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

