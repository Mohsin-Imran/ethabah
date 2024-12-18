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
                    <h3>Vehicle View</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row mt-4">
        @foreach ($bikes as $data)
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <!-- Card Body -->
            <div class="card-body bg-white" style="border: 2px solid black; border-style: dashed;">
                <a href="{{ asset('bike/'.$data->image) }}" data-fancybox="gallery{{ $data->user_id }}">
                    <img src="{{ asset('bike/'.$data->image) }}" class="img-fluid" alt="Image of {{ $data->user->name ?? 'User' }}">
                </a>
            </div>
            <!-- Card Footer -->
            <div class="card-footer text-center" style="border: 2px solid black; border-style: dashed;">
                <small class="text-dark">{{ $data->name ?? 'N/A' }}</small>
                <br>
                <small class="text-muted">Created on: {{ $data->created_at->format('d M, Y') ?? 'N/A' }}</small>
            </div>
        </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-3">
        {{ $bikes->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection
