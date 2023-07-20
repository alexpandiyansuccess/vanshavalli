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
    .pointer {cursor: pointer;}
    .pagination {
  display: flex;
  justify-content: center;
  align-items: center;
  list-style: none;
  padding: 0;
  margin-top: 20px;
}

.pagination li {
  margin-right: 5px;
}

.pagination li a,
.pagination li span {
  display: inline-block;
  padding: 5px 10px;
  text-decoration: none;
  border: 1px solid #ccc;
  color: #333;
  border-radius: 3px;
}

.pagination li.active span {
  background-color: #333;
  color: #fff;
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



                             @if(Auth::user()->remember_token)
                                <a href="#">
                                  <img src="{{ asset('user_images') }}/{{Auth::user()->remember_token}}" class="is_avatar" alt="">
                                 </a>
                                @endif
                                @if(!Auth::user()->remember_token)
                                <a href="#">
                                  <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQiwNq38SajDT2OFHZZTMwFa1FmicSLP56STzs2cJA&s" class="is_avatar" alt="">
                                 </a>
                                @endif
                            <div uk-drop="mode: click;offset:5" class="header_dropdown profile_dropdown">

                                <a href="javascript:void(0)" class="user">

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
            <div class="mcontainer">

                <div id="wrapper" class="is-collapse container">

                    <form method="POST" action="{{ route('create-forum') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card lg:mx-0 p-4">
                            <div class="flex space-x-3">
                                @if(Auth::user()->remember_token)
                                <a href="#">
                                  <img src="{{ asset('user_images') }}/{{Auth::user()->remember_token}}" class="w-10 h-10 rounded-full" alt="">
                                 </a>
                                @endif
                                @if(!Auth::user()->remember_token)
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQiwNq38SajDT2OFHZZTMwFa1FmicSLP56STzs2cJA&s"
                                class="w-10 h-10 rounded-full">
                                @endif
                                
                                <input id="post-input" name="description" placeholder="What's on your mind?"
                                    class="bg-gray-100 hover:bg-gray-200 flex-1 h-10 px-6 rounded-full">


                            </div>
                            <div class="grid grid-flow-col pt-3 -mx-1 -mb-1 font-semibold text-sm">
                                <label for="file">
                                    <input type="file" name="image" id="file" style="display: none"
                                        data-original-title="upload photos">
                                    <div id="photo-video"
                                        class="hover:bg-gray-100 flex items-center p-1.5 rounded-md cursor-pointer">
                                        <svg class="bg-blue-100 h-9 mr-2 p-1.5 rounded-full text-blue-600 w-9 -my-0.5 hidden lg:block"
                                            data-tippy-placement="top" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" data-tippy=""
                                            data-original-title="Tooltip">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        Photo/Video
                                    </div>
                            </div>
                            </label>
                            <button type="submit" style="float: right;">
                                submit
                                <ion-icon style="font-size: 30px;"
                                    class="hover:bg-gray-200 p-1.5 rounded-full md hydrated" role="img"
                                    aria-label="link outline"></ion-icon>
                            </button>

                        </div>



                    </form>





                </div>
                @if (session('success'))
                <div class="alert alert-success" style="background-color: #155522 !important;
    padding: 10px;text-align: center;" role="alert">
                    {{ session('success') }}
                </div>
                @endif

                <div class="card lg:mx-0 uk-animation-slide-bottom-small mt-11">
                    @foreach ($getAllForm as $getForm)


                    <div>
                        <!-- post header-->
                        <div class="flex justify-between items-center lg:p-4 p-2.5">
                            <div class="flex flex-1 items-center space-x-4">


                                @if(Auth::user()->remember_token)
                                <a href="#">
                                  <img src="{{ asset('user_images') }}/{{Auth::user()->remember_token}}" class="bg-gray-200 border border-white rounded-full w-10 h-10" alt="">
                                 </a>
                                @endif
                                @if(!Auth::user()->remember_token)
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQiwNq38SajDT2OFHZZTMwFa1FmicSLP56STzs2cJA&s"
                                class="bg-gray-200 border border-white rounded-full w-10 h-10">
                                @endif

                                <div class="flex-1 font-semibold capitalize">
                                    <a href="#" class="text-black dark:text-gray-100"> {{$getForm->user->name}} </a>
                                    <div class="text-gray-700 flex items-center space-x-2"><span>{{$getForm->posted_at}}<span> 
                                        <!-- <ion-icon name="people" role="img" class="md hydrated" aria-label="people">
                                        </ion-icon> -->
                                    </div>
                                </div>
                            </div>
                            <div>
                            @if($getForm->user_id == Auth::user()->id)

                                <a href="#" aria-expanded="false"> <i
                                        class="icon-feather-more-horizontal text-2xl hover:bg-gray-200 rounded-full p-2 transition -mr-1 dark:hover:bg-gray-700"></i>
                                </a>
                                <div class="bg-white w-56 shadow-md mx-auto p-2 mt-12 rounded-md text-gray-500 hidden text-base border border-gray-100 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700 uk-drop"
                                    uk-drop="mode: click;pos: bottom-right;animation: uk-animation-slide-bottom-small">

                                    <ul class="space-y-1">

                                        <!-- <li>
                                            <a href="#"
                                                class="flex items-center px-3 py-2 hover:bg-gray-200 hover:text-gray-800 rounded-md dark:hover:bg-gray-800">
                                                <i class="bi bi-pencil mr-1"></i> Edit Post
                                            </a>
                                        </li> -->


                                      
                                        <li>
                                            <a href="{{ route('delete-post',['id' => $getForm->id]) }}"
                                                class="flex items-center px-3 py-2 text-red-500 hover:bg-red-100 hover:text-red-500 rounded-md dark:hover:bg-red-600">
                                                <i class="bi bi-trash mr-1"></i> Delete
                                            </a>
                                        </li>
                                    </ul>

                                </div>
                                @endif
                            </div>
                        </div>


                        <div class="p-5 pt-0 border-b dark:border-gray-700">

                            @if($getForm->file_type == 'video')
                            <video controls style="width: -webkit-fill-available;">
                                <source src="{{ asset('post_images') }}/{{$getForm->image_link}}" type="video/mp4">
                                <source src="{{ asset('post_images') }}/{{$getForm->image_link}}" type="video/ogg">
                                Your browser does not support the video tag.
                            </video>
                            @endif

                            @if($getForm->image_link)


                            <img src="{{ asset('post_images') }}/{{$getForm->image_link}}" class="is_avatar" alt="">
                            @endif
                            <br>
                            {{$getForm->description}}

                        </div>


                        <div class="p-4 space-y-3 likeButton pointer" id="{{$getForm->id}}">
                          <input hidden id="like_hidden" value="{{$getForm->id}}">
                            <div class="flex space-x-4 lg:font-bold">
                                @if($getForm->user_liked)
                                <a   class="flex items-center space-x-2">
                                    <div class="p-2 rounded-full  text-black lg:bg-gray-100 dark:bg-gray-600 ">
                                        <svg class="{{$getForm->id}}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="yellow"
                                            width="22" height="22" class="dark:text-gray-100">
                                            <path
                                                d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div  > Like ({{$getForm->likes_by_user}})</div>
                                </a>
                                @endif
                                @if(!$getForm->user_liked)
                                <a   class="flex items-center space-x-2">
                                    <div class="p-2 rounded-full  text-black lg:bg-gray-100 dark:bg-gray-600 ">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                            width="22" height="22" class="dark:text-gray-100">
                                            <path
                                                d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div  > Like ({{$getForm->likes_by_user}})</div>
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                <hr>
                    @endforeach
                    {{ $getAllForm->links() }}
                    <br>
                </div>


            </div>
        </div>

    </div>










    <!-- For Night mode -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>

$('.likeButton').click(function() {
    debugger
        var getLikeHidden = $(this).attr('id');
        $.ajax({
            url: '/like/'+getLikeHidden, // Replace with the actual API endpoint URL
            method: 'GET', // Replace with the appropriate HTTP method
            success: function(response) {
                let getClass = "."+getLikeHidden
                $(getClass).attr('fill', 'yellow');
            },
            error: function(xhr, status, error) {
                // Handle the API call error
                console.log(xhr.responseText);
            }
        });
    });



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

    <script rel="stylesheet" src="{{ asset('newdesign/forum/assets/js/uikit.js') }}"></script>
    <script rel="stylesheet" src="{{ asset('newdesign/forum/assets/js/simplebar.js') }}"></script>
    <script rel="stylesheet" src="{{ asset('newdesign/forum/assets/js/custom.js') }}"></script>
    <script rel="stylesheet" src="{{ asset('newdesign/forum/assets/js/bootstrap-select.min.js') }}"></script>
    <script rel="stylesheet" src="{{ asset('newdesign/forum/assets/js/bootstrap-select.min.js') }}"></script>
    <script src="https://unpkg.com/ionicons@5.2.3/dist/ionicons.js"></script>

</body>

</html>