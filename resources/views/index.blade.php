@extends('layouts.master')
@section('title') Team  @endsection
@section('content')


    <div class="container">
        <div class="row">
            {{-- <img class="card-img-top" src="holder.js/100x180/" alt="Title"> --}}
            <div class="col-3"></div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h3>Add Team Member</h3>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form class="row g-3 needs-validation" novalidate action="{{ route('team.post') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-12 mb-3">
                                <label for="validationCustom01" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" id="validationCustom01"
                                    required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="designation" class="form-label">Designation</label>
                                <input type="text" class="form-control" name="designation" id="designation"
                                    required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="validationCustom02" class="form-label">Phone</label>
                                <input type="text" class="form-control" name="phone" id="validationCustom02"
                                    required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="email" class="form-label">Email</label>
                                {{-- <div class="input-group has-validation"> --}}
                                    {{-- <span class="input-group-text" id="inputGroupPrepend">@</span> --}}
                                    <input type="email" name="email" class="form-control"
                                        id="email" id="email" required>
                                    <div class="invalid-feedback">
                                        Please choose a Email.
                                    </div>
                                {{-- </div> --}}
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" class="form-control" name="image" id="image"
                                    required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="invalidCheck"
                                        required>
                                    <label class="form-check-label" for="invalidCheck">
                                        Agree to terms and conditions
                                    </label>
                                    <div class="invalid-feedback">
                                        You must agree before submitting.
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">Submit form</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-3"></div>

        </div>

        <div class="row">
            {{-- <img class="card-img-top" src="holder.js/100x180/" alt="Title"> --}}
            <div class="col"></div>
            <div class="col-12">
                <div class="card mb-5">
                    <div class="card-header">
                        <h3 class="d-inline">Team Member
                            <span class="text-white badge bg-primary">{{ $teams_count }}</span>
                            <span class="float-end">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                    Recycle Bin
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Deleted Member</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container-fluid">
                                                <div class="row">
                                                  <div class="col-md-12">

                                                    <table class="table">
                                                        <thead>
                                                        <tr>
                                                            <th>SL</th>
                                                            <th>Name</th>
                                                            <th>Phone</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @forelse ($deleted_team as $item)
                                                        <tr>
                                                            <th>{{ $loop->index+1 }}</th>
                                                            <td>{{ $item->name }}</td>
                                                            <td>{{ $item->phone }}</td>

                                                            <td>
                                                                <a href="{{ url('team/forcedelete') }}/{{ $item->id }}" class=" btn btn-danger">Permanently Delete</a>
                                                                <a href="{{ url('team/restore') }}/{{ $item->id }}" class=" btn btn-info">Restore</a>
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
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <a href="{{ url('team/restore/all') }}" class=" btn btn-info">Restore All</a>
                                        </div>
                                    </div>
                                    </div>
                                </div>

                            </span>
                        </h3>

                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            @if (session('delete_massege'))
                                <div class="alert alert-warning" role="alert">
                                    {{ session('delete_massege') }}
                                </div>
                            @endif
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Image</th>
                                        <th>Detail</th>
                                        <th>Create At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($teams as $team)
                                        <tr
                                            class="@if ($loop->odd) table-primary @else table-danger @endif">
                                            <td>{{ $teams->firstitem() + $loop->index }}</td>
                                            {{-- <td>{{ $loop->index+1 }}</td> --}}
                                            <td>
                                                <img src="{{ asset('dashboard/uplaods/team_photos') }}/{{ $team->image }}" width="100" alt="">
                                            </td>
                                            <td>
                                                <ul>
                                                    <li>{{ $team->name }}</li>
                                                    <li>{{ $team->designation }}</li>
                                                    <li>{{ $team->phone }}</li>
                                                    <li>{{ $team->email }}</li>
                                                </ul>
                                            </td>
                                            <td>{{ $team->created_at->diffForHumans() }}</td>

                                            <td>
                                                <a href="{{ url('team/delete') }}/{{ $team->id }}"
                                                    class="btn btn-sm btn-danger">Delete</a>
                                                {{-- <a href="{{ url('team/edit') }}/{{ $team->id }}"
                                                    class="btn btn-sm btn-secondary">Edit</a> --}}
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop{{$team->id}}">
                                                    Edit modal
                                                  </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="staticBackdrop{{$team->id}}" data-bs-backdrop="static"
                                                    data-bs-keyboard="false" tabindex="-1"
                                                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Modal
                                                                    title</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <form class="row g-3 needs-validation" novalidate action="{{ url('team/update') }}/{{ $team->id}}" enctype="multipart/form-data" method="POST">
                                                                @csrf
                                                            <div class="modal-body">
                                                                <div class="col-md-12">
                                                                    <label for="validationCustom01" class="form-label">Name</label>
                                                                    <input type="text" class="form-control" name="name" id="validationCustom01" value="{{ $team->name }}"
                                                                        required>
                                                                    <div class="valid-feedback">
                                                                        Looks good!
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label for="designation" class="form-label">Designation</label>
                                                                    <input type="text" class="form-control" name="designation" value="{{ $team->designation }}" id="designation"
                                                                        required>
                                                                    <div class="valid-feedback">
                                                                        Looks good!
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label for="validationCustom02" class="form-label">Phone</label>
                                                                    <input type="text" class="form-control" name="phone" id="validationCustom02" value="{{ $team->phone }}"
                                                                        required>
                                                                    <div class="valid-feedback">
                                                                        Looks good!
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label for="validationCustomUsername" class="form-label">Email</label>
                                                                    <div class="input-group has-validation">
                                                                        <input type="email" name="email" class="form-control"
                                                                            id="validationCustomUsername"  value="{{ $team->email }}" required>
                                                                        <div class="invalid-feedback">
                                                                            Please choose a Email.
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label for="image" class="form-label">Image</label>
                                                                    <input type="file" class="form-control" name="image" id="image"
                                                                        required>
                                                                    <div class="valid-feedback">
                                                                        Looks good!
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Update</button>
                                                            </div>
                                                            </form>
                                                        </div>
                                                    </div>
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
                            <a href="{{ url('team/delete/all') }}" class="btn btn-warning">Delete all</a>
                        </div>
                        {{ $teams->links() }}

                    </div>
                </div>
            </div>
            <div class="col"></div>
        </div>
    </div>

@endsection
@push('scripts')
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (() => {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>
@endpush


