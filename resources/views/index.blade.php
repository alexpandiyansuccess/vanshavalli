<!DOCTYPE html>
<html lang="en">
<head>

  <!-- Metas -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">


  <!-- Title  -->
  <title>Vanshavali - Family tree chart</title>

  <!-- Favicon -->
  <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">


  <!-- Plugins -->
  <link rel="stylesheet" href="{{ asset('css/custom/plugins.css') }}">

  <!-- Core Style Css -->
  <link rel="stylesheet" href="{{ asset('css/custom/style.css') }}">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Mouse+Memoirs&display=swap');

    .header-logo-text {
      font-family: 'Mouse Memoirs', sans-serif;
    }
  </style>





<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>


  <!-- ==================== Start Loading ==================== -->

  <div id="preloader">
  </div>

  <!-- ==================== End Loading ==================== -->

<!-- <div id="g_id_onload" data-client_id="296534124626-7lpa6e1b9jqdgcr0h7pbej1u1032tm65.apps.googleusercontent.com"
    data-login_uri="" data-callback="handleCredentialResponse" data-context="use">
</div> -->


  <!-- ==================== Start progress-scroll-button ==================== -->

  <div class="progress-wrap cursor-pointer">
    <svg class="progress-circle svg-content" width="100%" height="100%" viewbox="-1 -1 102 102">
      <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"></path>
    </svg>
  </div>

  <!-- ==================== End progress-scroll-button ==================== -->



  <!-- ==================== Start cursor ==================== -->

  <div class="mouse-cursor cursor-outer"></div>
  <div class="mouse-cursor cursor-inner"></div>

  <!-- ==================== End cursor ==================== -->



  <!-- ==================== Start Navbar ==================== -->

  <nav class="navbar navbar-expand-lg">
    <div class="container">

      <!-- Logo -->
      <a class="logo" href="#">
        <h3 class="header-logo-text">Vanshavali</h3>
      </a>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="icon-bar"><i class="fas fa-bars"></i></span>
      </button>

      <!-- navbar links -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          
          <li class="nav-item">
            <a class="nav-link" href="#">Home</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>

          @guest
          @if (Route::has('login'))
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">Login</a>
          </li>
          @endif
          @else
          <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">{{ Auth::user()->name }}</a>
          </li>
          @endguest
        </ul>
        
        <div class="search">
          <!-- <span class="icon pe-7s-user pe-4x pe-va cursor-pointer"></span> -->
          <!-- <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
              <div id="profile"></div>
                
                
            </li>
          </ul> -->
          <div id="profile"></div>
          <!-- <i class="fa fa-user-circle fa-2x"></i> -->
          
        </div>
      </div>
    </div>
  </nav>

  <!-- ==================== End Navbar ==================== -->



  <!-- ==================== Start Slider ==================== -->

  <header class="slider slider-prlx fixed-slider text-center">
    <div class="swiper-container parallax-slider">
      <div class="swiper-wrapper">
        <div class="swiper-slide">
          <div class="bg-img valign" data-background="https://images.unsplash.com/photo-1655185497013-db98aca061d3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" data-overlay-dark="6">
            <div class="container">
              <div class="row justify-content-center">
                <div class="col-lg-7 col-md-9">
                  <div class="caption center">
                    <h1 data-splitting="" class="header-logo-text">Find your <br> roots. </h1>
                    <p>Discover the past and inspire the present. 
                      Trace your ancestral roots, collaborate with family menbers, and find your story.
                      </p>
                    <a href="./oauth/index.html" class="btn-curve btn-lit mt-30">
                      <span>Learn More</span>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="swiper-slide">
          <div class="bg-img valign" data-background="https://images.unsplash.com/photo-1577897113292-3b95936e5206?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1090&q=80" data-overlay-dark="6">
            <div class="container">
              <div class="row justify-content-center">
                <div class="col-lg-7 col-md-9">
                  <div class="caption center">
                    <h1 data-splitting="" class="header-logo-text">Trace, Connect, <br>  Collaborate </h1>
                    <p>Unlock the mysteries of family ancestry.</p>
                    <a href="./oauth/index.html" class="btn-curve btn-lit mt-30">
                      <span>Learn More</span>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="swiper-slide">
          <div class="bg-img valign" data-background="https://images.unsplash.com/photo-1611516818236-8faa056fb659?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" data-overlay-dark="6">
            <div class="container">
              <div class="row justify-content-center">
                <div class="col-lg-7 col-md-9">
                  <div class="caption center">
                    <h1 data-splitting="" class="header-logo-text">Experience safe collaborative networks
                      <br> Safely Converge your data </h1>
                    <p>

                      Connect with ease. </p>
                    <a href="./oauth/index.html" class="btn-curve btn-lit mt-30">
                      <span>Learn More</span>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- slider setting -->
      <div class="setone setwo">
        <div class="swiper-button-next swiper-nav-ctrl next-ctrl cursor-pointer">
          <i class="fas fa-chevron-right"></i>
        </div>
        <div class="swiper-button-prev swiper-nav-ctrl prev-ctrl cursor-pointer">
          <i class="fas fa-chevron-left"></i>
        </div>
      </div>
      <div class="swiper-pagination top botm custom-font"></div>

      <div class="social-icon">
        <a href="#0"><i class="fab fa-facebook-f"></i></a>
        <a href="#0"><i class="fab fa-twitter"></i></a>
        <a href="#0"><i class="fab fa-instagram"></i></a>
        <a href="#0"><i class="fab fa-whatsapp"></i></a>
      </div>
    </div>
  </header>

  <!-- ==================== End Slider ==================== -->










  <!-- jQuery -->
  <script src="{{ asset('js/customjs/jquery-3.0.0.min.js') }}"></script>


  <!-- plugins -->
  <script src="{{ asset('js/customjs/plugins.js') }}"></script>

  <!-- customjs scripts -->
  <script src="{{ asset('js/customjs/scripts.js') }}"></script>

</body>

</html>
