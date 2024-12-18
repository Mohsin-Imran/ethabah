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
                    <strong class="text-dark">Register Certificate</strong>
                    <span class="text-secondary">
                        <a href="{{ asset('register_certificate/'.$investor->register_certificate) }}" data-fancybox="gallery" data-caption="Register Certificate">
                            <img src="{{ asset('register_certificate/'.$investor->register_certificate) }}" width="80px" class="img-fluid" alt="Image of {{ $investor->user->name ?? 'User' }}">
                        </a>
                    </span>
                </div>

                <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <strong class="text-dark">Commercial Certificate</strong>
                    <span class="text-secondary">
                        <a href="{{ asset('commercial_certificate/'.$investor->commercial_certificate) }}" data-fancybox="gallery" data-caption="Commercial Certificate">
                            <img src="{{ asset('commercial_certificate/'.$investor->commercial_certificate) }}" width="80px" class="img-fluid" alt="Image of {{ $investor->user->name ?? 'User' }}">
                        </a>
                    </span>
                </div>

                <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <strong class="text-dark">License</strong>
                    <span class="text-secondary">
                        <a href="{{ asset('licenses/'.$investor->licenses) }}" data-fancybox="gallery" data-caption="License">
                            <img src="{{ asset('licenses/'.$investor->licenses) }}" class="img-fluid" width="80px" alt="Image of {{ $investor->user->name ?? 'User' }}">
                        </a>
                    </span>
                </div>
            </div>
            <div class="card-footer text-center" style="background-color: #e0e0e0; padding: 15px; border-radius: 0 0 15px 15px;">
                <small class="text-muted">Created on: {{ $investor->created_at->format('d M, Y') ?? '' }}</small>
            </div>
        </div>
    </div>
</div>
@endsection
