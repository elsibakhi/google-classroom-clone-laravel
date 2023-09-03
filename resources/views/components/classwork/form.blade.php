

{{-- to pass object or variable as statment to component i use :classroom="$classroom" --}}
<div class="row">
<div class="col-8">




  <x-form.floating-control  id="title" name="title">
    <x-slot:label>
      <label for=title  class="form-label">{{ __('Title') }}</label>
    </x-slot:label>
    <input  @class(['form-control', 'is-invalid' => $errors->has("title")])  type="text" id="title" name="title" value='{{$classwork->title??null}}' />
  </x-form.floating-control>

  <x-form.floating-control  id="description" name="description">
    <x-slot:label>
      <label for=description  class="form-label">{{ __('Description') }}</label>
    </x-slot:label>
    <textarea @class(['form-control', 'is-invalid' => $errors->has("description")]) id="description" name="description">{{$classwork->description??null}}</textarea>

  </x-form.floating-control>
  <x-form.floating-control  id="topic" name="topic">
    <x-slot:label>
      <label for="topic"  class="form-label">{{ __('Topic') }}</label>
    </x-slot:label>
   <select name="topic_id" id="topic"  @class(['form-control', 'is-invalid' => $errors->has("topic_id")])>
    <option value="">{{ __('No topics selected') }}</option>


    @foreach ($classroom->topics as $topic)

    <option value="{{ $topic->id }}" @selected($topic->id==($classwork->topic_id??null)) >{{ $topic->name }}</option>
    @endforeach
  </select>

  </x-form.floating-control>


</div>
<div class="col-4">

  <x-form.floating-control  id="student" name="students[]">
    <x-slot:label>
      <label for="student"  class="form-label">{{ __('For') }}</label>
    </x-slot:label>

<div>


@foreach ($classroom->students as $student)
<div>

  <input type="checkbox" name="students[]" id="student{{$student->id}}" value="{{$student->id}}"  @checked(!isset($classwork)||$classwork?->users()->find($student->id)) />
  <label for="student{{$student->id}}">{{$student->name}}</label>

</div>
@endforeach






</div>


  </x-form.floating-control>

  <x-form.floating-control  id="published_at2" name="published_at">
    <x-slot:label>
      <label for=published_at  class="form-label">{{ __('Published at') }}</label>
    </x-slot:label>
    <input  @class(['form-control', 'is-invalid' => $errors->has("published_at")])  type="date" id="published_at" name="published_at" value='{{$classwork->published_date??null}}' />
  </x-form.floating-control>

  @if($type=="assignment")
  <x-form.floating-control  id="grade2" name="options[grade]">
    <x-slot:label>
      <label for=grade  class="form-label">{{ __('Grade') }}</label>
    </x-slot:label>
    <input  @class(['form-control', 'is-invalid' => $errors->has("options.grade")])  type="number" id="grade" name="options[grade]" value='{{$classwork->options["grade"]??null}}' />
  </x-form.floating-control>



  <x-form.floating-control  id="due2" name="options[due]">
    <x-slot:label>
      <label for=due  class="form-label">{{ __('Due') }}</label>
    </x-slot:label>
    <input  @class(['form-control', 'is-invalid' => $errors->has("options.due")])  type="date" id="due" name="options[due]" value='{{$classwork->options["due"]??null}}' />
  </x-form.floating-control>

@endif




</div>

</div>



  <button type="submit" class="btn btn-primary">{{$buttonLabel}}</button>




  