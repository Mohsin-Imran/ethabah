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
                <div class="page-header-left arabic-text">
                    <h3>الاستثمارات</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid" dir="rtl">
    <div class="row g-4">
        @foreach ($requestesData as $data)
        <div class="col-md-4 card-item">
            <div class="card p-3" style="background-color: #e8f8ec;">
                @if($data->investmentFund && $data->investmentFund->image)
                <img src="{{ asset('investorFund/' . $data->investmentFund->image) }}" height="200px" class="card-img-top rounded" alt="صورة الاستثمار">
                @else
                <img src="{{ asset('images.png') }}" height="200px" class="card-img-top rounded" alt="الصورة الافتراضية">
                @endif
                <div class="card-body">
                    <h5 class="card-title text-dark" style="color: black; font-weight: bold;">{{ $data->name ?? '' }}</h5>
                    <p class="card-text">
                        <small style="color: black;">{{ $data->created_at->format('d M, Y') ?? '' }}</small>
                        <svg style="position: relative; right: 20px; top: 5px;" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-tags" viewBox="0 0 16 16">
                            <path d="M3 2v4.586l7 7L14.586 9l-7-7zM2 2a1 1 0 0 1 1-1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 2 6.586z" />
                            <path d="M5.5 5a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1m0 1a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3M1 7.086a1 1 0 0 0 .293.707L8.75 15.25l-.043.043a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 0 7.586V3a1 1 0 0 1 1-1z" />
                        </svg>
                        @if($data->investmentFund && $data->investmentFund->category)
                        <span class="badge bg-success me-2 mt-2 float-start">
                            {{ $data->investmentFund->category->name }}
                        </span>
                        @else
                        <span class="badge bg-secondary me-2 mt-2 float-start">لا توجد فئة</span>
                        @endif
                    </p>
                    <p class="mt-2" style="color: black;"><strong class="text-change">اسم الاستثمار</strong> <br>{{ $data->investmentFund->name ?? '' }}</p>
                    <p class="mt-2" style="color: black;"><strong class="text-change">مبلغ الاستثمار</strong> <br> ر.س {{ $data->amount ?? '' }}</p>
                    <p class="mt-2" style="color: black;">
                        <strong class="text-change">بداية الفترة</strong> <br>
                        {{ $data->investmentFund->start_of_period ? \Carbon\Carbon::parse($data->investmentFund->start_of_period)->format('D, F j, Y') : '' }}
                    </p>
                    <p class="mt-2" style="color: black;">
                        <strong class="text-change">نهاية الفترة</strong> <br>
                        {{ $data->investmentFund->end_of_period ? \Carbon\Carbon::parse($data->investmentFund->end_of_period)->format('D, F j, Y') : '' }}
                    </p>

                    <div class="d-flex flex-row justify-content-between">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#modalId{{ $data->id }}" class="fa fa-file btn-sm btn-red ml-3" style="font-size: 15px; background-color: #214D45; color: white;"></a>
                        <div class="modal fade" id="modalId{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content p-2">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalTitleId">
                                            وثيقة المشروع
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row mt-3">
                                            <div class="col-lg-6 p-2" style="border: 1px solid;">
                                                تحديث الاسم
                                            </div>
                                            <div class="col-lg-6 p-2" style="border: 1px solid;">
                                                تحديث المستند
                                            </div>
                                            @forelse ($projectUpdates as $projectData)
                                            @if ($projectData->request_id == $data->investmentFund->investmentFundCompanies->first()->request_id)
                                            <div class="col-lg-6 p-2" style="border: 1px solid;">
                                                {{ $projectData->update_name ?? 'لم يتم توفير اسم التحديث' }}
                                            </div>
                                            <div class="col-lg-6 p-2" style="border: 1px solid;">
                                                @php
                                                $document = json_decode($projectData->document, true) ?? [];
                                                @endphp
                                                @forelse ($document as $file)
                                                @php
                                                $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                                                @endphp
                                                <span class="text-secondary me-2" data-file="{{ asset('document/' . $file) }}" style="margin-bottom: 10px;">
                                                    @if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif', 'bmp']))
                                                    <a href="{{ asset('document/' . $file) }}" data-fancybox="gallery" data-caption="الترخيص">
                                                        <img src="{{ asset('document/' . $file) }}" width="40px" height="40px" class="mb-2 border" alt="الترخيص" style="border: 2px solid #000; padding: 3px;">
                                                    </a>
                                                    @elseif (strtolower($fileExtension) == 'pdf')
                                                    <a href="{{ asset('document/' . $file) }}" target="_blank" class="btn btn-info p-2 text-white" style="position: relative; top:0px;">
                                                        <i class="fas fa-file-pdf" style="font-size: 24px;"></i>
                                                    </a>
                                                    @elseif (strtolower($fileExtension) == 'docx' || strtolower($fileExtension) == 'doc')
                                                    <a href="{{ asset('document/' . $file) }}" target="_blank" class="btn btn-success p-2 text-white" style="position: relative; top:0px;">
                                                        <i class="fas fa-file-word" style="font-size: 24px;"></i>
                                                    </a>
                                                    @endif
                                                </span>
                                                @empty
                                                <span>لا توجد مستندات متاحة</span>
                                                @endforelse
                                            </div>
                                            @endif
                                            @empty
                                            <div class="col-12">
                                                <p>لا توجد تحديثات للمشروع.</p>
                                            </div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
