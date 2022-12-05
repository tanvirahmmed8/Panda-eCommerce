@extends('layouts.master')

@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Policy</a></li>
    </ol>
</div>

<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Profile Edit</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-responsive-md">
                        <thead>
                            <tr>
                                <th>SL NO.</th>
                                <th>Name</th>
                                <th>Text</th>
                                <th>Icon</th>
                                <th>Status</th>
                                <th>Create Date</th>
                                <th>Change status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($policies as $policy)

                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $policy->policy_name }}</td>
                                    <td>{{ $policy->policy_text }}</td>
                                    <td><div class="badge badge-info"><i class="fa-2x {{ $policy->policy_icon }}"></i></div></td>
                                    <td>
                                        @if ($policy->status == 'active')
                                        <div class="badge badge-success">Active</div>
                                        @else
                                        <div class="badge badge-warning">Deactive</div>
                                        @endif
                                    </td>
                                    <td>{{ $policy->created_at->diffForHumans() }}</td>
                                    <td>
                                        <form action="{{ route('change.policy.status', ['id' => $policy->id]) }}" method="post">
                                            @csrf
                                            @if ($policy->status == 'active')
                                            <input type="text" name="status" hidden value="deactive">
                                            @else
                                            <input type="text" name="status" hidden value="active">
                                            @endif

                                            @if ($policy->status == 'active')
                                            <button type="submit" class="btn-sm btn btn-warning">Deactive</button>
                                            @else
                                            <button type="submit" class="btn-sm btn btn-success">Active</button>
                                            @endif
                                        </form>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('policy.edit', ['policy' => $policy->id]) }}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                                            <form action="{{ route('policy.destroy', ['policy' => $policy->id]) }}" method="post">
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
