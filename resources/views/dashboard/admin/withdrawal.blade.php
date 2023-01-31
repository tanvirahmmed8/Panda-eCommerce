@extends('layouts.master')
@section('title') Withdrawal @endsection
@push('stylesheet')
<!-- Datatable -->
<link href="{{ asset('dashboard') }}/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Withdrawal</a></li>
    </ol>
</div>

<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Withdrawal List</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="" class="table table-responsive-md">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Order No</th>
                                <th>Vendor</th>
                                <th>Vendor Name</th>
                                <th>status</th>
                                <th>Total</th>
                                <th>Created</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <form action="{{ route('withdrawal.status_change') }}" method="post">
                            @csrf
                        <tbody>
                            @foreach ($withdrawal_requests as $withdrawal_request)
                                <tr>
                                    <td>{{ $withdrawal_request->id }}</td>
                                    <td>{{ $withdrawal_request->invoice_id }}</td>
                                    <td>{{ $withdrawal_request->vendor_id }}</td>
                                    <td>
                                        <ul>
                                            <li>{{ $withdrawal_request->user_info->name }}</li>
                                            <li>{{ $withdrawal_request->user_info->email }}</li>
                                            <li>{{ $withdrawal_request->user_info->phone_number }}</li>
                                        </ul>
                                    </td>
                                    <td>{{ $withdrawal_request->status }}</td>
                                    <td>{{ currency() }} {{ floor($withdrawal_request->invoice_info->total_price - ($withdrawal_request->invoice_info->total_price * 5 / 100)) }}</td>
                                    <td>{{ $withdrawal_request->created_at->diffforhumans() }}</td>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" name="withdrawal[]" type="checkbox" value="{{ $withdrawal_request->id }}">
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="50" class="text-right">
                                    <button class="btn btn-primary" type="submit">Change Status</button>
                                </td>
                            </tr>
                        </tbody>
                    </form>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Withdrawal Paid</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example3" class="table table-responsive-md">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Order No</th>
                                <th>Vendor</th>
                                <th>Vendor Name</th>
                                <th>status</th>
                                <th>Total</th>
                                <th>Created</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($withdrawal_paids as $withdrawal_request)
                                <tr>
                                    <td>{{ $withdrawal_request->id }}</td>
                                    <td>{{ $withdrawal_request->invoice_id }}</td>
                                    <td>{{ $withdrawal_request->vendor_id }}</td>
                                    <td>
                                        <ul>
                                            <li>{{ $withdrawal_request->user_info->name }}</li>
                                            <li>{{ $withdrawal_request->user_info->email }}</li>
                                            <li>{{ $withdrawal_request->user_info->phone_number }}</li>
                                        </ul>
                                    </td>
                                    <td>{{ $withdrawal_request->status }}</td>
                                    <td>{{ currency() }} {{ floor($withdrawal_request->invoice_info->total_price - ($withdrawal_request->invoice_info->total_price * 5 / 100)) }}</td>
                                    <td>{{ $withdrawal_request->created_at->diffforhumans() }}</td>
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
 <!-- Datatable -->
 <script src="{{ asset('dashboard') }}/vendor/datatables/js/jquery.dataTables.min.js"></script>
 <script src="{{ asset('dashboard') }}/js/plugins-init/datatables.init.js"></script>
@endpush
