
    
    <h1 class="text-success">{{$classwork->title}}</h1>
<div class="text-secondary">{{$classwork->user}} - {{$classwork->created_at->diffForHumans()}} 
@if ($classwork->updated_at != null)

(Edited {{$classwork->updated_at->diffForHumans()}} )
@endif    

</div>

<hr>

<div>{{$classwork->description}}</div>
