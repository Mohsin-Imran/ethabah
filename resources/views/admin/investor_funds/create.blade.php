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
                <h3 class="mb-0 text-white">Add investment Fund</h3>
            </div>
            <div class="card-body p-2" dir="rtl">
                <form method="POST" action="{{ route('admin.investor.funds.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="mb-3 mt-2 col-lg-12">
                            <label for="profit_percentage" class="form-label">Name <span style="color: red;">*</span></label>
                            <input type="text" placeholder="Name" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') }}">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3 mt-2 col-lg-12">
                            <label for="category" class="form-label">Category <span style="color: red;">*</span></label>
                            <select name="category_id" id="" class="form-control @error('category_id') is-invalid @enderror">
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
                            <select name="company_id[]" id="select3" multiple class="form-control @error('company_id') is-invalid @enderror">
                                <option value="" disabled>Select Company</option>
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}" {{ in_array($company->id, old('company_id', [])) ? 'selected' : '' }}>
                                        {{ $company->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('company_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3 mt-2 col-lg-12">
                            <label for="amount" class="form-label">Amount <span style="color: red;">*</span></label>
                            <input type="number" placeholder="Amount"  min="10" class="form-control @error('amount') is-invalid @enderror" name="amount" id="amount" value="{{ old('amount') }}">
                            @error('amount')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3 mt-2 col-lg-12">
                            <label for="profit_percentage" class="form-label">Profit Percentage <span style="color: red;">*</span></label>
                            <input type="number" placeholder="Profit Percentage" min="10" class="form-control @error('profit_percentage') is-invalid @enderror" name="profit_percentage" id="profit_percentage" value="{{ old('profit_percentage') }}">
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
                            <label for="month" class="form-label">Month <span style="color: red;">*</span></label>
                            <input type="number" placeholder="Month" min="1" class="form-control @error('month') is-invalid @enderror" name="month" id="month" value="{{ old('month') }}">
                            @error('month')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3 mt-2 col-lg-12">
                            <label for="year" class="form-label">Year <span style="color: red;">*</span></label>
                            <input type="number" placeholder="Year" min="1" class="form-control @error('year') is-invalid @enderror" name="year" id="year" value="{{ old('year') }}">
                            @error('year')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3 mt-2 col-lg-12">
                            <label class="form-label">Profit will be paid <span style="color: red;">*</span></label>
                            <div>
                                <input type="radio" id="monthly" name="profit" value="monthly" {{ old('profit') == 'monthly' ? 'checked' : '' }}>
                                <label for="monthly">Monthly</label>
                            </div>
                            <div>
                                <input type="radio" id="quarterly" name="profit" value="quarterly" {{ old('profit') == 'quarterly' ? 'checked' : '' }}>
                                <label for="quarterly">Quarterly</label>
                            </div>
                            <div>
                                <input type="radio" id="yearly" name="profit" value="yearly" {{ old('profit') == 'yearly' ? 'checked' : '' }}>
                                <label for="yearly">Yearly</label>
                            </div>
                            @error('profit')
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
@include('select')
@endsection
