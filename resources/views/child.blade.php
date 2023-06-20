@if($parent->children->count())
<ul class="{{$parent->children->count() > 1 ? 'lines' : '' }}">
  @foreach($parent->children as $child)
  <li>
    <a id="{{ $child->id }}" class="node" href="" data-toggle="tooltip" data-placement="top" title="{{$child->secondProfile ? $child->secondProfile->designation : 'No Second Profile'}}">
    <input type="hidden" name="designation_second" id="designation_second" class="designation_second" value="{{$child->secondProfile ? $child->secondProfile->designation : ""}}">
    <div class="child_images">
    <img class="child-image {{ $child->color_code }}-border " id="image_1"  src="{{ $child->picture ? asset('profile_images/'.$child->picture) : asset('images/def.jpeg') }}" width="70" >
    <!-- @if ($child->secondProfile)
    <img class="child-image {{ $child->color_code }}-border " id="image_2" style="left: 85px; !important" src="{{ $child->secondProfile->picture ? asset('profile_images/'.$child->secondProfile->picture): asset('images/def.jpeg') }}" width="70" >
    @endif -->
    </div>
    <br>
    <div class="position">{{$child->designation}}</div>
    <span class="nodetext {{ $child->color_code }}-background">{{ $child->profile_name }}</span></a>
    @include('child',['parent' => $child])
  </li>       
  @endforeach
</ul>
@endif

