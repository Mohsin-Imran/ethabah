@extends('layouts.app')

@section('header')
@include('layouts.header')
@endsection


@section('sidebar')
@include('layouts.sidebar')
@endsection

@section('content')

{{-- <div class="container-fluid" dir="rtl" lang="ar">
    <div class="page-header">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-header-left arabic-text">
                    <h3>الشركات</h3>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<div class="container-fluid">
    <div class="row">
        <div class="card p-2">
            <div class="card-header p-2 bg-primary">
                <h3 class="mb-0 text-white">قوائم الشركات</h3>
            </div>
            <div class="table-responsive mt-4">
                <table id="example" class="tabel table-bordered  table-hover  table-striped">
                    <thead>
                        <tr>
                            <th>الإجراءات</th>
                            <th>الحالة</th>
                            <th>السجل التجاري</th>
                            <th>رقم الهاتف</th>
                            <th>البريد الإلكتروني</th>
                            <th>الاسم</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($companies as $data)
                        <tr>

                            <td class="p-1">
                                <a href="{{ route('admin.company.view',$data->id) }}" class="fa fa-eye-slash btn-sm btn-primary" style="font-size: 15px; margin:5px;"></a>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#modalIdDelete{{ $data->id }}" class="fa fa-trash btn-sm btn-red ml-3" style="font-size: 15px; background-color: red; color: white;"></a>
                            </td>
                            <td class="p-1">
                                @if($data->status == 1)
                                <span class="badge bg-success" data-bs-toggle="modal" data-bs-target="#modalId{{ $data->id }}">موافق عليه</span>
                                @else
                                <span class="badge bg-warning" data-bs-toggle="modal" data-bs-target="#modalId{{ $data->id }}">قيد الانتظار</span>
                                @endif
                            </td>
                            <td>{{ $data->register_num ?? 'N/A'}}</td>
                            <td>{{ $data->phone ?? 'N/A'}}</td>
                            <td>{{ $data->email ?? 'N/A'}}</td>
                            <td>{{ $data->name ?? 'N/A'}}</td>
                        </tr>


                        <div class="modal fade" id="modalIdDelete{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content p-2">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalTitleId">
                                            حذف الشركة
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-user mt-3">
                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">إغلاق</button>
                                        <a class="btn btn-primary btn-sm" href="{{ route('admin.category.destroy', ['id' => $data->id]) }}">حذف</a>
                                    </div>
                                </div>
                            </div>
                        </div>

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
</div>
@endsection
