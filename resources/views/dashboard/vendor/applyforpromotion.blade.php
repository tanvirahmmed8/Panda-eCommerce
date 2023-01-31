@extends('layouts.master')
@section('title') Promotion @endsection
@section('content')
    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Promotion</a></li>
        </ol>
    </div>

    <div class="row">
        <div class="col-md-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Apply for Banner -- {{ $product->name }} </h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{ route('vendor.apply_banner') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <input type="text" name="product_id" value="{{ $product->id }}" hidden>
                              <label for="short_title" class="form-label">Short Title</label>
                              <input type="text"
                                class="form-control" name="short_title" id="short_title" aria-describedby="helpId" placeholder="">
                              <small id="helpId" class="form-text text-muted">Help text</small>
                              @error('short_title')
                              <p class=" text-danger">{{ $message }}</p>
                              @enderror
                            </div>
                            <div class="mb-3">
                              <label for="short_description" class="form-label">Short Description</label>
                              <input type="text"
                                class="form-control" name="short_description" id="short_description" aria-describedby="helpId" placeholder="">
                              <small id="helpId" class="form-text text-muted">Help text</small>
                              @error('short_description')
                              <p class=" text-danger">{{ $message }}</p>
                              @enderror
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Banner image</label>
                                <input type="file"
                                  class="form-control" name="image" id="image" aria-describedby="helpId">
                                <small id="helpId" class="form-text text-muted">Help text</small>
                                @error('image')
                                <p class=" text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Apply for Promotion -- {{ $product->name }}</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{ route('vendor.apply_promotion') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="text" name="product_id" value="{{ $product->id }}" hidden>
                            <div class="mb-3">
                              <label for="p_short_description" class="form-label">Short Description</label>
                              <input type="text"
                                class="form-control" name="p_short_description" id="p_short_description" aria-describedby="helpId" placeholder="">
                              <small id="helpId" class="form-text text-muted">Help text</small>
                              @error('p_short_description')
                              <p class=" text-danger">{{ $message }}</p>
                              @enderror
                            </div>
                            <div class="mb-3">
                                <label for="p_image" class="form-label">Banner image</label>
                                <input type="file"
                                  class="form-control" name="p_image" id="p_image" aria-describedby="helpId">
                                <small id="helpId" class="form-text text-muted">Help text</small>
                                @error('p_image')
                                <p class=" text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card text-start">
              <div class="card-body">
                <h4 class="card-title">Promotion List</h4>
                <div class="table-responsive">
                    <table class="table table-primary">
                        <thead>
                            <tr>
                                <th scope="col">Image</th>
                                <th scope="col">short_title</th>
                                <th scope="col">Product Code</th>
                                <th scope="col">short_description</th>
                                <th scope="col">type</th>
                                <th scope="col">status</th>
                                <th scope="col">created_at</th>
                            </tr>
                        </thead>
                        <tbody>
                           @forelse ($promotions as $promotion)
                             <tr>
                                 <td>
                                    <img width="150" src="{{ asset('dashboard/uplaods/banner') }}/{{ $promotion->image }}" alt="">
                                 </td>
                                 <td>{{ $promotion->short_title }}</td>
                                 <td>#{{ $promotion->product_id }}</td>
                                 <td>{{ $promotion->short_description }}</td>
                                 <td>{{ $promotion->type }}</td>
                                 <td>@if ($promotion->status == 0)
                                    Panding
                                    @else
                                    Approved
                                    @endif
                                </td>
                                 <td>{{ $promotion->created_at }}</td>
                             </tr>
                           @empty

                           @endforelse
                        </tbody>
                    </table>
                </div>

              </div>
            </div>
        </div>
    </div>
@endsection

