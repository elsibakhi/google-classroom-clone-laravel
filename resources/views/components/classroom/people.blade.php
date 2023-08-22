

    

    <div class="col-md-8 stretch-card grid-margin">
   @if (session()->has("people"))
   <div class="alert alert-success">{{session("people")}}</div>
   @endif
     
     @error('user_id')
     
     <div class="alert alert-danger">{{$message}}</div>
     @enderror
        <div class="card">
          <div class="card-body">
           

            <ul class="list-group list-group-flush">
              <li class="list-group-item">Teachers</li>
              @foreach ($classroom->teachers as $teacher)
              <li class="list-group-item d-flex justify-content-between">  
                
                <p class=" mb-1 ">{{$teacher->name}}</p>
                {{-- <p class="mb-0">{{$teacher->join->role}}</p> --}}

                
@if ($classroom->user_id==Auth::id())
    
<x-btns.delete  :action="route('classrooms.people.destroy',$classroom->id)" >
<input type="hidden" name="user_id" value="{{$teacher->id}}" />
</x-btns.delete>
@endif
             
              </li>
              @endforeach
            </ul>

          </div>
        </div>
      </div>

   

    

    <div class="col-md-8 stretch-card grid-margin">
        <div class="card">
          <div class="card-body">
      
            <ul class="list-group list-group-flush">
              <li class="list-group-item">Students</li>
              @foreach ($classroom->students as $student)
              <li class="list-group-item d-flex justify-content-between">  
                
                <p class=" mb-1 ">{{$student->name}}</p>
                {{-- <p class="mb-0">{{$student->join->role}}</p> --}}
                @if ($classroom->user_id==Auth::id())
    
          <x-btns.delete  :action="route('classrooms.people.destroy',$classroom->id)" >
                  <input type="hidden" name="user_id" value="{{$student->id}}" />
                </x-btns.delete>
@endif
      
               
              </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>

   


