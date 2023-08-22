<x-main-layout title='{{$classwork->title}}'>


    <div class="container my-5">
        <div class="row">
            <div class="col-8">
                  <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
          <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Description</button>
          @can('teacher', $classroom)

          <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Student answers</button>
          @endcan

        </div>
      </nav>
      <div class="tab-content py-3" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            @can('update', ['App\Models\Classwork',$classroom])

            <a href='{{route("classrooms.classworks.edit",[$classroom->id,$classwork->id])}}' class="btn btn-warning">Edit</a>
            @endcan

            @can('delete', [$classwork])


            <x-btns.delete  :action="route('classrooms.classworks.destroy',[$classroom->id,$classwork->id])" />
            @endcan

            <x-classwork.show-description :classwork="$classwork" />
                  </div>
                   @can('teacher', $classroom)


                   <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">Not added yet</div>
                     @endcan


      </div>

            </div>

            @can('create', ['App\Models\Submission',$classwork])
            <div class="col-4 pt-5">
                <x-alert name="error" class="alert-danger"  />
                <x-alert name="success" class="alert-success"  />
  @if ($submissions->count()==0)
                      <form action="{{route('submissions.store',$classwork->id)}}" method="post" enctype="multipart/form-data">
@csrf

                    <x-form.floating-control  name="files[]" >
                             <x-slot:label>
                               <label for="file">Add submissions</label>
                             </x-slot:label>
                       <x-form.input  id="file" type="file" name="files[]" multiple accept="image/*,application/pdf"     />

                    </x-form.floating-control>


                         <input type="submit" class="btn btn-primary" value="Send">


                </form>
  @else
  <h4>Submitted files</h4>
      <ul>
  @foreach ($submissions as $file)
      <li> <a href="{{route("submissions.file",$file->id)}}">File#{{$loop->iteration}}</a></li>
  @endforeach


      </ul>
  @endif


            </div>

            @endcan
        </div>
    </div>


    </x-main-layout>



