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
                <h3 class="text-white">Personal Information</h3>
            </div>

            <div class="card-body p-2">
                <form method="POST" action="{{ route('company.profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="col-lg-6" style="direction: rtl;">
                            <div class="mb-3 mt-2 col-lg-12">
                                <label for="register_certificate" class="form-label">شهادات تسجيل الشركة<span style="color: red;">*</span></label>
                                <input id="register_certificate" type="file" class="form-control @error('register_certificate') is-invalid @enderror" name="register_certificate[]" multiple>
                                @error('register_certificate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <br>
                                @php
                                $registerCertificates = json_decode($profile->company->register_certificate, true) ?? [];
                                @endphp
                                @foreach ($registerCertificates as $file)
                                @php
                                $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                                @endphp
                                <span class="text-secondary me-2" data-file="{{ asset('register_certificate/' . $file) }}" style="margin-bottom: 10px;">
                                    @if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif', 'bmp']))
                                    <a href="{{ asset('register_certificate/' . $file) }}" data-fancybox="gallery" data-caption="شهادة التسجيل">
                                        <img src="{{ asset('register_certificate/' . $file) }}" width="40px" height="40px" class="mb-2 border" alt="شهادة التسجيل" style="border: 2px solid #000; padding: 3px;">
                                    </a>
                                    @elseif (strtolower($fileExtension) == 'pdf')
                                    <a href="{{ asset('register_certificate/' . $file) }}" target="_blank" class="btn btn-info p-2 text-white" style="position: relative; top:0px;">
                                        <i class="fas fa-file-pdf" style="font-size: 24px;"></i>
                                    </a>
                                    @elseif (strtolower($fileExtension) == 'docx' || strtolower($fileExtension) == 'doc')
                                    <a href="{{ asset('register_certificate/' . $file) }}" target="_blank" class="btn btn-success p-2 text-white" style="position: relative; top:0px;">
                                        <i class="fas fa-file-word" style="font-size: 24px;"></i>
                                    </a>
                                    @endif
                                </span>
                                @endforeach
                            </div>

                            <div class="mt-4 col-lg-12">
                                <label for="commercial_certificate" class="form-label mt-1">شهادات التسجيل التجاري<span style="color: red;">*</span></label>
                                <input id="commercial_certificate" type="file" class="form-control @error('commercial_certificate') is-invalid @enderror" name="commercial_certificate[]" multiple>
                                @error('commercial_certificate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <br>
                                @php
                                $commercialCertificates = json_decode($profile->company->commercial_certificate, true) ?? [];
                                @endphp
                                @foreach ($commercialCertificates as $file)
                                @php
                                $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                                @endphp
                                <span class="text-secondary me-2" data-file="{{ asset('commercial_certificate/' . $file) }}" style="margin-bottom: 10px;">
                                    @if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif', 'bmp']))
                                    <a href="{{ asset('commercial_certificate/' . $file) }}" data-fancybox="gallery" data-caption="شهادة التسجيل">
                                        <img src="{{ asset('commercial_certificate/' . $file) }}" width="40px" height="40px" class="mb-2 border" alt="شهادة التسجيل" style="border: 2px solid #000; padding: 3px;">
                                    </a>
                                    @elseif (strtolower($fileExtension) == 'pdf')
                                    <a href="{{ asset('commercial_certificate/' . $file) }}" target="_blank" class="btn btn-info p-2 text-white" style="position: relative; top:0px;">
                                        <i class="fas fa-file-pdf" style="font-size: 24px;"></i>
                                    </a>
                                    @elseif (strtolower($fileExtension) == 'docx' || strtolower($fileExtension) == 'doc')
                                    <a href="{{ asset('commercial_certificate/' . $file) }}" target="_blank" class="btn btn-success p-2 text-white" style="position: relative; top:0px;">
                                        <i class="fas fa-file-word" style="font-size: 24px;"></i>
                                    </a>
                                    @endif
                                </span>
                                @endforeach
                            </div>

                            <div class="mt-4 col-lg-12">
                                <label for="licenses" class="form-label mt-2">التراخيص<span style="color: red;">*</span></label>
                                <input id="licenses" type="file" class="form-control @error('licenses') is-invalid @enderror" name="licenses[]" multiple>
                                @error('licenses')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <br>
                                @php
                                $licenses = json_decode($profile->company->licenses, true) ?? [];
                                @endphp
                                @foreach ($licenses as $file)
                                @php
                                $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                                @endphp
                                <span class="text-secondary me-2" data-file="{{ asset('licenses/' . $file) }}" style="margin-bottom: 10px;">
                                    @if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif', 'bmp']))
                                    <a href="{{ asset('licenses/' . $file) }}" data-fancybox="gallery" data-caption="شهادة التسجيل">
                                        <img src="{{ asset('licenses/' . $file) }}" width="40px" height="40px" class="mb-2 border" alt="شهادة التسجيل" style="border: 2px solid #000; padding: 3px;">
                                    </a>
                                    @elseif (strtolower($fileExtension) == 'pdf')
                                    <a href="{{ asset('licenses/' . $file) }}" target="_blank" class="btn btn-info p-2 text-white" style="position: relative; top:0px;">
                                        <i class="fas fa-file-pdf" style="font-size: 24px;"></i>
                                    </a>
                                    @elseif (strtolower($fileExtension) == 'docx' || strtolower($fileExtension) == 'doc')
                                    <a href="{{ asset('licenses/' . $file) }}" target="_blank" class="btn btn-success p-2 text-white" style="position: relative; top:0px;">
                                        <i class="fas fa-file-word" style="font-size: 24px;"></i>
                                    </a>
                                    @endif
                                </span>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-lg-6" style="direction: rtl;">
                            <div class="mb-3 mt-2 col-lg-12">
                                <label for="name" class="form-label">الاسم <span style="color: red;">*</span></label>
                                <input type="text" value="{{ $profile->name ?? '' }}" placeholder="الاسم" class="form-control @error('name') is-invalid @enderror" name="name" id="name">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3 mt-2 col-lg-12">
                                <label for="email" class="form-label">البريد الإلكتروني <span style="color: red;">*</span></label>
                                <input type="email" value="{{ $profile->email ?? '' }}" placeholder="البريد الإلكتروني" class="form-control @error('email') is-invalid @enderror" name="email" id="email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3 mt-2 col-lg-12">
                                <label for="phone" class="form-label">رقم الهاتف <span style="color: red;">*</span></label>
                                <input type="tel" dir="rtl" value="{{ $profile->company->phone ?? '' }}" placeholder="رقم الهاتف" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone">
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3 mt-2 col-lg-12">
                                <label for="registration_number" class="form-label">رقم تسجيل الشركة <span style="color: red;">*</span></label>
                                <input id="registration_number" dir="rtl" name="register_num" type="text" placeholder="رقم تسجيل الشركة" class="form-control @error('register_num') is-invalid @enderror" value="{{ $profile->company->register_num ?? '' }}" required autofocus>
                                @error('register_num')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3 mt-2 col-lg-12">
                                <label for="password" class="form-label">كلمة المرور <span style="color: red;">*</span></label>
                                <input type="password" value="" placeholder="كلمة المرور الجديدة" class="form-control @error('password') is-invalid @enderror" name="password" id="password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3 mt-2 col-lg-12">
                                <label for="password_confirmation" class="form-label">تأكيد كلمة المرور <span style="color: red;">*</span></label>
                                <input type="password" value="" placeholder="تأكيد كلمة المرور" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" id="password_confirmation">
                                @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                    </div>
                    <button type="submit" class="btn-sm btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@include('admin.js')
@endsection
