
    
    <h1 class="text-success">{{$classwork->title}}</h1>
<div class="text-secondary">{{$classwork->user}} - {{$classwork->created_at->diffForHumans()}} 
@if ($classwork->updated_at != null)

(Edited {{$classwork->updated_at->diffForHumans()}} )
@endif    

</div>

<hr>

<div>{{$classwork->description}}</div>


<div>


<hr>
    <form class="row g-3" method="post" action="{{route('comments.store')}}">
  @csrf
        <input type="hidden" name="id" value="{{$classwork->id}}" />
        <input type="hidden" name="type" value="Classwork" />
        <div class="form-floating">
            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" name="comment" ></textarea>
            <label for="floatingTextarea2">Comments</label>
          </div>

        <div class="col-12">
          <button type="submit" class="btn btn-primary">Comment</button>
        </div>
      </form>

<hr>
<x-comments  :classwork="$classwork" />

</div>
