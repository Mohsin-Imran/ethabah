@extends('layouts.app')

@section('header')
@include('layouts.header')
@endsection


@section('sidebar')
@include('layouts.sidebar')
@endsection

@section('content')

{{-- <div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-header-left arabic-text">
                    <h3>Investors Funds</h3>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<div class="container-fluid">
    <div class="row">
        <div class="card p-2">
            <div class="card-header p-2 bg-primary d-flex flex-row justify-content-between">
                <a href="{{ route('admin.investor.funds.create') }}" class="btn-sm btn-danger p-2 text-dark"><i class="fa fa-user-plus"></i> Add Investor Funds</a>
                <h3 class="mb-0 text-white">Investors Funds Lists</h3>
            </div>
            <div class="table-responsive mt-4">
                <table id="example" class="tabel table-bordered  table-hover  table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Profit Percentage</th>
                            <th>Duration Of Investment</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($investorFunds as $data)
                        <tr>
                            <td>{{ $data->user->name ?? 'N/A'}}</td>
                            <td>{{ $data->user->email ?? 'N/A'}}</td>
                            <td>{{ $data->profit_percentage ?? 'N/A'}}</td>
                            <td>{{ $data->duration_of_investment ?? 'N/A'}}</td>
                            <td class="p-1">
                                <a href="{{ route('admin.investor.funds.view',$data->id) }}" class="fa fa-eye-slash btn-sm btn-primary" style="font-size: 15px; margin:5px;"></a>
                                <a href="{{ route('admin.investor.funds.edit',$data->id) }}" class="fa fa-pencil btn-sm btn-success" style="font-size: 15px; margin:5px;"></a>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#modalId{{ $data->id }}" class="fa fa-trash btn-sm btn-red ml-3" style="font-size: 15px; background-color: red; color: white;"></a>
                            </td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="modalId{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content p-2">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalTitleId">
                                            Delete Funds
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-user mt-3">
                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                        <a class="btn btn-primary btn-sm" href="{{ route('admin.investor.funds.destroy', ['id' => $data->id]) }}">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>
@endsection
