@extends('layouts.app')

@section('header')
@include('layouts.header')
@endsection


@section('sidebar')
@include('layouts.sidebar')
@endsection

@section('content')

{{-- <div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-header-left">
                    <h3 class="">Add Vehicle</h3>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<div class="container-fluid">
    <div class="row">
        <div class="card p-1">
            <div class="card-header p-2 bg-primary">
                <h3 class="mb-0 text-white">Add Investor Funds</h3>
            </div>
            <div class="card-body p-2" dir="rtl">
                <form method="POST" action="{{ route('admin.investor.funds.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="mb-3 mt-2 col-lg-12">
                            <label for="user_id" class="form-label">Investors <span style="color: red;">*</span></label>
                            <select name="user_id" id="user_id" class="form-control @error('user_id') is-invalid @enderror">
                                <option value="">Select Inveator</option>
                                @foreach ($investors as $user)
                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name ?? '' }}
                                </option>
                                @endforeach
                            </select>
                            @error('user_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>


                        <div class="mb-3 mt-2 col-lg-12">
                            <label for="category" class="form-label">Category <span style="color: red;">*</span></label>
                            <select name="category_id" id="category" class="form-control @error('category_id') is-invalid @enderror">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3 mt-2 col-lg-12">
                            <label for="company" class="form-label">Company <span style="color: red;">*</span></label>
                            <select name="company_id" id="company" class="form-control @error('company_id') is-invalid @enderror">
                                <option value="">Select Company</option>
                            </select>
                            @error('company_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3 mt-2 col-lg-12">
                            <label for="profit_percentage" class="form-label">Profit Percentage <span style="color: red;">*</span></label>
                            <input type="number" placeholder="Profit Percentage" class="form-control @error('profit_percentage') is-invalid @enderror" name="profit_percentage" id="profit_percentage" value="{{ old('profit_percentage') }}">
                            @error('profit_percentage')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3 mt-2 col-lg-12">
                            <label for="duration_of_investment" class="form-label">Duration Of Investment <span style="color: red;">*</span></label>
                            <input type="number" placeholder="Duration Of Investment" class="form-control @error('duration_of_investment') is-invalid @enderror" name="duration_of_investment" id="duration_of_investment" value="{{ old('duration_of_investment') }}">
                            @error('duration_of_investment')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3 mt-2 col-lg-12">
                            <label for="message" class="form-label">Message</label>
                            <textarea name="message" id="message" class="form-control" cols="30" rows="5" placeholder="Message">{{ old('message') }}</textarea>
                            @error('message')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn-sm btn-primary">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>



@endsection
