@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/index.css') }}" rel="stylesheet">

<link href="{{ asset('css/custom.css') }}" rel="stylesheet">

<link type="text/css" rel="stylesheet" href="{{ asset('css/bcPicker.css') }}" />
@endsection

@section('content')


<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #000000;">
            <a class="navbar-brand" href="{{ url('/') }}">Vanshavali</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link navbtn" href="{{ url('/dashboard') }}"><img class="mt-1 mb-3" src="{{asset('images/Vector.png')}}" alt=""><br> Home <span class="sr-only"></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navbtn" href="{{ url('/create-chart') }}"><img class="mt-2 mb-3" src="{{asset('images/nav1.png')}}" alt=""><br>Create Chart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navbtn" href="{{ url('/familyTree') }}"><img class="mt-2 manage-link" src="{{asset('images/nav2.png')}}" alt=""><br>Manage Chart</a>
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
                        <a class="nav-link navbtn2" href="{{ url('/familyTree') }}"><img src="{{asset('images/nav2.png')}}" alt="">&emsp;Manage Chart</a>
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
                <!-- <ul class="nav nav-pills d-flex justify-content-around active"  role="tablist" style="width:100%">
                    <li class="nav-item">
                        <a href="#user-1" class="nav-link active" data-toggle="tab">User 1</a>
                    </li>
                    <li class="nav-item">
                        <a href="#user-2" class="nav-link" data-toggle="tab">User 2</a>
                    </li> 
                </ul> -->
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
                <button id="addchild" type="button" class="btn btn-modal1">Add Spouse</button>
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
@endsection


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
