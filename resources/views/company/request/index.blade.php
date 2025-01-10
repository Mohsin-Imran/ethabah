@extends('layouts.app')

@section('header')
@include('layouts.header')
@endsection


@section('sidebar')
@include('layouts.sidebar')
@endsection

@section('content')

<div class="container-fluid" dir="rtl">
    {{-- <div class="page-header">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-header-left arabic-text">
                    <h3>Request</h3>
                </div>
            </div>
        </div>
    </div> --}}
    {{-- <div class="row gy-3">
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
    </div> --}}
    {{-- <div class="row mt-4">
        <div class="card p-2">
            <div class="card-header p-2 bg-primary d-flex flex-row justify-content-between">
                <h3 class="mb-0 text-white">Request</h3>
                <a href="{{ route('company.request.create') }}" class="btn-sm btn-danger p-2 text-dark"><i class="fa fa-user-plus"></i> Add Request</a>
</div>
<div class="table-responsive mt-4">
    <table id="example" class="tabel table-bordered  table-hover  table-striped">
        <thead>
            <tr>
                <th>Company Name</th>
                <th>Company Email</th>
                <th>Category</th>
                <th>Purpose oF Funding</th>
                <th>Total Funds</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($requestesData as $data)
            <tr>
                <td>{{ $data->user->name ?? 'N/A'}}</td>
                <td>{{ $data->user->email ?? 'N/A'}}</td>
                <td>{{ $data->category ?? 'N/A'}}</td>
                <td>{{ $data->purpose_of_funding ?? 'N/A'}}</td>
                <td><span class="badge bg-primary">{{ $data->total_funds ?? 'N/A'}}</span></td>
                <td class="p-1">
                    @if($data->status == 1)
                    <span class="badge bg-success">Accept</span>
                    @else
                    <span class="badge bg-danger">review</span>
                    @endif
                </td>
                <td class="p-2">
                    <a href="{{ route('company.request.view', $data->id) }}" class="btn-sm btn-info text-white m-1" title="View">
                        <i class="fa fa-eye"></i>
                        View
                    </a>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalId{{ $data->id }}" class="fa fa-file btn-sm btn-red ml-3" style="font-size: 15px; background-color: #214D45; color: white;"></a>
                </td>
                <div class="modal fade" id="modalId{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content p-2">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalTitleId">
                                    Project Document
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Tab Bar -->
                                <ul class="nav nav-tabs" id="tabBar{{ $data->id }}" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active btn-sm btn-success" id="form-tab-{{ $data->id }}" data-bs-toggle="tab" data-bs-target="#form-{{ $data->id }}" type="button" role="tab" aria-controls="form-{{ $data->id }}" aria-selected="true">
                                            Add
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link btn-sm btn-success" style="position: relative;left:10px;" id="table-tab-{{ $data->id }}" data-bs-toggle="tab" data-bs-target="#table-{{ $data->id }}" type="button" role="tab" aria-controls="table-{{ $data->id }}" aria-selected="false">
                                            View
                                        </button>
                                    </li>
                                </ul>

                                <!-- Tab Content -->
                                <div class="tab-content" id="tabContent{{ $data->id }}">
                                    <!-- Form Tab -->
                                    <div class="tab-pane fade show active" id="form-{{ $data->id }}" role="tabpanel" aria-labelledby="form-tab-{{ $data->id }}">
                                        <form class="mt-3" action="{{ route('company.request.updateDocument') }}" enctype="multipart/form-data" method="post">
                                            @csrf
                                            <label for="">Update Name</label>
                                            <input type="text" class="form-control @error('update_name') is-invalid @enderror" name="update_name" placeholder="Update Name" id="">
                                            @error('update_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                            <br>
                                            <input type="hidden" name="request_id" value="{{ $data->id }}" id="">
                                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}" id="">
                                            <input type="hidden" name="company_id" value="{{ auth()->user()->company_id }}" id="">
                                            <label for="">Project Name</label>
                                            <input type="text" class="form-control" value="{{ $data->name }}" readonly id="">
                                            <br>
                                            <label for="">Update Document</label>
                                            <input type="file" class="form-control" name="document[]" multiple>
                                            <br>
                                            <button type="button" class="btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn-sm btn-primary">Add</button>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="table-{{ $data->id }}" role="tabpanel" aria-labelledby="table-tab-{{ $data->id }}">
                                        <div class="row mt-3">
                                            <div class="col-lg-6 p-2" style="border: 1px solid;">
                                                Update Name
                                            </div>
                                            <div class="col-lg-6 p-2" style="border: 1px solid;">
                                                Update Document
                                            </div>
                                            @forelse ($data->projectUpdate as $projectData)
                                            <div class="col-lg-6 p-2" style="border: 1px solid;">
                                                {{ $projectData->update_name ?? 'No update name provided' }}
                                            </div>
                                            <div class="col-lg-6 p-2" style="border: 1px solid;">
                                                @php
                                                $document = json_decode($projectData->document, true) ?? [];
                                                @endphp
                                                @forelse ($document as $file)
                                                @php
                                                $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                                                @endphp
                                                <span class="text-secondary me-2" data-file="{{ asset('document/' . $file) }}" style="margin-bottom: 10px;">
                                                    @if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif', 'bmp']))
                                                    <a href="{{ asset('document/' . $file) }}" data-fancybox="gallery" data-caption="License">
                                                        <img src="{{ asset('document/' . $file) }}" width="40px" height="40px" class="mb-2 border" alt="License" style="border: 2px solid #000; padding: 3px;">
                                                    </a>
                                                    @elseif (strtolower($fileExtension) == 'pdf')
                                                    <a href="{{ asset('document/' . $file) }}" target="_blank" class="btn btn-info p-2 text-white" style="position: relative; top:0px;">
                                                        <i class="fas fa-file-pdf" style="font-size: 24px;"></i>
                                                    </a>
                                                    @elseif (strtolower($fileExtension) == 'docx' || strtolower($fileExtension) == 'doc')
                                                    <a href="{{ asset('document/' . $file) }}" target="_blank" class="btn btn-success p-2 text-white" style="position: relative; top:0px;">
                                                        <i class="fas fa-file-word" style="font-size: 24px;"></i>
                                                    </a>
                                                    @endif
                                                </span>
                                                @empty
                                                <span>No documents available</span>
                                                @endforelse
                                            </div>
                                            @empty
                                            <div class="col-12">
                                                <p>No project updates available.</p>
                                            </div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
</div> --}}

