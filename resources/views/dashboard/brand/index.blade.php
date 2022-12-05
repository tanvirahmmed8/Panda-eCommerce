@extends('layouts.master')

@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Brand</a></li>
    </ol>
</div>

<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Brand List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-responsive-md">
                        <thead>
                            <tr>
                                <th>SL NO.</th>
                                <th>Brand Logo</th>
                                {{-- <th>Category Slug</th> --}}
                                <th>Status</th>
                                <th>Create Date</th>
                                <th>Change status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($brands as $brand)

                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td><img width="150" src="{{ asset('dashboard/uplaods/brand_logo') }}/{{ $brand->brand_logo }}" alt="Image not found"></td>
                                    {{-- <td>{{ $brand->brand_link }}</td> --}}
                                    <td>
                                        @if ($brand->status == 'active')
                                        <div class="badge badge-success">Active</div>
                                        @else
                                        <div class="badge badge-warning">Deactive</div>
                                        @endif
                                    </td>
                                    <td>{{ $brand->created_at->diffForHumans() }}</td>
                                    <td>
                                        <form action="{{ route('change.status', ['id' => $brand->id]) }}" method="post">
                                            @csrf
                                            @if ($brand->status == 'active')
                                            <input type="text" name="status" hidden value="deactive">
                                            @else
                                            <input type="text" name="status" hidden value="active">
                                            @endif
                                            <button type="submit" class="btn-sm btn btn-success">Change status</button>
                                        </form>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('brand.edit', ['brand' => $brand->id]) }}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                                            <a href="{{ route('brand.show', ['brand' => $brand->id]) }}" class="btn btn-info shadow btn-xs sharp mr-1"><i class="fa fa-eye"></i></a>
                                            {{-- <form action="{{ route('category.edit', ['category' => $category->id]) }}" method="post">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></button>
                                            </form> --}}
                                            <form action="{{ route('brand.destroy', ['brand' => $brand->id]) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </div>
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
