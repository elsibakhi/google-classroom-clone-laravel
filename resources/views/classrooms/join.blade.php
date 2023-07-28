<x-main-layout>
<div class="d-flex align-items-center justify-content-center vh100">


    <form  class="border p-5"  action={{route("classrooms.join.store",$classroom->id)}} method="post">
   @csrf
        <button type="submit" class="btn btn-primary">{{__("Join")}}</button>
    
    </form>

</div>


</x-main-layout>