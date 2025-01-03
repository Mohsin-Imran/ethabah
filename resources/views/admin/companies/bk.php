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
                <h3 class="mb-0 text-white">Company Profile</h3>
            </div>
            <div class="card-body bg-white" style="border-radius: 0 0 15px 15px;">
                <div class="d-flex flex-row justify-content-between mt-1 p-1 border-bottom">
                    <strong class="text-dark">Name</strong>
                    <span class="text-secondary">{{ $company->user->name ?? 'Not Available' }}</span>
                </div>
                <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <strong class="text-dark">Email</strong>
                    <span class="text-secondary">{{ $company->user->email ?? 'Not Available' }}</span>
                </div>
                <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <strong class="text-dark">Phone</strong>
                    <span class="text-secondary">{{ $company->phone ?? 'Not Available' }}</span>
                </div>
                <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <strong class="text-dark">Register Number</strong>
                    <span class="text-secondary">{{ $company->register_num ?? 'Not Available' }}</span>
                </div>
                <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <strong class="text-dark">Register Certificates</strong>
                    <div class="d-flex flex-wrap mt-2" id="register-certificates">
                        @foreach (json_decode($company->register_certificate, true) as $file)
                        @php
                        $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                        @endphp
                        <span class="text-secondary me-2" data-file="{{ asset('register_certificate/' . $file) }}" style="margin-bottom: 10px;">
                            @if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif', 'bmp']))
                            <a href="{{ asset('register_certificate/' . $file) }}" data-fancybox="gallery" data-caption="Register Certificate">
                                <img src="{{ asset('register_certificate/' . $file) }}" width="80px" class="img-fluid mb-2 border" alt="Register Certificate" style="border: 2px solid #000; padding: 3px;">
                            </a>
                            @elseif (strtolower($fileExtension) == 'pdf')
                            <a href="{{ asset('register_certificate/' . $file) }}" target="_blank" class="btn btn-link p-0" style="position: relative; top:20px;">
                                <i class="fas fa-file-pdf" style="font-size: 24px;"></i>
                            </a>
                            @elseif (strtolower($fileExtension) == 'docx' || strtolower($fileExtension) == 'doc')
                            <a href="{{ asset('register_certificate/' . $file) }}" target="_blank" class="btn btn-link p-0" style="position: relative; top:20px;">
                                <i class="fas fa-file-word" style="font-size: 24px;"></i>
                            </a>
                            @endif
                            <br> <!-- Line break after each file -->
                            {{-- <button class="btn btn btn-info mt-2" onclick="downloadFile('{{ asset('register_certificate/' . $file) }}')">Download</button> --}}
                        </span>
                        @endforeach
                    </div>
                    <!-- Download All Button (Optional) -->
                    <div class="text-center">
                        <button class="btn btn-primary p-2" onclick="downloadAll('register-certificates')"> <i class="fa fa-download"></i> Download </button>
                    </div>
                </div>

                <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <strong class="text-dark">Commercial Certificates</strong>
                    <div class="d-flex flex-wrap mt-2" id="commercial-certificates">
                        @foreach (json_decode($company->commercial_certificate, true) as $file)
                        @php
                        $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                        @endphp
                        <span class="text-secondary me-2" data-file="{{ asset('commercial_certificate/' . $file) }}" style="margin-bottom: 10px;">
                            @if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif', 'bmp']))
                            <a href="{{ asset('commercial_certificate/' . $file) }}" data-fancybox="gallery" data-caption="Commercial Certificate">
                                <img src="{{ asset('commercial_certificate/' . $file) }}" width="80px" class="img-fluid mb-2 border" alt="Commercial Certificate" style="border: 2px solid #000; padding: 3px;">
                            </a>
                            @elseif (strtolower($fileExtension) == 'pdf')
                            <a href="{{ asset('commercial_certificate/' . $file) }}" target="_blank" class="btn btn-link p-0" style="position: relative; top:20px;">
                                <i class="fas fa-file-pdf" style="font-size: 24px;"></i>
                            </a>
                            @elseif (strtolower($fileExtension) == 'docx' || strtolower($fileExtension) == 'doc')
                            <a href="{{ asset('commercial_certificate/' . $file) }}" target="_blank" class="btn btn-link p-0" style="position: relative; top:20px;">
                                <i class="fas fa-file-word" style="font-size: 24px;"></i>
                            </a>
                            @endif
                            <br> <!-- Line break after each file -->
                            {{-- <button class="btn btn btn-info mt-2" onclick="downloadFile('{{ asset('commercial_certificate/' . $file) }}')">Download</button> --}}
                        </span>
                        @endforeach
                    </div>
                    <div class="text-center mt-3">
                        <button class="btn btn-primary p-2" onclick="downloadAll('commercial-certificates')"> <i class="fa fa-download"></i> Download </button>
                    </div>
                </div>
                <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <strong class="text-dark">Licenses</strong>
                    <div class="d-flex flex-wrap mt-2" id="licenses">
                        @foreach (json_decode($company->licenses, true) as $file)
                        @php
                        $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                        @endphp
                        <span class="text-secondary me-2" data-file="{{ asset('licenses/' . $file) }}" style="margin-bottom: 10px;">
                            @if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif', 'bmp']))
                            <a href="{{ asset('licenses/' . $file) }}" data-fancybox="gallery" data-caption="License">
                                <img src="{{ asset('licenses/' . $file) }}" width="80px" class="img-fluid mb-2 border" alt="License" style="border: 2px solid #000; padding: 3px;">
                            </a>
                            @elseif (strtolower($fileExtension) == 'pdf')
                            <a href="{{ asset('licenses/' . $file) }}" target="_blank" class="btn btn-info p-2 text-white" style="position: relative; top:20px;">
                                <i class="fas fa-file-pdf" style="font-size: 24px;"></i>
                            </a>
                            @elseif (strtolower($fileExtension) == 'docx' || strtolower($fileExtension) == 'doc')
                            <a href="{{ asset('licenses/' . $file) }}" target="_blank" class="btn btn-info p-2 text-white" style="position: relative; top:20px;">
                                <i class="fas fa-file-word" style="font-size: 24px;"></i>
                            </a>
                            @endif
                            <br> <!-- Line break after each file -->
                            {{-- <button class="btn btn btn-info mt-2" onclick="downloadFile('{{ asset('licenses/' . $file) }}')">Download</button> --}}
                        </span>
                        @endforeach
                    </div>
                    <div class="text-center mt-3">
                        <button class="btn btn-primary p-2" onclick="downloadAll('licenses')"> <i class="fa fa-download"></i> Download </button>
                    </div>
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
        document.querySelectorAll('#' + sectionId + ' span[data-file]').forEach(function (span) {
            fileUrls.push(span.getAttribute('data-file'));
        });
        fileUrls.forEach(function (url) {
            downloadFile(url);
        });
    }

</script>
@endsection
