<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Dashboard - Vanshavali</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/gh/iamraghavan/Vanshavali@main/css/ishulove.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/custom/profile/css/bootstrap.css') }}">

    <link rel="stylesheet" href="{{ asset('css/custom/profile/vendors/iconly/bold.css') }}">

    <link rel="stylesheet" href="{{ asset('css/custom/profile/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom/profile/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom/profile/css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <!-- <script src="jquery.js"></script>  -->

</head>
<style>
@import url('https://fonts.googleapis.com/css2?family=Mouse+Memoirs&display=swap');

.header-logo-text {
    font-family: 'Mouse Memoirs', sans-serif;
    color: #FFF;
}
</style>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <h3 class="header-logo-text">Vanshavali</h3>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>


                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item  ">
                            <a href="{{ route('dashboard') }}" class='sidebar-link'>
                                <i class="bi bi-person-circle"></i>
                                <span>Profile</span>
                            </a>
                        </li>
                        <li class="sidebar-item  ">
                            <a href="{{ route('dashboard') }}" class='sidebar-link'>
                                <i class="bi bi-chat-quote-fill"></i>
                                <span>Foreroom</span>
                            </a>
                        </li>
                        <li class="sidebar-item  ">
                            <a href="{{ url('/create-chart') }}" class='sidebar-link'>
                                <i class="bi bi-option"></i>
                                <span>Family Tree</span>
                            </a>
                        </li>
                        <li class="sidebar-item  ">
                            <a href="{{ url('/familyTree') }}" class='sidebar-link'>
                                <i class="bi bi-option"></i>
                                <span> Manage Chart</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main" class='layout-navbar'>
            <header class='mb-3'>
                <nav class="navbar navbar-expand navbar-light ">
                    <div class="container-fluid">
                        <a href="#" class="burger-btn d-block">
                            <i class="bi bi-justify fs-3"></i>
                        </a>

                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                                <li class="nav-item dropdown me-3">
                                    <a class="nav-link active dropdown-toggle" href="#" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class='bi bi-bell bi-sub fs-4 text-gray-600'></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                        <li>
                                            <h6 class="dropdown-header">Notifications</h6>
                                        </li>
                                        <li><a class="dropdown-item">No notification available</a></li>
                                    </ul>
                                </li>
                            </ul>
                            <div class="dropdown">
                                <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="user-menu d-flex">
                                        <div class="user-name text-end me-3">
                                            <h6 class="mb-0 text-gray-600">Hello, {{ Auth::user()->name }}</h6>
                                            <p class="mb-0 text-sm text-gray-600"><span id="user" class="message">
                                                    <email-id>{{ Auth::user()->email }}</Email-id>
                                                </span></p>
                                        </div>
                                        <div class="user-img d-flex align-items-center">
                                            <div class="avatar avatar-md">
                                                <img src="https://kurudhi.netlify.app/admin/images/man.png">
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <h6 class="dropdown-header">Hello, {{ Auth::user()->name }}</h6>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('dashboard') }}">
                                            <i class="icon-mid bi bi-chat-quote-fill me-2"></i>
                                            Foreroom
                                        </a>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ url('/create-chart') }}"><i
                                                class="icon-mid bi bi-option me-2"></i>
                                            Family Tree</a></li>
                                    <li><a class="dropdown-item" href="{{ url('/familyTree') }}"><i
                                                class="icon-mid bi bi-option me-2"></i>
                                            Manage Chart</a></li>

                                    <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item"  href="{{ route('logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();"><i
                                                class="icon-mid bi bi-box-arrow-left me-2"></i> Logout</a>
                                            

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            
                        
                        </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
            </header>
            <div id="main-content">

                <div class="">
                    @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="collapse-tabs new-property-step">
                        <div class="tab-content shadow-none p-0">
                            <div class="container">
                                <div class="main-body">
                                    @if (!$userProfile)
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex flex-column align-items-center text-center">
                                                <img src="https://bootdey.com/img/Content/avatar/avatar7.png"
                                                    alt="Admin" class="rounded-circle" width="150">
                                                <div class="mt-3">
                                                    <h4>{{ Auth::user()->name }}</h4>
                                                    <p class="text-secondary mb-1">{{ Auth::user()->email }}</p>
                                                    <a class="btn btn-info " target="__blank"
                                                        href="{{ url('/addprofile') }}">
                                                        Add More details  <i class="bi bi-pencil"></i> </a>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                    @if ($userProfile)
                                    <div class="row gutters-sm">
                                        <div class="col-md-4 mb-3">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="d-flex flex-column align-items-center text-center">
                                                        <img src="https://bootdey.com/img/Content/avatar/avatar7.png"
                                                            alt="Admin" class="rounded-circle" width="150">
                                                        <div class="mt-3">
                                                            <h4>{{$userProfile->full_name}}</h4>
                                                            <p class="text-secondary mb-1">{{$userProfile->email}}</p>
                                                            <p class="text-muted font-size-sm">{{$userProfile->area}},{{$userProfile->state}},{{$userProfile->country}}
                                                                CA</p>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card mt-3">
                                                <ul class="list-group list-group-flush">
                                                @if ($userProfile->website_url)
                                                    <li
                                                        class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg"
                                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="feather feather-globe mr-2 icon-inline">
                                                                <circle cx="12" cy="12" r="10"></circle>
                                                                <line x1="2" y1="12" x2="22" y2="12"></line>
                                                                <path
                                                                    d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z">
                                                                </path>
                                                            </svg> Website</h6>
                                                        <span class="text-secondary">{{$userProfile->website_url}}</span>
                                                    </li>
                                                @endif
                                                @if ($userProfile->github_url)
                                                    <li
                                                        class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg"
                                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="feather feather-github mr-2 icon-inline">
                                                                <path
                                                                    d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22">
                                                                </path>
                                                            </svg> Github</h6>
                                                        <span class="text-secondary">{{$userProfile->github_url}}</span>
                                                    </li>
                                                @endif
                                                @if ($userProfile->twitter_username)
                                                    <li
                                                        class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg"
                                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="feather feather-twitter mr-2 icon-inline text-info">
                                                                <path
                                                                    d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z">
                                                                </path>
                                                            </svg> Twitter</h6>
                                                        <span class="text-secondary">{{$userProfile->twitter_username}}</span>
                                                    </li>
                                                @endif
                                                @if ($userProfile->instagram_username)
                                                    <li
                                                        class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg"
                                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="feather feather-instagram mr-2 icon-inline text-danger">
                                                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5">
                                                                </rect>
                                                                <path
                                                                    d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z">
                                                                </path>
                                                                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                                                            </svg> Instagram</h6>
                                                        <span class="text-secondary">{{$userProfile->instagram_username}}</span>
                                                    </li>
                                                    @endif
                                                    @if ($userProfile->facebook_username)
                                                    <li
                                                        class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                                        <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg"
                                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="feather feather-facebook mr-2 icon-inline text-primary">
                                                                <path
                                                                    d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z">
                                                                </path>
                                                            </svg> Facebook</h6>
                                                        <span class="text-secondary">{{$userProfile->facebook_username}}</span>
                                                    </li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card mb-3">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <h6 class="mb-0"> Name</h6>
                                                        </div>
                                                        <div class="col-sm-9 text-secondary">
                                                            {{$userProfile->full_name}}
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <h6 class="mb-0">Email</h6>
                                                        </div>
                                                        <div class="col-sm-9 text-secondary">
                                                            {{$userProfile->email}}
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <h6 class="mb-0">Phone</h6>
                                                        </div>
                                                        <div class="col-sm-9 text-secondary">
                                                            {{$userProfile->contact_number}}
                                                        </div>
                                                    </div>

                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <h6 class="mb-0">Address</h6>
                                                        </div>
                                                        <div class="col-sm-9 text-secondary">
                                                        {{$userProfile->door_number}}, {{$userProfile->street_name}}
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <h6 class="mb-0">State</h6>
                                                        </div>
                                                        <div class="col-sm-9 text-secondary">
                                                            {{$userProfile->state}}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <h6 class="mb-0">Area</h6>
                                                        </div>
                                                        <div class="col-sm-9 text-secondary">
                                                            {{$userProfile->area}}
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                            <h6 class="mb-0">Pincode</h6>
                                                        </div>
                                                        <div class="col-sm-9 text-secondary">
                                                            {{$userProfile->pincode}}
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <a class="btn btn-info " target="__blank"
                                                                href="{{ url('/editprofile') }}">
                                                                Edit your profile <i class="bi bi-pencil"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <footer>
                    <div class="footer clearfix mb-0 text-muted">
                        <div class="float-start">
                            <p> <span id="current-year"></span> &copy; Vanshavali</p>
                        </div>

                    </div>
                </footer>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/customjs/profilejs/js/main.js') }}"></script>
    <script src="{{ asset('js/customjs/profilejs/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/customjs/profilejs/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script>
    // Get the current year
    var currentYear = new Date().getFullYear();
    // Set the current year in the HTML element with the specified ID
    var currentYearElement = document.getElementById('current-year');
    currentYearElement.textContent = currentYear.toString();

    function DateSelectionChanged() {
        var today = new Date();

        var dob = new Date(document.getElementById('dob').value);
        var months = (today.getMonth() - dob.getMonth() + (12 * (today.getFullYear() - dob.getFullYear())));

        let findDate = Math.round(months / 12);
        let donorName = document.getElementById('age').value;
        console.log(donorName);

        if (findDate >= 18 && findDate < 55) {
            document.getElementById('age').value = (findDate);
        } else {
            alert('Age Restricted' + ' ' + `Sorry! ${donorName} you are not allowed to vanshavali`);

        }

    }
    </script>
</body>

</html>