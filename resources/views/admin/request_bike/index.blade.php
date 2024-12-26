@extends('layouts.app')

@section('header')
@include('layouts.header')
@endsection


@section('sidebar')
@include('layouts.sidebar')
@endsection

@section('content')

<div class="container-fluid" lang="ar">
    <div class="page-header">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-header-left arabic-text">
                    <h3>الطلبات</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row gy-3">
        <div class="col-md-3">
            <div class="dashboard-card">
                <div class="dashboard-icon">
                    <i class="fa fa-chart-line"></i> <!-- تم تحديثه إلى أيقونة "chart-line" للإيرادات -->
                </div>
                <div class="dashboard-content">
                    <h5>78.423K</h5>
                    <p>إجمالي الإيرادات <span class="growth">15.2% ↑</span></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="dashboard-card">
                <div class="dashboard-icon">
                    <i class="fa fa-hand-holding-usd"></i> <!-- تم تحديثه إلى أيقونة "hand-holding-usd" للصندوق -->
                </div>
                <div class="dashboard-content">
                    <h5>إجمالي الصندوق</h5>
                    <p>المستثمرين <span class="growth">{{ $investorFunds ?? '' }}</span></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="dashboard-card">
                <div class="dashboard-icon">
                    <i class="fa fa-users"></i> <!-- تم تحديثه إلى أيقونة "users" للشركات -->
                </div>
                <div class="dashboard-content">
                    <h5>الشركات</h5>
                    <p>طلب جديد <span class="growth">5 أكثر ↑</span></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="dashboard-card">
                <div class="dashboard-icon">
                    <i class="fa fa-people-carry"></i> <!-- تم تحديثه إلى أيقونة "people-carry" للمستثمرين -->
                </div>
                <div class="dashboard-content">
                    <h5>المستثمرين</h5>
                    <p>مستثمرون جدد <span class="growth">10 أكثر ↑</span></p>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="card p-2">
            <div class="table-responsive mt-4">
                <table id="example" class="tabel table-bordered  table-hover  table-striped">
                    <thead>
                        <tr>
                            <th dir="rtl" style="text-align: justify;">الإجراءات</th>
                            <th dir="rtl" style="text-align: justify;">الحالة</th>
                            <th dir="rtl" style="text-align: justify;">إجمالي الصناديق</th>
                            <th dir="rtl" style="text-align: justify;">الاستثمار</th>
                            <th dir="rtl" style="text-align: justify;">الفئة</th>
                            <th dir="rtl" style="text-align: justify;">البريد الإلكتروني للشركة</th>
                            <th dir="rtl" style="text-align: justify;">اسم الشركة</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($requestBikes as $data)
                        <tr>
                            <td class="p-2" dir="rtl">
                                <a href="{{ route('admin.request.bike.declineRequest', $data->id) }}" class="btn-sm btn-primary m-1" title="رفض">
                                    <i class="fa fa-times"></i>
                                    رفض
                                </a>
                                <a href="{{ route('admin.request.bike.acceptRequest', $data->id) }}" class="btn-sm btn-success m-1" title="قبول">
                                    <i class="fa fa-check"></i>
                                    قبول
                                </a>
                                <a href="{{ route('admin.request.bike.view', $data->id) }}" class="btn-sm btn-info text-white m-1" title="عرض">
                                    <i class="fa fa-eye"></i>
                                    عرض
                                </a>
                            </td>
                            <td class="p-1">
                                @if($data->status == 1)
                                <span class="badge bg-success">مقبول</span>
                                @else
                                <span class="badge bg-danger">مرفوض</span>
                                @endif
                            </td>
                            <td>{{ $data->total_funds ?? 'غير متوفر'}}</td>
                            <td><span class="badge bg-primary">{{ $data->purpose_of_funding ?? 'غير متوفر'}}</span></td>
                            <td>{{ $data->category ?? 'غير متوفر'}}</td>
                            <td>{{ $data->user->email ?? 'غير متوفر'}}</td>
                            <td>{{ $data->user->name ?? 'غير متوفر'}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endsection
