@props(['id','name'])
@php
    $feedbackname = str_replace("[",".",$name);
    $feedbackname = str_replace("]","",$feedbackname);
 
@endphp
<div class="my-3">
  
    {{ $label }}
  {{ $slot }}
    <x-feedback-error name={{$feedbackname}} />
  </div>