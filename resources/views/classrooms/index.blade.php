<x-main-layout title="Classrooms"> 
    
    
    
    
    <div class="container my-5">
    
        <h1>Classrooms</h1>
        <hr>
        
    <x-alert name="success" id="alert1" class="alert-success"/>
    <x-alert name="error"  id="alert1" class="alert-danger" />
            <div class="row my-5">
              
                @foreach ( $classrooms as $classroom)
                <div class="col-3">
              
                <x-classroom.card :classroom="$classroom" />
    
    
                 
                    
                </div>
                
                
                @endforeach
            </div>  
        
            
            <a href={{route("classrooms.create")}} type="button" class="btn btn-primary">Create a classroom</a>
            <a href={{route("topics.index")}} type="button" class="btn btn-dark">Show all topics</a>
        
    
    
    </div>
    



</x-main-layout>    




  




