

{{-- to pass object or variable as statment to component i use :classroom="$classroom" --}}
<x-form.floating-control  id="title" name="title">
  <x-slot:label>
    <label for=title  class="form-label">Title</label>
  </x-slot:label>
  <input class="form-control"  type="text" id="title" name="title" value='{{$title??null}}' />  
</x-form.floating-control>  

<x-form.floating-control  id="description" name="description">
  <x-slot:label>
    <label for=description  class="form-label">Description</label>
  </x-slot:label>
  <textarea class="form-control" id="description" name="description">{{$description??null}}</textarea>
  
</x-form.floating-control>  
<x-form.floating-control  id="topic" name="topic">
  <x-slot:label>
    <label for="topic"  class="form-label">Topic</label>
  </x-slot:label>
 <select name="topic_id" id="topic" class="form-control">
  <option value="">No topics selected</option>
  
  
  @foreach ($topics as $topic)

  <option value="{{ $topic->id }}" @selected($topic->id==($topicId??null)) >{{ $topic->name }}</option>
  @endforeach
</select>

</x-form.floating-control>


 
  <button type="submit" class="btn btn-primary">{{$buttonLabel}}</button>