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
                    <h3 class="">Edit Vehicle</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="card p-1">
            <div class="card-header bg-primary p-2 d-flex flex-row">
                <h3 class="text-white">Edit Vehicle</h3>
            </div>
            <div class="card-body p-2">
                <form method="POST" action="{{ route('admin.bike.update', $bike->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="mb-3 mt-2 col-lg-12">
                            <label for="name" class="form-label">Name <span style="color: red;">*</span></label>
                            <input type="text" placeholder="Name" value="{{ old('name', $bike->name ?? '') }}" class="form-control @error('name') is-invalid @enderror" name="name" id="name">
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
                                <option value="{{ $category->id }}" {{ old('category_id', $bike->category_id) == $category->id ? 'selected' : '' }}>
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
                            <input type="number" placeholder="Price" value="{{ old('price', $bike->price ?? '') }}" class="form-control @error('price') is-invalid @enderror" name="price" id="price">
                            @error('price')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3 mt-2 col-lg-12">
                            <label for="image" class="form-label">Picture <span style="color: red;">*</span></label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image">

                            @if (isset($bike->image) && !empty($bike->image))
                            <div class="mt-3">
                                <img src="{{ asset('bike/' . $bike->image) }}" alt="Current Image" class="img-fluid" style="max-width: 200px;">
                            </div>
                            @endif
                            <div id="imagePreview" class="mt-3">
                                <img id="preview" src="" alt="Image Preview" class="img-fluid" style="max-width: 200px; display: none;">
                            </div>
                            @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3 mt-2 col-lg-12">
                            <label for="limit" class="form-label">Limit</label>
                            <input type="number" placeholder="Limit" value="{{ old('limit', $bike->limit ?? '') }}" class="form-control @error('limit') is-invalid @enderror" name="limit" id="limit">
                            @error('limit')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-3 mt-2 col-lg-12">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control" cols="30" rows="5" placeholder="Description">{{ old('description', $bike->description ?? '') }}</textarea>
                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="mb-3 mt-2 col-lg-12">
                            <button type="submit" class="btn-sm btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
