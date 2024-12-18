@extends('layouts.app')

@section('header')
@include('layouts.header')
@endsection


@section('sidebar')
@include('layouts.sidebar')
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="card p-1">
            <div class="card-header bg-primary p-2 d-flex flex-row">
                <h3 class="text-white">Aassigned Company</h3>
            </div>

            <div class="card-body p-2">
                <form method="POST" action="{{ route('admin.assigned.company.store') }}">
                    @csrf
                    <div class="row">
                        <div class="mb-3 mt-2 col-lg-12">
                            <label for="category_id" class="form-label">Categories <span style="color: red;">*</span></label>
                            <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name ?? '' }}
                                </option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3 mt-2 col-lg-12">
                            <label for="company_id" class="form-label">Companies <span style="color: red;">*</span></label>
                            <select name="company_id[]" id="select3" multiple class="form-control @error('company_id') is-invalid @enderror">
                                <option value="" disabled>Select Company</option>
                                @foreach ($companies as $company)
                                <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>
                                    {{ $company->name ?? '' }}
                                </option>
                                @endforeach
                            </select>
                            @error('company_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn-sm btn-primary">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>
@include('select')
@endsection
