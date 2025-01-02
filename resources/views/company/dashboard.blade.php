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
                <div class="page-header-left">
                    <h3 id="investment-title">Dashboard</h>
                </div>
            </div>
            <div class="row gy-3">
                <div class="col-md-3">
                    <div class="dashboard-card">
                        <div class="dashboard-icon">
                            <i class="fa-solid fa-hourglass-start"></i>
                        </div>
                        <div class="dashboard-content">
                            <h5>Request Pending</h5>
                            <p>{{ $requestPending ?? '' }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="dashboard-card">
                        <div class="dashboard-icon">
                            <i class="fa-solid fa-thumbs-up"></i>
                        </div>
                        <div class="dashboard-content">
                            <h5>Request Approved</h5>
                            <p>{{ $requestApproved ?? '' }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="dashboard-card">
                        <div class="dashboard-icon">
                            <i class="fa-solid fa-money-bill-1-wave"></i> <!-- Updated to "users" icon for Companies -->
                        </div>
                        <div class="dashboard-content">
                            <h5>Total Funds</h5>
                            <p>{{ $requestFundsSum ?? '' }}.00</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="dashboard-card">
                        <div class="dashboard-icon">
                            <i class="fa-solid fa-code-pull-request"></i>
                        </div>
                        <div class="dashboard-content">
                            <h5>Total Request</h5>
                            <p>{{ $requestTotal ?? '' }}</p>
                        </div>
                    </div>
                </div>

            </div>
            {{-- <div class="card mt-5">
                <div class="col-lg-12">
                    <canvas id="lineChart" width="300" height="100"></canvas>
                </div>
            </div> --}}
            <div class="row mt-5">
                <div class="text-center">
                    <h2 class="h2Hed">My Request</h2>
                </div>
                @foreach ($requestesDatas as $requestesData)
                <div class="col-lg-4 mt-2">
                    <!-- Adjusted col size for responsive layout -->
                    <div class="card p-2" style="border: 1px solid #214D45;">
                        <div class="d-flex flex-row justify-content-between">
                            <p class="PTag">{{ $requestesData->name ?? ''}}</p>
                            <button class="btn" style="color: #b3dd0d; padding: 10px;height:40px;">
                                <i class="fa fa-ellipsis-v"></i>
                            </button>
                        </div>
                        <span class="bBorder"></span>
                        <div class="d-flex flex-row justify-content-between mt-2">
                            <p class="categoryName">{{ $requestesData->category ?? '' }}</p>
                            <p class="fundTotal ">SAR{{ $requestesData->total_funds ?? '' }}</p>
                        </div>
                        <span class="bBorder"></span>
                        <div class="d-flex flex-row justify-content-between mt-2">
                            @if($requestesData->status == 1)
                            <span class="btn-sm h-25 " style="background-color: #214D45;color:white;">Accept</span>
                            @else
                            <span class="btn-sm h-25 " style="background-color: #b3dd0d;color:#214D45;">Under Review</span>
                            @endif
                            <p class="timeDate ">{{ $requestesData->created_at->format('d M, Y') ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </div>
</div>
@include('company.js')
@endsection
