
@props(['classroom'])


{{-- to pass object or variable as statment to component i use :classroom="$classroom" --}}
<x-form.floating-control  id="name" name="name">
  <x-slot:label>
    <label for=name  class="form-label">{{ __('name') }}</label>
  </x-slot:label>
  <x-form.input  id="name" name="name" :classroom="$classroom??null"/>
</x-form.floating-control>

<x-form.floating-control  id="section" name="section">
  <x-slot:label>
    <label for=section  class="form-label">{{ __('section') }}</label>
  </x-slot:label>
  <x-form.input  id="section" name="section" :classroom="$classroom??null"/>

</x-form.floating-control>
<x-form.floating-control  id="subject" name="subject">
  <x-slot:label>
    <label for=subject  class="form-label">{{ __('subject') }}</label>
  </x-slot:label>
  <x-form.input  id="subject" name="subject" :classroom="$classroom??null"/>

</x-form.floating-control>
<x-form.floating-control  id="room" name="room">
  <x-slot:label>
    <label for=room  class="form-label">{{ __('room') }}</label>
  </x-slot:label>
  <x-form.input  id="room" name="room" :classroom="$classroom??null" />

</x-form.floating-control>
<x-form.floating-control  id="cover_image" name="cover_image">
  <x-slot:label>
    <label for=cover_image  class="form-label">{{ __('cover image') }}</label>
  </x-slot:label>
  <x-form.input type="file" id="cover_image" name="cover_image" :classroom="$classroom??null"  />

</x-form.floating-control>



  <button type="submit" class="btn btn-primary">{{$buttonLabel}}</button>
