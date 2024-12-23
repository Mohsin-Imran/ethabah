@extends('layouts.app')

@section('header')
@include('layouts.header')
@endsection


@section('sidebar')
@include('layouts.sidebar')
@endsection

@section('content')



<div class="container-fluid">
    <div class="row">
        <div class="card p-1">
            <div class="card-header bg-primary p-2 d-flex flex-row">
                <h3 class="text-white">Edit Setting</h3>
            </div>

            <div class="card-body p-2">
                <form method="POST" action="{{ route('admin.setting.update') }}">
                    @csrf
                    <div class="row">
                        <div class="mb-3 mt-2 col-lg-12">
                            <label for="name" class="form-label">Name <span style="color: red;">*</span></label>
                            <input type="text" value="{{ $setting->name ?? '' }}" placeholder="Name" class="form-control @error('name') is-invalid @enderror" name="name" id="name">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3 mt-2 col-lg-12">
                            <label for="email" class="form-label">Email <span style="color: red;">*</span></label>
                            <input type="email" value="{{ $setting->email ?? '' }}" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" id="email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3 mt-2 col-lg-12">
                            <label for="phone" class="form-label">Phone <span style="color: red;">*</span></label>
                            <input type="text" value="{{ $setting->phone ?? '' }}" placeholder="Phone" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone">
                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3 mt-2 col-lg-12">
                            <label for="password" class="form-label">Password <span style="color: red;">*</span></label>
                            <input type="password" value="" placeholder="New Password" class="form-control @error('password') is-invalid @enderror" name="password" id="password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3 mt-2 col-lg-12">
                            <label for="password_confirmation" class="form-label">Confirm Password <span style="color: red;">*</span></label>
                            <input type="password" value="" placeholder="Confirm Password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" id="password_confirmation">
                            @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn-sm btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
