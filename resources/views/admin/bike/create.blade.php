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
            <div class="card-header p-2 bg-primary d-flex flex-row justify-content-between">
                <h3 class="mb-0 text-white">Add Vehicle</h3>
                <a href="#" class="btn-sm btn-danger p-2 text-dark" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                    <i class="fa fa-folder-plus"></i> Add Category
                </a>
            </div>
            <div class="card-body p-2">
                <form method="POST" action="{{ route('admin.bike.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="mb-3 mt-2 col-lg-12">
                            <label for="name" class="form-label">Name <span style="color: red;">*</span></label>
                            <input type="text" placeholder="Name" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') }}">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3 mt-2 col-lg-12">
                            <label for="category_id" class="form-label">Category <span style="color: red;">*</span></label>
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
                            <label for="price" class="form-label">Price <span style="color: red;">*</span></label>
                            <input type="number" placeholder="Price" class="form-control @error('price') is-invalid @enderror" name="price" id="price" value="{{ old('price') }}">
                            @error('price')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3 mt-2 col-lg-12">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control" cols="30" rows="5" placeholder="Description">{{ old('description') }}</textarea>
                            @error('description')
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


<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCategoryModalLabel">Add Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('admin.category.store') }}">
                    @csrf
                    <div class="row">
                        <div class="mb-3 mt-2 col-lg-12">
                            <label for="name" class="form-label">Name <span style="color: red;">*</span></label>
                            <input type="text" placeholder="Name" class="form-control @error('name') is-invalid @enderror" name="name" id="name">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn-sm btn-primary">Save Category</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
