@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/index.css') }}" rel="stylesheet">

<link href="{{ asset('css/custom.css') }}" rel="stylesheet">

<link type="text/css" rel="stylesheet" href="{{ asset('css/bcPicker.css') }}" />
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
                                    <li onclick="logout()"><a class="dropdown-item" href="#"><i
                                                class="icon-mid bi bi-box-arrow-left me-2"></i> Logout</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
            </header>
            <div id="main-content">

                <div class="">

                    <div class="collapse-tabs new-property-step">
                        <div class="tab-content shadow-none p-0">
                            <div class="page-content">

<div class="container">
    <div class="row justify-content-center" id="panel1">
        <div class="col-md-12">
            <div class="card manage-head-card">
                <div class="card-header manage-header-card">{{ __('Manage Chart') }}
                    <div class="delete_switch_div">
                        <div class="multi_delete_button mr-4"  >
                            <button class="delete-btn">Delete Selected</button>
                        </div>
                        <div class="mr-4">
                            <button class="select_all-btn">Select all</button>
                        </div>
                        <span class="switcher">
                            <i class="fa fa-list-alt"></i>
                      </span>
                    </div>
                </div>
                @csrf
                <div class=" card-body">
                    <div class = 'mycol'>
                        <div class="row">
                            @foreach ($profiles as $profile)
                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 mb-4 tree-col" data-id="{{ $profile->id }}">
                                <div class="manage-card card {{ $profile->color_code }}-background">
                                    <div class="card-body">
                                        <h5 class="card-title tree-name text-white mt-2 mb-4">{{ $profile->profile_name }}</h5>
                                        <div class="card-text">
                                            <div class="text-center card-buttons">
                                                 <div class="custom-button manage" data-id="{{ $profile->id }}" >
                                                    <a class="" data-id="{{ $profile->id }}" href="javascript:void(0)">
                                                        <span>Manage</span>
                                                        <br>
                                                        <span>Tree</span>
                                                    </a>
                                                </div>
                                                <div class="custom-button" data-id="{{ $profile->id }}">
                                                    <a class=""  href={{ 'org/export/' . $profile->id }}>
                                                        <span>Export</span>
                                                        <br>
                                                        <span>Tree</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="row text-center mt-4 delete_button">
                                                <div class="custom-button deletetree" data-id="{{ $profile->id }}">
                                                    <a data-id="{{ $profile->id }}" class="">
                                                        <span>Delete</span>
                                                        <br>
                                                        <span>Tree</span>
                                                    </a>
                                                </div>
                                                <i class="edit_icon" data-id="{{ $profile->id }}"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    </div>
                    <div class="mytable">
                    <table class="table test table-striped text-white table-responsive">
                        <tr>
                            <th>Root Name</th>
                            <th colspan="3">Status</th>
                        </tr>
                        @foreach ($profiles as $profile)
                        <tr class="mytable-row" data-id="{{ $profile->id }}">
                            <td>
                            <div class="table-color {{ $profile->color_code }}-background"></div>
                               <div  class="edit_icon_div">
                                <i class="edit_icon_table" data-id="{{ $profile->id }}"></i>
                                {{ $profile->profile_name }}
                               </div>
                            </td>
                            <td><a class="manage" data-id="{{ $profile->id }}" href="javascript:void(0)">Manage Tree</a>
                            </td>
                            <td><a href={{ 'org/export/' . $profile->id }}>Export</a>
                            </td>
                            <td><a class="deletetree" id="deletetree" data-id="{{ $profile->id }}" class="">Delete Tree</a></td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center">
                {!! $profiles->links() !!}
            </div>
        </div>
    </div>
    <div id="justToAttach"></div>
    <div class="row" id="panel2">
        <div class="col-md-12">
            <div class="card manage-head-card">
                <div class="card-header manage-header-card">Tree Chart</div>
                <div class="tree_card_body card-body">
                    <button class="btn btn-outline-dark" id="back">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        Back
                    </button>
                    <button class="btn btn-outline-dark" id="zoom">
                        <i class="fa fa-search-plus" aria-hidden="true"></i>
                        Zoom
                    </button>
                    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
                    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
                    <div class="tree mt-5">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="nodeModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content tab-content tab-pane show active">
            <div class="modal-header custom-header container">
                <ul class="nav nav-pills d-flex justify-content-around active"  role="tablist" style="width:100%">
                    <li class="nav-item">
                        <a href="#user-1" class="nav-link active" data-toggle="tab">User 1</a>
                    </li>
                    <li class="nav-item">
                        <a href="#user-2" class="nav-link" data-toggle="tab">User 2</a>
                    </li>
                </ul>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="modal-close mr-3" aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="tab-pane fade show active" id="user-1" role="tabpanel" aria-labelledby="pills-tab">
            <div class="modal-body custom-modal-body">
                <input type="hidden" id="campaign_image" value="">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12">
                            <p class="loading" style="position: absolute;
                            z-index: 100;
                            width: 100%;
                            text-align: center;">Loading...</p>
                            <div class="img-container" style="height: 230px;">
                                <img id="profile_image" style="visibility: hidden" class="profile_image" src="{{ asset('images/def.jpeg') }}">

                            </div>
                            <p></p>
                            <div class="row modal-color-space" >
                               <div class="upload_loading">
                                <h4>Please Wait..</h4>
                               </div>
                                <div class="uploads_button">
                                    <div class="btn-group">
                                        <label class="btn btn-modal2 btn-upload" for="inputImage" title="Upload image file">
                                            <input type="file" class="sr-only" id="inputImage" name="file" accept="image/*">
                                            <span class="docs-tooltip" data-toggle="tooltip" title="Import image with Blob URLs">
                                                <span class="fa fa-upload"></span>
                                                Upload
                                            </span>
                                        </label>
                                    </div>
                                    <div class="btn-group btn-group-crop">
                                        <button type="button" class="btn btn-modal2" id="save_image" data-id="1" data-method="getCroppedCanvas">
                                            <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;getCroppedCanvas&quot;)">
                                                <span class="fa fa-picture-o"></span>
                                                Save Image
                                            </span>
                                        </button>
                                    </div>
                                </div>
                                <div class="color-main">
                                    <div id="bcPicker1" class="form-control color-picker display-inline"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input id="nodeid" type="hidden" value="0">
                <span id="errormodal"></span>
                    <div class="form-group">
                        <label for="rootname">Title</label>
                        <input type="text" class="form-control" id="nodename">
                    </div>
                    <div class="form-group">
                        <label for="designation">Name</label>
                        <input type="text" class="form-control" id="designation">
                    </div>
                    <input type="hidden" value="#008000" id="color">
                </form>
                <!-- <div class="wrapper-button">
                  <button id="savenodename" type="button" class="btn btn-modal1">Save</button>
                </div> -->
            </div>
            <div class="modal-footer custom-body">
                <button type="button" class="btn btn-modal2" data-dismiss="modal">Close</button>
                <button id="savenodename" type="button" class="btn btn-modal1">Save</button>
                <button id="addparent" type="button" class="btn btn-modal1">Add Parent</button>
                <button id="addchild" type="button" class="btn btn-modal1">Add Child</button>
                <button id="deletenode" type="button" class="btn btn-modal2">Delete</button>
            </div>
            </div>
            <div class="tab-pane fade" id="user-2" role="tabpanel" aria-labelledby="pills-tab">
            <div class="modal-body custom-modal-body">
                <input type="hidden" id="campaign_image" value="">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12">
                            <p class="loading" style="position: absolute;
                            z-index: 100;
                            width: 100%;
                            text-align: center;">Loading...</p>
                            <div class="img-container" style="height: 230px;">
                                <img id="profile_image_1" style="visibility: hidden" class="profile_image" src="{{ asset('images/def.jpeg') }}">

                            </div>
                            <p></p>
                            <div class="row modal-color-space" >
                                <div>
                                    <div class="upload_loading">
                                        <h4>Please Wait..</h4>
                                       </div>
                                       {{-- <div class="uploads_button"> --}}
                                    <div class="uploads_button">
                                        <div class="btn-group">
                                            <label class="btn btn-modal2 btn-upload" for="inputImage_second_profile" title="Upload image file">
                                                <input type="file" class="sr-only" id="inputImage_second_profile" name="second_profile_image" accept="image/*">
                                                <span class="docs-tooltip" data-toggle="tooltip" title="Import image with Blob URLs">
                                                    <span class="fa fa-upload"></span>
                                                    Upload
                                                </span>
                                            </label>
                                        </div>
                                        <div class="btn-group btn-group-crop">
                                            <button type="button" class="btn btn-modal2" id="save_image_second_profile" data-id="2" data-method="getCroppedCanvas">
                                                <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;getCroppedCanvas&quot;)">
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
                </div>
                <input id="nodeid" type="hidden" value="0">
                <span id="errormodal"></span>
                <form>
                    <div class="form-group">
                        <label for="designation">Name</label>
                        <input type="text" class="form-control" id="designation2">
                    </div>
                    <input type="hidden" value="#008000" id="color">
                </form>
                <!-- <div class="wrapper-button">
                <button id="savenodename2" type="button" class="btn btn-modal1">Save</button>
                </div> -->
            </div>
            <div class="modal-footer custom-body">
                <button type="button" class="btn btn-modal2" data-dismiss="modal">Close</button>
                <button id="savenodename_second_profile" type="button" class="btn btn-modal1">Save</button>
                <button id="addchild_second_profile" type="button" class="btn btn-modal1">Add Child</button>
                <button id="deletenode_second_profile" type="button" class="btn btn-modal2">Delete</button>
            </div>
            </div>
            </div>
        </div>
    </div>
</div>
                                <div class="form-v10-content">
                                   
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

    <link rel="stylesheet" href="{{ asset('js/customjs/profilejs/js/main.js') }}">
    <link rel="stylesheet" href="{{ asset('js/customjs/profilejs/js/bootstrap.bundle.min.js') }}">
    <link rel="stylesheet" href="{{ asset('js/customjs/profilejs/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}">
    <script>
    // Get the current year
    var currentYear = new Date().getFullYear();
    // Set the current year in the HTML element with the specified ID
    var currentYearElement = document.getElementById('current-year');
    currentYearElement.textContent = currentYear.toString();
    </script>
</body>
</html>




@section('scripts')
<script>
let color = $("#color").val();
</script>

<script type="text/javascript" src="{{ asset('js/bcPicker.js') }}"></script>
<script>
    $('#bcPicker1').bcPicker();
    $('.bcPicker-palette').on('click', '.bcPicker-color', function() {
        var color = $(this).css('background-color');
        $(this).parent().parent().next().children().text(toHex(color));
        $(this).parent().parent().next().next().children().text(color);
        $('#color').val(toHex(color));
    })
</script>

@endsection
