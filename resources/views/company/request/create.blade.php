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
                <div class="page-header-left">
                    <h3 class="">Add Vehicle</h3>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<div class="container-fluid">
    <div class="row">
        <div class="card p-1">
            <div class="card-header p-2 bg-primary">
                <h3 class="mb-0 text-white">Add Request</h3>
            </div>
            <div class="card-body p-2" dir="rtl">
                <form method="POST" action="{{ route('company.request.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="mb-3 mt-2 col-lg-6">
                            <label for="name" class="form-label">Name <span style="color: red;">*</span></label>
                            <input type="text" placeholder="Name" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') }}">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3 mt-2 col-lg-6">
                            <label for="category" class="form-label">Category <span style="color: red;">*</span></label>
                            <select name="category" class="form-control @error('category') is-invalid @enderror">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->name }}">
                                    {{ $category->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('category')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3 mt-2 col-lg-6">
                            <label for="purpose_of_funding" class="form-label">Purpose of Funding <span style="color: red;">*</span></label>
                            <input type="text" placeholder="Purpose of Funding" class="form-control @error('purpose_of_funding') is-invalid @enderror" name="purpose_of_funding" id="purpose_of_funding" value="{{ old('purpose_of_funding') }}">
                            @error('purpose_of_funding')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3 mt-2 col-lg-6">
                            <label for="total_funds" class="form-label">Total Funds <span style="color: red;">*</span></label>
                            <input type="number" placeholder="Total Funds" class="form-control @error('total_funds') is-invalid @enderror" name="total_funds" id="total_funds" value="{{ old('total_funds') }}">
                            @error('total_funds')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3 mt-2 col-lg-6">
                            <label for="request_document" class="form-label">Document</span></label>
                            <input id="request_document" type="file" class="form-control @error('request_document') is-invalid @enderror" name="request_document[]" multiple>
                            @error('request_document')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3 mt-2 col-lg-6">
                            <label for="description" class="form-label">Description</label>
                           <textarea name="description" id="" placeholder="Description" class="form-control"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn-sm btn-primary">Add</button>
                </form>

            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('message1'))
    <script>
        Swal.fire({
            title: 'Under Review',
            text: 'Our team reviews and approves the documents to activate the account. It usually takes 24-48 hours to review the document.',
            icon: 'success',
            confirmButtonText: 'OK',
            background: '#142E29',  // Dark green background color
            color: '#fff',  // White text color
            iconColor: '#fff',  // White icon color
            confirmButtonColor: '#b3dd0d'  // Primary blue button background color
        });
    </script>
@endif

@include('select')
@endsection
