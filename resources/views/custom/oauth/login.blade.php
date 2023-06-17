
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">
<link href="{{ asset('favicon.ico') }}" rel="icon" />
<title>Vanshavali - Profile - Login</title>
<meta name="description" content="Login and Register Form Html Template">
<meta name="author" content="harnishdesign.net">

<!-- Web Fonts
========================= -->
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900' type='text/css'>

<!-- Stylesheet
========================= -->
<link rel="stylesheet" type="text/css" href="{{ asset('css/custom/profile/css/bootstrap.css') }}" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="stylesheet" type="text/css" href="{{ asset('css/custom/stylesheet.css') }}" />
<!-- Colors Css -->
<link id="color-switcher" type="text/css" rel="stylesheet" href="#" />


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
        <div class="hero-wrap d-flex align-items-center h-100">
          <div class="hero-mask opacity-5 bg-dark"></div>
          <div class="hero-bg hero-bg-scroll" style="background-image:url('https://images.unsplash.com/photo-1611024847487-e26177381a3f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80');"></div>
          <div class="hero-content mx-auto w-100 h-100">
            <div class="container d-flex flex-column h-100">
              <div class="row g-0">
                <div class="col-11 col-lg-9 mx-auto">
                  <div class="logo mt-5 mb-5"> <h3 class="header-logo-text">Vanshavali</h3> </div>
                </div>
              </div>
              <div class="row g-0 mt-3">
                <div class="col-11 col-lg-9 mx-auto">
                  <h1 class="text-9 text-white fw-300 mb-5"><span class="fw-500">Welcome</span>, We are glad to see you again!</h1>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Welcome Text End --> 
      
      <!-- Login Form
      ========================= -->
      <div class="col-md-8 d-flex flex-column align-items-center bg-dark">
        <div class="container my-auto py-5">
          <div class="row g-0">
            <div class="col-11 col-md-8 col-lg-7 col-xl-6 mx-auto">
              <p class="text-2 text-light">Not a member? <a class="fw-500" href="{{ route('register') }}">Register</a></p>
              <h3 class="text-white mb-4">Log In to Your Account</h3>
              <!-- <div class="d-flex">
                <button type="button" class="btn btn-primary btn-sm fw-400 rounded-3 shadow-none"><span class="me-2"><i class="fa fa-google"></i></span><span class="mx-3">Log in with Google</span></button>
                <ul class="social-icons d-inline-block social-icons-rounded">
                  <li class="social-icons-apple mb-0"><a class="bg-dark-4" href="#" data-bs-toggle="tooltip" data-bs-original-title="Sign in with apple"><i class="fa fa-facebook"></i></a></li>
                </ul>
              </div> -->
              <div class="d-flex align-items-center my-4">
                <hr class="col-1 bg-dark-4">
                <span class="mx-3 text-2 text-muted">OR</span>
                <hr class="flex-grow-1 bg-dark-4">
              </div>
              <form id="login-form" autocomplete="off" class="form-dark"  method="post">
                <div class="mb-3">
                  <label class="form-label text-light" for="emailAddress">Email Address</label>
                  <input type="email" autocomplete="nope" class="form-control" id="email" required placeholder="Enter Your Email">
                </div>
                <div class="mb-3">
                  <label class="form-label text-light" for="loginPassword">Password</label>
                  <a class="float-end text-2" href="./forgot-password.html">Forgot Password ?</a>
                  <input type="password" autocomplete="nope" class="form-control" id="password" required placeholder="Enter Password">
                </div>
                <button class="btn btn-primary my-2" type="submit">Log in</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- Login Form End --> 
    </div>
  </div>
</div>


<!-- <style>
  .swal-modal {
    background-color: rgba(0, 0, 0, 0.6);
  
}
.swal-text {
  color: #FFF;
}
</style> -->

<!-- Script --> 
<script src="https://harnishdesign.net/demo/html/oxyy/vendor/jquery/jquery.min.js"></script> 
<!-- Style Switcher --> 
<script src="https://harnishdesign.net/demo/html/oxyy/js/theme.js"></script>

</body>
</html>