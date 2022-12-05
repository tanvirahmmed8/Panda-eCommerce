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
                <form wire:submit.prevent="insert_color">
                    <div class="mb-3">
                        <label for="color_name" class="form-label">Color Name</label>
                        <input type="text" wire:model="color_name" id="color_name" class="form-control">
                        @error('color_name')
                        <p class=" text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="color_code" class="form-label">Color Code</label><br>
                        <input type="color" wire:model="color_code" id="color_code">
                        @error('color_name')
                        <p class=" text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Add variation color</button>
                </form>
            </div>
        </div>
        <div class="card-footer">
            <div class="table-responsive">
                <table class="table table-primary">
                    <thead>
                        <tr>
                            <th>Color Name</th>
                            <th>Color Code</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       @forelse ($colors as $color)
                         <tr>
                             <td>{{ $color->color_name }}</td>
                             <td><input type="color" readonly disabled value="{{ $color->color_code }}"></td>
                             <td>
                                 <button wire:click="delete_color({{ $color->id }})" class="btn btn-sm btn-danger">Delete</button>
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
