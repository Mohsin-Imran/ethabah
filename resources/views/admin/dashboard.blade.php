@extends('layouts.app')

@section('header')
@include('layouts.header')
@endsection

@section('sidebar')
@include('layouts.sidebar')
@endsection

@section('content')
<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-header-left">
                    <h3 id="investment-title">لوحة التحكم</h3>
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
                            <h5> إجمالي صناديق الإستثمار</h5>
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
                            <p>{{ $companiesCounts ?? '' }}</p>
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
                            <p>{{ $investorCounts ?? '' }}</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row align-items-stretch">
            <!-- البطاقة اليسرى -->
            <div class="col-lg-8 mt-5" dir="rtl">
                <div class="card h-100 p-2">
                    <div class="table-responsive mt-4">
                        <table id="example" class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    {{-- <th style="font-size:14px !important; text-align: end; padding: 5px;">الاسم</th> --}}
                                    <th style="font-size:14px !important;">الاسم</th>
                                    <th style="font-size:14px !important;">الوقت</th>
                                    {{-- <th style="font-size:14px !important;">إجمالي الصناديق</th> --}}
                                    <th style="font-size:14px !important;">الحالة</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($companies as $data)
                                <tr>
                                    <td>{{ $data->name ?? 'N/A'}}</td>
                                    <td>{{ $data->created_at ? $data->created_at->format('Y-m-d') : 'N/A' }}</td>
                                    {{-- <td>{{ $data->total_funds ?? 'N/A'}}</td> --}}
                                    <td class="p-1">
                                        @if($data->status == 1)
                                        <span class="badge bg-success" data-bs-toggle="modal" data-bs-target="#modalId{{ $data->id }}">موافق عليه</span>
                                        @else
                                        <span class="badge bg-warning" data-bs-toggle="modal" data-bs-target="#modalId{{ $data->id }}">قيد الانتظار</span>
                                        @endif
                                    </td>
                                </tr>

                                <!-- مودال -->
                                <div class="modal fade" id="modalId{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content p-2">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalTitleId">
                                                    تحديث حالة الشركة
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body mt-3">
                                                <form action="{{ route('admin.company.status', $data->id) }}" method="POST">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="status{{ $data->id }}" class="form-label">حالة الشركة</label>
                                                        <select name="status" id="status{{ $data->id }}" class="form-control">
                                                            <option value="" disabled selected>حالة الشركة</option>
                                                            <option value="1" {{ $data->status == 1 ? 'selected' : '' }}>موافق عليه</option>
                                                            <option value="0" {{ $data->status == 0 ? 'selected' : '' }}>قيد الانتظار</option>
                                                        </select>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">حفظ</button>
                                                </form>
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
            <!-- البطاقة اليمنى -->
            {{-- <div class="row justify-content-center"> --}}
            <!-- حاوية البطاقة -->
            <div class="col-lg-4 col-md-6 col-sm-12 mt-5" dir="rtl">
                <div class="card shadow-sm">
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">المستثمرين الجدد</h5>
                            {{-- <button class="btn btn-light btn-sm">
                                <i class="fa fa-ellipsis-v"></i>
                            </button> --}}
                        </div>
                        <hr>
                        <!-- قائمة الاستثمارات -->
                        <ul class="list-group list-group-flush">
                            @foreach ($investors as $investor)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-briefcase fa-lg text-primary p-lg-2"></i>
                                    <div>
                                        <h6 class="mb-0">{{ $investor->name ?? '' }}</h6>
                                        <small class="text-muted">{{ $investor->created_at ? $investor->created_at->format('M d, Y') : '' }}</small>
                                    </div>
                                </div>
                                <span class="text-success">SAR 820.00</span>
                            </li>
                            @endforeach
                        </ul>
                        <div class="text-center mt-3">
                            <a href="{{ route('admin.investor.index') }}" class="text-primary text-decoration-none">عرض الكل</a>
                        </div>
                    </div>
                </div>
            </div>
            {{-- </div> --}}
        </div>

    </div>
</div>
@endsection
