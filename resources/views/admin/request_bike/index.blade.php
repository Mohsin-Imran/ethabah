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
                    <i class="fa fa-chart-line"></i> 
                </div>
                <div class="dashboard-content">
                    <h5>إجمالي الطلبات</h5>
                    <p><span class="growth">{{ $requestBikesCount ?? '' }}</span></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="dashboard-card">
                <div class="dashboard-icon">
                    <i class="fa fa-hand-holding-usd"></i> 
                </div>
                <div class="dashboard-content">
                    <h5>إجمالي أموال المستثمرين</h5>
                    <p><span class="growth">{{ $investorFunds ?? '' }}</span></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="dashboard-card">
                <div class="dashboard-icon">
                    <i class="fa fa-users"></i> 
                </div>
                <div class="dashboard-content">
                    <h5>إجمالي الشركات</h5>
                    <p>{{ $companiesCounts ?? '' }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="dashboard-card">
                <div class="dashboard-icon">
                    <i class="fa fa-people-carry"></i> 
                </div>
                <div class="dashboard-content">
                    <h5>إجمالي المستثمرين</h5>
                    <p>{{ $investorCounts ?? '' }}</p>
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
                            <th dir="rtl" style="text-align: justify;">إجمالي التمويل المطلوب</th>
                            <th dir="rtl" style="text-align: justify;">الاستثمار</th>
                            <th dir="rtl" style="text-align: justify;">فئة</th>
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
                            @php
                            $categoryName = \App\Models\Category::where('id', $data->category_id)->value('name');
                            @endphp
                            {{-- <span class="badge bg-success me-2 mt-2 float-start">{{ $categoryName }}</span> --}}
                            <td>{{ $categoryName ?? 'غير متوفر' }}</td>
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
