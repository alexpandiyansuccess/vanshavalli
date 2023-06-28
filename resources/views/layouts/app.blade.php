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
