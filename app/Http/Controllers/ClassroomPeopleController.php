<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;

class ClassroomPeopleController extends Controller
{
    //

    // public function __invoke(Classroom $classroom){


    //     return view("classrooms.people",compact("classroom"));
    // }

    public function destroy(Request $request, Classroom $classroom){

$request->validate(["user_id"=>["required","exists:classroom_user,user_id"]]);
$user_id=$request->input("user_id");
if($user_id == $classroom->user_id){
    return back()->withErrors(["user_id"=>"Cant remove owner"]);
}
         $classroom->users()->detach($user_id);

return back()->with("people","User removed!");

    }




}
