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
                <h3 class="text-white">Edit Category</h3>
            </div>

            <div class="card-body p-2">
                <form method="POST" action="{{ route('admin.category.update',$category->id) }}">
                    @csrf
                    <div class="row">
                        <div class="mb-3 mt-2 col-lg-12">
                            <label for="name" class="form-label">Name <span style="color: red;">*</span></label>
                            <input type="text" value="{{ $category->name ?? '' }}" placeholder="Name" class="form-control @error('name') is-invalid @enderror" name="name" id="name">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn-sm btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
