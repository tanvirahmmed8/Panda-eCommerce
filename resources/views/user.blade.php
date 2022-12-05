@extends('layouts.master')

@push('stylesheet')
<!-- Datatable -->
<link href="{{ asset('dashboard') }}/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked+.slider {
            background-color: #2196F3;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>

@endpush

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add New Admin </h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form action="{{ route('addnew.admin') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="admin_name" class="form-label">Admin Name</label>
                                <input type="text" name="admin_name" id="admin_name" class="form-control">
                                @error('admin_name')
                                    <p class=" text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="admin_email" class="form-label">Admin Email</label>
                                <input type="email" name="admin_email" id="admin_email" class="form-control">
                                @error('admin_email')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Add Admin</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- =========================
    Admin section start
    ========================= --}}
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Admin List</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="table table-responsive-md">
                            <thead>
                                <tr>
                                    <th>SL NO.</th>
                                    <th>Profile Photo</th>
                                    <th>NAME</th>
                                    <th>Email</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users->where('role', 'admin') as $user)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>
                                            @if ($user->profile_photo)
                                                <img src="{{ asset('dashboard/uplaods/profile_photos') }}/{{ $user->profile_photo }}"
                                                    width="50" class="img-fluid rounded-circle" alt="">
                                            @else
                                                <img src="{{ Avatar::create(Str::upper($user->name))->toBase64() }}"
                                                    width="50" alt="">
                                            @endif
                                        </td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->created_at->diffForHumans() }}</td>
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
    {{-- =========================
    Admin section end
    ========================= --}}

    {{-- =========================
    Vendor section start
    ========================= --}}
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Vendor List</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table  id="example3" class="table table-responsive-md display">
                            <thead>
                                <tr>
                                    <th>SL NO.</th>
                                    <th>Profile Photo</th>
                                    <th>Details</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users->where('role', 'vendor') as $user)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>
                                            @if ($user->profile_photo)
                                                <img src="{{ asset('dashboard/uplaods/profile_photos') }}/{{ $user->profile_photo }}"
                                                    width="50" class="img-fluid rounded-circle" alt="">
                                            @else
                                                {{-- <img src="{{ Avatar::create(Str::upper(auth()->user()->name))->toBase64() }}" class="img-fluid rounded-circle" alt=""> --}}
                                                <img src="{{ Avatar::create(Str::upper($user->name))->toBase64() }}"
                                                    width="50" alt="">
                                            @endif
                                        </td>
                                        <td>
                                            <ul>
                                                <li> <strong>Name: </strong> {{ $user->name }}</li>
                                                <li> <strong>Email: </strong> {{ $user->email }}</li>
                                                <li> <strong>Phone: </strong> {{ $user->phone_number }}</li>
                                            </ul>
                                        </td>
                                        <td>{{ $user->action == true ? 'avtive' : 'deactive' }}</td>
                                        <td>
                                            <form action="{{ route('vendor.action.change', $user->id) }}" method="post">
                                                @csrf
                                                <label class="switch">
                                                    <input onchange="this.form.submit()"
                                                        {{ $user->action == true ? 'checked' : '' }} type="checkbox">
                                                    <span class="slider round"></span>
                                                </label>
                                            </form>
                                        </td>
                                        <td>{{ $user->created_at->diffForHumans() }}</td>
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
    {{-- =========================
    Admin section end
    ========================= --}}
@endsection

@push('scripts')
 <!-- Datatable -->
 <script src="{{ asset('dashboard') }}/vendor/datatables/js/jquery.dataTables.min.js"></script>
 <script src="{{ asset('dashboard') }}/js/plugins-init/datatables.init.js"></script>
@endpush
