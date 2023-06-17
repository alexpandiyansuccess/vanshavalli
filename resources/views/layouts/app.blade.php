<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
     <script type="text/javascript">
     (function(window) {
        if (window.location !== window.top.location) {
          window.top.location = window.location;
        }
      })(this);
    </script>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <script type="text/javascript">
        window.APP_URL = "{{ url('/') }}";
        window.AUTH_CHECK = "{{ Auth::check() }}";
        window.colorConfig = JSON.parse('{!! json_encode(config('color')) !!}');
    </script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="{{ asset('css/googleapi.font.css') }}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/cropper.css') }}" rel="stylesheet">
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"> </script>
    @yield('styles')
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="{{ url('/') }}">Tree Chart Maker</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link navbtn" href="{{ url('/') }}"><img class="mt-1 mb-3" src="{{asset('images/Vector.png')}}" alt=""><br> Home <span class="sr-only"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navbtn" href="{{ url('/create-chart') }}"><img class="mt-2 mb-3" src="{{asset('images/nav1.png')}}" alt=""><br>Create Chart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navbtn" href="{{ url('/manage-chart') }}"><img class="mt-2 manage-link" src="{{asset('images/nav2.png')}}" alt=""><br>Manage Chart</a>
                    </li>
                </ul>
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link navbtn2" href="{{ url('/') }}"><img src="{{asset('images/Vector.png')}}" alt="">&emsp;Home <span class="sr-only"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navbtn2" href="{{ url('/create-chart') }}"><img src="{{asset('images/nav1.png')}}" alt="">&emsp;Create Chart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navbtn2" href="{{ url('/manage-chart') }}"><img src="{{asset('images/nav2.png')}}" alt="">&emsp;Manage Chart</a>
                    </li>
                </ul>

                <div class="form-inline my-2 my-lg-0">
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="custom-button-main btn-sm my-2 my-sm-0 mr-4" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="custom-button-main btn-sm my-2 my-sm-0 mr-5" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="auth-name dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                                             document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>


        <main>
            @yield('content')
        </main>
    </div>

    @yield('scripts')
    <script>
    $(".navbar-toggler-icon").on("click", function(event){
               $(".navbar-toggler-icon").addClass("spin")
               setTimeout(() => {
                    $(".navbar-toggler-icon").removeClass("spin")
                    
                }, 500);
        })
    </script>
</body>

</html>
