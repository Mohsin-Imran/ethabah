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
                    <h3>Investments</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid" dir="rtl">
    <div class="row g-4">
        @foreach ($requestesData as $data)
        <div class="col-md-4 card-item">
            <div class="card p-3" style="background-color: #e8f8ec;">
                @if($data->investmentFund && $data->investmentFund->image)
                <img src="{{ asset('investorFund/' . $data->investmentFund->image) }}" height="200px" class="card-img-top rounded" alt="Investment Image">
                @else
                <img src="https://static.toiimg.com/photo/80452572.cms?imgsize=156776" height="200px" class="card-img-top rounded" alt="Default Image">
                @endif
                <div class="card-body">
                    <h5 class="card-title text-dark" style="color: black; font-weight: bold;">{{ $data->name ?? '' }}</h5>
                    <p class="card-text">
                        <small style="color: black;">{{ $data->created_at->format('d M, Y') ?? '' }}</small>
                        <svg style="position: relative; right: 20px; top: 5px;" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-tags" viewBox="0 0 16 16">
                            <path d="M3 2v4.586l7 7L14.586 9l-7-7zM2 2a1 1 0 0 1 1-1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 2 6.586z" />
                            <path d="M5.5 5a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1m0 1a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3M1 7.086a1 1 0 0 0 .293.707L8.75 15.25l-.043.043a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 0 7.586V3a1 1 0 0 1 1-1z" />
                        </svg>
                        @if($data->investmentFund && $data->investmentFund->category)
                        <span class="badge bg-success me-2 mt-2 float-start">
                            {{ $data->investmentFund->category->name }}
                        </span>
                        @else
                        <span class="badge bg-secondary me-2 mt-2 float-start">No Category</span>
                        @endif
                    </p>
                    <p class="mt-2" style="color: black;"><strong class="text-change">Investment Name</strong> <br>{{ $data->investmentFund->name ?? '' }}</p>
                    <p class="mt-2" style="color: black;"><strong class="text-change">Investment Amount</strong> <br> SAR {{ $data->amount ?? '' }}</p>
                    <p class="mt-2" style="color: black;">
                        <strong class="text-change">Start of Period</strong> <br>
                        {{ $data->start_of_period ? \Carbon\Carbon::parse($data->start_of_period)->format('D, F j, Y') : '' }}
                    </p>
                    <p class="mt-2" style="color: black;">
                        <strong class="text-change">End of Period</strong> <br>
                        {{ $data->end_of_period ? \Carbon\Carbon::parse($data->end_of_period)->format('D, F j, Y') : '' }}
                    </p>


                    <div class="d-flex flex-row justify-content-between">
                        {{-- @if($data->status == 1)
                        <span class="badge bg-success me-2 float-end">Approved</span>
                        @else
                        <span class="badge bg-warning me-2 float-end">Review</span>
                        @endif --}}
                    </div>

                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
                