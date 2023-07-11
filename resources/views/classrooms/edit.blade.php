@include('partials.header')

<div class="container my-5">
    <form class="w-50" action={{route("classrooms.update",$classroom->id)}} method="POST">
      @method("PUT") 
   @csrf

   {{-- Form method sppofing --}}
   {{--   -1- <input type="hidden" name="_method" vlaue="put">
   {{ -2-  method_field("put")}} --}}
   {{-- -3- --}}
  
        <h1>Create classroom</h1>
        <hr>
        <div class="my-3">
          <label for="name" class="form-label">Name</label>
          <input type="text" class="form-control" id="name" name="name" value="{{$classroom->name}}" aria-describedby="emailHelp">
         
        </div>
        <div class="my-3">
            <label for="section" class="form-label">section</label>
            <input type="text" class="form-control" id="section" name="section" value='{{$classroom->section}}' aria-describedby="emailHelp">
        
          </div>
          <div class="my-3">
            <label for="subject" class="form-label">subject</label>
            <input type="text" class="form-control" id="subject" name="subject" value='{{$classroom->subject}}' aria-describedby="emailHelp">
         
          </div>
          <div class="my-3">
            <label for="room" class="form-label">room</label>
            <input type="text" class="form-control" id="room" name="room" value='{{$classroom->room}}' aria-describedby="emailHelp">
           
          </div>
        <div class="mb-3">
          <label for="cover_image" class="form-label">Cover Img</label>
          <input type="file" class="form-control" id="cover_image" name="cover_image">
        </div>
       
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>

</div>



@include('partials.footer')