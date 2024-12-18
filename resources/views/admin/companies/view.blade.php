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
                    <strong class="text-dark">Register Certificate</strong>
                    <span class="text-secondary">
                        <a href="{{ asset('register_certificate/'.$company->register_certificate) }}" data-fancybox="gallery" data-caption="Register Certificate">
                            <img src="{{ asset('register_certificate/'.$company->register_certificate) }}" width="80px" class="img-fluid" alt="Image of {{ $company->user->name ?? 'User' }}">
                        </a>
                    </span>
                </div>

                <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <strong class="text-dark">Commercial Certificate</strong>
                    <span class="text-secondary">
                        <a href="{{ asset('commercial_certificate/'.$company->commercial_certificate) }}" data-fancybox="gallery" data-caption="Commercial Certificate">
                            <img src="{{ asset('commercial_certificate/'.$company->commercial_certificate) }}" width="80px" class="img-fluid" alt="Image of {{ $company->user->name ?? 'User' }}">
                        </a>
                    </span>
                </div>

                <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <strong class="text-dark">License</strong>
                    <span class="text-secondary">
                        <a href="{{ asset('licenses/'.$company->licenses) }}" data-fancybox="gallery" data-caption="License">
                            <img src="{{ asset('licenses/'.$company->licenses) }}" class="img-fluid" width="80px" alt="Image of {{ $company->user->name ?? 'User' }}">
                        </a>
                    </span>
                </div>
            </div>
            <div class="card-footer text-center" style="background-color: #e0e0e0; padding: 15px; border-radius: 0 0 15px 15px;">
                <small class="text-muted">Created on: {{ $company->created_at->format('d M, Y') ?? '' }}</small>
            </div>
        </div>
    </div>
</div>
@endsection
