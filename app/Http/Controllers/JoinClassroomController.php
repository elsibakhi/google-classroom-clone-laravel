<?php

namespace App\Http\Controllers;

use App\Models\Classroom;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Exception ;

class JoinClassroomController extends Controller
{
public function __construct() {
$this->middleware("auth");

}


public function create($id){

$classroom=Classroom::withoutGlobalScopes()->active()->findOrfail($id);
try{
    $this->exists($id,Auth::id());

}catch(Exception $e){
    return redirect()->route("classrooms.show",$id);
}

return view("classrooms.join",compact("classroom"));

}

public function store(Request $request,$id){
    $classroom=Classroom::withoutGlobalScopes()->active()->findOrfail($id);
$request->validate(["role"=>"in:student,teacher"]);
    try{
        $this->exists($id,Auth::id());
    
    }catch(Exception $e){
        return redirect()->route("classrooms.show",$id);
    }
    $classroom->join(Auth::id(),$request->input("role","student"),);



return redirect()->route("classrooms.show",$id);
}
protected function exists($classroom_id,$user_id){
  
    $exists=DB::table('classroom_user') // i use DB because i dont need to create model to this table
    ->where("classroom_id",$classroom_id)
    ->where("user_id",$user_id)
    ->exists();

if($exists){
    throw new Exception("Erorr");
}

}

}
