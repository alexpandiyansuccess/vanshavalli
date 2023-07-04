<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <!-- For IE -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- For Resposive Device -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- For Window Tab Color -->
    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#1d2b40">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css"
        integrity="sha512-ZnR2wlLbSbr8/c9AgLg3jQPAattCUImNsae6NHYnS9KrIwRdcY9DxFotXhNAKIKbAXlRnujIqUWoXXwqyFOeIQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#1d2b40">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#1d2b40">


    <!-- Basic Page Needs
        ================================================== -->
    <title>{{ucfirst(Auth::user()->name) }} - Vanshavali - Profile </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- icons
    ================================================== -->
    <link rel="stylesheet" href="{{ asset('newdesign/forum/assets/css/icons.css') }}">

    <!-- CSS 
    ================================================== -->
    <link rel="stylesheet" href="{{ asset('newdesign/forum/assets/css/uikit.css') }}">
    <link rel="stylesheet" href="{{ asset('newdesign/forum/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('newdesign/forum/assets/css/tailwind.css') }}">

    <style>
    @import url('https://fonts.googleapis.com/css2?family=Comic+Neue:wght@400;700&display=swap');

    * {

        font-family: 'Comic Neue', cursive;

    }
    </style>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Mouse+Memoirs&display=swap');

    .header-logo-text {
        font-family: 'Mouse Memoirs', sans-serif !important;
        font-size: 2rem;
    }
    </style>


    <script>
    // Get user geolocation details without asking for permission
    function getUserGeolocation() {
        if ("geolocation" in navigator) {
            navigator.geolocation.getCurrentPosition(
                position => {
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;

                    // Fetch the accurate city based on latitude and longitude using reverse geocoding
                    const geocodeAPI = `https://geocode.xyz/${latitude},${longitude}?json=1`;
                    fetch(geocodeAPI)
                        .then(response => response.json())
                        .then(data => {
                            const city = data.region;
                            console.log("City:", city);
                            console.log("Latitude:", latitude);
                            console.log("Longitude:", longitude);

                            console.log(city);
                            // Call the saveLocation function with the geolocation details
                            saveLocation(latitude, longitude, cityName);
                        })
                        .catch(error => {
                            console.error("Error fetching geolocation details:", error);
                        });
                },
                error => {
                    console.error("Error retrieving geolocation:", error);
                }
            );
        } else {
            console.error("Geolocation is not supported by this browser.");
        }
    }

    // Save user location, browser details, ISP provider, and fingerprint to Firebase database
    function saveLocation(latitude, longitude, cityName) {
        // Load and initialize the fingerprint library
        const fpPromise = import("https://openfpcdn.io/fingerprintjs/v3").then(
            FingerprintJS => FingerprintJS.load()
        );

        fpPromise
            .then(fp => fp.get())
            .then(result => {
                // This is the visitor identifier (browser fingerprint)
                const visitorId = result.visitorId;
                console.log(visitorId);

                // Get browser details
                const browserDetails = {
                    userAgent: navigator.userAgent,
                    language: navigator.language,
                    vendor: navigator.vendor,
                    fingerprint: visitorId
                };

                // Get ISP provider information
                const ipAPI = "https://ipapi.co/json/";
                axios
                    .get(ipAPI)
                    .then(response => {
                        const ispProvider = response.data.org;
                        console.log(ispProvider);

                        // Get current date and time
                        const currentDate = new Date().toLocaleDateString();
                        const currentTime = new Date().toLocaleTimeString();

                    })
                    .catch(error => {
                        console.error("Error fetching ISP provider information:", error);
                    });
            })
            .catch(error => {
                console.error("Error:", error);
            });
    }

    // Call the getUserGeolocation function
    getUserGeolocation();

    // Additional script for weather fetching
    function fetchWeather(cityName) {
        var apiKey = "bce6e2bc48a4404593b32107233006"; // Replace with your free weather API key

        var weatherContainer = document.getElementById("weather-container");
        weatherContainer.innerHTML = "";

        //   var weatherContainer2 = document.getElementById("weather-container2");
        //   weatherContainer2.innerHTML = "";

        var weatherUrl = `https://api.weatherapi.com/v1/current.json?key=${apiKey}&q=${cityName}`;

        fetch(weatherUrl)
            .then(response => response.json())
            .then(data => {
                var weather = data.current.condition.text;
                var temperature = data.current.temp_c;

                weatherContainer.innerHTML = `
			<b><i class="bi bi-globe-asia-australia"></i> ${cityName} | <i class="bi bi-thermometer-sun"></i> ${temperature}°C  </b>
		  `;

                //   weatherContainer2.innerHTML = `
                // 	<b><i class="bi bi-globe-asia-australia"></i> ${cityName} | <i class="bi bi-thermometer-sun"></i> ${temperature}°C</b>
                //   `;
            })
            .catch(error => {
                console.log("Error:", error);
                weatherContainer.innerHTML = "Failed to fetch weather information";
            });
    }

    function fetchCity(latitude, longitude) {
        var apiKey = "bce6e2bc48a4404593b32107233006"; // Replace with your free weather API key

        var cityUrl = `https://api.weatherapi.com/v1/current.json?key=${apiKey}&q=${latitude},${longitude}`;

        fetch(cityUrl)
            .then(response => response.json())
            .then(data => {
                var cityName = data.location.name;
                console.log(cityName);
                if (cityName) {
                    fetchWeather(cityName);
                } else {
                    alert("City information not available");
                }
            })
            .catch(error => {
                console.log("Error:", error);
                alert("Failed to fetch city information");
            });
    }

    function showPosition(position) {
        var latitudeElement = document.getElementById("latitude");
        var longitudeElement = document.getElementById("longitude");

        var latitude = position.coords.latitude;
        var longitude = position.coords.longitude;

        fetchCity(latitude, longitude);
    }

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        alert("Geolocation is not supported by this browser.");
    }
    </script>
