

    <h1 class="text-success">{{$classwork->title}}</h1>
<div class="text-secondary">{{$classwork->user->name}} - {{$classwork->created_at->diffForHumans()}}
@if ($classwork->updated_at != null)

({{ __('Edited') }} {{$classwork->updated_at->diffForHumans()}} )
@endif

</div>

<hr>

<div>{!! $classwork->description !!}</div>


<div>


<hr>
    <form class="row g-3" method="post" action="{{route('comments.store')}}">
  @csrf
        <input type="hidden" name="id" value="{{$classwork->id}}" />
        <input type="hidden" name="type" value="Classwork" />
        <label for="floatingTextarea2" > <b> {{ __('Leave a comment here') }}:</b> </label>
        <div class="form-floating">
            <textarea class="form-control" placeholder="{{ __('Leave a comment here') }}" id="floatingTextarea2" style="height: 100px" name="comment" ></textarea>
            <label for="floatingTextarea2">{{ __('Comments') }}</label>
          </div>

        <div class="col-12">
          <button type="submit" class="btn btn-primary">{{ __('Comment') }}</button>
        </div>
      </form>

<hr>
<x-comments  :classwork="$classwork" />

</div>
