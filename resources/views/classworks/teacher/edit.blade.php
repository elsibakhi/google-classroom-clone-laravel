<x-main-layout title="Edit classwork"> 



    <div class="container my-5">
    
    
      <x-alert class="alert-success" name="success"  />
    <x-alert class="alert-error" name="error"  />
    
        <form class="w-50" action={{route("classrooms.classworks.update",[$classroom->id,$classwork->id])}} method="POST" enctype="multipart/form-data" >
          @method("put")
         @csrf
            <h1>Edit classwork</h1>
            <hr>
           
    
    <x-classwork.form button-label="Edit {{$classwork->type}}" title='{{$classwork->title}}' description='{{$classwork->description}}' topic-id='{{$classwork->topic->id??null}}'  :topics='$classroom->topics' />
    
          </form>
    
    </div>
      
    
    </x-main-layout>
    
    
    
    
    
    
    
    