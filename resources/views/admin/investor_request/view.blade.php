@extends('layouts.app')

@section('header')
@include('layouts.header')
@endsection


@section('sidebar')
@include('layouts.sidebar')
@endsection

@section('content')


<div class="container-fluid" dir="rtl" lang="ar">
    <div class="row justify-content-center">
        <div class="card p-4 shadow-sm border-0" style="background: #f4f4f4;">
            <div class="card-header p-2 bg-primary text-white arabic-text">
                <h3 class="mb-0 text-white">طلب المستثمر</h3>
            </div>
            <div class="card-body bg-white" style="border-radius: 0 0 15px 15px;">
                <div class="d-flex flex-row justify-content-between mt-1 p-1 border-bottom">
                    <strong class="text-dark">الاسم</strong>
                    <span class="text-secondary">{{ $investorReq->user->name ?? 'غير متوفر' }}</span>
                </div>
                <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <strong class="text-dark">اسم صندوق الاستثمار</strong>
                    <span class="text-secondary">{{ $investorReq->investmentFund->name ?? 'غير متوفر' }} <a href="{{ route('admin.investor.funds.view',$investorReq->investor_funds_id) }}" class="btn-sm btn-primary">عرض</a> </span>
                </div>

                <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <strong class="text-dark">مبلغ الاستثمار</strong>
                    <span class="text-secondary">{{ $investorReq->amount ?? 'غير متوفر' }}</span>
                </div>
                <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <strong class="text-dark">نسبة الربح</strong>
                    <span class="text-secondary">{{ $profitPercentage ?? 'غير متوفر' }}%</span>
                </div>
                <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <strong class="text-dark">ربح</strong>
                    <span class="text-secondary">{{ $calculatedProfit ?? 'غير متوفر' }}</span>
                </div>
                <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <strong class="text-dark">المجموع </strong>
                    <span class="text-secondary">{{ ($investorReq->amount ?? 0) + ($calculatedProfit ?? 0) ?: 'غير متوفر' }}</span>
                </div>
                <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <strong class="text-dark">إجمالي مبلغ الدفع</strong>
                    <span class="text-secondary">{{ $payment ?? ''}}</span>
                </div>

                {{-- <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <strong class="text-dark">إضافة الدفع</strong>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalIdDelete{{ $investorReq->id }}" class="btn-sm btn-primary ml-3">إضافة الدفع</a>
                </div>
                <div class="modal fade" id="modalIdDelete{{ $investorReq->id }}" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content p-2">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalTitleId">
                                    إضافة الدفع
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-user mt-3">
                                <div class="d-flex flex-row justify-content-between mt-2 p-1 border-bottom">
                                    <p class="text-dark">إجمالي المبلغ المدفوع</p>
                                    <span class="text-secondary">{{ ($investorReq->amount ?? 0) + ($calculatedProfit ?? 0) ?: 'غير متوفر' }}</span>
                                </div>
                                <div class="d-flex flex-row justify-content-between mt-2 p-1 border-bottom">
                                    <p class="text-dark">بداية الفترة</p>
                                    <p class="text-dark">{{ $investorReq->investmentFund->start_of_period ?? 'غير متوفر' }}</p>
                                </div>
                                <div class="d-flex flex-row justify-content-between mt-2 p-1">
                                    <p class="text-dark">نهاية الفترة</p>
                                    <p class="text-dark">{{ $investorReq->investmentFund->end_of_period ?? 'غير متوفر' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

            </div>
            <div class="card-footer text-center" style="background-color: #e0e0e0; padding: 15px; border-radius: 0 0 15px 15px;">
                <small class="text-muted">تم الإنشاء في: {{ $investorReq->created_at->format('d M, Y') ?? '' }}</small>
            </div>
        </div>
    </div>
</div>
{{-- <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
    <strong class="text-dark">بداية الفترة</strong>
    <span class="text-secondary">
        {{ $investorReq->start_of_period ? \Carbon\Carbon::parse($investorReq->start_of_period)->format('d M,Y') : 'غير متوفر' }}
    </span>
</div>
<div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
    <strong class="text-dark">نهاية الفترة</strong>
    <span class="text-secondary">
        {{ $investorReq->end_of_period ? \Carbon\Carbon::parse($investorReq->end_of_period)->format('d M,Y') : 'غير متوفر' }}
    </span>
</div> --}}
@endsection
