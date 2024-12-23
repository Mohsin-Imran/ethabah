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
                <h3 class="mb-0 text-white">Investor Request</h3>
            </div>
            <div class="card-body bg-white" style="border-radius: 0 0 15px 15px;">
                <div class="d-flex flex-row justify-content-between mt-1 p-1 border-bottom">
                    <strong class="text-dark">Name</strong>
                    <span class="text-secondary">{{ $investorReq->user->name ?? 'Not Available' }}</span>
                </div>
                <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <strong class="text-dark">Investment Fund Name</strong>
                    <span class="text-secondary">{{ $investorReq->investmentFund->name ?? 'Not Available' }} <a href="{{ route('admin.investor.funds.view',$investorReq->investor_funds_id) }}" class="btn-sm btn-primary">View</a> </span>
                </div>
                {{-- <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <strong class="text-dark">Company Name</strong>
                    <div class="d-flex flex-wrap">
                        @if($investorReq->investmentFund->companies->isNotEmpty())
                            @foreach ($investorReq->investmentFund->companies as $company)
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
                </div> --}}
                <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <strong class="text-dark">Amount</strong>
                    <span class="text-secondary">{{ $investorReq->amount ?? 'Not Available' }}</span>
                </div>
                <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <strong class="text-dark">Profit Percentage</strong>
                    <span class="text-secondary">{{ $profitPercentage ?? 'Not Available' }}%</span>
                </div>
                <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <strong class="text-dark">Total Profit Amount</strong>
                    <span class="text-secondary">{{ $calculatedProfit ?? 'Not Available' }}</span>
                </div>

                <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <strong class="text-dark">Time Of Investment</strong>
                    <span class="text-secondary">{{ $investorReq->time_of_investment ?? 'Not Available' }}</span>
                </div>
                <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <strong class="text-dark">Start Of Period</strong>
                    <span class="text-secondary">
                        {{ $investorReq->start_of_period ? \Carbon\Carbon::parse($investorReq->start_of_period)->format('d M,Y') : 'Not Available' }}
                    </span>
                </div>
                <div class="d-flex flex-row justify-content-between mt-4 p-1 border-bottom">
                    <strong class="text-dark">End Of Period</strong>
                    <span class="text-secondary">
                        {{ $investorReq->end_of_period ? \Carbon\Carbon::parse($investorReq->end_of_period)->format('d M,Y') : 'Not Available' }}
                    </span>
                </div>
            </div>
            <div class="card-footer text-center" style="background-color: #e0e0e0; padding: 15px; border-radius: 0 0 15px 15px;">
                <small class="text-muted">Created on: {{ $investorReq->created_at->format('d M, Y') ?? '' }}</small>
            </div>
        </div>
    </div>
</div>
@endsection
