@extends('layouts.frontendmaster')

@section('content')
<!-- breadcrumb_section - start
================================================== -->
<div class="breadcrumb_section">
    <div class="container">
        <ul class="breadcrumb_nav ul_li">
            <li><a href="{{ route('index') }}">Home</a></li>
            <li>My Account</li>
        </ul>
    </div>
</div>
<!-- breadcrumb_section - end
================================================== -->

<!-- account_section - start
================================================== -->
<section class="account_section section_space">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 account_menu">
                <div class="nav account_menu_list flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <button class="nav-link text-start active w-100" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Account Dashboard </button>
                    <button class="nav-link text-start w-100" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Acount</button>
                    <button class="nav-link text-start w-100" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">My Orders</button>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="tab-content bg-light p-3" id="v-pills-tabContent">
                    @if($errors->any())
                        <div class="alert alert-danger" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                            @endforeach
                        </ul>
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            <strong>{{ session('success') }}</strong>
                        </div>

                    @endif
                    <div class="tab-pane fade show active text-center" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <h5>Welcome to Account</h5>
                        <div class="row mb-3">
                            <div class="col-sm-4">
                                <div class="card widget-flat">
                                    <div class="card-body">
                                        <h5 class="text-muted fw-normal mt-0" title="Number of Customers">Total Order</h5>
                                        <h3 class="mt-3 mb-3">{{ $invoices->count() }}</h3>
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col-->

                            <div class="col-sm-4">
                                <div class="card widget-flat">
                                    <div class="card-body">
                                        <h5 class="text-muted fw-normal mt-0" title="Number of Customers">Online Order</h5>
                                        <h3 class="mt-3 mb-3">{{ $invoices->where('payment_method', 'stripe')->count() + $invoices->where('payment_method','SSL')->count() }}</h3>
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col-->

                            <div class="col-sm-4">
                                <div class="card widget-flat">
                                    <div class="card-body">
                                        <h5 class="text-muted fw-normal mt-0" title="Number of Customers">COD Order</h5>
                                        <h3 class="mt-3 mb-3">{{ $invoices->where('payment_method', 'COD')->count() }}</h3>
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col-->
                        </div>{{-- end row --}}
                        <div class="row">

                            <div class="col-sm-4">
                                <div class="card widget-flat">
                                    <div class="card-body">
                                        <h5 class="text-muted fw-normal mt-0" title="Number of Customers">Total Order Value</h5>
                                        <h3 class="mt-3 mb-3">{{ $invoices->sum('total_price') }}</h3>
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col-->

                            <div class="col-sm-4">
                                <div class="card widget-flat">
                                    <div class="card-body">
                                        <h5 class="text-muted fw-normal mt-0" title="Number of Customers">Total Paid</h5>
                                        <h3 class="mt-3 mb-3">{{ $invoices->where('payment_status', 'paid')->sum('total_price') }}</h3>
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col-->

                            <div class="col-sm-4">
                                <div class="card widget-flat">
                                    <div class="card-body">
                                        <h5 class="text-muted fw-normal mt-0" title="Number of Customers">Total Unpaid</h5>
                                        <h3 class="mt-3 mb-3">{{ $invoices->where('payment_status', 'unpaid')->sum('total_price') }}</h3>
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col-->
                        </div>{{-- end row --}}
                    </div>
                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                        <h5 class="text-center pb-3">Account Details</h5>
                        <form class="row g-3 p-2" action="{{ route('profileupdate') }}" method="POST">
                            @csrf
                            <div class="col-md-6">
                                <label for="inputnamel4" class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" id="inputnamel4" value="{{ $profile->name }}">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="inputEmail4" class="form-label">Phone</label>
                                <input type="tel" name="phone_number" class="form-control" id="inputEmail4" value="{{ $profile->phone_number }}">
                                @error('phone_number')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="inputPassword4" class="form-label">Current Password</label>
                                <input type="password" name="current_password" class="form-control" id="inputPassword4">
                                @error('current_password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="inputPassword4" class="form-label">New Password</label>
                                <input type="password" name="password" class="form-control" id="inputPassword4">
                                @error('password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="inputPassword4" class="form-label">Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control" id="inputPassword4">
                                @error('password_confirmation')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-primary active">Update</button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                        <h5 class="text-center pb-3">Your Orders</h5>
                        <table class="table table-bordered">
                            <tr>
                                <th>SL</th>
                                <th>Order No</th>
                                <th>Sub Total</th>
                                <th>Discount</th>
                                <th>Delivery Charge</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($invoices_list as $invoice)

                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>#{{ $invoice->id }}</td>
                                    <td>{{ $invoice->subtotal }}</td>
                                    <td>{{ ($invoice->subtotal+$invoice->delivery_charge)-$invoice->total_price }}</td>
                                    <td>{{ $invoice->delivery_charge }}</td>
                                    <td>{{ $invoice->total_price }}</td>
                                    <td>
                                        <a href="{{ route('download.invoice', $invoice->id) }}" class="btn btn-primary">Download Invoice</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        {{ $invoices_list->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- account_section - end
================================================== -->
@endsection
