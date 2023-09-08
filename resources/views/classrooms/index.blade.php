<x-main-layout title="Classrooms" path="../../">




    <div class="container my-5">

        <h1>{{ __('Classrooms') }}</h1>
        <hr>
        <ul id="apiClassrooms"></ul>
    <x-alert name="success" id="alert1" class="alert-success"/>
    <x-alert name="error"  id="alert1" class="alert-danger" />
            <div class="row my-5">

                @foreach ( $classrooms as $classroom)
                <div class="col-3">

                <x-classroom.card :classroom="$classroom" />




                </div>


                @endforeach
            </div>


            <a href={{route("classrooms.create")}} type="button" class="btn btn-primary">{{ __('Create a classroom') }}</a>
            {{-- <a href={{route("topics.index",$classroom)}} type="button" class="btn btn-dark">Show all topics</a> --}}



                <a href={{route("classrooms.trashed")}} type="button" class="btn btn-warning">{{ __('Trashed Classrooms') }}</a>





    </div>



<x-slot:scripts>
    <script>

        const xhttp = new XMLHttpRequest();
          xhttp.onload = function() {
            let classrooms=JSON.parse(this.responseText);
                let list = "";
          classrooms["data"].forEach(function (classroom){


                  list+= `<li> ${classroom["name"]}</li>`;
            });
               document.getElementById("apiClassrooms").innerHTML =list;
            }
          xhttp.open("GET", "api/v1/classrooms");
          xhttp.send();

          </script>
          </x-slot:scripts>
</x-main-layout>









