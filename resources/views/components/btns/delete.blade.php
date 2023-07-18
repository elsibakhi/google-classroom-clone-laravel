<form class="d-inline" action={{$action}} method="post">
    @csrf
    @method("delete")
    
    
    <input class="btn btn-danger"  type="submit" value="Delete">
    </form>