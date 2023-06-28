@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/index.css') }}" rel="stylesheet">

<link href="{{ asset('css/custom.css') }}" rel="stylesheet">

<link type="text/css" rel="stylesheet" href="{{ asset('css/bcPicker.css') }}" />
<script src="https://balkan.app/js/FamilyTree.js"></script> 
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

@if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif

     
                
    
<div id="tree"></div>


@endsection


@section('scripts')


<script>
  
  var response = {!! json_encode($jsonData) !!};
    var data = response;
  let family = new FamilyTree(document.getElementById("tree"), { 
    nodeBinding: {
      field_0: "name"
    },
    nodeMouseClick: FamilyTree.action.edit,
     nodeMenu: {
        details: {text:"Details"},
        edit: {text:"Edit"}
     },
    nodeTreeMenu: true,
  });

    family.on('click', function(sender, args){
        sender.editUI.show(args.node.id, false); 
        return false; 
    });


  family.onUpdateNode((args) => {
    var csrfToken = '{{ csrf_token() }}';
    fetch('/onUpdateNodeData', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken
      },
      body: JSON.stringify(args)
    })
    .then(response => response.json())
    .then(data => console.log(data))
    .catch(error => console.error(error));
  //return false; to cancel the operation

  });


  family.load(data)
</script>


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
