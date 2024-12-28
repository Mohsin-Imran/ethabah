@extends('layouts.app')

@section('header')
@include('layouts.header')
@endsection


@section('sidebar')
@include('layouts.sidebar')
@endsection

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/4.0.3/fancybox.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/4.0.3/fancybox.umd.js"></script>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="card p-4 shadow-sm border-0" style="background: #f4f4f4;">
            <div class="card-header p-2 bg-primary text-white arabic-text">
                <h3 class="mb-0 text-white">عرض الطلب</h3>
            </div>
            <div class="card-body bg-white" style="border-radius: 0 0 15px 15px;">
                <div class="d-flex flex-row justify-content-between mt-1 p-1 border-bottom">
                    <span class="text-secondary">{{ $requestBike->user->name ?? 'Not Available' }}</span>
                    <strong class="text-dark">اسم الشركة</strong>
                </div>
                <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <span class="text-secondary">{{ $requestBike->user->email ?? 'Not Available' }}</span>
                    <strong class="text-dark">البريد الإلكتروني للشركة</strong>
                </div>
                {{-- <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <strong class="text-dark">Company Phone</strong>
                    <span class="text-secondary">{{ $requestBike->phone ?? 'Not Available' }}</span>
                </div>
                <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <strong class="text-dark">Company Register Number</strong>
                    <span class="text-secondary">{{ $requestBike->register_num ?? 'Not Available' }}</span>
                </div> --}}
                <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <span class="text-secondary">{{ $requestBike->name ?? 'Not Available' }}</span>
                    <strong class="text-dark">اسم المشروع</strong>
                </div>
                <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <span class="text-secondary">{{ $requestBike->category ?? 'Not Available' }}</span>
                    <strong class="text-dark">اسم الفئة</strong>
                </div>
                <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <span class="text-secondary">{{ $requestBike->purpose_of_funding ?? 'Not Available' }}</span>
                    <strong class="text-dark">غرض التمويل</strong>
                </div>
                <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <span class="text-secondary">{{ $requestBike->total_funds ?? 'Not Available' }}</span>
                    <strong class="text-dark">إجمالي الصناديق</strong>
                </div>
                <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <span class="text-secondary">{{ $requestBike->description ?? 'Not Available' }}</span>
                    <strong class="text-dark">الوصف</strong>
                </div>
                <div class="mt-4 p-1 border-bottom">
                    <div class="d-flex flex-row justify-content-start" id="licenses">
                        @php
                        $request_document = json_decode($requestBike->request_document, true) ?? [];
                        @endphp
                        @foreach ($request_document as $file)
                        @php
                        $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                        @endphp
                        <span class="text-secondary me-2" data-file="{{ asset('request_document/' . $file) }}" style="margin-bottom: 10px;">
                            @if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif', 'bmp']))
                            <a href="{{ asset('request_document/' . $file) }}" data-fancybox="gallery" data-caption="License">
                                <img src="{{ asset('request_document/' . $file) }}" width="40px" height="40px" class="mb-2 border" alt="License" style="border: 2px solid #000; padding: 3px;">
                            </a>
                            @elseif (strtolower($fileExtension) == 'pdf')
                            <a href="{{ asset('request_document/' . $file) }}" target="_blank" class="btn btn-info p-2 text-white" style="position: relative; top:0px;">
                                <i class="fas fa-file-pdf" style="font-size: 24px;"></i>
                            </a>
                            @elseif (strtolower($fileExtension) == 'docx' || strtolower($fileExtension) == 'doc')
                            <a href="{{ asset('request_document/' . $file) }}" target="_blank" class="btn btn-success p-2 text-white" style="position: relative; top:0px;">
                                <i class="fas fa-file-word" style="font-size: 24px;"></i>
                            </a>
                            @endif
                        </span>
                        @endforeach
                        {{-- <button class="btn-sm btn-primary h-25" onclick="downloadAll('request_document')"> <i class="fa fa-download"></i></button> --}}
                    </div>
                    <br>
                    <strong class="text-dark mt-2" style="float: right; position: relative; top: -40px;">المستند</strong>
                </div>
            </div>
            <div class="card-footer text-center" style="background-color: #e0e0e0; padding: 15px; border-radius: 0 0 15px 15px;">
                <small class="text-muted">تم الإنشاء في: {{ $requestBike->created_at->format('d M, Y') ?? '' }}</small>
            </div>
        </div>
    </div>
</div>
@endsection
