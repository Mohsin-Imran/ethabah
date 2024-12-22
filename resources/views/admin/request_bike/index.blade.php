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
                    <h3>Request</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row gy-3">
        <div class="col-md-3">
            <div class="dashboard-card">
                <div class="dashboard-icon">
                    <i class="fa fa-chart-line"></i> <!-- Updated to "chart-line" icon for Revenue -->
                </div>
                <div class="dashboard-content">
                    <h5>78.423K</h5>
                    <p>Total Revenue <span class="growth">15.2% ↑</span></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="dashboard-card">
                <div class="dashboard-icon">
                    <i class="fa fa-hand-holding-usd"></i> <!-- Updated to "hand-holding-usd" icon for Fund -->
                </div>
                <div class="dashboard-content">
                    <h5>Total Fund</h5>
                    <p>Investors <span class="growth">5.2% ↑</span></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="dashboard-card">
                <div class="dashboard-icon">
                    <i class="fa fa-users"></i> <!-- Updated to "users" icon for Companies -->
                </div>
                <div class="dashboard-content">
                    <h5>Companies</h5>
                    <p>New Request <span class="growth">5 more ↑</span></p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="dashboard-card">
                <div class="dashboard-icon">
                    <i class="fa fa-people-carry"></i> <!-- Updated to "people-carry" icon for Investors -->
                </div>
                <div class="dashboard-content">
                    <h5>Investors</h5>
                    <p>New Investors <span class="growth">10 more ↑</span></p>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="card p-2">
            <div class="table-responsive mt-4">
                <table id="example" class="tabel table-bordered  table-hover  table-striped">
                    <thead>
                        <tr>
                            <th>Company Name</th>
                            <th>Company Email</th>
                            <th>Category</th>
                            <th>Investment</th>
                            <th>Total Funds</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($requestBikes as $data)
                        <tr>
                            <td>{{ $data->user->name ?? 'N/A'}}</td>
                            <td>{{ $data->user->email ?? 'N/A'}}</td>
                            <td>{{ $data->category ?? 'N/A'}}</td>
                            <td><span class="badge bg-primary">{{ $data->purpose_of_funding ?? 'N/A'}}</span></td>
                            <td>{{ $data->total_funds ?? 'N/A'}}</td>
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
                                <a href="{{ route('admin.request.bike.view', $data->id) }}" class="btn-sm btn-info text-white m-1" title="View">
                                    <i class="fa fa-eye"></i>
                                    View
                                </a>
                            </td>
                        </tr>
                        {{-- <div class="modal fade" id="modalId{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content p-2">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalTitleId">
                                        Delete Request
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-user mt-3">
                                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                                    <a class="btn btn-primary btn-sm" href="{{ route('admin.request.bike.destroy', ['id' => $data->id]) }}">Delete</a>
                                </div>
                            </div>
                        </div>
            </div> --}}
            @endforeach
            </tbody>
            </table>
        </div>
    </div>
</div>
</div>


@endsection
