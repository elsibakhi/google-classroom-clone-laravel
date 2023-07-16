@extends('layouts.master')



@section('content')

<div class="container my-5">
    <form class="w-50" action={{route("classrooms.update",$classroom->id)}} method="POST" enctype="multipart/form-data"  >
      @method("PUT") 
   @csrf

   {{-- Form method sppofing --}}
   {{--   -1- <input type="hidden" name="_method" vlaue="put">
   {{ -2-  method_field("put")}} --}}
   {{-- -3- --}}
  
        <h1>Edit classroom</h1>
        <hr>


      
        @include('partials.classroom_form',[
          "button_label"=>"Update Classroom"
        ])


      </form>

</div>



  

@endsection

