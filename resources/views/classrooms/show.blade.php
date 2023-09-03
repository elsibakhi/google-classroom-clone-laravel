<x-main-layout title='{{ $classroom->name }}'>

    <x-slot:styles>

        <link rel="stylesheet" href="\assets\css\classroom\show.css">

    </x-slot:styles>


    @php
        $updated_topic = '';
    @endphp


    <x-classroom.topic-model :classroom="$classroom" />



    <div class="container ">


        <div class="">
            <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                <li class=" nav-item" role="presentation">
                    <button @class([
                        'nav-link',
                        'active' => !(($errors->has('name') || session()->has('success'))
                  ||
                  ($errors->has('user_id') || session()->has('people'))
                  ),
                    ]) clas id="home-tab" data-bs-toggle="tab"
                        data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane"
                        aria-selected="true">{{ __('Stream') }}</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button @class([
                        'nav-link',
                        'active' => $errors->has('name') || session()->has('success'),
                    ]) id="profile-tab" data-bs-toggle="tab"
                        data-bs-target="#profile-tab-pane" type="button" role="tab"
                        aria-controls="profile-tab-pane" aria-selected="false">{{ __('Classwork') }}</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button @class([
                        'nav-link',
                        'active' => $errors->has('user_id') || session()->has('people'),
                    ]) id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane"
                        type="button" role="tab" aria-controls="contact-tab-pane"
                        aria-selected="false">{{ __('People') }}</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="disabled-tab" data-bs-toggle="tab" data-bs-target="#disabled-tab-pane"
                        type="button" role="tab" aria-controls="disabled-tab-pane"
                        aria-selected="false">{{ __('Grades') }}</button>
                </li>
            </ul>


        </div>


        <div class="row py-5">

            <div class="tab-content " id="myTabContent">
                <div @class([
                    'tab-pane fade',
                    'show active' => !(($errors->has('name') || session()->has('success'))
                    ||
                 ( $errors->has('user_id') || session()->has('people'))
                  ),
                ]) id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab"
                    tabindex="0">

                    <div class="row">
                        <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                          <div class="carousel-inner">
                            <div class="carousel-item active">
                              <img id="cover_img" src={{Storage::disk("public")->url($classroom->cover_img_path)}} class="d-block" alt="..." >
                            </div>

                          </div>
                        </div>


                    <div class="col-4">



                        <h1>{{$classroom->name}} # {{$classroom->id}}</h1>
                    <h3>{{$classroom->section}}</h3>

                    <div>{{   __('Invitation link')  }}:   <button class="btn btn-primary" id="copyButton" data-link="{{$invitation_link}}">{{ __('Copy Link') }}</button></div>
                    <div class="row">
                    <div class="col-md-8">
                    <div class="border rounded p-3 text-center" >
                    <span class="text-success fs-2">

                        {{$classroom->code}}

                    </span>

                    </div>



                    </div>


                    </div>

                    </div>


                    <div class="col-8">

   <div class="container ">
    <h1 class="my-5">{{ __('Stream') }}</h1>

    <div id="notification-list" class="notification-list">
        @foreach ($classroom->streams as $stream)


 <div class="card mb-3" style="max-width: 700px" >
  <div class="row g-0">
    {{-- <div class="col-md-4">
      <img src="..." class="img-fluid rounded-start" alt="...">
    </div> --}}
    <div class="col-md-12">
      <div class="card-body">

        <p class="card-text w-100">{{ $stream->content }}</p>
        <p class="card-text"><small class="text-muted"> {{ $stream->created_at->diffForHumans() }}</small></p>
      </div>
    </div>
  </div>
</div>



        @endforeach
    </div>
</div>
                    </div>

                    </div>





















                </div>

                <div @class([
                    'tab-pane fade',
                    'show active' => $errors->has('name') || session()->has('success'),
                ]) id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab"
                    tabindex="0">

                    <x-classroom.classwork :classroom="$classroom" :classworks="$classworks" />

                </div>



                <div @class([
                  'tab-pane fade',
                  'show active' => $errors->has('user_id') || session()->has('people'),
              ]) id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab"
                    tabindex="0">


                    <x-classroom.people :classroom="$classroom" />


                </div>
                <div class="tab-pane fade" id="disabled-tab-pane" role="tabpanel" aria-labelledby="disabled-tab"
                    tabindex="0">4444444444...</div>
            </div>

        </div>



    </div>

    <x-slot:scripts>




        @error('name')

            <script>
                var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
                myModal.show();
                </script>
                @enderror


<script>
    document.addEventListener("DOMContentLoaded", function() {
        const copyButton = document.getElementById("copyButton");

        copyButton.addEventListener("click", function() {
            const link = copyButton.getAttribute("data-link");

            // Create a temporary input element to copy the link
            const tempInput = document.createElement("input");
            tempInput.value = link;
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand("copy");
            document.body.removeChild(tempInput);

            // Update the button text to indicate copying
            copyButton.innerHTML = "{{   __('Copied!') }}";
            setTimeout(function() {
                copyButton.innerHTML = "{{  __('Copy Link') }}";
            }, 1000); // Reset the button text after 1 second
        });
    });



</script>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>

<script>
    classroom_id="{{ $classroom->id }}"
</script>

@vite('resources/js/app.js')
        </x-slot:scripts>


</x-main-layout>
