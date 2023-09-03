<div class="card" >
    <img src={{Storage::disk("public")->url($classroom->cover_img_path)}} class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">{{$classroom->name}}</h5>
      <p class="card-text">{{$classroom->section}} - {{$classroom->room}}</p>
      <a href={{{route("classrooms.show",$classroom->id)}}} class="btn btn-primary">{{ __('Show') }}</a>

      @can('update', $classroom)

      <a href={{{route("classrooms.edit",$classroom->id)}}} class="btn btn-dark">{{ __('Edit') }}</a>
      @endcan
      @can('delete', $classroom)


      <x-btns.delete :action='route("classrooms.destroy",$classroom->id)' />
      @endcan


    </div>
  </div>