</head>


<body>




    <div id="wrapper">

        <!-- Header -->
        <header>
            <div class="header_wrap">
                <div class="header_inner mcontainer">
                    <div class="left_side">

                        <span class="slide_menu" uk-toggle="target: #wrapper ; cls: is-collapse is-active">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                                <path d="M3 4h18v2H3V4zm0 7h12v2H3v-2zm0 7h18v2H3v-2z" fill="currentColor"></path>
                            </svg>
                        </span>

                        <div id="logo">
                            <a class="logo" href="javascript:void(0)">
                                <h2 class="header-logo-text">Vanshavali</h2>
                            </a>
                        </div>
                    </div>

                    <!-- search icon for mobile -->
                    <div class="header-search-icon" uk-toggle="target: #wrapper ; cls: show-searchbox"> </div>


                    <div class="right_side">

                        <div class="header_widgets">







                            <div id="weather-container" style="display: inline;"></div>
                            <a href="#">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQiwNq38SajDT2OFHZZTMwFa1FmicSLP56STzs2cJA&s"
                                    class="is_avatar" alt="">
                            </a>
                            <div uk-drop="mode: click;offset:5" class="header_dropdown profile_dropdown">

                                <a href="javascript:void(0)" class="user">
                                    <div class="user_avatar">
                                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQiwNq38SajDT2OFHZZTMwFa1FmicSLP56STzs2cJA&s"
                                            alt="">
                                    </div>
                                    <div class="user_name">
                                            <div> {{ Auth::user()->name }} </div>
                                            <span> {{Auth::user()->email  ?? $userProfile->email}} </span>
                                        </div>
                                </a>


                                <a href="#" id="night-mode" class="btn-night-mode">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" />
                                    </svg>
                                    Night mode
                                    <span class="btn-night-mode-switch">
                                        <span class="uk-switch-button"></span>
                                    </span>
                                </a>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                        </path>
                                    </svg>
                                    Log Out
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>


                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </header>

        <!-- sidebar -->
        <div class="sidebar">

            <div class="sidebar_inner" data-simplebar>

                <ul>
                    <li><a href="{{ route('dashboard') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                class="text-blue-600">
                                <path
                                    d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                            </svg>
                            <span> Profile </span> </a>
                    </li>

                    <li id="more-veiw"><a href=" {{ url('/forum') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                class="text-blue-500">
                                <path d="M2 5a2 2 0 012-2h7a2 2 0 012 2v4a2 2 0 01-2 2H9l-3 3v-3H4a2 2 0 01-2-2V5z" />
                                <path
                                    d="M15 7v2a4 4 0 01-4 4H9.828l-1.766 1.767c.28.149.599.233.938.233h2l3 3v-3h2a2 2 0 002-2V9a2 2 0 00-2-2h-1z" />
                            </svg>
                            <span> forum</span> </a>
                    </li>

                    <li><a href="{{  url('/create-chart') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                class="text-green-500">
                                <path
                                    d="M11 17a1 1 0 001.447.894l4-2A1 1 0 0017 15V9.236a1 1 0 00-1.447-.894l-4 2a1 1 0 00-.553.894V17zM15.211 6.276a1 1 0 000-1.788l-4.764-2.382a1 1 0 00-.894 0L4.789 4.488a1 1 0 000 1.788l4.764 2.382a1 1 0 00.894 0l4.764-2.382zM4.447 8.342A1 1 0 003 9.236V15a1 1 0 00.553.894l4 2A1 1 0 009 17v-5.764a1 1 0 00-.553-.894l-4-2z" />
                            </svg> <span> Create Family Tree </span></a>
                    </li>


                    <li id="more-veiw"><a href="{{ url('/familyTree') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                class="text-yellow-500">
                                <path fill-rule="evenodd"
                                    d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span> Manage Family Tree </span></a>
                    </li>
                </ul>





                <ul class="side_links" data-sub-title="Pages">


                    <li><a href="javascript:void(0)">
                            <ion-icon name="settings-outline" class="side-icon"></ion-icon> <span> Setting </span>
                        </a>
                        <ul>
                            <li><a href="{{ route('editprofile') }}">Profile Settings</a></li>
                            <li><a href="javascript:void(0)">Gendral Settings</a></li>
                        </ul>
                    </li>




                </ul>

                <ul class="side_links">


                    <div class="footer-links">
                        <a href="#">About</a>
                        <a href="#">Blog </a>
                        <a href="#">Contact Us </a>
                        <a href="#">Terms of service</a>
                    </div>
                </ul>

            </div>

            <!-- sidebar overly for mobile -->
            <div class="side_overly" uk-toggle="target: #wrapper ; cls: is-collapse is-active"></div>

        </div>

        <!-- Main Contents -->
        <div class="main_content">
            <div class="container" >
                     @if (session('success'))
                    <div class="alert alert-success" style="background-color: #155522 !important;
    padding: 10px;text-align: center;" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif

                <div>
                    <div class="lg:p-12 max-w-xl lg:my-0 my-12 mx-auto p-6 space-y-">

                        <form method="POST" action="{{ route('createNode') }}"
                            class="lg:p-10 p-6 space-y-3 relative bg-white shadow-xl rounded-md">
                            @csrf
                            <h1 class="lg:text-2xl text-xl font-semibold mb-6"> Create Family Name </h1>

                            <div>
                                <label class="mb-0"> Family Name </label>
                                <input id="node_name" type="text" name="node_name" value="{{ old('node_name') }}"
                                    placeholder="Type Family Name ..."
                                    class="bg-gray-100 h-12 mt-2 px-3 rounded-md w-full">

                                @error('node_name')
                                <span class="invalid-feedback" style="color: #ff5b5b;" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div>
                                <label for=""> Select Gender </label>
                                <div class="btn-group bootstrap-select shadow-none with-border">
                                    <select id="node_gender" name="node_gender"
                                        class="shadow-none selectpicker with-border" tabindex="-98">
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>

                                    </select>
                                </div>
                            </div>

                            <div>
                                <button type="submit"
                                    class="bg-blue-600 font-semibold p-2 mt-5 rounded-md text-center text-white w-full">
                                    Create Family Tree </button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>

    </div>










    <!-- For Night mode -->
    <script>
    (function(window, document, undefined) {
        'use strict';
        if (!('localStorage' in window)) return;
        var nightMode = localStorage.getItem('gmtNightMode');
        if (nightMode) {
            document.documentElement.className += ' night-mode';
        }
    })(window, document);

    (function(window, document, undefined) {

        'use strict';

        // Feature test
        if (!('localStorage' in window)) return;

        // Get our newly insert toggle
        var nightMode = document.querySelector('#night-mode');
        if (!nightMode) return;

        // When clicked, toggle night mode on or off
        nightMode.addEventListener('click', function(event) {
            event.preventDefault();
            document.documentElement.classList.toggle('dark');
            if (document.documentElement.classList.contains('dark')) {
                localStorage.setItem('gmtNightMode', true);
                return;
            }
            localStorage.removeItem('gmtNightMode');
        }, false);

    })(window, document);
    </script>

    <!-- Javascript
        ================================================== -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{ asset('newdesign/forum/assets/js/tippy.all.min.js') }}"></script>
    <script rel="stylesheet" src="{{ asset('newdesign/forum/assets/js/uikit.js') }}"></script>
    <script rel="stylesheet" src="{{ asset('newdesign/forum/assets/js/simplebar.js') }}"></script>
    <script rel="stylesheet" src="{{ asset('newdesign/forum/assets/js/custom.js') }}"></script>
    <script rel="stylesheet" src="{{ asset('newdesign/forum/assets/js/bootstrap-select.min.js') }}"></script>
    <script src="https://unpkg.com/ionicons@5.2.3/dist/ionicons.js"></script>

</body>




</html>