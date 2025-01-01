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
                    <span class="text-secondary">{{ $profile->name ?? 'Not Available' }}</span>
                </div>
                <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <strong class="text-dark">Email</strong>
                    <span class="text-secondary">{{ $profile->email ?? 'Not Available' }}</span>
                </div>
                <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <strong class="text-dark">Phone</strong>
                    <span class="text-secondary">{{ $profile->phone ?? 'Not Available' }}</span>
                </div>
                <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <strong class="text-dark">Address</strong>
                    <span class="text-secondary">{{ $profile->address ?? 'Not Available' }}</span>
                </div>

                <div class="mt-4 p-1 border-bottom">
                    <strong class="text-dark">National ID</strong>
                    <div class="d-flex flex-row justify-content-end" id="register-certificates">
                        @php
                        $national_ids = json_decode($profile->national_id, true) ?? [];
                        @endphp
                        @foreach ($national_ids as $file)
                        @php
                        $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                        @endphp
                        <span class="text-secondary me-2" data-file="{{ asset('investor_profile/' . $file) }}" style="margin-bottom: 10px;">
                            @if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif', 'bmp']))
                            <a href="{{ asset('investor_profile/' . $file) }}" data-fancybox="gallery" data-caption="Register Certificate">
                                <img src="{{ asset('investor_profile/' . $file) }}" width="40px" height="40px" class="mb-2 border" alt="Register Certificate" style="border: 2px solid #000; padding: 3px;">
                            </a>
                            @elseif (strtolower($fileExtension) == 'pdf')
                            <a href="{{ asset('investor_profile/' . $file) }}" target="_blank" class="btn btn-info p-2 text-white" style="position: relative; top:0px;">
                                <i class="fas fa-file-pdf" style="font-size: 24px;"></i>
                            </a>
                            @elseif (strtolower($fileExtension) == 'docx' || strtolower($fileExtension) == 'doc')
                            <a href="{{ asset('investor_profile/' . $file) }}" target="_blank" class="btn btn-success p-2 text-white" style="position: relative; top:0px;">
                                <i class="fas fa-file-word" style="font-size: 24px;"></i>
                            </a>
                            @endif
                        </span>
                        @endforeach
                        {{-- <button class="btn-sm btn-primary h-25" onclick="downloadAll('register-certificates')"><i class="fa fa-download"></i></button> --}}
                    </div>
                    <br>
                </div>

                <div class="mt-4 p-1 border-bottom">
                    <strong class="text-dark">Passport</strong>
                    <div class="d-flex flex-row justify-content-end" id="register-certificates">
                        @php
                        $passports = json_decode($profile->passport, true) ?? [];
                        @endphp
                        @foreach ($passports as $file)
                        @php
                        $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                        @endphp
                        <span class="text-secondary me-2" data-file="{{ asset('investor_profile/' . $file) }}" style="margin-bottom: 10px;">
                            @if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif', 'bmp']))
                            <a href="{{ asset('investor_profile/' . $file) }}" data-fancybox="gallery" data-caption="Register Certificate">
                                <img src="{{ asset('investor_profile/' . $file) }}" width="40px" height="40px" class="mb-2 border" alt="Register Certificate" style="border: 2px solid #000; padding: 3px;">
                            </a>
                            @elseif (strtolower($fileExtension) == 'pdf')
                            <a href="{{ asset('investor_profile/' . $file) }}" target="_blank" class="btn btn-info p-2 text-white" style="position: relative; top:0px;">
                                <i class="fas fa-file-pdf" style="font-size: 24px;"></i>
                            </a>
                            @elseif (strtolower($fileExtension) == 'docx' || strtolower($fileExtension) == 'doc')
                            <a href="{{ asset('investor_profile/' . $file) }}" target="_blank" class="btn btn-success p-2 text-white" style="position: relative; top:0px;">
                                <i class="fas fa-file-word" style="font-size: 24px;"></i>
                            </a>
                            @endif
                        </span>
                        @endforeach
                        {{-- <button class="btn-sm btn-primary h-25" onclick="downloadAll('register-certificates')"><i class="fa fa-download"></i></button> --}}
                    </div>
                    <br>
                </div>

                <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <strong class="text-dark d-none">Description</strong>
                    <a class="btn-sm btn-success" href="{{ route('investor.profile.edit') }}">Edit Profile</a>
                </div>
            </div>
            <div class="card-footer text-center" style="background-color: #e0e0e0; padding: 15px; border-radius: 0 0 15px 15px;">
                <small class="text-muted">Created on: {{ $profile->created_at->format('d M, Y') ?? '' }}</small>
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
