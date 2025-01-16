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


            <div class="row mt-5" style="direction: rtl;">
                @foreach ($investorFunds as $data)
                <div class="col-lg-4">
                    <div class="card" style="background-color: #fffff9;">
                        <div class="card-header">
                            @if($data->image)
                            <img src="{{ asset('investorFund/'.$data->image) }}" height="200px" class="card-img-top rounded" alt="صورة الاستثمار">
                            @else
                            <img src="{{ asset('images.png') }}" height="200px" class="card-img-top" alt="Default Image">
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h5 class="card-title1">{{ $data->name ?? 'غير متوفر' }}</h5>
                                </div>
                                <div class="col-lg-6">
                                    <div class="info-text">
                                        <span class="badge bg-primary">📅 {{ $data->updated_at ? $data->updated_at->format('d M, Y') : '' }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="amount-text">
                                <span class="spanTest">
                                    مبلغ المجموع
                                </span>
                                <br>
                                SAR {{ number_format($data->amount_received, 2) ?? 'غير متوفر' }}
                            </div>
                            <div class="progress" style="height: 25px;">
                                <div class="progress-bar progress-bar-striped" role="progressbar" style="width: {{ round($data->progress_percentage, 2) }}%;" aria-valuenow="{{ round($data->progress_percentage, 2) ?? 0 }}" aria-valuemin="0" aria-valuemax="100">
                                    {{ round($data->progress_percentage, 0) }}% مكتمل
                                </div>
                            </div>

                            <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                                <span class="spanTest">إجمالي المبلغ</span>
                                <span class="badge bg-primary">{{ number_format($data->total_funds, 2) ?? 'غير متوفر' }}</span>
                            </div>
                            <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                                <span class="spanTest">مدة التمويل</span>
                                <span class="badge bg-primary">{{ $data->duration_of_investment ?? 'غير متوفر' }}</span>
                            </div>
                            <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                                <span class="spanTest">نوع التمويل</span>
                                <span class="badge bg-primary">{{ $data->category->name ?? 'غير متوفر' }}</span>
                            </div>
                            <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                                <span class="spanTest">نسبة الربح</span>
                                <span class="badge bg-primary">{{ $data->profit_percentage ?? 'غير متوفر' }}%</span>
                            </div>
                            <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                                <span class="spanTest">حالة التمويل</span>
                                <span class="">
                                    @switch($data->status)
                                    @case(0)
                                    <span class="badge bg-success">الاستثمار غير مكتمل</span>
                                    @break
                                    @case(3)
                                    <span class="badge bg-warning">في انتظار المستثمرين</span>
                                    @break
                                    @case(2)
                                    <span class="badge bg-primary">بدأت</span>
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
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </div>
</div>
@endsection
