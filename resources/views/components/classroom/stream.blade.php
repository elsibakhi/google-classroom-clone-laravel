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

<div>invitation_link : <a  href='{{$invitationLink}}' >{{$invitationLink}}</a></div>
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