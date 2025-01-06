<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<style>
    span,
    label,
    p,
    a {
        font-family: 'Times New Roman';
    }

</style>
<body>
    <section class="vh-100" style="background-color: #214d45;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="{{ asset('MainLogo_Dark.png') }}" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem; border: none;     position: relative;width: 400px;top: 136px;left: 40px;" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">
                                    <form class="form-horizontal auth-form" method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="d-flex align-items-center mb-3 pb-1">
                                            {{-- <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i> --}}
                                            <span class="h1 fw-bold mb-0">Login</span>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form2Example17">Email address</label>
                                            <input id="email" type="email" placeholder="Email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form2Example27">Password</label>
                                            <input id="email" type="password" placeholder="Password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required autocomplete="password" autofocus>
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>

                                        <div class="pt-1 mb-2">
                                            <button class="btn w-100" style="background-color: #214d45; color:white;" type="submit">Login</button>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <a class="btn w-100 mt-2" href="{{ route('register') }}" style="background-color: #214d45; color: white;">
                                                        <i class="fa fa-user-plus"></i> Company Register
                                                    </a>
                                                </div>
                                                <div class="col-lg-6">
                                                    <a class="btn w-100 mt-2" href="{{ route('investor.register') }}" style="background-color: #b3dd0d; color: white;">
                                                        <i class="fa fa-user-plus"></i> Investor Register
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row justify-content-between">
                                            <a href="{{ route('password.request') }}" style="color: #393f81; text-decoration: none;">Forgot password?</a>
                                            {{-- <a href="{{ route('register') }}" style="color: #393f81; text-decoration: none;;">Register here</a> --}}
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>
</html>
