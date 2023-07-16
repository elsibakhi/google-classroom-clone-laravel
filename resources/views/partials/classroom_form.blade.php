<div class="my-3">
    <label for="name" class="form-label">Name</label>
    <input type="text"   @class(['form-control', 'is-invalid' => $errors->has("name")]) id="name" name="name" value="{{old("name",$classroom->name)}}" aria-describedby="emailHelp">
  @error("name")
  <div class="invalid-feedback">{{$message}}</div>

  @enderror
  </div>
  <div class="my-3">
      <label for="section" class="form-label">section</label>
      <input type="text"  @class(['form-control', 'is-invalid' => $errors->has("section")]) id="section" name="section" value="{{old("section",$classroom->section)}}" aria-describedby="emailHelp">
      @error("section")
      <div class="invalid-feedback">{{$message}}</div>

      @enderror
    </div>
    <div class="my-3">
      <label for="subject" class="form-label">subject</label>
      <input type="text"  @class(['form-control', 'is-invalid' => $errors->has("subject")]) id="subject" name="subject" value="{{old("subject",$classroom->subject)}}" aria-describedby="emailHelp">
      @error("subject")
      <div class="invalid-feedback">{{$message}}</div>

      @enderror
    </div>
    <div class="my-3">
      <label for="room" class="form-label">room</label>
      <input type="text"  @class(['form-control', 'is-invalid' => $errors->has("room")]) id="room" name="room" value="{{old("room",$classroom->room)}}" aria-describedby="emailHelp">
      @error("room")
      <div class="invalid-feedback">{{$message}}</div>

      @enderror
    </div>
  <div class="mb-3">
    <label for="cover_image" class="form-label">Cover Img</label>
    <input type="file"  @class(['form-control', 'is-invalid' => $errors->has("cover_image")]) id="cover_image" name="cover_image">
    @error("cover_image")
    <div class="invalid-feedback">{{$message}}</div>

    @enderror
  
  </div>
 
  <button type="submit" class="btn btn-primary">{{$button_label}}</button>