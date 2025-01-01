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
                    <h3>Vehicles Request</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="card p-2">
            <div class="card-header p-2 bg-primary d-flex flex-row justify-content-between">
                <h3 class="mb-0 text-white">Vehicles Request Lists</h3>
                <a href="{{ route('customer.request.bike.create') }}" class="btn-sm btn-danger p-2 text-dark"><i class="fa fa-user-plus"></i> Vehicles Request</a>

            </div>
            <div class="table-responsive mt-4">
                <table id="example" class="tabel table-bordered  table-hover  table-striped">
                    <thead>
                        <tr>
                            <th>Bike Name</th>
                            <th>Category</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($requestBikes as $data)
                        <tr>
                            <td>{{ $data->bike->name ?? 'N/A'}}</td>
                            <td>{{ $data->category->name ?? 'N/A'}}</td>
                            <td>{{ $data->qty ?? 'N/A'}}</td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>
@endsection
