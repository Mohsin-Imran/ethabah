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
                    <h3>Dashboard</h>
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
                            <p>{{ $investorpendingStatus ?? '' }}</p>
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
                            <p>{{ $investorapprovedStatus ?? '' }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="dashboard-card">
                        <div class="dashboard-icon">
                            <i class="fa-solid fa-money-bill-1-wave"></i> <!-- Updated to "users" icon for Companies -->
                        </div>
                        <div class="dashboard-content">
                            <h5>Total Investment</h5>
                            <p>{{ $investorAmount ?? '' }}</p>
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
                            <p>{{ $investorRequest ?? '' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-5">
                <div class="col-lg-12">
                    <canvas id="investorChart" width="300" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
