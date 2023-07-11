<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Classroom;
class ClassroomController extends Controller
{
    // Actions 


    public function index(Request $request){
//   echo $request->url();

//Classroom::get()  is the same as Classroom::all()
// $classrooms= Classroom::all(); //return  collection of classrooms
// <<collection>> is class in php we can act with it the same as array
        
$classrooms= Classroom::orderBy("name","DESC")->get(); // now we cant use all but we can use -> first

return view("classrooms.index",compact("classrooms"));
    }


    public function create(){

        return view("classrooms.create");
    }
    public function store(Request $request) : RedirectResponse  {
   
    //    $request->input("name"); // for both

  // $request->post("name");  // get data from body jsut
   //$request->query("name") // get data from query string
   //$request->get("name") // almost similer to input
   // $request->name  // direct access by name of field

// $request("name")  // request as array

   //$request->all()  / get all fields in array
// $request->only("name","section")   get specfic fields        
// $request->except("name","section")   get specfic fields  -- except some fields        
 


$classroom = new Classroom();

// --way1-- this way dont depend on fillable property
// $classroom->name=$request->post("name");
// $classroom->section=$request->post("section");
// $classroom->subject=$request->post("subject");
// $classroom->room=$request->post("room");
// $classroom->code=Str::random(8);
// $classroom->save();

// to add code
// $data=$request->all();
// $date["code"]=Str::random(8);


// alter way to add code
$request->merge(["code"=>Str::random(8)]);

// --way2-- this way  depend on fillable property  -- mass assignment
$classroom::create($request->all()); // if we use form fields names similer to fields names in the table

// --way3--  this way  depend on fillable property  -- mass assignment
// $classroom = new Classroom($request->all());
// $classroom->save();






// PRG post redirect get

return  redirect()->route("classrooms.index");






}

    public function show(Request $request,string $id){ // the objects that i need it from laravel ,i put it first


$classroom=Classroom::findOrFail($id);
 //  alter way to get classroom -->  Classroom:where("id","=",$id)->first();

 $topics=$classroom->topics()->get();

        return view("classrooms.show")->with([
            "classroom"=>$classroom
            , "topics"=>$topics
        ]);
    }
    public function edit($id){ 
$classroom=Classroom::find($id);

        return view("classrooms.edit",["classroom"=> $classroom ]);
    }



    public function update(Request $request ,$id){ 



   


        $classroom = Classroom::find($id);
        
        //1-
        // $classroom->name=$request->post("name");
        // $classroom->section=$request->post("section");
        // $classroom->subject=$request->post("subject");
        // $classroom->room=$request->post("room");
        // $classroom->code=Str::random(8);
        // $classroom->save();

    //2- 
        $classroom->update($request->all());

        // 3- $classroom->fill($request->all());
        
        
        return  redirect()->route("classrooms.index");
        
        
        
        
        
        
        }


        public function destroy($id){

Classroom::destroy($id);


//2- Classroom::where("id","=",$id)->delete();


//3- $classroom=Classroom::find($id);
// $classroom->delete();


return  redirect()->route("classrooms.index");
        }


}
