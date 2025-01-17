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

<div class="container-fluid" dir="rtl" lang="ar">
    <div class="row">
        <div class="card p-2">
            <div class="card-header p-2 bg-primary">
                <h3 class="mb-0 text-white">طلبات المستثمرين</h3>
            </div>
            <div class="table-responsive mt-4">
                <table id="example" class="tabel table-bordered  table-hover  table-striped">
                    <thead>
                        <tr>
                            <th>الاسم</th>
                            <th>المبلغ</th>
                            <th>  بداية الفترة </th>
                            <th>   نهاية الفترة </th>
                            {{-- <th>وقت الاستثمار</th> --}}
                            {{-- <th>الحالة</th> --}}
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($investorReqs as $data)
                        <tr>
                            <td>{{ $data->user->name ?? 'غير متوفر'}}</td>
                            <td>{{ $data->amount ?? 'غير متوفر'}}</td>
                            <td>{{ $data->investmentFund->start_of_period ? \Carbon\Carbon::parse($data->investmentFund->start_of_period)->format('d M,Y') : 'غير متوفر' }}
                            </td>
                            <td>{{ $data->investmentFund->end_of_period ? \Carbon\Carbon::parse($data->investmentFund->end_of_period)->format('d M,Y') : 'غير متوفر' }}
                            </td>
                            {{-- <td>{{ $data->time_of_investment ?? 'غير متوفر'}}</td> --}}
                            {{-- <td class="p-1">
                                @if($data->status == 1)
                                <span class="badge bg-success">مقبول</span>
                                @else
                                <span class="badge bg-danger">مرفوض</span>
                                @endif
                            </td> --}}
                            <td class="p-2">
                                {{-- <a href="{{ route('admin.investor.request.declineRequest', $data->id) }}" class="btn-sm btn-primary m-1" title="رفض"> --}}
                                    {{-- <i class="fa fa-times"></i>
                                    رفض
                                </a>
                                <a href="{{ route('admin.investor.request.acceptRequest', $data->id) }}" class="btn-sm btn-success m-1" title="قبول">
                                    <i class="fa fa-check"></i>
                                    قبول
                                </a> --}}
                                <a href="{{ route('admin.investor.request.view', $data->id) }}" class="btn-sm btn-info text-white m-1" title="عرض">
                                    <i class="fa fa-eye"></i>
                                    عرض
                                </a>
                            </td>
                            {{-- <td class="p-1">
                                <a href="{{ route('admin.investor.view', $data->id) }}" class="fa fa-eye-slash btn-sm btn-primary" style="font-size: 15px; margin:5px;"></a>
                                <a href="#" class="fa fa-pencil btn-sm btn-success" style="font-size: 15px; margin:5px;"></a>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#modalIdDelete{{ $data->id }}" class="fa fa-trash btn-sm btn-red ml-3" style="font-size: 15px; background-color: red; color: white;"></a>
                            </td> --}}
                        </tr>

                        <!-- مودال -->
                        <div class="modal fade" id="modalIdDelete{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content p-2">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalTitleId">
                                            حذف المستثمر
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-user mt-3">
                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">إغلاق</button>
                                        <a class="btn btn-primary btn-sm" href="{{ route('admin.investor.destroy', ['id' => $data->id]) }}">حذف</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @endforeach

                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>

@endsection
