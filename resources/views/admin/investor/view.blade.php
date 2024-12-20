@extends('layouts.app')

@section('header')
@include('layouts.header')
@endsection


@section('sidebar')
@include('layouts.sidebar')
@endsection

@section('content')


<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="card p-4 shadow-sm border-0" style="background: #f4f4f4;">
            <div class="card-header p-2 bg-primary text-white arabic-text">
                <h3 class="mb-0 text-white">Investor Profile</h3>
            </div>
            <div class="card-body bg-white" style="border-radius: 0 0 15px 15px;">
                <div class="d-flex flex-row justify-content-between mt-1 p-1 border-bottom">
                    <strong class="text-dark">Name</strong>
                    <span class="text-secondary">{{ $investor->name ?? 'Not Available' }}</span>
                </div>
                <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <strong class="text-dark">Email</strong>
                    <span class="text-secondary">{{ $investor->email ?? 'Not Available' }}</span>
                </div>
                <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <strong class="text-dark">Phone</strong>
                    <span class="text-secondary">{{ $investor->phone ?? 'Not Available' }}</span>
                </div>
                <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <strong class="text-dark">Address</strong>
                    <span class="text-secondary">{{ $investor->address ?? 'Not Available' }}</span>
                </div>
                <div class="mt-4 p-1 border-bottom">
                    <strong class="text-dark">Passport</strong>
                    <div class="d-flex flex-row justify-content-end" style="margin: -20px;" id="commercial-certificates">
                        @php
                        $passport = json_decode($investor->passport, true) ?? [];
                        @endphp
                        @foreach ($passport as $file)
                        @php
                        $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                        @endphp
                        <span class="text-secondary me-2" data-file="{{ asset('investor_register/' . $file) }}" style="margin-bottom: 10px;">
                            @if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif', 'bmp']))
                            <a href="{{ asset('investor_register/' . $file) }}" data-fancybox="gallery" data-caption="Commercial Certificate">
                                <img src="{{ asset('investor_register/' . $file) }}" width="40px" height="40px" class="mb-2 border" alt="Commercial Certificate" style="border: 2px solid #000; padding: 3px;">
                            </a>
                            @elseif (strtolower($fileExtension) == 'pdf')
                            <a href="{{ asset('investor_register/' . $file) }}" target="_blank" class="btn btn-info p-2 text-white" style="position: relative; top:0px;">
                                <i class="fas fa-file-pdf" style="font-size: 24px;"></i>
                            </a>
                            @elseif (strtolower($fileExtension) == 'docx' || strtolower($fileExtension) == 'doc')
                            <a href="{{ asset('investor_register/' . $file) }}" target="_blank" class="btn btn-success p-2 text-white" style="position: relative; top:0px;">
                                <i class="fas fa-file-word" style="font-size: 24px;"></i>
                            </a>
                            @endif
                        </span>
                        @endforeach
                        {{-- <button class="btn-sm btn-primary h-25" onclick="downloadAll('commercial-certificates')"> <i class="fa fa-download"></i></button> --}}
                    </div>
                    <br>
                </div>
                <div class="mt-4 p-1 border-bottom">
                    <strong class="text-dark">National ID</strong>
                    <div class="d-flex flex-row justify-content-end" style="margin: -20px;" id="commercial-certificates">
                        @php
                        $national_id = json_decode($investor->national_id, true) ?? [];
                        @endphp
                        @foreach ($national_id as $file)
                        @php
                        $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                        @endphp
                        <span class="text-secondary me-2" data-file="{{ asset('investor_register/' . $file) }}" style="margin-bottom: 10px;">
                            @if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif', 'bmp']))
                            <a href="{{ asset('investor_register/' . $file) }}" data-fancybox="gallery" data-caption="Commercial Certificate">
                                <img src="{{ asset('investor_register/' . $file) }}" width="40px" height="40px" class="mb-2 border" alt="Commercial Certificate" style="border: 2px solid #000; padding: 3px;">
                            </a>
                            @elseif (strtolower($fileExtension) == 'pdf')
                            <a href="{{ asset('investor_register/' . $file) }}" target="_blank" class="btn btn-info p-2 text-white" style="position: relative; top:0px;">
                                <i class="fas fa-file-pdf" style="font-size: 24px;"></i>
                            </a>
                            @elseif (strtolower($fileExtension) == 'docx' || strtolower($fileExtension) == 'doc')
                            <a href="{{ asset('investor_register/' . $file) }}" target="_blank" class="btn btn-success p-2 text-white" style="position: relative; top:0px;">
                                <i class="fas fa-file-word" style="font-size: 24px;"></i>
                            </a>
                            @endif
                        </span>
                        @endforeach
                        {{-- <button class="btn-sm btn-primary h-25" onclick="downloadAll('commercial-certificates')"> <i class="fa fa-download"></i></button> --}}
                    </div>
                    <br>
                </div>
            </div>
            <div class="card-footer text-center" style="background-color: #e0e0e0; padding: 15px; border-radius: 0 0 15px 15px;">
                <small class="text-muted">Created on: {{ $investor->created_at->format('d M, Y') ?? '' }}</small>
            </div>
        </div>
    </div>
</div>
@endsection
