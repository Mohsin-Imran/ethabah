@extends('layouts.app')

@section('header')
@include('layouts.header')
@endsection


@section('sidebar')
@include('layouts.sidebar')
@endsection

@section('content')


<div class="container-fluid" dir="rtl" lang="ar">
    <div class="row">
        <div class="card p-1">
            <div class="card-header p-2 bg-primary d-flex flex-row justify-content-between">
                <h3 class="mb-0 text-white">تحديث صناديق الاستثمار</h3>
            </div>
            <div class="card-body p-2">
                <form method="POST" action="{{ route('admin.investor.funds.update', $investorFund->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="mb-3 mt-2 col-lg-12">
                            <label for="name" class="form-label">الاسم <span style="color: red;">*</span></label>
                            <input type="text" placeholder="الاسم" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name', $investorFund->name) }}">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3 mt-2 col-lg-12">
                            <label for="category_id" class="form-label">الفئة <span style="color: red;">*</span></label>
                            <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                <option value="">اختر الفئة</option>
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
                            <label for="company" class="form-label">الشركات <span style="color: red;">*</span></label>
                            <select name="company_id[]" id="select3" multiple class="form-control custom-select">
                                @foreach ($companies as $requestBike)
                                @if ($requestBike->company)
                                <option value="{{ $requestBike->company->id }}" data-total-funds="{{ $requestBike->total_funds }}" data-ids="{{ $requestBike->id }}" {{ in_array($requestBike->company->id, old('company_id', $investorFund->companies->pluck('id')->toArray())) ? 'selected' : '' }}>
                                    <!-- This is the ID you want to capture -->
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

                            <input id="selected_company_ids" name="selected_company_ids" type="hidden" value="{{ old('company_id', implode(',', $investorFund->companies->pluck('id')->toArray())) }}">
                        </div>

                        <!-- JavaScript to update hidden input field on change -->
                        <script>
                            document.getElementById('select3').addEventListener('change', function() {
                                var selectedCompanies = Array.from(this.selectedOptions).map(option => option.value);
                                document.getElementById('selected_company_ids').value = selectedCompanies.join(',');
                            });
                        </script>


                        <div class="mb-3 mt-2 col-lg-6">
                            <label for="amount" class="form-label">إجمالي الصناديق</label>
                            <input type="number" placeholder="إجمالي الصناديق" min="1" value="{{ old('amount', $investorFund->total_funds) }}" class="form-control" name="total_funds" id="total_funds" readonly>
                        </div>

                        <div class="mb-3 mt-2 col-lg-6">
                            <label for="amount" class="form-label">المبلغ <span style="color: red;">*</span></label>
                            <input type="number" placeholder="المبلغ" class="form-control @error('amount') is-invalid @enderror" name="amount" id="amount" value="{{ old('amount', $investorFund->amount) }}">
                            @error('amount')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3 mt-2 col-lg-12">
                            <label for="profit_percentage" class="form-label">نسبة الربح <span style="color: red;">*</span></label>
                            <input type="number" placeholder="نسبة الربح" class="form-control @error('profit_percentage') is-invalid @enderror" name="profit_percentage" id="profit_percentage" value="{{ old('profit_percentage', $investorFund->profit_percentage) }}">
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
                                <option value="months" {{ $investorFund->duration_of_investment == 'months' ? 'selected' : '' }}>الأشهر</option>
                            </select>
                            @error('duration_of_investment')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="col-lg-6" style="margin-top: 33px;">
                            <input type="number" placeholder="عدد" min="1" class="form-control @error('month') is-invalid @enderror" name="month" id="month" value="{{ old('month', $investorFund->month) }}">
                            @error('month')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3 mt-2 col-lg-12">
                            <label class="form-label">سيتم دفع الربح <span style="color: red;">*</span></label>
                            <div>
                                <input type="radio" id="monthly" name="profit" value="monthly" {{ old('profit', $investorFund->profit) == 'monthly' ? 'checked' : '' }}>
                                <label for="monthly">شهري</label>
                            </div>
                            <div>
                                <input type="radio" id="quarterly" name="profit" value="quarterly" {{ old('profit', $investorFund->profit) == 'quarterly' ? 'checked' : '' }}>
                                <label for="quarterly">ربع سنوي</label>
                            </div>
                            <div>
                                <input type="radio" id="yearly" name="profit" value="yearly" {{ old('profit', $investorFund->profit) == 'yearly' ? 'checked' : '' }}>
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
                            <input type="date" min="1" class="form-control @error('start_of_period') is-invalid @enderror" name="start_of_period" id="start_of_period" value="{{ old('start_of_period',$investorFund->start_of_period) }}">
                            @error('start_of_period')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3 mt-2 col-lg-12">
                            <label for="image" class="form-label">صورة</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image" onchange="previewImage(event)">
                            @if(!empty($investorFund->image))
                            <img src="{{ asset('investorFund/' . $investorFund->image) }}" alt="Investor Fund Image" height="100px" width="100px">
                            @else
                            <p>Image not found</p>
                            @endif
                            <div id="image-preview-container" class="mt-3" style="display:none;">
                                <img id="image-preview" src="" alt="Image Preview" height="100px" width="100px">
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn-sm btn-primary">تحديث</button>
                </form>
            </div>
        </div>
    </div>
</div>

@include('select')
@endsection