<div class="container mt-5" dir="rtl">
    {{-- <h3 class="mb-4">My Request</h3> --}}
    <div class="d-flex justify-content-start mb-3">
        <div class="d-flex justify-content-end align-items-center mb-3">
            <span class="form-check ms-3">
                <input class="form-check-input" type="radio" id="approved" name="status" value="approved" checked onchange="filterCards()">
                <label class="form-check-label" style="position: relative;right:30px;" for="approved">
                    Approved
                </label>
            </span>
            <span class="form-check ms-3">
                <input class="form-check-input" type="radio" id="review" name="status" value="review" onchange="filterCards()">
                <label class="form-check-label" style="position: relative;right:30px;" for="review">
                    Review
                </label>
            </span>
        </div>
    </div>

    <div class="row g-4" id="cardsContainer">
        @foreach ($requestesData as $data)
        <div class="col-md-4 card-item" data-status="{{ $data->status == 1 ? 'approved' : 'review' }}">
            <div class="card p-3" style="background-color: #e8f8ec;">
                {{-- <img src="https://static.toiimg.com/photo/80452572.cms?imgsize=156776" height="200px" class="card-img-top rounded" alt="Google Ads"> --}}
                <div class="card-body">
                    <h5 class="card-title text-dark" style="color: black; font-weight: bold;">{{ $data->name ?? '' }}</h5>
                    <p class="card-text">
                        <small style="color: black;">{{ $data->created_at->format('d M, Y') ?? '' }}</small>
                        <svg style="position: relative; right: 20px; top: 5px;" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-tags" viewBox="0 0 16 16">
                            <path d="M3 2v4.586l7 7L14.586 9l-7-7zM2 2a1 1 0 0 1 1-1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 2 6.586z" />
                            <path d="M5.5 5a.5.5 0 1 1 0-1 .5.5 0 0 1 0 1m0 1a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3M1 7.086a1 1 0 0 0 .293.707L8.75 15.25l-.043.043a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 0 7.586V3a1 1 0 0 1 1-1z" />
                        </svg>
                        <span class="badge bg-success me-2 mt-2 float-start">{{ $data->category ?? '' }}</span>
                    </p>
                    <p class="mt-2" style="color: black;"><strong class="text-change">Funds Amount</strong> <br> SAR {{ $data->total_funds ?? '' }}</p>
                    <p class="mt-2" style="color: black;"><strong class="text-change">Purpose of Funding</strong> <br> {{ $data->purpose_of_funding ?? '' }}</p>
                    <p class="mt-2" style="color: black;"><strong class="text-change">Description</strong> <br> {{ $data->description ?? '' }}</p>
                    <div class="d-flex flex-row justify-content-between">
                        @if($data->status == 1)
                        <span class="badge bg-success me-2 float-end">Approved</span>
                        @else
                        <span class="badge bg-warning me-2 float-end">Review</span>
                        @endif
                        <a href="#" data-bs-toggle="modal" data-bs-target="#modalId{{ $data->id }}" class="fa fa-file btn-sm btn-red ml-3" style="font-size: 15px; background-color: #214D45; color: white;"></a>
                    </div>
                    <div class="modal fade" id="modalId{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content p-2">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalTitleId">
                                        Project Document
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Tab Bar -->
                                    <ul class="nav nav-tabs" id="tabBar{{ $data->id }}" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active btn-sm btn-success" id="form-tab-{{ $data->id }}" data-bs-toggle="tab" data-bs-target="#form-{{ $data->id }}" type="button" role="tab" aria-controls="form-{{ $data->id }}" aria-selected="true">
                                                Add
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link btn-sm btn-success" style="position: relative;left:-10px;" id="table-tab-{{ $data->id }}" data-bs-toggle="tab" data-bs-target="#table-{{ $data->id }}" type="button" role="tab" aria-controls="table-{{ $data->id }}" aria-selected="false">
                                                View
                                            </button>
                                        </li>
                                    </ul>

                                    <!-- Tab Content -->
                                    <div class="tab-content" id="tabContent{{ $data->id }}">
                                        <!-- Form Tab -->
                                        <div class="tab-pane fade show active" id="form-{{ $data->id }}" role="tabpanel" aria-labelledby="form-tab-{{ $data->id }}">
                                            <form class="mt-3" action="{{ route('company.request.updateDocument') }}" enctype="multipart/form-data" method="post">
                                                @csrf
                                                <label for="">Update Name</label>
                                                <input type="text" class="form-control @error('update_name') is-invalid @enderror" name="update_name" placeholder="Update Name" id="">
                                                @error('update_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                                <br>
                                                <input type="hidden" name="request_id" value="{{ $data->id }}" id="">
                                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}" id="">
                                                <input type="hidden" name="company_id" value="{{ auth()->user()->company_id }}" id="">
                                                <label for="">Project Name</label>
                                                <input type="text" class="form-control" value="{{ $data->name }}" readonly id="">
                                                <br>
                                                <label for="">Update Document</label>
                                                <input type="file" class="form-control" name="document[]" multiple>
                                                <br>
                                                <button type="button" class="btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn-sm btn-primary">Add</button>
                                            </form>
                                        </div>
                                        <div class="tab-pane fade" id="table-{{ $data->id }}" role="tabpanel" aria-labelledby="table-tab-{{ $data->id }}">
                                            <div class="row mt-3">
                                                <div class="col-lg-6 p-2" style="border: 1px solid;">
                                                    Update Name
                                                </div>
                                                <div class="col-lg-6 p-2" style="border: 1px solid;">
                                                    Update Document
                                                </div>
                                                @forelse ($data->projectUpdate as $projectData)
                                                <div class="col-lg-6 p-2" style="border: 1px solid;">
                                                    {{ $projectData->update_name ?? 'No update name provided' }}
                                                </div>
                                                <div class="col-lg-6 p-2" style="border: 1px solid;">
                                                    @php
                                                    $document = json_decode($projectData->document, true) ?? [];
                                                    @endphp
                                                    @forelse ($document as $file)
                                                    @php
                                                    $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                                                    @endphp
                                                    <span class="text-secondary me-2" data-file="{{ asset('document/' . $file) }}" style="margin-bottom: 10px;">
                                                        @if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif', 'bmp']))
                                                        <a href="{{ asset('document/' . $file) }}" data-fancybox="gallery" data-caption="License">
                                                            <img src="{{ asset('document/' . $file) }}" width="40px" height="40px" class="mb-2 border" alt="License" style="border: 2px solid #000; padding: 3px;">
                                                        </a>
                                                        @elseif (strtolower($fileExtension) == 'pdf')
                                                        <a href="{{ asset('document/' . $file) }}" target="_blank" class="btn btn-info p-2 text-white" style="position: relative; top:0px;">
                                                            <i class="fas fa-file-pdf" style="font-size: 24px;"></i>
                                                        </a>
                                                        @elseif (strtolower($fileExtension) == 'docx' || strtolower($fileExtension) == 'doc')
                                                        <a href="{{ asset('document/' . $file) }}" target="_blank" class="btn btn-success p-2 text-white" style="position: relative; top:0px;">
                                                            <i class="fas fa-file-word" style="font-size: 24px;"></i>
                                                        </a>
                                                        @endif
                                                    </span>
                                                    @empty
                                                    <span>No documents available</span>
                                                    @endforelse
                                                </div>
                                                @empty
                                                <div class="col-12">
                                                    <p>No project updates available.</p>
                                                </div>
                                                @endforelse
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
</div>
@endsection
