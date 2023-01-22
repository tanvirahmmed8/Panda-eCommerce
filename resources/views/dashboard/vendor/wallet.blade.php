@extends('layouts.master')
@section('title') Wallet @endsection
@push('stylesheet')
<!-- Datatable -->
<link href="{{ asset('dashboard') }}/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Wallet</a></li>
    </ol>
</div>

<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Redy for withdrawal</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="" class="table table-responsive-md">
                        <thead>
                            <tr>
                                <th>Order No</th>
                                <th>Customer NAME</th>
                                <th>order_status</th>
                                <th>Order Total</th>
                                <th>Commission(5%)</th>
                                <th>Net Total</th>
                                <th>Withdrawal Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    <form action="{{ route('vendor.withdraw') }}" method="post">
                        @csrf
                        <tbody>
                            @foreach ($invoices as $invoice)
                                <tr>
                                    <td>{{ $invoice->id }}</td>
                                    <td>{{ $invoice->customer_name }}</td>
                                    <td>{{ $invoice->order_status }}</td>
                                    <td>{{ currency() }}{{ $invoice->total_price }}</td>
                                    <td>{{ currency() }}{{ $invoice->total_price * 5 / 100 }}</td>
                                    <td>{{ currency() }}{{ floor($invoice->total_price - ($invoice->total_price * 5 / 100)) }}</td>
                                    <td>{{ $invoice->withdrawal_status }}</td>
                                    <td>
                                        @if ($invoice->withdrawal_status == 'Ready to withdraw')
                                        <div class="form-check">
                                            <input class="form-check-input" name="invoices[]" type="checkbox" value="{{ $invoice->id }}" aria-label="Text for screen reader">
                                        </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="50" class="text-right">
                                    <button class="btn btn-primary" type="submit">Get Payment</button>
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
                <h4 class="card-title">Withdrawal Done</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example3" class="table table-responsive-md">
                        <thead>
                            <tr>
                                <th>Order No</th>
                                <th>Customer NAME</th>
                                <th>order_status</th>
                                <th>Order Total</th>
                                <th>Commission(5%)</th>
                                <th>Net Total</th>
                                <th>Withdrawal Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invoice_dones as $invoice)
                                <tr>
                                    <td>{{ $invoice->id }}</td>
                                    <td>{{ $invoice->customer_name }}</td>
                                    <td>{{ $invoice->order_status }}</td>
                                    <td>{{ currency() }}{{ $invoice->total_price }}</td>
                                    <td>{{ currency() }}{{ $invoice->total_price * 5 / 100 }}</td>
                                    <td>{{ currency() }}{{ floor($invoice->total_price - ($invoice->total_price * 5 / 100)) }}</td>
                                    <td>{{ $invoice->withdrawal_status }}</td>
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
