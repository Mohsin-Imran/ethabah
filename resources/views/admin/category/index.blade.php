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
        <div class="card p-2">
            <div class="card-header p-2 bg-primary d-flex flex-row justify-content-between">
                <a href="{{ route('admin.category.create') }}" class="btn-sm btn-danger p-2 text-dark"><i class="fa fa-user-plus"></i> إضافة فئة</a>
                <h3 class="mb-0 text-white">قوائم الفئات</h3>
            </div>
            <div class="table-responsive mt-4">
                <table id="example" class="tabel table-bordered  table-hover  table-striped">
                    <thead>
                        <tr>
                            <th>الإجراء</th>
                            <th>الاسم</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $data)
                        <tr>

                            <td class="p-1">
                                <a href="{{ route('admin.category.edit',$data->id) }}" class="fa fa-pencil btn-sm btn-success" style="font-size: 15px; margin:5px;"></a>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#modalId{{ $data->id }}" class="fa fa-trash btn-sm btn-red ml-3" style="font-size: 15px; background-color: red; color: white;"></a>
                            </td>
                            <td>{{ $data->name ?? 'N/A'}}</td>
                        </tr>
                        <div class="modal fade" id="modalId{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content p-2">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalTitleId">
                                            حذف الفئة
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
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>
@endsection
