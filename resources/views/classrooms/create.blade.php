<x-main-layout title="Create Classroom"> 



<div class="container my-5">

{{-- way to show errors --}}

  {{-- @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
    <li>  {{$error}}  </li>
  @endforeach

    </ul>
 
    </div>
  @endif --}}

    <form class="w-50" action={{route("classrooms.store")}} method="POST" enctype="multipart/form-data" >
      
      {{-- // three ways to csrf token --}}
        {{-- 1- <input type="hidden" name="_token" value={{csrf_token()}}>
        {{ 2- csrf_field()}} --}}
        {{-- 3- --}}   @csrf
        <h1>Create classroom</h1>
        <hr>
       

<x-classroom.form button-label="Create Classroom"  />

      </form>

</div>
  

</x-main-layout>





