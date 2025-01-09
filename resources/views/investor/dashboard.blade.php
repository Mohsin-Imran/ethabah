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
                    <h3>Dashboard</h3>
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
                    <canvas id="investmentChart" width="300" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script type="text/javascript">
        // Fetching the labels, data, and colors from the server-side
        var chartLabels = {!! json_encode($chartLabels ?? []) !!};
        var chartDataValues = {!! json_encode($chartDataValues ?? []) !!};
        var chartColors = {!! json_encode($chartColors ?? []) !!};

        // Chart configuration
        const investmentChartData = {
            labels: chartLabels,
            datasets: [{
                label: 'Monthly Investment Amount',
                backgroundColor: chartColors,
                borderColor: chartColors,
                data: chartDataValues,
            }]
        };

        const investmentChartConfig = {
            type: 'bar',
            data: investmentChartData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return 'SAR: ' + tooltipItem.raw;
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true
                    }
                }
            }
        };

        // Create the chart
        const investmentChart = new Chart(
            document.getElementById('investmentChart'),
            investmentChartConfig
        );
    </script>
@endsection
