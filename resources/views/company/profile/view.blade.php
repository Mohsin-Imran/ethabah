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
        <div class="card p-4 shadow-lg border-0" style="background: #f8f9fa;">
            <div class="card-header p-3 bg-primary text-white rounded-top">
                <h3 class="mb-0 text-white">Company Profile</h3>
            </div>
            <div class="card-body bg-white" style="border-radius: 0 0 20px 20px;">
                <div class="d-flex flex-row justify-content-between mt-3 p-3 border-bottom">
                    <strong class="text-dark">Name</strong>
                    <span class="text-secondary">{{ $profile->company->user->name ?? 'Not Available' }}</span>
                </div>
                <div class="d-flex flex-row justify-content-between mt-3 p-3 border-bottom">
                    <strong class="text-dark">Email</strong>
                    <span class="text-secondary">{{ $profile->company->user->email ?? 'Not Available' }}</span>
                </div>
                <div class="d-flex flex-row justify-content-between mt-3 p-3 border-bottom">
                    <strong class="text-dark">Phone</strong>
                    <span class="text-secondary">{{ $profile->company->phone ?? 'Not Available' }}</span>
                </div>
                <div class="d-flex flex-row justify-content-between mt-3 p-3 border-bottom">
                    <strong class="text-dark">Register Number</strong>
                    <span class="text-secondary">{{ $profile->company->register_num ?? 'Not Available' }}</span>
                </div>

                <div class="mt-4 p-3 border-bottom">
                    <div class="row">
                        <div class="col-lg-6">
                            <strong class="text-dark">Register Certificates</strong>
                        </div>
                        <div class="col-lg-6">
                            <div class="d-flex flex-row justify-content-end" id="register-certificates">
                                @php
                                $registerCertificates = json_decode($profile->company->register_certificate, true) ?? [];
                                @endphp
                                @foreach ($registerCertificates as $file)
                                @php
                                $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                                @endphp
                                <span class="text-secondary me-2" data-file="{{ asset('register_certificate/' . $file) }}" style="margin-bottom: 10px;">
                                    @if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif', 'bmp']))
                                    <a href="{{ asset('register_certificate/' . $file) }}" data-fancybox="gallery" data-caption="Register Certificate">
                                        <img src="{{ asset('register_certificate/' . $file) }}" width="50px" height="50px" class="mb-2 border" alt="Register Certificate" style="border: 2px solid #007bff; padding: 5px;">
                                    </a>
                                    @elseif (strtolower($fileExtension) == 'pdf')
                                    <a href="{{ asset('register_certificate/' . $file) }}" target="_blank" class="btn btn-info p-2 text-white">
                                        <i class="fas fa-file-pdf" style="font-size: 24px;"></i>
                                    </a>
                                    @elseif (strtolower($fileExtension) == 'docx' || strtolower($fileExtension) == 'doc')
                                    <a href="{{ asset('register_certificate/' . $file) }}" target="_blank" class="btn btn-success p-2 text-white">
                                        <i class="fas fa-file-word" style="font-size: 24px;"></i>
                                    </a>
                                    @endif
                                </span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 p-3 border-bottom">
                    <strong class="text-dark">Commercial Certificates</strong>
                    <div class="d-flex flex-row justify-content-end" id="commercial-certificates">
                        @php
                        $commercialCertificates = json_decode($profile->company->commercial_certificate, true) ?? [];
                        @endphp
                        @foreach ($commercialCertificates as $file)
                        @php
                        $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                        @endphp
                        <span class="text-secondary me-2" data-file="{{ asset('commercial_certificate/' . $file) }}" style="margin-bottom: 10px;">
                            @if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif', 'bmp']))
                            <a href="{{ asset('commercial_certificate/' . $file) }}" data-fancybox="gallery" data-caption="Commercial Certificate">
                                <img src="{{ asset('commercial_certificate/' . $file) }}" width="50px" height="50px" class="mb-2 border" alt="Commercial Certificate" style="border: 2px solid #007bff; padding: 5px;">
                            </a>
                            @elseif (strtolower($fileExtension) == 'pdf')
                            <a href="{{ asset('commercial_certificate/' . $file) }}" target="_blank" class="btn btn-info p-2 text-white">
                                <i class="fas fa-file-pdf" style="font-size: 24px;"></i>
                            </a>
                            @elseif (strtolower($fileExtension) == 'docx' || strtolower($fileExtension) == 'doc')
                            <a href="{{ asset('commercial_certificate/' . $file) }}" target="_blank" class="btn btn-success p-2 text-white">
                                <i class="fas fa-file-word" style="font-size: 24px;"></i>
                            </a>
                            @endif
                        </span>
                        @endforeach
                    </div>
                </div>

                <div class="mt-4 p-3 border-bottom">
                    <strong class="text-dark">Licenses</strong>
                    <div class="d-flex flex-row justify-content-end" id="licenses">
                        @php
                        $licenses = json_decode($profile->company->licenses, true) ?? [];
                        @endphp
                        @foreach ($licenses as $file)
                        @php
                        $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                        @endphp
                        <span class="text-secondary me-2" data-file="{{ asset('licenses/' . $file) }}" style="margin-bottom: 10px;">
                            @if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif', 'bmp']))
                            <a href="{{ asset('licenses/' . $file) }}" data-fancybox="gallery" data-caption="License">
                                <img src="{{ asset('licenses/' . $file) }}" width="50px" height="50px" class="mb-2 border" alt="License" style="border: 2px solid #007bff; padding: 5px;">
                            </a>
                            @elseif (strtolower($fileExtension) == 'pdf')
                            <a href="{{ asset('licenses/' . $file) }}" target="_blank" class="btn btn-info p-2 text-white">
                                <i class="fas fa-file-pdf" style="font-size: 24px;"></i>
                            </a>
                            @elseif (strtolower($fileExtension) == 'docx' || strtolower($fileExtension) == 'doc')
                            <a href="{{ asset('licenses/' . $file) }}" target="_blank" class="btn btn-success p-2 text-white">
                                <i class="fas fa-file-word" style="font-size: 24px;"></i>
                            </a>
                            @endif
                        </span>
                        @endforeach
                    </div>
                </div>

                <div class="d-flex flex-row justify-content-between mt-4 p-3">
                    <strong class="text-dark d-none">Description</strong>
                </div>
            </div>
            <div class="card-footer text-center" style="background-color: #f1f1f1; padding: 15px; border-radius: 0 0 20px 20px;">
                <small class="text-muted">Created on: {{ $profile->company->created_at->format('d M, Y') ?? '' }}</small>
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
