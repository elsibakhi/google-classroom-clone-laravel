<x-main-layout title="Topics"> 





<div class="container py-5">
<x-alert name="success" class="alert-success" />

    <h1>Trahed topics</h1>
<hr>
@foreach ($topics as $topic)
<div class="card w-75 mb-3 mx-auto">
    <div class="card-body d-flex justify-content-between">

            <h5 class="card-title">{{$topic->name}}</h5>


<span>



    <form class="d-inline" action={{route("topics.restore",["classroom"=>$classroom_id,"topic"=>$topic->id])}} method="post">
        @csrf
            @method("put")
            
            <input type="submit" class="btn btn-primary" value="Restore" ></li>
        </form>
    <form class="d-inline" action={{route("topics.force.delete",["classroom"=>$classroom_id,"topic"=>$topic->id])}} method="post">
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

