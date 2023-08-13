<div class="col-md-4 stretch-card grid-margin my-3">
    <div class="card">
      <div class="card-body">
        <p class="card-title">Comments</p>
        <ul class="" style="list-style: none">
        
        @foreach ($classwork->comments as $comment)
            
      
            <li class="border p-2" >
            <div class="d-flex">
              {{-- <img src="images/faces/face1.jpg" alt="user"> --}}
              <div>
                <p class=" mb-1"> - {{$comment->user->name}}</p>
                <p class="mb-0">{{$comment->content}}</p>
                <small>{{$comment->created_at->diffForHumans()}}</small>
              </div>
            </div>
          </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>