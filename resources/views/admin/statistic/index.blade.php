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
        <div class="row" dir="rtl" lang="ar">
            <div class="col-lg-12">
                <div class="page-header-left">
                    <h3>الإحصائية</h3>
                </div>
            </div>
            <div class="row gy-3">
                <div class="card">
                    {{-- <div class="col-lg-2 mt-3">
                        <select id="timePeriodSelect" class="form-control">
                            <option value="monthly">Monthly</option>
                            <option value="yearly">Yearly</option>
                        </select>
                    </div> --}}
                    <canvas id="lineChart" width="300" height="100"></canvas>
                </div>

            </div>
        </div>

    </div>
</div>

@include('admin.js')
@endsection

