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
        font-family: 'Times New Roman';
    }

</style>

<body>
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem;">
                        <form class="form-horizontal auth-form" method="POST" action="{{ url('register/company') }}">
                            @csrf
                            <div class="row g-0">
                                <div class="col-md-6 col-lg-6 d-flex align-items-center">
                                    <div class="card-body p-4 p-lg-5 text-black">
                                        <div class="d-flex align-items-center mb-3 pb-1">
                                            <span class="h1 fw-bold mb-0" style="position: relative; right: 16px;">Company Registration</span>
                                        </div>
                                        <div class="form-outline mb-4">
                                            <label for="name">Full Company Name</label>
                                            <input id="name" placeholder="Full Company Name" type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="registration_number">Company Registration Number</label>
                                            <input id="registration_number" name="register_num" type="text" placeholder="Company Registration Number" class="form-control form-control-lg @error('register_num') is-invalid @enderror" value="{{ old('register_num') }}" required autofocus>
                                            @error('register_num')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="form-outline mb-4">
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

                                        <div class="form-outline mb-4">
                                            <label for="email">Email Address</label>
                                            <input id="email" type="email" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="Email Address" value="{{ old('email') }}" required autofocus>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label for="email">Password</label>
                                            <input id="password" type="password" placeholder="Password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-outline mb-4">
                                            <label for="email">Confirm Password</label>
                                            <input id="password-confirm" placeholder="Confirm Password" type="password" class="form-control form-control-lg" name="password_confirmation" required autocomplete="new-password">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="card-body p-4 p-lg-5 text-black">
                                        <div class="d-flex align-items-center mb-3 pb-1">
                                            <span class="h1 fw-bold mb-0" style="position: relative; right: 16px;">Account
                                                Verification</span>
                                        </div>
                                        <div class="form-outline mb-4">
                                            <label for="company_certificate">Company Registration Certificate</label>
                                            <div>
                                                <input id="company_certificate" type="file" class="d-none @error('register_certificate') is-invalid @enderror" name="register_certificate" value="{{ old('register_certificate') }}" required>
                                                <label for="company_certificate" class="btn btn-success btn-md">
                                                    <i class="fas fa-plus"></i> Upload
                                                </label>
                                                <span id="file-name" class="text-muted ml-2"></span>
                                            </div>
                                            @error('register_certificate')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-outline mb-4">
                                            <label for="commercial_certificate">Commercial Registration Certificate</label>
                                            <div>
                                                <input id="commercial_certificate" type="file" class="mt-2d-none  @error('commercial_certificate') is-invalid @enderror" name="commercial_certificate" value="{{ old('commercial_certificate') }}" required>
                                                <label for="commercial_certificate" class="btn btn-success btn-md">
                                                    <i class="fa fa-plus"></i> Upload
                                                </label>
                                            </div>
                                            @error('commercial_certificate')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-outline mb-4">
                                            <label for="licenses">Any other licence to bussiness type</label>
                                            <div>
                                                <input id="licenses" type="file" class="mt-1 d-none @error('licenses') is-invalid @enderror" name="licenses" value="{{ old('licenses') }}" required>
                                                <label for="licenses" class="btn btn-success btn-md">
                                                    <i class="fas fa-plus"></i> Upload
                                                </label>
                                            </div>
                                            @error('licenses')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-outline mb-4">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="termsCheckbox" required>
                                                <label class="form-check-label" for="termsCheckbox">
                                                    I agree with
                                                    <a href="/terms" target="_blank" class="text-primary">Terms of
                                                        Condition</a>
                                                    and
                                                    <a href="/privacy" target="_blank" class="text-primary">Privacy
                                                        Policy</a>.
                                                </label>
                                            </div>
                                            <div class="pt-1 mt-3">
                                                <button class="btn w-100" style="background-color: #CCF148; color:##178B7B;" type="submit">Submit</button>
                                            </div>
                                            <div class="d-flex flex-row justify-content-end">
                                                <a href="{{ route('login') }}" style="color: #393f81; text-decoration: none;">Login here</a>
                                            </div>
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
</body>
</html>
