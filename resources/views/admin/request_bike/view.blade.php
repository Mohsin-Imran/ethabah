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
                <h3 class="mb-0 text-white">Request View</h3>
            </div>
            <div class="card-body bg-white" style="border-radius: 0 0 15px 15px;">
                <div class="d-flex flex-row justify-content-between mt-1 p-1 border-bottom">
                    <strong class="text-dark">Company Name</strong>
                    <span class="text-secondary">{{ $requestBike->user->name ?? 'Not Available' }}</span>
                </div>
                <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <strong class="text-dark">Company Email</strong>
                    <span class="text-secondary">{{ $requestBike->user->email ?? 'Not Available' }}</span>
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
                    <strong class="text-dark">Project Name</strong>
                    <span class="text-secondary">{{ $requestBike->name ?? 'Not Available' }}</span>
                </div>
                <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <strong class="text-dark">Category Name</strong>
                    <span class="text-secondary">{{ $requestBike->category ?? 'Not Available' }}</span>
                </div>
                <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <strong class="text-dark">Purpose Of Funding</strong>
                    <span class="text-secondary">{{ $requestBike->purpose_of_funding ?? 'Not Available' }}</span>
                </div>
                <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <strong class="text-dark">Total Funds</strong>
                    <span class="text-secondary">{{ $requestBike->total_funds ?? 'Not Available' }}</span>
                </div>
                <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <strong class="text-dark">Document</strong>
                    <span class="text-secondary">
                        <a href="{{ asset('request_document/'.$requestBike->request_document) }}" data-fancybox="gallery" data-caption="Register Certificate">
                            <img src="{{ asset('request_document/'.$requestBike->request_document) }}" width="80px" class="img-fluid" alt="Image of {{ $company->user->name ?? 'User' }}">
                        </a>
                    </span>
                </div>
                <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <strong class="text-dark">Description</strong>
                    <span class="text-secondary">{{ $requestBike->description ?? 'Not Available' }}</span>
                </div>
            </div>
            <div class="card-footer text-center" style="background-color: #e0e0e0; padding: 15px; border-radius: 0 0 15px 15px;">
                <small class="text-muted">Created on: {{ $requestBike->created_at->format('d M, Y') ?? '' }}</small>
            </div>
        </div>
    </div>
</div>
@endsection
