@extends('layouts.master')
@section('title') withdraw @endsection
@push('stylesheet')
<!-- Datatable -->
<link href="{{ asset('dashboard') }}/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">withdraw</a></li>
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
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total_withdraw = 0;
                                @endphp
                                @foreach ($invoices as $invoice)
                                    <tr>
                                        <td>{{ $invoice->id }}</td>
                                        <td>{{ $invoice->customer_name }}</td>
                                        <td>{{ $invoice->order_status }}</td>
                                        <td>{{ currency() }}{{ $invoice->total_price }}</td>
                                        <td>{{ currency() }}{{ $invoice->total_price * 5 / 100 }}</td>
                                        <td>{{ currency() }}{{ floor($invoice->total_price - ($invoice->total_price * 5 / 100)) }}</td>
                                        @php
                                            $total_withdraw += floor($invoice->total_price - ($invoice->total_price * 5 / 100));
                                        @endphp
                                        <td>{{ $invoice->withdrawal_status }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="50" class="text-center">
                                        <h4>Total: {{ currency() }} {{ $total_withdraw  }}</h4>
                                        <form action="{{ route('withdraw.request') }}" method="post">
                                            @csrf
                                            <input type="text" class="d-none" name="invoices" value="{{ $invoices->pluck('id') }}">
                                            <input type="text" class="d-none" name="total_withdraw" value="{{ $total_withdraw  }}">
                                            <button class="btn btn-sm btn-success">Send withdraw Request</button>
                                        </form>
                                    </td>
                                </tr>
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
