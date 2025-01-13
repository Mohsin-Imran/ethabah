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
                <h3 class="text-white">إضافة استثمار</h3>
            </div>

            <div class="card-body p-2">
                <form method="POST" action="{{ route('investor.request.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="mb-3 mt-2 col-lg-12">
                            <label for="investor_funds_id" class="form-label">اختر صناديق المستثمر <span style="color: red;">*</span></label>
                            <select name="investor_funds_id" id="investor_funds_id" class="form-control @error('investor_funds_id') is-invalid @enderror" onchange="toggleInput()">
                                <option value="">اختر صناديق المستثمر</option>
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
                            <label for="pending_amount" class="form-label">الصناديق المعلقة</label>
                            <input type="text" id="pending_amount" class="form-control" readonly>
                        </div>
                        <div class="mb-3 mt-2 col-lg-12">
                            <label for="investment_amount" class="form-label">المبلغ</label>
                            <input type="number" id="investment_amount" name="amount" class="form-control" placeholder="أدخل المبلغ" min="1">
                            <span id="error_message" class="text-danger" style="display: none;">المبلغ يتجاوز الصناديق المعلقة!</span>
                        </div>
                    </div>
                    <button type="submit" class="btn-sm btn-primary">إضافة</button>
                </form>
            </div>
        </div>
    </div>
</div>
@include('select')
@endsection
