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
                <h4 class="card-title">Policy Edit</h4>
            </div>
            <div class="card-body">
                <div class="basic-form">
                    @if (session('success'))
                        <div class="alert alert-success">
                           {{ session('success') }}
                        </div>
                    @endif
                    <form action="{{ route('policy.update', ['policy' => $policy->id]) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="mb-3 input-primary">
                            <label for="policy_name" class="form-label">Policy Name</label>
                            <input type="text" name="policy_name" id="policy_name" class="form-control" value="{{ $policy->policy_name }}">
                            {{-- <small id="helpId" class=" text-info">If you want to Change!</small> --}}
                            @error('policy_name')
                            <p class=" text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 input-primary">
                            <label for="policy_text" class="form-label">Policy Text</label>
                            <input type="text" name="policy_text" id="policy_text" class="form-control" value="{{ $policy->policy_text }}">
                            {{-- <small id="helpId" class=" text-info">If you want to Change!</small> --}}
                            @error('policy_text')
                            <p class=" text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 input-primary">
                            <label for="policy_icon" class="form-label">Policy Icon</label>
                            <span id="view_style" class="badge badge-info"><i id="view_icon" class=" {{ $policy->policy_icon }}" style="font-size: 2em;"></i></span>
                            <input readonly type="text" name="policy_icon" id="policy_icon" class="form-control" value="{{ $policy->policy_icon }}">
                            @error('policy_icon')
                            <div class=" text-danger">{{ $message }}</div>
                            @enderror
                            <div class="card text-start">
                                <div class="card-header">
                                    <h4 class="card-title">Icon</h4>
                                </div>
                              <div class="card-body text-dark" style="overflow-y: scroll; height: 250px;">

                                @foreach($fontAwesomeIcons as $font)
                                <span class="badge badge-dark m-1 icon_span" id="{{ $font }}"><i class="fa-2x {{ $font }}"></i></span>
                                @endforeach
                              </div>
                            </div>

                        </div>
                        <button type="submit" class="btn btn-primary">Policy Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function(){
        $('.icon_span').click(function(){
        //    alert($(this).attr('id'))
        $('#policy_icon').val($(this).attr('id'));
        $('#view_icon').removeClass();
        $('#view_icon').addClass($(this).attr('id'));
        $('#view_style').removeClass();
        $('#view_style').addClass('badge badge-info');
        });
    });
    </script>
@endpush
