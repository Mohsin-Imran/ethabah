@extends('layouts.app')

@section('header')
@include('layouts.header')
@endsection


@section('sidebar')
@include('layouts.sidebar')
@endsection

@section('content')



<div class="container-fluid" dir="rtl">
    <div class="row">
        <div class="card p-1">
            <div class="card-header bg-primary p-2 d-flex flex-row">
                <h3 class="text-white">Add Investment</h3>
            </div>

            <div class="card-body p-2">
                <form method="POST" action="{{ route('investor.request.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="mb-3 mt-2 col-lg-12">
                            <label for="investor_funds_id" class="form-label">Select Investor Funds <span style="color: red;">*</span></label>
                            <select name="investor_funds_id" id="investor_funds_id" class="form-control @error('investor_funds_id') is-invalid @enderror" onchange="toggleInput()">
                                <option value="">Select Investor Funds</option>
                                @foreach ($investorFunds as $investorFund)
                                <option value="{{ $investorFund->id }}" data-pending="{{ $investorFund->pending_amount }}" data-total="{{ $investorFund->amount }}" {{ old('investor_funds_id') == $investorFund->id ? 'selected' : '' }}>
                                    {{ $investorFund->name ?? '' }}
                                </option>
                                @endforeach
                            </select>
                            @error('investor_funds_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3 mt-2 col-lg-12" id="amount-container" style="display: none;">
                            <label for="pending_amount" class="form-label">Pending Funds</label>
                            <input type="text" id="pending_amount" class="form-control" readonly>
                        </div>
                        <div class="mb-3 mt-2 col-lg-12">
                            <label for="investment_amount" class="form-label">Amount</label>
                            <input type="number" id="investment_amount" name="amount" class="form-control" placeholder="Enter amount" min="1">
                            <span id="error_message" class="text-danger" style="display: none;">Amount exceeds the pending funds!</span>
                        </div>

                        <div class="mb-3 mt-2 col-lg-12">
                            <label for="start_of_period" class="form-label">Start of Period <span style="color: red;">*</span></label>
                            <input type="date" placeholder="start_of_period" class="form-control @error('start_of_period') is-invalid @enderror" name="start_of_period" id="start_of_period" value="">
                            @error('start_of_period')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3 mt-2 col-lg-12">
                            <label for="end_of_period" class="form-label">End of Period <span style="color: red;">*</span></label>
                            <input type="date" placeholder="end_of_period" class="form-control @error('end_of_period') is-invalid @enderror" name="end_of_period" id="end_of_period" value="">
                            @error('end_of_period')
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
