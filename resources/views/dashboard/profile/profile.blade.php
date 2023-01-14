@extends('layouts.master')
@section('title') Profile @endsection
@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Profile</a></li>
    </ol>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="profile card card-body px-3 pt-3 pb-0">
            <div class="profile-head">
                <div class="photo-content">
                    <div class="cover-photo" @if (auth()->user()->cover_photo) style="background-image: url({{ asset('dashboard/uplaods/cover_photos') }}/{{ auth()->user()->cover_photo }})" @endif ></div>
                </div>
                <div class="profile-info">
                    <div class="profile-photo">
                        @if (auth()->user()->profile_photo)
                            <img src="{{ asset('dashboard/uplaods/profile_photos') }}/{{ auth()->user()->profile_photo }}" class="img-fluid rounded-circle" alt="">
                        @else
                            <img src="{{ Avatar::create(Str::upper(auth()->user()->name))->toBase64() }}" class="img-fluid rounded-circle" alt="">
                        @endif
                    </div>
                    <div class="profile-details">
                        <div class="profile-name px-3 pt-2">
                            <h4 class="text-primary mb-0">{{ auth()->user()->name }}</h4>
                            <p>Name</p>
                        </div>
                        <div class="profile-email px-2 pt-2">
                            <h4 class="text-muted mb-0">{{ auth()->user()->email }}</h4>
                            <p>Email</p>
                        </div>
                        <div class="dropdown ml-auto">
                            <a href="#" class="btn btn-primary light sharp" data-toggle="dropdown" aria-expanded="true"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18px" height="18px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"></rect><circle fill="#000000" cx="5" cy="12" r="2"></circle><circle fill="#000000" cx="12" cy="12" r="2"></circle><circle fill="#000000" cx="19" cy="12" r="2"></circle></g></svg></a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li class="dropdown-item"><i class="fa fa-user-circle text-primary mr-2"></i> View profile</li>
                                <li class="dropdown-item"><i class="fa fa-users text-primary mr-2"></i> Add to close friends</li>
                                <li class="dropdown-item"><i class="fa fa-plus text-primary mr-2"></i> Add to group</li>
                                <li class="dropdown-item"><i class="fa fa-ban text-primary mr-2"></i> Block</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Profile Edit</h4>
            </div>
            <div class="card-body">
                <div class="basic-form">
                    <form action="{{ route('profile.photo.upload') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Profile Photo</label>
                            <div class="col-sm-6">
                                {{-- <input type="file" class="form-control" name="profile_photo"> --}}
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="profile_photo">
                                    <label class="custom-file-label">Choose file</label>
                                    @error('profile_photo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <button type="submit" class="btn btn-primary">Upload</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Profile Edit</h4>
            </div>
            <div class="card-body">
                <div class="basic-form">
                    <form action="{{ route('cover.photo.upload') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Cover Photo</label>
                            <div class="col-sm-6">
                                {{-- <input type="file" class="form-control" name="profile_photo"> --}}
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="cover_photo">
                                    <label class="custom-file-label">Choose file</label>
                                    @error('cover_photo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <button type="submit" class="btn btn-primary">Upload</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-6 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Password Change</h4>
            </div>
            <div class="card-body">
                <div class="basic-form">
                    @if ($errors->any())
                        <div class=" alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $err)
                                <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success">
                            <p>{{ session('success') }}</p>

                        </div>
                    @endif
                    <form action="{{ route('password.change') }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Current Password</label>
                            <div class="col-sm-9">
                                <input type="password" name="current_password" class="form-control" placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">New Password</label>
                            <div class="col-sm-9">
                                <input type="password" name="password" class="form-control" placeholder="Password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Conform Password</label>
                            <div class="col-sm-9">
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Password">
                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Change Password</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
