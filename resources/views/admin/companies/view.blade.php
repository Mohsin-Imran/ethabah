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
                <h3 class="mb-0 text-white">ملف الشركة</h3>
            </div>
            <div class="card-body bg-white" style="border-radius: 0 0 15px 15px;">
                <div class="d-flex flex-row justify-content-between mt-1 p-1 border-bottom">
                    <span class="text-secondary">{{ $company->user->name ?? 'غير متوفر' }}</span>
                    <strong class="text-dark">الاسم</strong>
                </div>
                <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <span class="text-secondary">{{ $company->user->email ?? 'غير متوفر' }}</span>
                    <strong class="text-dark">البريد الإلكتروني</strong>
                </div>
                <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <span class="text-secondary" style="unicode-bidi: bidi-override; direction: ltr;">
                        {{ $company->phone ?? 'غير متوفر' }}
                    </span>
                    <strong class="text-dark">رقم الهاتف</strong>
                </div>

                <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <span class="text-secondary">{{ $company->register_num ?? 'غير متوفر' }}</span>
                    <strong class="text-dark">رقم السجل التجاري</strong>
                </div>

                <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <span class="text-secondary">{{ $company->address ?? 'N/A' }}</span>
                    <strong class="text-dark">عنوان الشركة</strong>
                </div>

                <div class="mt-4 p-1 border-bottom">
                    <div class="d-flex flex-row justify-content-start" id="register-certificates">
                        @php
                        $registerCertificates = json_decode($company->register_certificate, true) ?? [];
                        @endphp
                        @foreach ($registerCertificates as $file)
                        @php
                        $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                        @endphp
                        <span class="text-secondary me-2" data-file="{{ asset('register_certificate/' . $file) }}" style="margin-bottom: 10px;">
                            @if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif', 'bmp']))
                            <a href="{{ asset('register_certificate/' . $file) }}" data-fancybox="gallery" data-caption="Register Certificate">
                                <img src="{{ asset('register_certificate/' . $file) }}" width="40px" height="40px" class="mb-2 border" alt="Register Certificate" style="border: 2px solid #000; padding: 3px;">
                            </a>
                            @elseif (strtolower($fileExtension) == 'pdf')
                            <a href="{{ asset('register_certificate/' . $file) }}" target="_blank" class="btn btn-info p-2 text-white" style="position: relative; top:0px;">
                                <i class="fas fa-file-pdf" style="font-size: 24px;"></i>
                            </a>
                            @elseif (strtolower($fileExtension) == 'docx' || strtolower($fileExtension) == 'doc')
                            <a href="{{ asset('register_certificate/' . $file) }}" target="_blank" class="btn btn-success p-2 text-white" style="position: relative; top:0px;">
                                <i class="fas fa-file-word" style="font-size: 24px;"></i>
                            </a>
                            @endif
                        </span>
                        @endforeach
                        <button class="btn-sm btn-primary h-25" onclick="downloadAll('register-certificates')"><i class="fa fa-download"></i></button>
                    </div>
                    <strong style="float: right; position: relative; top: -40px;">السجل التجاري</strong>
                </div>

                <div class="mt-4 p-1 border-bottom">
                    <div class="d-flex flex-row justify-content-start" id="commercial-certificates">
                        @php
                        $commercialCertificates = json_decode($company->commercial_certificate, true) ?? [];
                        @endphp
                        @foreach ($commercialCertificates as $file)
                        @php
                        $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                        @endphp
                        <span class="text-secondary me-2" data-file="{{ asset('commercial_certificate/' . $file) }}" style="margin-bottom: 10px;">
                            @if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif', 'bmp']))
                            <a href="{{ asset('commercial_certificate/' . $file) }}" data-fancybox="gallery" data-caption="Commercial Certificate">
                                <img src="{{ asset('commercial_certificate/' . $file) }}" width="40px" height="40px" class="mb-2 border" alt="Commercial Certificate" style="border: 2px solid #000; padding: 3px;">
                            </a>
                            @elseif (strtolower($fileExtension) == 'pdf')
                            <a href="{{ asset('commercial_certificate/' . $file) }}" target="_blank" class="btn btn-info p-2 text-white" style="position: relative; top:0px;">
                                <i class="fas fa-file-pdf" style="font-size: 24px;"></i>
                            </a>
                            @elseif (strtolower($fileExtension) == 'docx' || strtolower($fileExtension) == 'doc')
                            <a href="{{ asset('commercial_certificate/' . $file) }}" target="_blank" class="btn btn-success p-2 text-white" style="position: relative; top:0px;">
                                <i class="fas fa-file-word" style="font-size: 24px;"></i>
                            </a>
                            @endif

                        </span>
                        @endforeach
                        <button class="btn-sm btn-primary h-25" onclick="downloadAll('commercial-certificates')"> <i class="fa fa-download"></i></button>
                    </div>
                    <strong class="text-dark" style="float: right; position: relative; top: -40px;">جواز السفر أو هوية المالك</strong>
                </div>

                <div class="mt-4 p-1 border-bottom">
                    <div class="d-flex flex-row justify-content-start" id="licenses">
                        @php
                        $licenses = json_decode($company->licenses, true) ?? [];
                        @endphp
                        @foreach ($licenses as $file)
                        @php
                        $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                        @endphp
                        <span class="text-secondary me-2" data-file="{{ asset('licenses/' . $file) }}" style="margin-bottom: 10px;">
                            @if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif', 'bmp']))
                            <a href="{{ asset('licenses/' . $file) }}" data-fancybox="gallery" data-caption="License">
                                <img src="{{ asset('licenses/' . $file) }}" width="40px" height="40px" class="mb-2 border" alt="License" style="border: 2px solid #000; padding: 3px;">
                            </a>
                            @elseif (strtolower($fileExtension) == 'pdf')
                            <a href="{{ asset('licenses/' . $file) }}" target="_blank" class="btn btn-info p-2 text-white" style="position: relative; top:0px;">
                                <i class="fas fa-file-pdf" style="font-size: 24px;"></i>
                            </a>
                            @elseif (strtolower($fileExtension) == 'docx' || strtolower($fileExtension) == 'doc')
                            <a href="{{ asset('licenses/' . $file) }}" target="_blank" class="btn btn-success p-2 text-white" style="position: relative; top:0px;">
                                <i class="fas fa-file-word" style="font-size: 24px;"></i>
                            </a>
                            @endif
                        </span>
                        @endforeach
                        <button class="btn-sm btn-primary h-25" onclick="downloadAll('licenses')"> <i class="fa fa-download"></i></button>
                    </div>
                    <strong class="text-dark" style="float: right; position: relative; top: -40px;">تراخيص أخرى</strong>
                </div>

            </div>
            <div class="card-footer text-center" style="background-color: #e0e0e0; padding: 15px; border-radius: 0 0 15px 15px;">
                <small class="text-muted">Created on: {{ $company->created_at->format('d M, Y') ?? '' }}</small>
            </div>
        </div>
    </div>
</div>

<script>
    function downloadFile(fileUrl) {
        var link = document.createElement('a');
        link.href = fileUrl;
        link.download = fileUrl.split('/').pop();
        link.click();
    }

    function downloadAll(sectionId) {
        var fileUrls = [];
        document.querySelectorAll('#' + sectionId + ' span[data-file]').forEach(function(span) {
            fileUrls.push(span.getAttribute('data-file'));
        });
        fileUrls.forEach(function(url) {
            downloadFile(url);
        });
    }
</script>
@endsection
