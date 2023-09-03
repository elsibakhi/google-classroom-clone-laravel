
<div class="row">



    <div class="col-4">



        <div class="btn-group-vertical w-75" role="group" aria-label="Vertical radio toggle button group">
            <input type="radio" class="btn-check " name="vbtn-radio" id="vbtn-radio1" autocomplete="off" checked>


            <label class="btn btn-outline-secondary" for="vbtn-radio1">{{ __('All topics') }}</label>
            @php
                $x=2;
            @endphp
@foreach ($classroom->topics as $topic)
<input type="radio" class="btn-check " name="vbtn-radio" id={{"vbtn-radio".$x}} autocomplete="off">
<label class="btn btn-outline-secondary" for={{"vbtn-radio".$x++}} >{{$topic->name}}</label>
@endforeach



          </div>
      @if ($classroom->user_id==Auth::id())

      <a class="btn btn-info my-5"  href={{route("topics.trashed",$classroom->id)}} >{{ __('Show tashed topics') }}</a>

@endif



</div>


<div class="col-8">
  <x-alert name="success" id="alert-suc" class="alert-success" />
@can('create', ['App\Models\Classwork',$classroom])
<div class="dropdown-center">
    <button class="btn btn-primary rounded-pill px-4 fw-bold" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fa-solid fa-plus"></i> {{ __('Create') }}
    </button>
    <ul class="dropdown-menu">
      <li>



        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">{{ __('Topic') }}</a></li>
        <a class="dropdown-item" href={{route("classrooms.classworks.create",[$classroom->id,"type"=>"assignment"])}} >{{ __('Assignment') }}</a></li>
        <a class="dropdown-item" href={{route("classrooms.classworks.create",[$classroom->id,"type"=>"material"])}} >{{ __('Material') }}</a></li>
        <a class="dropdown-item" href={{route("classrooms.classworks.create",[$classroom->id,"type"=>"question"])}} >{{ __('Question') }}</a></li>

    </ul>
</div>

@endcan


        <div class="accordion my-5" id="accordionPanelsStayOpenExample">

            @forelse ($classworks as $topic_id => $collection)



            <div class="accordion-item p-3">
              <h2 class="accordion-header">
                <div class="d-flex justify-content-between accordion_topics" >
             <div class="w-75" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse{{$topic_id}}" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                {{$collection->first()->topic->name?? __('Without topic') }}
            </div>

              @can('teacher', $classroom)

         @if ($topic_id != null)
             <div class="dropdown-center">
                 <div class="" style="cursor: pointer;"  data-bs-toggle="dropdown" aria-expanded="false">
                     <i class="fa-solid fa-ellipsis-vertical"></i>
                 </div>
                 <ul class="dropdown-menu">
                   <li>



                     <a class="dropdown-item"  href={{route("topics.edit",["classroom"=>$classroom->id,"topic"=>$topic_id])}} >{{ __('Rename') }}</a></li>
                     <li>

                       <form class="d-inline" action={{route("topics.destroy",["classroom"=>$classroom->id,"topic"=>$topic_id])}} method="post">
                         @csrf
                         @method("delete")

                           <input class="dropdown-item"  type="submit" value="Delete">



                         </form>
                     </li>

                     {{-- <x-btns-delete :action="route("topics.destroy",$topic->id)" /> --}}



                   {{-- <x-btns-delete :action="route("topics.force.delete",$topic->id)" /> --}}


                 </ul>
             </div>

             @endif



          @endcan


                </div>
              </h2>
              <hr>
              <div id="panelsStayOpen-collapse{{$topic_id}}" class="accordion-collapse collapse show">
                <div class="accordion-body">

     @foreach ($collection as $classwork)
     <div class="card">
      <div class="card-header">
        {{$classwork->created_at->diffForHumans()}} - {{__($classwork->classworkType)}}
      </div>
      <div class="card-body">
        <h5 class="card-title">{{$classwork->title}}</h5>
        <p class="card-text">{!! $classwork->description !!}.</p>
        <div class="card-text row">

            <div class="col text-center " style="font-weight: 700">
                <div>Total Assigned</div>
                <div>{{ $classwork->users_count }}</div>
            </div>
            <div class="col text-center " style="font-weight: 700">
                <div>Turned In</div>
                <div>{{ $classwork->turnedIn_count }}</div>
            </div>
            <div class="col text-center " style="font-weight: 700">
                <div>Still Assigned (not Turned In)</div>
                <div>{{ $classwork->stillassigned_count }}</div>
            </div>


        </div>
        <a href={{route("classrooms.classworks.show",[$classroom->id,$classwork->id])}} class="btn btn-primary">{{ __('Show') }}</a>
      </div>
    </div>



     @endforeach


                </div>
              </div>
            </div>

            @empty
           <p> {{ __('No topics found ') }} </p>

            @endforelse
          </div>

      </div>



</div>
