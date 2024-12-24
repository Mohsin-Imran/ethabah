<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<style>
    span,
    label,
    p,
    a {
        font-family: 'Times New Roman';
    }

    input::placeholder {
        font-size: 16px;
        /* font-family: 'Times New Roman'; */
    }

    .file-list {
        list-style-type: none;
        padding-left: 0;
    }

    .file-item {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .file-name {
        flex-grow: 1;
    }

    .delete-btn {
        margin-left: 10px;
        cursor: pointer;
        color: red;
    }

</style>

<body>
    <section class="" style="background-color: #214d45;">
        <div class="container py-3 h-100">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <form class="form-horizontal auth-form" method="POST" action="{{ route('company.register') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body p-4 p-lg-5 text-black">
                                <div class="text-center mb-3">
                                    <img src="{{ asset('MainLogo_Dark.png') }}" height="150px" width="150px" class="img-fluid" alt="">
                                    <br>
                                    <span class="h1 fw-bold mb-0" style="position: relative; right: 16px;">Company Registration</span>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 mb-4">
                                        <label for="name">Full Company Name</label>
                                        <input id="name" placeholder="Full Company Name" type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 mb-4">
                                        <label class="form-label" for="registration_number">Company Registration Number</label>
                                        <input id="registration_number" name="register_num" type="text" placeholder="Company Registration Number" class="form-control form-control-lg @error('register_num') is-invalid @enderror" value="{{ old('register_num') }}" required autofocus>
                                        @error('register_num')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col-lg-6 mb-4">
                                        <label for="phone">Phone Number</label>
                                        <div class="d-flex">
                                            <select id="country_code" name="country_code" class="form-control form-control-lg w-auto me-2" required>
                                                <option value="+966">+966</option>
                                                <option value="+972">+972</option>
                                                <option value="+971">+971</option>
                                                <option value="+973">+973</option>
                                            </select>
                                            <input id="phone" name="phone" type="text" placeholder="Enter Phone Number" class="form-control form-control-lg @error('phone') is-invalid @enderror" value="{{ old('phone') }}" required>
                                        </div>
                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col-lg-6 mb-4">
                                        <label for="email">Email Address</label>
                                        <input id="email" type="email" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="Email Address" value="{{ old('email') }}" required autofocus>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col-lg-6 mb-4">
                                        <label for="email">Password</label>
                                        <input id="password" type="password" placeholder="Password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 mb-4">
                                        <label for="email">Confirm Password</label>
                                        <input id="password-confirm" placeholder="Confirm Password" type="password" class="form-control form-control-lg" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                    <div class="col-lg-6 mb-4">
                                        <label for="register_certificate">Company Registration Certificates</label>
                                        <input id="register_certificate" type="file" class="form-control @error('register_certificate') is-invalid @enderror" name="register_certificate[]" multiple required>
                                        <ul id="register_preview" class="file-list mt-3"></ul>
                                    </div>

                                    <div class="col-lg-6 mb-4">
                                        <label for="commercial_certificate">Commercial Registration Certificates</label>
                                        <input id="commercial_certificate" type="file" class="form-control @error('commercial_certificate') is-invalid @enderror" name="commercial_certificate[]" multiple required>
                                        <ul id="commercial_preview" class="file-list mt-3"></ul>
                                    </div>

                                    <div class="col-lg-6 mb-4">
                                        <label for="licenses">Other Licenses</label>
                                        <input id="licenses" type="file" class="form-control @error('licenses') is-invalid @enderror" name="licenses[]" multiple required>
                                        <ul id="licenses_preview" class="file-list mt-3"></ul>
                                    </div>
                                    {{-- <div class="form-check mb-4">
                                        <input type="checkbox" class="form-check-input" id="termsCheckbox" required>
                                        <label class="form-check-label" for="termsCheckbox">
                                            I agree with <a href="/terms" target="_blank" class="text-primary">Terms of Condition</a> and <a href="/privacy" target="_blank" class="text-primary">Privacy Policy</a>.
                                        </label>
                                    </div> --}}

                                    <div class="col-lg-6 mt-4">
                                        <button class="btn w-100 btn-success" style="" type="submit">Submit</button>
                                        <div class="d-flex flex-row justify-content-between">
                                            <a href="{{ route('password.request') }}" style="color: #393f81; text-decoration: none;">Forgot password?</a>
                                            <a href="{{ route('login') }}" style="color: #393f81; text-decoration: none;;">Login here</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('admin.js')
</body>
</html>
