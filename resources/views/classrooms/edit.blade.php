<x-main-layout title="{{ __('Edit Classroom') }}">




<div class="container my-5">
    <form class="w-50" action={{route("classrooms.update",$classroom->id)}} method="POST" enctype="multipart/form-data"  >
      @method("PUT")
   @csrf

   {{-- Form method sppofing --}}
   {{--   -1- <input type="hidden" name="_method" vlaue="put">
   {{ -2-  method_field("put")}} --}}
   {{-- -3- --}}

        <h1>{{ __('Edit Classroom') }}</h1>
        <hr>




<x-classroom.form button-label="{{ __('Update Classroom') }}" :classroom="$classroom" />

      </form>

</div>




</x-main-layout>

