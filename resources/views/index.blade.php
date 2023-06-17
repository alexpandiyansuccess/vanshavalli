@extends('layouts.app')

@section('content')


<section class="bg1">
    <div class="container">

        <div class="row">

            <div class="col-lg-6">
                <h1 class="bg1-header mt-5">Tree Chart Maker</h1>
                <p class="bg1-paragraph">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>

            </div>

            <div class="col-lg-6">

                <img src="images/first_page.png" class="img-fluid mt-5">
            </div>

        </div>


    </div>
</section>

<section class="bg2">
    <div class="container">

        <div class="row">

            <div class="col-lg-6">
                <h1 class="bg2-header">Listing View</h1>

                <img src="images/page2-1.png" class="img-fluid mt-5 image-space">

            </div>

            <div class="col-lg-6">
                <h1 class="bg2-header">Gallery View</h1>

                <img src="images/page2-2.png" class="img-fluid mt-5 image-space">

            </div>

        </div>


    </div>
</section>

<section class="bg3">
    <div class="container footer-contact">

        <div class="row justify-content-center">

            <div class="col-lg-6 mt-5">
                <div class="card footer-card">
                    <div class="card-body">
                        <h5 class="card-title mt-3 mb-5 footer-form">Create Account</h5>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-row mb-2">
                                <div class="col">
                                    <input id="name" type="text" placeholder="Name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                            </div>

                            <div class="form-row mb-2">
                                <div class="col">
                                    <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                            </div>

                            <div class="form-row mb-2">
                                <div class="col">
                                    <input id="password" placeholder="Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                            </div>
                            <div class="form-row mb-2">
                                <div class="col">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>

                            </div>

                            <button type="submit" class="signup-btn">Sign Up</button>

                            <a href="{{ route('login') }}" class="login-btn mt-4 d-flex justify-content-center">Already Have an Account? Login.</a>
                        </form>
                       
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mt-5">
                <h1 class="footer-about">About Us</h1>
                <img class="contact-logo mt-3 mb-3" src="images/abt_us.png" alt="">
                <h1 class="footer-about-contact">Email : ******@gmail.com</h1>
                <h1 class="footer-about-contact">Contact : 9999999999</h1>
            </div>

        </div>


    </div>
</section>

@endsection