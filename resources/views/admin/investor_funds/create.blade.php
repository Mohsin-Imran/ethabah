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
<div class="container-fluid" dir="rtl" lang="ar">
    <div class="row">
        <div class="card p-1">
            <div class="card-header p-2 bg-primary">
                <h3 class="mb-0 text-white">إضافة صندوق استثماري</h3>
            </div>
            <div class="card-body p-2">
                <form method="POST" action="{{ route('admin.investor.funds.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="mb-3 mt-2 col-lg-12">
                            <label for="name" class="form-label">الاسم <span style="color: red;">*</span></label>
                            <input type="text" placeholder="الاسم" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') }}">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3 mt-2 col-lg-12">
                            <label for="category" class="form-label">الفئة <span style="color: red;">*</span></label>
                            <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                <option value="">اختر الفئة</option>
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
                            <label for="company" class="form-label">الشركة <span style="color: red;">*</span></label>
                            <select name="company_id[]" id="select3" multiple class="form-control custom-select @error('company_id') is-invalid @enderror">
                                @foreach ($companies as $requestBike)
                                @if ($requestBike->company)
                                <!-- Ensure the relationship exists -->
                                <option value="{{ $requestBike->company->id }}" data-total-funds="{{ $requestBike->total_funds }}" {{ in_array($requestBike->company->id, old('company_id', [])) ? 'selected' : '' }}>
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
                            <label for="total_funds" class="form-label">إجمالي الصناديق</label>
                            <input type="number" placeholder="إجمالي الصناديق" min="1" class="form-control" name="total_funds" id="total_funds" readonly>
                        </div>

                        <div class="mb-3 mt-2 col-lg-6">
                            <label for="amount" class="form-label">المبلغ</label>
                            <input type="number" placeholder="المبلغ" min="1" value="total_funds value auto pouplate user select company" class="form-control @error('amount') is-invalid @enderror" name="amount" id="amount" value="{{ old('amount') }}">
                        </div>

                        <div class="mb-3 mt-2 col-lg-12">
                            <label for="profit_percentage" class="form-label">نسبة الربح <span style="color: red;">*</span></label>
                            <input type="number" placeholder="نسبة الربح" min="1" class="form-control @error('profit_percentage') is-invalid @enderror" name="profit_percentage" id="profit_percentage" value="{{ old('profit_percentage') }}">
                            @error('profit_percentage')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3 mt-1 col-lg-6">
                            <label for="duration_of_investment" class="form-label">مدة الاستثمار <span style="color: red;">*</span></label>
                            <select name="duration_of_investment" id="duration_of_investment" class="form-control @error('duration_of_investment') is-invalid @enderror" required>
                                <option value="">مدة الاستثمار</option>
                                <option value="months">الأشهر</option>
                            </select>
                            @error('duration_of_investment')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-lg-6" style="margin-top: 33px;">
                            <input type="number" placeholder="عدد" min="1" class="form-control @error('month') is-invalid @enderror" name="month" id="month" value="{{ old('month') }}">
                            @error('month')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3 mt-2 col-lg-12">
                            <label class="form-label">سيتم دفع الربح <span style="color: red;">*</span></label>
                            <div>
                                <input type="radio" id="monthly" name="profit" value="monthly" {{ old('profit') == 'monthly' ? 'checked' : '' }}>
                                <label for="monthly">شهري</label>
                            </div>
                            <div>
                                <input type="radio" id="quarterly" name="profit" value="quarterly" {{ old('profit') == 'quarterly' ? 'checked' : '' }}>
                                <label for="quarterly">ربع سنوي</label>
                            </div>
                            <div>
                                <input type="radio" id="yearly" name="profit" value="yearly" {{ old('profit') == 'yearly' ? 'checked' : '' }}>
                                <label for="yearly">سنوي</label>
                            </div>
                            @error('profit')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
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
