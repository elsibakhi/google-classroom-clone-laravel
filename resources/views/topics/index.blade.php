@include('partials.header')
    
<div class="container">

    <h1>Index</h1>
    
    
    
        <div class="row">
          
            @foreach ( $topics as $topic)
            <div class="col-3">
                <div class="card" >
                    {{-- <img src="" class="card-img-top" alt="..."> --}}
                    <div class="card-body">
                      <h5 class="card-title">{{$topic->name}}</h5>
                      {{-- <p class="card-text">{{$topic->section}} - {{$topic->room}}</p> --}}
                      <a href={{{route("topics.show",$topic->id)}}} class="btn btn-primary">Show</a>
                      <a href={{{route("topics.edit",$topic->id)}}} class="btn btn-dark">Edit</a>
                  <form  action={{route("topics.destroy",$topic->id)}} method="post">
                @csrf
                @method("delete")


                <input class=" btn btn-danger"  type="submit" value="Delete">
                </form>
                  
                    </div>
                  </div>
                
            </div>
            
            
            @endforeach
        </div>  
    
    
    
    
    <a href={{route("topics.create")}}>Create page</a>

</div>









@include('partials.footer')