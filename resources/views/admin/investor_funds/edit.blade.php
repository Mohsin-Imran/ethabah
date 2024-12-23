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
            <div class="card-header p-2 bg-primary d-flex flex-row justify-content-between">
                <h3 class="mb-0 text-white">Update investment Funds</h3>
            </div>
            <div class="card-body p-2">
                <form method="POST" action="{{ route('admin.investor.funds.update', $investorFund->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="mb-3 mt-2 col-lg-12">
                            <label for="name" class="form-label">Name <span style="color: red;">*</span></label>
                            <input type="text" placeholder="Name" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name', $investorFund->name) }}">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3 mt-2 col-lg-12">
                            <label for="category_id" class="form-label">Category <span style="color: red;">*</span></label>
                            <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $investorFund->category_id) == $category->id ? 'selected' : '' }}>
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
                            <select name="company_id[]" id="select3" multiple class="form-control custom-select @error('company_id') is-invalid @enderror">
                                @foreach ($companies as $requestBike)
                                @if ($requestBike->company)
                                <!-- Ensure the relationship exists -->
                                <option value="{{ $requestBike->company->id }}" data-total-funds="{{ $requestBike->total_funds }}" {{ in_array($requestBike->company->id, old('company_id', $investorFund->companies->pluck('id')->toArray())) ? 'selected' : '' }}>
                                    {{ $requestBike->company->name }}
                                </option>
                                @endif
                                @endforeach
                            </select>
                            @error('company_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>



                        <div class="mb-3 mt-2 col-lg-6">
                            <label for="amount" class="form-label">Total Funds</label>
                            <input type="number" placeholder="Total Funds" min="1" value="{{ old('amount', $investorFund->total_funds) }}" class="form-control" name="total_funds" id="total_funds" readonly>
                        </div>

                        {{-- <div class="mb-3 mt-2 col-lg-12">
                            <label for="company_id" class="form-label">Company <span style="color: red;">*</span></label>
                            <select name="company_id[]" id="select3" multiple="multiple" class="form-control @error('company_id') is-invalid @enderror">
                                @foreach ($companies as $company)
                                <option value="{{ $company->id }}" {{ in_array($company->id, old('company_id', $investorFund->companies->pluck('id')->toArray())) ? 'selected' : '' }}>
                        {{ $company->name }}
                        </option>
                        @endforeach
                        </select>
                        @error('company_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div> --}}

                    <div class="mb-3 mt-2 col-lg-6">
                        <label for="amount" class="form-label">Amount <span style="color: red;">*</span></label>
                        <input type="number" placeholder="Amount" class="form-control @error('amount') is-invalid @enderror" name="amount" id="amount" value="{{ old('amount', $investorFund->amount) }}">
                        @error('amount')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mb-3 mt-2 col-lg-12">
                        <label for="profit_percentage" class="form-label">Profit Percentage <span style="color: red;">*</span></label>
                        <input type="number" placeholder="Profit Percentage" class="form-control @error('profit_percentage') is-invalid @enderror" name="profit_percentage" id="profit_percentage" value="{{ old('profit_percentage', $investorFund->profit_percentage) }}">
                        @error('profit_percentage')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mb-3 mt-1 col-lg-6">
                        <label for="duration_of_investment" class="form-label">Duration Of Investment <span style="color: red;">*</span></label>
                        <select name="duration_of_investment" id="duration_of_investment" class="form-control @error('duration_of_investment') is-invalid @enderror" required>
                            <option value="">Duration Of Investment</option>
                            <option value="months" {{ $investorFund->duration_of_investment == 'months' ? 'selected' : '' }}>Months</option>
                        </select>
                        @error('duration_of_investment')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-lg-6" style="margin-top: 33px;">
                        <input type="number" placeholder="Number" min="1" class="form-control @error('month') is-invalid @enderror" name="month" id="month" value="{{ old('month', $investorFund->month) }}">
                        @error('month')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3 mt-2 col-lg-12">
                        <label class="form-label">Profit will be paid <span style="color: red;">*</span></label>
                        <div>
                            <input type="radio" id="monthly" name="profit" value="monthly" {{ old('profit', $investorFund->profit) == 'monthly' ? 'checked' : '' }}>
                            <label for="monthly">Monthly</label>
                        </div>
                        <div>
                            <input type="radio" id="quarterly" name="profit" value="quarterly" {{ old('profit', $investorFund->profit) == 'quarterly' ? 'checked' : '' }}>
                            <label for="quarterly">Quarterly</label>
                        </div>
                        <div>
                            <input type="radio" id="yearly" name="profit" value="yearly" {{ old('profit', $investorFund->profit) == 'yearly' ? 'checked' : '' }}>
                            <label for="yearly">Yearly</label>
                        </div>
                        @error('profit')
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
@include('select')
@endsection
