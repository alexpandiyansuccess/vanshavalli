@extends('layouts.app')

@section('styles')
<link href="{{ asset('css/index.css') }}" rel="stylesheet">

<link href="{{ asset('css/custom.css') }}" rel="stylesheet">

<link type="text/css" rel="stylesheet" href="{{ asset('css/bcPicker.css') }}" />
<script src="{{ asset('js/familyTree/FamilyTree.js') }}"></script> 
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

                </ul>
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link navbtn2" href="{{ url('/') }}"><img src="{{asset('images/Vector.png')}}" alt="">&emsp;Home <span class="sr-only"></a>
                    </li>


                </ul>


            </div>
        </nav>

        <div class="alert alert-success" style="margin-bottom:0px !important" role="alert">
                       <b>Note : </b> If anything went wrong, please delete and create a new!
        </div>

        <input value="{{request()->segment(2)}}" id="user_id" hidden> 
    
<div id="tree"></div>


@endsection


@section('scripts')


<script>
  
  var response = {!! json_encode($jsonData) !!};
    var data = response;
  let family = new FamilyTree(document.getElementById("tree"), { 
    nodeBinding: {
      field_0: "name",
      img_0: "image",
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
    var getUserId = document.getElementById('user_id').value;
    fetch('/onUpdateNodeDataInvite', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken,
        'user_id':getUserId
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
<style>
    svg.tommy .node.male>rect {
      fill: #039be5;
    }  
      svg.tommy .node.female>rect {
      fill: #FF46A3;
    } 
</style>

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
