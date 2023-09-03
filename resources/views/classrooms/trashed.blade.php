<x-main-layout title="{{ __('Trash') }}">




    <div class="container my-5">

        <h1>{{ __('Trashed Classrooms') }}</h1>
        <hr>

    <x-alert name="success" id="alert1" class="alert-success"/>
    <x-alert name="error"  id="alert1" class="alert-danger" />
            <div class="row my-5">

                @foreach ( $classrooms as $classroom)
                <div class="col-3">



                        <div class="card" >
                            <img src={{Storage::disk("public")->url($classroom->cover_img_path)}} class="card-img-top" alt="...">
                            <div class="card-body">
                              <h5 class="card-title">{{$classroom->name}}</h5>
                              <p class="card-text">{{$classroom->section}} - {{$classroom->room}}</p>

                              <form class="d-inline" action='{{route("classrooms.restore",$classroom->id)}}' method="post">
                                @csrf
                                @method("put")


                                <input class="btn btn-warning"  type="submit" value="{{ __('restore') }}">
                                </form>
                              <x-btns.delete :action='route("classrooms.force.delete",$classroom->id)' />

                            </div>
                          </div>


                </div>


                @endforeach
            </div>






    </div>




</x-main-layout>









