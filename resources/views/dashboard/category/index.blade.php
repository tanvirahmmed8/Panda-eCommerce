@extends('layouts.master')
@section('title') Category @endsection
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Category</a></li>
    </ol>
</div>

<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Category List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-responsive-md">
                        <thead>
                            <tr>
                                <th>SL NO.</th>
                                <th>Category NAME</th>
                                <th>Category Slug</th>
                                <th>Category Image</th>
                                <th>Create Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $category)

                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $category->category_name }}</td>
                                    <td>{{ $category->category_slug }}</td>
                                    <td><img width="50" src="{{ asset('dashboard/uplaods/category_photo') }}/{{ $category->category_photo }}" alt="Image not found"></td>
                                    <td>{{ $category->created_at->diffForHumans() }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('category.edit', ['category' => $category->id]) }}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                                            {{-- <form action="{{ route('category.edit', ['category' => $category->id]) }}" method="post">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></button>
                                            </form> --}}
                                            <form action="{{ route('category.destroy', ['category' => $category->id]) }}" method="post">
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
{{-- Recycel bin section start --}}

<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Recycle Bin</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-responsive-md">
                        <thead>
                            <tr>
                                <th>SL NO.</th>
                                <th>Category NAME</th>
                                <th>Category Slug</th>
                                <th>Category Image</th>
                                <th>Deleted Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($deleted_categories as $category)

                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $category->category_name }}</td>
                                    <td>{{ $category->category_slug }}</td>
                                    <td><img width="50" src="{{ asset('dashboard/uplaods/category_photo') }}/{{ $category->category_photo }}" alt="Image not found"></td>
                                    <td>{{ $category->deleted_at->diffForHumans() }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('category.restore', ['id' => $category->id]) }}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-undo"></i></a>
                                            <a href="{{ route('category.forcedelete', ['id' => $category->id]) }}" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                                            {{-- <form action="{{ route('category.restore', ['category' => $category->id]) }}" method="GET">
                                                @csrf
                                                @method('POST')
                                                <button type="submit" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-undo"></i></button>
                                            </form> --}}
                                            {{-- <form action="{{ route('category.destroy', ['category' => $category->id]) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></button>

                                            </form> --}}
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
{{-- Recycel bin section end --}}
@endsection
