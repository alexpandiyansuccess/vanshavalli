<ul>
		<li>
      <a id="{{  $root->id }}" class="root node"   href="">
      	@if(empty($root->picture))
	    <img class="tree-image {{ $root->color_code }}-border" style="left:18px;" src="{{ asset('images/def.jpeg') }}" width="70" >
	    @else
	    <img class="tree-image {{ $root->color_code }}-border" style="left:18px;" src="{{  $root->picture }}" width="70" >
	    @endif
			@if(empty($root->picture))
	    <img class="tree-img {{ $root->color_code }}-border" style="left: 85px;px;" src="{{ asset('images/def.jpeg') }}" width="70" >
	    @else
	    <img class="tree-img {{ $root->color_code }}-border" style="left: 85px;px;" src="{{ $root->picture }}" width="70" >
	    @endif
	    <br>
		<div class="position">{{ $root->designation }}</div>
      <span class="nodetext {{ $root->color_code }}-background">{{ $root->profile_name }}</span></a>
        @include('child', ['parent' => $root] )
				
				
    </li>
 </ul>
