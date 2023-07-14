@extends('layouts.master')

@push('styles')
    <link rel="stylesheet" href="\assets\css\classroom\show.css">
@endpush

@section('content')

@php
    $updated_topic="";
@endphp

  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form action={{route("topics.store")}} method="post">
            @csrf
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Add topic</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" name="name" placeholder="Mangement">
                    <label for="floatingInput">Topic</label>
                  </div>
                  <input type="hidden" name="classroom_id" value={{$classroom->id}} >
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary">Add</button>
            </div>

        </form>
      </div>
    </div>
  </div>



<div class="container ">


    <div class="">
        <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
            <li class=" nav-item" role="presentation">
              <button class=" nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Stream</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class=" nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Classwork</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class=" nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">people</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="disabled-tab" data-bs-toggle="tab" data-bs-target="#disabled-tab-pane" type="button" role="tab" aria-controls="disabled-tab-pane" aria-selected="false" >Grades</button>
            </li>
          </ul>
   
    
    </div>


    <div class="row py-5">

        <div class="tab-content " id="myTabContent">
            <div class="tab-pane fade show active " id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
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
            <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">


                <div class="row">
            
            
           
                    <div class="col-4">
                        
                    
                       
                        <div class="btn-group-vertical w-75" role="group" aria-label="Vertical radio toggle button group">
                            <input type="radio" class="btn-check " name="vbtn-radio" id="vbtn-radio1" autocomplete="off" checked>
  
  
                            <label class="btn btn-outline-secondary" for="vbtn-radio1">All topics</label>
                            @php
                                $x=2;
                            @endphp
  @foreach ($topics as $topic)
  <input type="radio" class="btn-check " name="vbtn-radio" id={{"vbtn-radio".$x}} autocomplete="off">
  <label class="btn btn-outline-secondary" for={{"vbtn-radio".$x++}} >{{$topic->name}}</label>
  @endforeach

                           
                           
                          </div>
                       
                </div>
            
            
                <div class="col-8">
                  
                    <div class="dropdown-center">
                        <button class="btn btn-primary rounded-pill px-4 fw-bold" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-plus"></i> Create
                        </button>
                        <ul class="dropdown-menu">
                          <li>

                            
                            
                            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">Topic</a></li>
                         
                        </ul>
                    </div>

                        <div class="accordion my-5" id="accordionPanelsStayOpenExample">

                            @foreach ($topics as $topic)
                         
                         

                            <div class="accordion-item p-3">
                              <h2 class="accordion-header">
                                <div class="d-flex justify-content-between accordion_topics" >
                             <div class="w-75" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse{{$topic->id}}" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                {{$topic->name}}
                            </div>   

                            <div class="dropdown-center">
                                <div class="" style="cursor: pointer;"  data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                </div>
                                <ul class="dropdown-menu">
                                  <li>
        
                                    
                                    
                                    <a class="dropdown-item"  href={{route("topics.edit",$topic->id)}} >Rename</a></li>
                                    <form action={{route("topics.destroy",$topic->id)}} method="post">
                                    @csrf
                                        @method("delete")
                                        
                                        <input type="submit" class="dropdown-item" value="Delete" ></li>
                                    </form>
                                 
                                </ul>
                            </div>
                          
                                </div>
                              </h2>
                              <hr>
                              <div id="panelsStayOpen-collapse{{$topic->id}}" class="accordion-collapse collapse show">
                                <div class="accordion-body">
                                 topic content
                                </div>
                              </div>
                            </div>
                        
                            @endforeach
                          </div>

                      </div>



                </div>
                        
            </div>  


            </div>
            <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">333333333...</div>
            <div class="tab-pane fade" id="disabled-tab-pane" role="tabpanel" aria-labelledby="disabled-tab" tabindex="0">4444444444...</div>
          </div>
        
        </div>
        


</div>


  

@endsection



