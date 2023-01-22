@extends('layouts.master')
@section('title') Order @endsection
@push('stylesheet')
<!-- Datatable -->
<link href="{{ asset('dashboard') }}/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="page-titles">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">Order</a></li>
    </ol>
</div>

    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Order List</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="table table-responsive-md">
                            <thead>
                                <tr>
                                    <th>Order No</th>
                                    {{-- <th>Customer NAME</th> --}}
                                    <th>Product list</th>
                                    <th>Method</th>
                                    <th>P_Status</th>
                                    <th>order_status</th>
                                    <th>Total</th>
                                    <th>Created</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoices as $invoice)
                                    <tr>
                                        <td>{{ $invoice->id }}</td>
                                        {{-- <td>{{ $invoice->customer_name }}</td> --}}
                                        <td>
                                            <ul style="height: 100px;overflow-y: auto;">
                                                @foreach ($invoice->invoice_detail_rel as $item)
                                                    <li>{{ $item->product->name }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>{{ $invoice->payment_method }}</td>
                                        <td>{{ $invoice->payment_status }}</td>
                                        <td>{{ $invoice->order_status }}</td>
                                        <td>{{ currency() }}{{ $invoice->total_price }}</td>
                                        <td>{{ $invoice->created_at->diffForHumans() }}</td>
                                        <td>
                                            <form action="{{ route('order.status', $invoice->id) }}" method="post">
                                                @csrf
                                                <select name="order_status" onchange="this.form.submit()">
                                                    <option>Change status</option>
                                                    <option {{ ($invoice->order_status == 'packeging')? 'selected':'' }} value="packeging">Packeging</option>
                                                    <option {{ ($invoice->order_status == 'shipping')? 'selected':'' }} value="shipping">Shipping</option>
                                                    <option {{ ($invoice->order_status == 'deleverd')? 'selected':'' }} value="deleverd">Deleverd</option>
                                                </select>
                                            </form>
                                        </td>
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
