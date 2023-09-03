<form class="d-inline" action='{{$action}}' method="post">
    @csrf
    @method("delete")

    {{$slot}}
    <input class="btn btn-danger"  type="submit" value="{{ __('Delete') }}">
    </form>
