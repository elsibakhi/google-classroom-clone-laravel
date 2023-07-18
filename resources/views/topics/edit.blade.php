<x-main-layout title="Edit Topic"> 





  
<div class="container my-5">
    <form class="w-50" action={{route("topics.update",$topic->id)}} method="POST">
      @method("PUT") 
   @csrf

   {{-- Form method sppofing --}}
   {{--   -1- <input type="hidden" name="_method" vlaue="put">
   {{ -2-  method_field("put")}} --}}
   {{-- -3- --}}
  <x-alert name="success" id="alert-suc" class="alert-success" />

        <h1>Update topic</h1>
        <hr>
        <div class="my-3">
          <label for="name" class="form-label">Name</label>
          <input type="text" @class(["form-control","is-invalid" => $errors->has("name")]) id="name" name="name" value="{{old("name",$topic->name)}}" aria-describedby="emailHelp">
         @error('name')
         <div class="invalid-feedback">{{$message}}</div>
             
         @enderror
        </div>
      

        <button type="submit" class="btn btn-primary">Submit</button>
      </form>

</div>




</x-main-layout>







