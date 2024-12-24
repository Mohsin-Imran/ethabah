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
                <h3 class="mb-0 text-white">investment Fund View</h3>
            </div>
            <div class="card-body bg-white" style="border-radius: 0 0 15px 15px;">
                <div class="d-flex flex-row justify-content-between mt-1 p-1 border-bottom">
                    <strong class="text-dark">Name</strong>
                    <span class="text-secondary">{{ $investorFund->user->name ?? 'Not Available' }}</span>
                </div>
                <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <strong class="text-dark">Category</strong>
                    <span class="text-secondary">{{ $investorFund->category->name ?? 'Not Available' }}</span>
                </div>
                <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <strong class="text-dark">Company Name</strong>
                    <div class="d-flex flex-wrap">
                        @if($investorFund->companies->isNotEmpty())
                        @foreach ($investorFund->companies as $company)
                        <span class="text-secondary badge bg-primary text-white me-2 mb-2">
                            {{ $company->name ?? 'Not Available' }}
                        </span>
                        @endforeach
                        @else
                        <span class="text-secondary badge bg-warning">
                            Not Available
                        </span>
                        @endif
                    </div>
                </div>
                <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <strong class="text-dark">Total Funds</strong>
                    <span class="text-secondary">{{ $investorFund->total_funds ?? 'Not Available' }}.00</span>
                </div>
                <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <strong class="text-dark">Total Received Funds</strong>
                    <span class="text-secondary">{{ $amountSum ?? 'Not Available' }}</span>
                </div>
                <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <strong class="text-dark">Status</strong>
                    <span class="text-secondary">
                        @if(isset($investorFund->total_funds) && isset($amountSum))
                        @if($amountSum >= $investorFund->total_funds)
                        <span class="text-secondary badge bg-info text-white">Start</span>
                        @else
                        <span class="text-secondary badge bg-warning text-white">Waiting</span>
                        @endif
                        @else
                        Not Available
                        @endif
                    </span>
                </div>

                <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <strong class="text-dark">Profit Percentage</strong>
                    <span class="text-secondary">{{ $investorFund->profit_percentage ?? 'Not Available' }}%</span>
                </div>
                <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <strong class="text-dark">Duration Of Investment</strong>
                    <span class="text-secondary">{{ $investorFund->duration_of_investment ?? 'Not Available' }}</span>
                </div>
                <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <strong class="text-dark">Profit will be paid</strong>
                    <span class="text-secondary">{{ $investorFund->profit ?? 'Not Available' }}</span>
                </div>
            </div>
            <div class="card-footer text-center" style="background-color: #e0e0e0; padding: 15px; border-radius: 0 0 15px 15px;">
                <small class="text-muted">Created on: {{ $investorFund->created_at->format('d M, Y') ?? '' }}</small>
            </div>
        </div>
    </div>
</div>
@endsection
