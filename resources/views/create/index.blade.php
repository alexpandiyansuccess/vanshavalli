@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/index.css') }}" rel="stylesheet">
@endsection

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
                                                    <email-id>{{ Auth::user()->email }}</Email-id></span></p>
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
                                        <h6 class="dropdown-header">Hello, Admin!</h6>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('dashboard') }}">
                                            <i class="icon-mid bi bi-chat-quote-fill me-2"></i>
                                            Foreroom
                                        </a>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ url('/create-chart') }}"><i
                                                class="icon-mid bi bi-option me-2"></i>
                                            Family Tree</a></li>

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
            @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif
                <div class="container mt-5">
                    <div id="panel1" class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="card custom-card">
                                <div class="card-header custom-header">{{ __('Create Chart') }}</div>

                                <div class="card-body custom-body">
                                    <form method="POST" action="{{ route('createNode') }}">
                                        @csrf

                                        <div class="form-group row mt-4">
                                            <label for="node_name" class="col-md-4 col-form-label text-md-right">Root
                                                Node : </label>

                                            <div class="col-md-6">
                                                <input id="node_name" type="text"
                                                    class="form-control @error('node_name') is-invalid @enderror custom-form"
                                                    name="node_name" value="{{ old('node_name') }}" required autofocus>

                                                @error('node_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            
                                        </div>

                                        <div class="form-group row mt-4">
                                            <label for="node_gender" class="col-md-4 col-form-label text-md-right">
                                                Select Gender : </label>

                                            <div class="col-md-6">
                                                <select class="form-control @error('node_gender') is-invalid @enderror custom-form"
                                                    name="node_gender"  required autofocus>
                                                    <option hidden>--Select Gender--</option>
                                                    <option value="male">Male</option>
                                                    <option value="felmale">Felmale</option>
                                                </select>
                                               
                                                @error('node_gender')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            
                                        </div>

                                        <div class="form-group row mb-0">

                                        <button class="btn btn-primary" type="submit">Log in</button>
                                            <!-- <div id="createButton" class="col-md-8 offset-md-4"></div> -->

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                

                </div>

                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Node</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <input type="hidden" id="campaign_image" value="">

                                <div class="form-group">

                                    <div class="row">
                                        <div class="col-sm-10">



                                            <div class="img-container">
                                                <img id="image123" src="{{ asset('images/def.jpeg') }}">
                                            </div>
                                            <p></p>



                                            <div class="row">
                                                <div class="col-md-9 docs-buttons">

                                                    <div class="btn-group">

                                                        <label class="btn btn-primary btn-upload" for="inputImage"
                                                            title="Upload image file">
                                                            <input type="file" class="sr-only" id="inputImage"
                                                                name="file" accept="image/*">
                                                            <span class="docs-tooltip" data-toggle="tooltip"
                                                                title="Import image with Blob URLs">
                                                                <span class="fa fa-upload"></span>
                                                                Upload
                                                            </span>
                                                        </label>

                                                    </div>

                                                    <div class="btn-group btn-group-crop">

                                                        <button type="button" class="btn btn-primary"
                                                            data-method="getCroppedCanvas">
                                                            <span class="docs-tooltip" data-toggle="tooltip"
                                                                title="$().cropper(&quot;getCroppedCanvas&quot;)">
                                                                <span class="fa fa-picture-o"></span>

                                                                Save Image
                                                            </span>
                                                        </button>

                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>

                                <input id="nodeid" type="hidden" value="0">
                                <span id="errormodal"></span>
                                <form>
                                    <div class="form-group">
                                        <label for="rootname">Node Name</label>
                                        <input type="text" class="form-control" id="nodename">
                                    </div>
                                </form>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-ligh" data-dismiss="modal">Close</button>
                                <button id="savenodename" type="button" class="btn btn-primary">Save</button>
                                <button id="addparent" type="button" class="btn btn-primary">Add Parent</button>
                                <button id="addchild" type="button" class="btn btn-primary">Add Spouse</button>

                                <button id="addchild" type="button" class="btn btn-primary">Add Child</button>
                                <button id="deletenode" type="button" class="btn btn-danger">Delete</button>
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
    </script>
</body>

</html>