@props(['classroom','id','name'])
@php
    $classroom=$classroom??null;
@endphp

    <input  {{$attributes->class(['form-control', 'is-invalid' => $errors->has($name)])->merge(["type"=>"text"])}} id={{$id}} name={{$name}}   value="{{old($name,$classroom?->$name)}}" aria-describedby="emailHelp">
