<x-main-layout title='{{$classwork->title}}'> 
    <div class="container">
    
 
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
          <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Description</button>
          <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Student answers</button>

        </div>
      </nav>
      <div class="tab-content py-3" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
          <a href='{{route("classrooms.classworks.edit",[$classroom->id,$classwork->id])}}' class="btn btn-warning">Edit</a>
          <x-btns.delete  :action="route('classrooms.classworks.destroy',[$classroom->id,$classwork->id])" />
                  </div>
                  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">Not added yet</div>
          
      <x-classwork.show-description :classwork="$classwork" />
     
      </div>


    </div>
    
    </x-main-layout>

    
    
    
    