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
                <h3 class="text-white">معلومات شخصية</h3>
            </div>

            <div class="card-body p-2" dir="rtl">
                <form method="POST" action="{{ route('investor.profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="mb-3 mt-2 col-lg-6">
                            <label for="name" class="form-label">اسم <span style="color: red;">*</span></label>
                            <input type="text" value="{{ $profile->name ?? '' }}" placeholder="اسم" class="form-control @error('name') is-invalid @enderror" name="name" id="name">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3 mt-2 col-lg-6">
                            <label for="email" class="form-label">بريد إلكتروني <span style="color: red;">*</span></label>
                            <input type="email" value="{{ $profile->email ?? '' }}" placeholder="بريد إلكتروني" class="form-control @error('email') is-invalid @enderror" name="email" id="email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3 mt-2 col-lg-6">
                            <label for="phone" class="form-label">هاتف <span style="color: red;">*</span></label>
                            <input type="tel" dir="rtl" value="{{ $profile->phone ?? '' }}" placeholder="هاتف" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone">
                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3 mt-2 col-lg-6">
                            <label for="address" class="form-label">عنوان <span style="color: red;">*</span></label>
                            <input type="text" value="{{ $profile->address ?? '' }}" placeholder="عنوان" class="form-control @error('address') is-invalid @enderror" name="address" id="address">
                            @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3 mt-2 col-lg-6">
                            <label for="password" class="form-label">كلمة المرور <span style="color: red;">*</span></label>
                            <input type="password" value="" placeholder="كلمة المرور الجديدة" class="form-control @error('password') is-invalid @enderror" name="password" id="password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3 mt-2 col-lg-6">
                            <label for="password_confirmation" class="form-label">تأكيد كلمة المرور <span style="color: red;">*</span></label>
                            <input type="password" value="" placeholder="تأكيد كلمة المرور" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" id="password_confirmation">
                            @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3 mt-2 col-lg-6">
                            <label for="national_id" class="form-label">الهوية الوطنية<span style="color: red;">*</span></label>
                            <input id="national_id" type="file" class="form-control @error('national_id') is-invalid @enderror" name="national_id[]" multiple>
                            @error('national_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <br>
                            @php
                            $registerCertificates = json_decode($profile->national_id, true) ?? [];
                            @endphp
                            @foreach ($registerCertificates as $file)
                            @php
                            $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                            @endphp
                            <span class="text-secondary me-2" data-file="{{ asset('investor_register/' . $file) }}" style="margin-bottom: 10px;">
                                @if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif', 'bmp']))
                                <a href="{{ asset('investor_register/' . $file) }}" data-fancybox="gallery" data-caption="شهادة التسجيل">
                                    <img src="{{ asset('investor_register/' . $file) }}" width="40px" height="40px" class="mb-2 border" alt="شهادة التسجيل" style="border: 2px solid #000; padding: 3px;">
                                </a>
                                @elseif (strtolower($fileExtension) == 'pdf')
                                <a href="{{ asset('investor_register/' . $file) }}" target="_blank" class="btn btn-info p-2 text-white" style="position: relative; top:0px;">
                                    <i class="fas fa-file-pdf" style="font-size: 24px;"></i>
                                </a>
                                @elseif (strtolower($fileExtension) == 'docx' || strtolower($fileExtension) == 'doc')
                                <a href="{{ asset('investor_register/' . $file) }}" target="_blank" class="btn btn-success p-2 text-white" style="position: relative; top:0px;">
                                    <i class="fas fa-file-word" style="font-size: 24px;"></i>
                                </a>
                                @endif
                            </span>
                            @endforeach
                        </div>

                        <div class="mb-3 mt-2 col-lg-6">
                            <label for="passport" class="form-label">جواز السفر<span style="color: red;">*</span></label>
                            <input id="passport" type="file" class="form-control @error('passport') is-invalid @enderror" name="passport[]" multiple>
                            @error('passport')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <br>
                            @php
                            $registerCertificates = json_decode($profile->passport, true) ?? [];
                            @endphp
                            @foreach ($registerCertificates as $file)
                            @php
                            $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                            @endphp
                            <span class="text-secondary me-2" data-file="{{ asset('investor_register/' . $file) }}" style="margin-bottom: 10px;">
                                @if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif', 'bmp']))
                                <a href="{{ asset('investor_register/' . $file) }}" data-fancybox="gallery" data-caption="شهادة التسجيل">
                                    <img src="{{ asset('investor_register/' . $file) }}" width="40px" height="40px" class="mb-2 border" alt="شهادة التسجيل" style="border: 2px solid #000; padding: 3px;">
                                </a>
                                @elseif (strtolower($fileExtension) == 'pdf')
                                <a href="{{ asset('investor_register/' . $file) }}" target="_blank" class="btn btn-info p-2 text-white" style="position: relative; top:0px;">
                                    <i class="fas fa-file-pdf" style="font-size: 24px;"></i>
                                </a>
                                @elseif (strtolower($fileExtension) == 'docx' || strtolower($fileExtension) == 'doc')
                                <a href="{{ asset('investor_register/' . $file) }}" target="_blank" class="btn btn-success p-2 text-white" style="position: relative; top:0px;">
                                    <i class="fas fa-file-word" style="font-size: 24px;"></i>
                                </a>
                                @endif
                            </span>
                            @endforeach
                        </div>
                    </div>
                    <button type="submit" class="btn-sm btn-primary">تحديث</button>
                </form>
            </div>
        </div>
    </div>
</div>

@include('admin.js')
@endsection
