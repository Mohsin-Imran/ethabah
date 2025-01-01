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
                    <h3 class="">Vehicle Request</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="card p-1">
            <div class="card-header bg-primary p-2 d-flex flex-row">
                <h3 class="text-white">Vehicle Request</h3>
            </div>

            <div class="card-body p-2">
                <form method="POST" action="{{ route('customer.request.bike.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="mb-3 mt-2 col-lg-12">
                            <label for="category_id" class="form-label">Select Category <span style="color: red;">*</span></label>
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
                            <label for="bike_id" class="form-label">Select Vehicle <span style="color: red;">*</span></label>
                            <select name="bike_id" id="bike_id" class="form-control @error('bike_id') is-invalid @enderror">
                                <option value="">Select Vehicle</option>
                                @foreach ($bikes as $bike)
                                <option value="{{ $bike->id }}" data-price="{{ $bike->price }}" {{ old('bike_id') == $bike->id ? 'selected' : '' }}>
                                    {{ $bike->name ?? '' }}
                                </option>
                                @endforeach
                            </select>
                            @error('bike_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3 mt-2 col-lg-12">
                            <label for="price" class="form-label">Price <span style="color: red;">*</span></label>
                            <input type="number" placeholder="Price" class="form-control @error('price') is-invalid @enderror" name="price" id="price" value="" readonly>
                            @error('price')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <script>
                            // JavaScript to auto-fill price when a bike is selected
                            document.getElementById('bike_id').addEventListener('change', function() {
                                var selectedBike = this.options[this.selectedIndex];
                                var price = selectedBike.getAttribute('data-price') || '';
                                document.getElementById('price').value = price;
                            });
                        </script>

                        <div class="mb-3 mt-2 col-lg-12">
                            <label for="qty" class="form-label">Quantity <span style="color: red;">*</span></label>
                            <input type="number" placeholder="Quantity" class="form-control @error('qty') is-invalid @enderror" name="qty" id="qty" value="{{ old('qty') }}">
                            @error('qty')
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
@include('select')
@endsection
