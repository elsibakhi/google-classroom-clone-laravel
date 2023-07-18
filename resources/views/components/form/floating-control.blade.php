@props(['id','name'])

<div class="my-3">
  
    {{ $label }}
  {{ $slot }}
    <x-feedback-error name={{$name}} />
  </div>