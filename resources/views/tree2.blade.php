<ul>
   <li>
      <a id="{{ $root->id }}" class="root node"  href="" class="node" href="" data-toggle="tooltip" data-placement="top" title="{{$root->secondProfile ? $root->secondProfile->designation : 'No Second Profile'}}">
		<input type="hidden" name="designation_second" id="designation_second" class="designation_second" value="{{$root->secondProfile ? $root->secondProfile->designation : ""}}">
		<div class="child_images">
			<img class="tree-image {{ $root->color_code }}-border" id="image_1"  src="{{ $root->picture ? asset('profile_images/'.$root->picture) : asset('images/def.jpeg') }}" width="70" >
		<!-- @if($root->secondProfile)
		<img class="tree-img {{ $root->color_code }}-border"  id="image_2" style="left: 85px"  src="{{ $root->secondProfile->picture ?  asset('profile_images/'.$root->secondProfile->picture): asset('images/def.jpeg') }}" width="70" >
	    @endif -->
		</div>
	    <br>
		<div class="position">{{ $root->designation }}</div>
     	 <span class="nodetext {{ $root->color_code }}-background">{{ $root->profile_name }}</span>
		</a>
        @include('child', ['parent' => $root] )
    </li>
 </ul>
