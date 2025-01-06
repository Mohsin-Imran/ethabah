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
                    <div class="card bg-primary p-3">
                        <div class="d-flex flex-row justify-content-between">
                            <h5 class="text-white">اسم صندوق الاستثمار </h5>
                            <h5 class="text-white">{{ $data->name ?? 'غير متوفر' }}</h5>
                        </div>
                        <div class="d-flex flex-row justify-content-between">
                            <p class="text-white">عدد الشركات</p>
                            <p class="text-white">{{ $data->investmentFundCount ?? 'غير متوفر' }}</p>
                        </div>
                        <div class="d-flex flex-row justify-content-between">
                            <p class="text-white">عدد المستثمرين</p>
                            <p class="text-white">{{ $data->investorCounts ?? 'غير متوفر' }}</p>
                        </div>
                        <div class="d-flex flex-row justify-content-between">
                            <p class="text-white">الربح</p>
                            <p class="text-white">{{ $data->profit_percentage ?? 'غير متوفر' }}%</p>
                        </div>
                        <div class="d-flex flex-row justify-content-between">
                            <p class="text-white">المدة</p>
                            <p class="text-white"> {{ $data->month . ' ' . ($data->duration_of_investment ?? 'غير متوفر') }}</p>
                        </div>
                        <div class="d-flex flex-row justify-content-between">
                            <p class="text-white">نظام الدفع</p>
                            <p class="text-white">{{ $data->profit ?? 'غير متوفر' }}</p>
                        </div>
                        <table>
                            <tbody>
                                <tr>
                                    <td class="p-1">
                                        <a href="{{ route('investor.investor.funds.view',$data->id) }}" class="fa fa-eye-slash btn-sm btn-secondary" style="font-size: 15px; margin:5px;"></a>
                                    </td>
                                </tr>

                                <!-- مودال -->
                                <div class="modal fade" id="modalId{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content p-2">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalTitleId">
                                                    حذف الصندوق
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-user mt-3">
                                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">إغلاق</button>
                                                <a class="btn btn-primary btn-sm" href="{{ route('admin.investor.funds.destroy', ['id' => $data->id]) }}">حذف</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </tbody>

                        </table>

                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</div>


@endsection
