<x-main-layout>

<div class="container">
    <div class="row justify-content-center my-5 text-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{__("Joining")}} {{ $classroom->name }}</div>

                <div class="card-body">
                    <form method="POST" action="{{route("classrooms.join.store",$classroom->id)}}">
                        @csrf
                        <button type="submit" class="btn btn-primary">{{__("Join Now")}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


</x-main-layout>
