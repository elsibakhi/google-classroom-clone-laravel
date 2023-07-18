{{-- @php
$class = $name == "error" ? "danger" : "success";
@endphp --}}

@props(['name']) <!--to determaine what it attributes that i dont need to be return by $attributes var-->

<div>
    <!-- Be present above all else. - Naval Ravikant -->
    @if(session()->has($name))
    <div  {{$attributes->class(["alert",{{--"anyclass"=>ture  (conditinal class the same as @class) --}}])->merge([
        "id"=>"defaultID"
    ])}}> <!--$attributes is reserved var in componenet that return all attributes that i pass to component when call it -->
        {{-- $attributes->class("alert") // i use this to merge alert class with class that i pass it to component (alert class is default one) --}}
        {{-- $attributes->merge() // is the same of class but used with other attributes (instead of class) --}}
    {{session($name)}}

    </div>    
    @endif
</div>