<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Classroom;
use Illuminate\Support\Facades\Storage;
class ClassroomController extends Controller
{
    // Actions 


    public function index(){
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
 
if ($request->hasFile("cover_image")) {
    $file=$request->file("cover_image");  // file to get file (retuen upLoadedFile object)
 // now $file have myltiple methods and properties to get info about the file
 
    $path=$file->store("/","public"); // there is public desk and local desk and s3(remote , amazon desk) desk to store files// default desk is local  (public and local is local desks)
 // we can use storeAs() to determine the name of file

 $request->merge([
  'cover_img_path' => $path,
 ]);

}



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
// if i need to find classroom directly by id without use Classroom::find($id)
// i will put (Classroom $classroom) instead of ($id) as parameter 
// this will work just with (resouce route )
// the name of this method is << model binding >>

    public function show(Request $request,Classroom $classroom){ // the objects that i need it from laravel ,i put it first

   // i use Classroom $classroom in resouce so i will not use this
// $classroom=Classroom::findOrFail($id);
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



    public function update(Request $request ,Classroom $classroom){ 



   

   
           // ------>  $classroom = Classroom::find($id);
        


        //1-
        // $classroom->name=$request->post("name");
        // $classroom->section=$request->post("section");
        // $classroom->subject=$request->post("subject");
        // $classroom->room=$request->post("room");
        // $classroom->code=Str::random(8);
        // $classroom->save();

    //2- 
    if ($request->hasFile("cover_image")) {

    $file=$request->file("cover_image");  

 
    $path=$file->store("/","public"); 

 $request->merge([
  'cover_img_path' => $path,
 ]);

 if($classroom->cover_img_path){ // to ensure that img is exist
  
     Storage::disk('public')->delete($classroom->cover_img_path);
    
}


    }
        $classroom->update($request->all());
      
 

        // 3- $classroom->fill($request->all());
        
        
        return  redirect()->route("classrooms.index")->with("success","The opreation done");
        
        
        
        
        
        
        }


        public function destroy($id){
if(Classroom::find($id)->cover_img_path != null){
    Storage::disk('public')->delete(Classroom::find($id)->cover_img_path);
    
}
Classroom::destroy($id);


//2- Classroom::where("id","=",$id)->delete();


//3- $classroom=Classroom::find($id);
// $classroom->delete();


// flash messages =>> to retuen messages to view (it stored in the session )
// example ==> session()->flash('success',"The class room has been deleted successfully!");
// if i need to send messages with redirect , i will use with()
// flash message is message stored in session to the next request (مش دائمة بتنحذف لما تعمل ريكوست تاني)
return  redirect()->route("classrooms.index")->with("success","The opreation done");
   
// i will access this message in view by use $success var or call session("success") or session()->get("success") or Session::get("success")
// Session::put(key,value) ==> put message in session بشكل دائم
// Session::flash(key,value) ==> put flash message
//Session::remove(value) ==> remove message from session


// Session::reflash()  تحتقظ بكل الفلاش مسجس لريكوست اضافي

}


}
