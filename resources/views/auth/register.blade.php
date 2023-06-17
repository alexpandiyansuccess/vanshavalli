<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">
    <link href="images/favicon.png" rel="icon" />
    <title>Vanshavali - Profile - Signup</title>


    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>
    </link>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>

    <!-- Web Fonts
========================= -->
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900'
        type='text/css'>

    <!-- Stylesheet
========================= -->
    <link rel="stylesheet" type="text/css"
        href="https://harnishdesign.net/demo/html/oxyy/vendor/bootstrap/css/bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/custom/stylesheet.css') }}" />
    <!-- Colors Css -->

    <style>
    @import url('https://fonts.googleapis.com/css2?family=Mouse+Memoirs&display=swap');

    .header-logo-text {
        font-family: 'Mouse Memoirs', sans-serif;
        color: #FFF;
    }
    </style>
</head>

<body>

    <!-- Preloader -->
    <div class="preloader preloader-dark">
        <div class="lds-ellipsis">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- Preloader End -->

    <div id="main-wrapper" class="oxyy-login-register">
        <div class="container-fluid px-0">
            <div class="row g-0 min-vh-100">
                <!-- Welcome Text
      ========================= -->
                <div class="col-md-4">
                    <div class="hero-wrap h-100">
                        <div class="hero-mask opacity-5 bg-dark"></div>
                        <div class="hero-bg hero-bg-scroll"
                            style="background-image:url('https://images.unsplash.com/photo-1602255680702-c47261041a97?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=688&q=80');">
                        </div>
                        <div class="hero-content mx-auto w-100 h-100">
                            <div class="container d-flex flex-column h-100">
                                <div class="row g-0">
                                    <div class="col-11 col-lg-9 mx-auto">
                                        <div class="logo mt-5 mb-5">
                                            <h3 class="header-logo-text">Vanshavali</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-0 mt-3">
                                    <div class="col-11 col-lg-9 mx-auto">
                                        <h1 class="text-9 text-white fw-300 mb-5"><span class="fw-500">Welcome</span>,
                                            Looks like you're new here!</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Welcome Text End -->

                <!-- Register Form
      ========================= -->
                <div class="col-md-8 d-flex flex-column align-items-center bg-dark">
                    <div class="container my-auto py-5">
                        @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                        @endif
                        <div class="row g-0">
                            <div class="col-11 col-md-8 col-lg-7 col-xl-6 mx-auto">
                                <p class="text-2 text-light">Already a member? <a class="fw-500"
                                        href="{{ route('login') }}">Login</a></p>
                                <h3 class="text-white mb-4">Register Your Account</h3>
                                <div class="d-flex align-items-center my-4">
                                    <hr class="col-1 bg-dark-4">
                                    <span class="mx-3 text-2 text-muted">OR</span>
                                    <hr class="flex-grow-1 bg-dark-4">
                                </div>
                                <form id="registration-form" action="{{ route('register') }}" class="form-dark"
                                    method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label text-light" for="name">Username</label>
                                        <input id="name" type="text" name="name"
                                            class="form-control @error('name') is-invalid @enderror" id="fullName"
                                            required placeholder="Enter Your username">
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label text-light" for="email">Email Address</label>
                                        <input type="email" name="email"
                                            class="form-control @error('email') is-invalid @enderror" id="email"
                                            required placeholder="Enter Your Email">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label text-light" for="password">Password</label>
                                        <input type="password" id="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required placeholder="Enter Password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label text-light" for="password-confirm">Confirm Password</label>
                                        <input type="password" id="password-confirm"
                                            class="form-control" name="password_confirmation"
                                            required placeholder="Enter Confirm Password">
                                    </div>

                                    <div class="form-check text-light my-4">
                                        <input id="agree" name="agree" class="form-check-input" type="checkbox">
                                        <label class="form-check-label" for="agree">I agree to the <a href="#">Terms</a>
                                            and <a href="#">Privacy Policy</a>.</label>
                                    </div>
                                    <button class="btn btn-primary shadow-none my-2" type="submit">Register</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Register Form End -->
            </div>
        </div>
    </div>
    <!-- Script -->
    <script src="https://harnishdesign.net/demo/html/oxyy/vendor/jquery/jquery.min.js"></script>
    <!-- Style Switcher -->
    <script src="https://harnishdesign.net/demo/html/oxyy/js/theme.js"></script>
</body>

</html>