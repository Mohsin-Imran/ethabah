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
            <div class="card-header p-2 bg-primary">
                <h3 class="mb-0 text-white">Investors Request</h3>
            </div>
            <div class="table-responsive mt-4">
                <table id="example" class="tabel table-bordered  table-hover  table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Amount</th>
                            <th>Time Of Investment</th>
                            <th>Investment Fund</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($investorReqs as $data)
                        <tr>
                            <td>{{ $data->user->name ?? 'N/A'}}</td>
                            <td>{{ $data->amount ?? 'N/A'}}</td>
                            <td>{{ $data->time_of_investment ?? 'N/A'}}</td>
                            <td>{{ $data->investment_fund ?? 'N/A'}}</td>
                            <td class="p-1">
                                @if($data->status == 1)
                                <span class="badge bg-success">Accept</span>
                                @else
                                <span class="badge bg-danger">Decline</span>
                                @endif
                            </td>
                            <td class="p-2">
                                <a href="{{ route('admin.investor.request.declineRequest', $data->id) }}" class="btn-sm btn-primary m-1" title="Decline">
                                    <i class="fa fa-times"></i>
                                    Decline
                                </a>
                                <a href="{{ route('admin.investor.request.acceptRequest', $data->id) }}" class="btn-sm btn-success m-1" title="Accept">
                                    <i class="fa fa-check"></i>
                                    Accept
                                </a>
                                <a href="{{ route('admin.investor.request.view', $data->id) }}" class="btn-sm btn-info text-white m-1" title="View">
                                    <i class="fa fa-eye"></i>
                                    View
                                </a>
                            </td>
                            {{-- <td class="p-1">
                                <a href="{{ route('admin.investor.view', $data->id) }}" class="fa fa-eye-slash btn-sm btn-primary" style="font-size: 15px; margin:5px;"></a>
                                <a href="#" class="fa fa-pencil btn-sm btn-success" style="font-size: 15px; margin:5px;"></a>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#modalIdDelete{{ $data->id }}" class="fa fa-trash btn-sm btn-red ml-3" style="font-size: 15px; background-color: red; color: white;"></a>
                            </td> --}}
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="modalIdDelete{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content p-2">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalTitleId">
                                            Delete Investor
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-user mt-3">
                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                        <a class="btn btn-primary btn-sm" href="{{ route('admin.investor.destroy', ['id' => $data->id]) }}">Delete</a>
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
