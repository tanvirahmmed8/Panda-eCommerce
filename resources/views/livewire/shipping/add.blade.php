<div>
    <div class="row">
        <div class="col-md-8 col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Shipping List</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-primary">
                            <thead>
                                <tr>
                                    <th>Shippin Type</th>
                                    <th>Shippin Charge</th>
                                    <th>Shippin Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($shippings as $shipping)
                                <tr>
                                    <td>{{ $shipping->shipping }}</td>
                                    <td>{{ $shipping->shipping_value }}</td>
                                    <td>
                                        <label class="switch">
                                            <input wire:click="status_change({{ $shipping->id }})" {{ $shipping->status == true ? 'checked' : '' }} type="checkbox">
                                            <span class="slider round"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('shipping.edit',['shipping' => $shipping->id]) }}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                                            <form action="{{ route('shipping.destroy',['shipping' => $shipping->id]) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="50" class="text-danger text-center">No data to show</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-4 col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add Shipping</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        @if (session()->has('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif
                       <form wire:submit.prevent="add_shipping">
                            <div class="mb-3">
                              <label for="shipping" class="form-label">Shipping Type</label>
                              <input type="text" wire:model="shipping" id="shipping" class="form-control" placeholder="">
                              @error('shipping') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3">
                              <label for="shipping_value" class="form-label">Shipping Charge</label>
                              <input type="number" wire:model="shipping_value" id="shipping_value" class="form-control" placeholder="">
                              @error('shipping_value') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <button class="btn btn-primary" type="submit">Add Shipping</button>
                       </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
