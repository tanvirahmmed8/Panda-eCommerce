<div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Add variation size</h4>
        </div>
        <div class="card-body">
            <div class="basic-form">
                @if (session()->has('success'))
                        <div class="alert alert-success">
                           {{ session('success') }}
                        </div>
                @endif
                <form wire:submit.prevent="insert_size">
                    <div class="mb-3">
                        <label for="size" class="form-label">Size</label>
                        <input type="text" wire:model="size" id="size" class="form-control">
                        @error('size')
                        <p class=" text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Add variation size</button>
                </form>
            </div>
        </div>
        <div class="card-footer">
            <div class="table-responsive">
                <table class="table table-primary">
                    <thead>
                        <tr>
                            <th>Size</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       @forelse ($sizes as $size)
                         <tr>
                             <td>{{ $size->size }}</td>
                             <td>
                                 <button wire:click="delete_size({{ $size->id }})" class="btn btn-sm btn-danger">Delete</button>
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
