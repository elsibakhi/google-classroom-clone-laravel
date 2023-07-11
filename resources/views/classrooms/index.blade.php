@include('partials.header')
    
<div class="container my-5">

    <h1>Classrooms</h1>
    <hr>
    
    
        <div class="row my-5">
          
            @foreach ( $classrooms as $classroom)
            <div class="col-3">
          
                    <div class="card" >
                        {{-- <img src="" class="card-img-top" alt="..."> --}}
                        <div class="card-body">
                          <h5 class="card-title">{{$classroom->name}}</h5>
                          <p class="card-text">{{$classroom->section}} - {{$classroom->room}}</p>
                          <a href={{{route("classrooms.show",$classroom->id)}}} class="btn btn-primary">Show</a>
                          <a href={{{route("classrooms.edit",$classroom->id)}}} class="btn btn-dark">Edit</a>
                      <form class="d-inline" action={{route("classrooms.destroy",$classroom->id)}} method="post">
                    @csrf
                    @method("delete")
    
    
                    <input class="btn btn-danger"  type="submit" value="Delete">
                    </form>
                      
                        </div>
                      </div>


             
                
            </div>
            
            
            @endforeach
        </div>  
    
        
        <a href={{route("classrooms.create")}} type="button" class="btn btn-primary">Create a classroom</a>
        <a href={{route("topics.show")}} type="button" class="btn btn-dark">Show all topics</a>
    


</div>









@include('partials.footer')