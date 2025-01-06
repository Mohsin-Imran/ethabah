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
                <h3 class="mb-0 text-white"> إسم الصندوق </h3>
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
                            <div class="mb-3 mt-2 col-lg-12">
                                <label for="company" class="form-label">الشركات <span style="color: red;">*</span></label>
                                <select name="company_id[]" id="select3" multiple class="form-control custom-select @error('company_id') is-invalid @enderror">
                                    @foreach ($companies as $requestBike)
                                    @if ($requestBike->company)
                                    <!-- Ensure the relationship exists -->
                                    <option value="{{ $requestBike->company->id }}"
                                            data-total-funds="{{ $requestBike->total_funds }}"
                                            data-requestbike-id="{{ $requestBike->id }}"
                                            {{ in_array($requestBike->company->id, old('company_id', [])) ? 'selected' : '' }}>
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

                            <!-- Input field for RequestBike ID (will be dynamically populated) -->
                            <div class="mb-3">
                                <label for="requestbike_id" class="form-label">RequestBike ID</label>
                                <input type="text" id="requestbike_id" class="form-control" readonly>
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

                        <div class="mb-3 mt-2 col-lg-12">
                            <label for="start_of_period" class="form-label">داية فترة التمويل</label>
                            <input type="date" min="1" class="form-control @error('start_of_period') is-invalid @enderror" name="start_of_period" id="start_of_period" value="{{ old('start_of_period') }}">
                            @error('start_of_period')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3 mt-2 col-lg-12">
                            <label for="end_of_period" class="form-label">نهاية الفترة</label>
                            <input type="date"  placeholder="نسبة الربح" min="1" class="form-control @error('end_of_period') is-invalid @enderror" name="end_of_period" id="end_of_period" value="{{ old('end_of_period') }}">
                            @error('end_of_period')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3 mt-2 col-lg-12">
                            <label for="image" class="form-label">صورة</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image" value="{{ old('image') }}" onchange="previewImage(event)">
                            @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <div id="image-preview-container" class="mt-3" style="display:none;">
                                <img id="image-preview" src="" alt="Image Preview" style="max-width: 100%; height: auto;">
                            </div>
                        </div>



{{--
                        <div class="mb-3 mt-2 col-lg-12">
                            <label class="form-label">سيتم دفع الربح <span style="color: red;">*</span></label>
                            <div>
                                <input type="radio" id="monthly" name="profit" value="monthly" {{ old('profit') == 'monthly' ? 'checked' : '' }} onclick="toggleCustomMonths(false)">
                                <label for="monthly">شهري</label>
                            </div>
                            <div>
                                <input type="radio" id="quarterly" name="profit" value="quarterly" {{ old('profit') == 'quarterly' ? 'checked' : '' }} onclick="toggleCustomMonths(false)">
                                <label for="quarterly">ربع سنوي</label>
                            </div>
                            <div>
                                <input type="radio" id="yearly" name="profit" value="yearly" {{ old('profit') == 'yearly' ? 'checked' : '' }} onclick="toggleCustomMonths(false)">
                                <label for="yearly">سنوي</label>
                            </div>
                            <div>
                                <input type="radio" id="custom" name="profit" value="custom" {{ old('profit') == 'custom' ? 'checked' : '' }} onclick="toggleCustomMonths(true)">
                                <label for="custom">مخصص</label>
                            </div>
                            <div id="custom-months-container" style="display: none;">
                                <label for="custom-months" class="form-label">أدخل عدد الأشهر</label>
                                <input type="number" id="custom-months" name="custom_months" class="form-control" value="{{ old('custom_months') }}" min="1" placeholder="عدد الأشهر">
                                @error('custom_months')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            @error('profit')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <script>
                            function toggleCustomMonths(show) {
                                const customMonthsContainer = document.getElementById('custom-months-container');
                                customMonthsContainer.style.display = show ? 'block' : 'none';
                            }

                            // Initialize state based on the selected radio button
                            document.addEventListener('DOMContentLoaded', function () {
                                const customRadio = document.getElementById('custom');
                                toggleCustomMonths(customRadio.checked);
                            });
                        </script> --}}

                    </div>
                    <button type="submit" class="btn-sm btn-primary">إضافة</button>
                </form>
            </div>
        </div>
    </div>
</div>

@include('select')
@endsection
