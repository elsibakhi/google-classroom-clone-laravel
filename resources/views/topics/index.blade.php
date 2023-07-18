<x-main-layout title="Topics"> 





<div class="container py-5">
    <h1>All topics</h1>
<hr>
@foreach ($topics as $topic)
<div class="card w-75 mb-3 mx-auto">
    <div class="card-body d-flex justify-content-between">

            <h5 class="card-title">{{$topic->name}}</h5>


<span>

    <a href={{route("topics.edit",$topic->id)}} class="btn btn-warning">Update</a>

    <form class="d-inline" action={{route("topics.destroy",$topic->id)}} method="post">
        @csrf
            @method("delete")
            
            <input type="submit" class="btn btn-danger" value="Delete" ></li>
        </form>
</span>



    </div>
  </div>

@endforeach
      




</div>

  

</x-main-layout>

