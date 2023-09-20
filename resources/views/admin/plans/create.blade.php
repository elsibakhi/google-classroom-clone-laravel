<x-admin-layout>
<div class="row justify-content-center">

    <div class=" col-6 m-5 p-2 card card-primary">

        {{-- @foreach ($errors->all() as $error)
                 <ul class="alert alert-danger">
                    <li>{{ $error }}</li>
                </ul>
          @endforeach --}}


      <div class="card-header">
        <h3 class="card-title">Add subscription plan</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <form action="{{ route("admin.plans.store") }}" method="POST">
        @csrf
        <div class="card-body">
          <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input type="text"  @class(['form-control', 'is-invalid' => $errors->has("name")]) id="exampleInputEmail1" name="name" placeholder="Enter plan name">
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror

        </div>
          <div class="form-group">
            <label for="exampleInputEmail2">Description</label>
            <textarea   @class(['form-control', 'is-invalid' => $errors->has("description")]) id="exampleInputEmail2" name="description" > </textarea>
           @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Price</label>
            <input type="text"  @class(['form-control', 'is-invalid' => $errors->has("price")]) id="exampleInputPassword1" name="price" placeholder="99.99$">
           @error('price')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
          <fieldset>
            <legend>Features</legend>

              @foreach ($features as $feature)
              <div class="form-group">
                <label for="exampleInputf{{ $feature->id }}">{{ $feature->name }}</label>
                <input type="number" name="features[{{ $feature->id }}]"  @class(['form-control', 'is-invalid' => $errors->has("features.".$feature->id )]) id="exampleInputf{{ $feature->id }}" placeholder="10">
             @error('features.'.$feature->id)
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            </div>

              @endforeach

          </fieldset>

          <div class="form-check">
            <input type="checkbox"  @class(['orm-check-input', 'is-invalid' => $errors->has("featured")]) id="exampleCheck1" name="featured">
            <label class="form-check-label" for="exampleCheck1">Set as primary plan</label>
           @error('featured')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>


</div>



</x-admin-layout>
