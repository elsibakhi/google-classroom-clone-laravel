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
                        aria-selected="true">Stream</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button @class([
                        'nav-link',
                        'active' => $errors->has('name') || session()->has('success'),
                    ]) id="profile-tab" data-bs-toggle="tab"
                        data-bs-target="#profile-tab-pane" type="button" role="tab"
                        aria-controls="profile-tab-pane" aria-selected="false">Classwork</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button @class([
                        'nav-link',
                        'active' => $errors->has('user_id') || session()->has('people'),
                    ]) id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane"
                        type="button" role="tab" aria-controls="contact-tab-pane"
                        aria-selected="false">people</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="disabled-tab" data-bs-toggle="tab" data-bs-target="#disabled-tab-pane"
                        type="button" role="tab" aria-controls="disabled-tab-pane"
                        aria-selected="false">Grades</button>
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
                    
                    <div>invitation_link : <a  href='{{$invitation_link}}' >{{$invitation_link}}</a></div>
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
                    
                    
                    
                    
                    Stream content
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

    @error('name')
        <x-slot:scripts>





            <script>
                var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
                myModal.show();
            </script>






        </x-slot:scripts>
    @enderror


</x-main-layout>
