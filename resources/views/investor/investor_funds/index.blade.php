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
                <div class="page-header-left arabic-text">
                    <h3>Investors Funds</h3>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<style>
    p {
        font-family: 'Times New Roman';
    }

</style>
<div class="container-fluid" dir="rtl" lang="ar">
    <div class="row">
        <div class="card p-2">
            <div class="card-header p-2 bg-primary d-flex flex-row justify-content-between">
                <h3 class="mb-0 text-white">قوائم صناديق الإستثمار</h3>
            </div>


            <div class="row mt-5">
                @foreach ($investorFunds as $data)
                <div class="col-lg-4">
                    <div class="card" style="background-color: #fffff9;">
                        <div class="card-header">
                            @if($data->image)
                            <img src="{{ asset('investorFund/'.$data->image) }}" height="200px" class="card-img-top rounded" alt="صورة الاستثمار">
                            @else
                            <img src="https://salonlfc.com/wp-content/uploads/2018/01/image-not-found-scaled.png" height="200px" class="card-img-top rounded" alt="الصورة الافتراضية">
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h5 class="card-title1">{{ $data->name ?? 'غير متوفر' }}</h5>
                                </div>
                                <div class="col-lg-6">
                                    <div class="info-text">
                                        <span class="badge bg-primary">📅 {{ $data->start_of_period ? \Carbon\Carbon::parse($data->start_of_period)->format('j F, Y') : '' }}</span>
                                    </div>

                                </div>
                            </div>
                            <div class="amount-text">
                                <span class="spanTest">
                                    المبلغ المُجمع
                                </span>
                                <br>
                                <span class="spanTest">
                                    SAR {{ number_format($data->amount_received, 2) ?? 'غير متوفر' }}
                                </span>

                            </div>
                            <div class="progress" style="height: 20px;">
                                <div class="progress-bar progress-bar-striped" role="progressbar" style="width: {{ round($data->progress_percentage, 2) }}%;" aria-valuenow="{{ round($data->progress_percentage, 2) ?? 0 }}" aria-valuemin="0" aria-valuemax="100">
                                    {{ round($data->progress_percentage, 0) }}% مكتمل
                                </div>
                            </div>

                            <div class="row p-1" style="position: relative; right: 5px;">
                                <div class="col-lg-6">
                                    <div class="col-lg-4">
                                        <i class="fa fa-briefcase cutomFontIcon"></i>
                                    </div>
                                    <div class="col-lg-12" style="position: relative;right: 29px;">
                                        <span class="cutomFontSpan">اسم الصندوق</span>
                                        <br>
                                        <span class="cutomFontSpan">{{ $data->name ?? '' }}</span>
                                    </div>
                                    <hr>
                                </div>
                                <div class="col-lg-6">
                                    <div class="col-lg-4">
                                        <i class="fa fa-ban cutomFontIcon"></i>
                                    </div>
                                    <div class="col-lg-12" style="position: relative;right: 29px;">
                                        <span class="cutomFontSpan">نوع الصندوق</span>
                                        <br>
                                        <span class="cutomFontSpan">{{ $data->category->name ?? '' }}</span>
                                    </div>
                                    <hr>
                                </div>
                                <div class="col-lg-6">
                                    <div class="col-lg-4">
                                        <i class="fas fa-clock cutomFontIcon"></i>
                                    </div>
                                    <div class="col-lg-12" style="position: relative;right: 29px;">
                                        <span class="cutomFontSpan">مدة الصندوق</span>
                                        <br>
                                        <span class="cutomFontSpan">{{ $data->duration_of_investment ?? 'غير متوفر' }}</span>
                                    </div>
                                    <hr>
                                </div>
                                <div class="col-lg-6">
                                    <div class="col-lg-4">
                                        <i class="fas fa-money-bill-wave cutomFontIcon"></i>
                                    </div>
                                    <div class="col-lg-12" style="position: relative;right: 29px;">
                                        <span class="cutomFontSpan">إجمالي الصناديق</span>
                                        <br>
                                        <span class="cutomFontSpan">{{ $data->total_funds ?? 'غير متوفر' }}</span>
                                    </div>
                                    <hr>
                                </div>
                                <div class="col-lg-6">
                                    <div class="col-lg-4">
                                        <i class="fas fa-money-bill-alt cutomFontIcon"></i>
                                    </div>
                                    <div class="col-lg-12" style="position: relative;right: 29px;">
                                        <span class="cutomFontSpan">الصناديق المستلمة</span>
                                        <br>
                                        <span class="cutomFontSpan"> SAR {{ number_format($data->amount_received, 2) ?? 'غير متوفر' }}</span>
                                    </div>
                                    <hr>
                                </div>
                                <div class="col-lg-6">
                                    <div class="col-lg-4">
                                        <i class="fa fa-percent cutomFontIcon"></i>
                                    </div>
                                    <div class="col-lg-12" style="position: relative;right: 29px;">
                                        <span class="cutomFontSpan">الأرباح</span>
                                        <br>
                                        <span class="badge bg-primary">{{ $data->profit_percentage ?? '' }}%</span>
                                    </div>
                                    <hr>
                                </div>
                                <div class="col-lg-6">
                                    <div class="col-lg-4">
                                        <i class="fas fa-user-alt cutomFontIcon"></i>
                                    </div>
                                    <div class="col-lg-12" style="position: relative;right: 29px;">
                                        <span class="cutomFontSpan">إجمالي الشركات</span>
                                        <br>
                                        <span class="cutomFontSpan">{{ $data->investmentFundCounts ?? 'غير متوفر' }}</span>
                                    </div>
                                    <hr>
                                </div>
                                <div class="col-lg-6">
                                    <div class="col-lg-4">
                                        <i class="fas fa-user-friends cutomFontIcon"></i>
                                    </div>
                                    <div class="col-lg-12" style="position: relative;right: 29px;">
                                        <span class="cutomFontSpan">إجمالي المستثمرين</span>
                                        <br>
                                        <span class="cutomFontSpan">{{ $data->investorCounts ?? '' }}</span>
                                    </div>
                                    <hr>
                                </div>
                                <div class="col-lg-6">
                                    <div class="col-lg-4">
                                        <i class="far fa-clock cutomFontIcon"></i>
                                    </div>
                                    <div class="col-lg-12" style="position: relative;right: 29px;">
                                        <span class="cutomFontSpan">بداية الفترة</span>
                                        <br>
                                        <span class="cutomFontSpan"> {{ $data->start_of_period ? \Carbon\Carbon::parse($data->start_of_period)->format('j F, Y') : '' }}</span>
                                    </div>
                                    <hr>
                                </div>
                                <div class="col-lg-6">
                                    <div class="col-lg-4">
                                        <i class="far fa-clock cutomFontIcon"></i>
                                    </div>
                                    <div class="col-lg-12" style="position: relative;right: 29px;">
                                        <span class="cutomFontSpan">نهاية الفترة</span>
                                        <br>
                                        <span class="cutomFontSpan">{{ $data->start_of_period ? \Carbon\Carbon::parse($data->start_of_period)->format('j F, Y') : '' }}</span>
                                    </div>
                                    <hr>
                                </div>
                                <div class="col-lg-6">
                                    <div class="col-lg-4">
                                        <i class="fa fa-star cutomFontIcon"></i>
                                    </div>
                                    <div class="col-lg-12" style="position: relative;right: 29px;">
                                        <span class="cutomFontSpan">الأرباح التي سيتم دفعها</span>
                                        <br>
                                        <span class="cutomFontSpan">{{ $data->profit ?? '' }}</span>
                                    </div>
                                    <hr>
                                </div>
                                <div class="col-lg-6">
                                    <div class="col-lg-4">
                                        <i class="fas fa-toggle-on cutomFontIcon"></i>
                                    </div>
                                    <div class="col-lg-12" style="position: relative;right: 29px;">
                                        <span class="cutomFontSpan">الحالة</span>
                                        <br>
                                        <span>
                                            @switch($data->status)
                                            @case(0)
                                            <span class="badge bg-success" style="font-size: 9px; white-space: normal;">الاستثمار غير مكتمل</span>
                                            @break
                                            @case(3)
                                            <span class="badge bg-warning">انتظار المستثمرين</span>
                                            @break
                                            @case(2)
                                            <span class="badge bg-primary">تم البدء</span>
                                            @break
                                            @case(1)
                                            <span class="badge bg-success">مكتمل</span>
                                            @break
                                            @case(4)
                                            <span class="badge bg-danger">مرفوض</span>
                                            @break
                                            @default
                                            <span class="badge bg-secondary">غير معروف</span>
                                            @endswitch
                                        </span>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                            <a href="{{ route('investor.request.create', ['investor_fund_id' => $data->id]) }}" class="btn btn-primary w-100">إضافة استثمار</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </div>
</div>
@endsection
