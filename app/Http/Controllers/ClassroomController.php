<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Classroom;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Http\Requests\ClassroomRequest;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class ClassroomController extends Controller
{
    // Actions 
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index()
    {
        //   echo $request->url();

        //Classroom::get()  is the same as Classroom::all()
        // $classrooms= Classroom::all(); //return  collection of classrooms
        // <<collection>> is class in php we can act with it the same as array

        $classrooms = Classroom::orderBy("name", "DESC")->active()->get(); // now we cant use all but we can use -> first
        // active is a scope method i declare it in classroom model
        return view("classrooms.index", compact("classrooms"));
    }


    // if i need to stop global scope in some queries
    //     public function index(){

    // // $classrooms= Classroom::orderBy("name","DESC")->active()->withoutGlobalScopes()->get(); // withoutGlobalScopes()--> stop all Global Scopes
    // // $classrooms= Classroom::orderBy("name","DESC")->active()->withoutGlobalScope("user")->get(); // withoutGlobalScope("user") --> stop user Global Scope
    // // $classrooms= Classroom::orderBy("name","DESC")->active()->withoutGlobalScope("user")->get(); // withoutGlobalScope(UserClassroomScope::class) --> stop UserClassroomScope

    // return view("classrooms.index",compact("classrooms"));
    //     }


    public function create()
    {

        return view("classrooms.create", ["classroom" => new Classroom()]); // i use ["classroom"=>new Classroom()] because i use classroom variable in << classroom_form.blade.php >>
    }  // i send empty classroom object
    public function store(ClassroomRequest $request): RedirectResponse
    {


        // <<<<<<<<<<<<<<<< i replace  $request->validate($rules,$messages);  with ClassroomRequest   >>>>>>>>>>>>>>>
        //  $rules=  [ // return array with validated inputs 
        //     "name"=> "required|string|max:255",
        //     "section"=> ["nullable","string","max:255" , function ($attribute,$value,$fail){  // if i need to create custom validation by clsuer function
        // if($value=="admin"){
        //     return $fail("this name is not allowed")
        // }
        //}],
        //     "subject"=> "nullable|string|max:255",
        //     "room"=> ["nullable","string","max:255"], // another way
        //     "cover_image"=> ["nullable","image",
        //    Rule::dimensions([
        //     'min_width'=>200,
        //     'min_height'=>200,
        //     'max_width'=>1000,
        //     'max_height'=>1000
        //    ]),
        //     // "dimentions:min_width=200,min_height=200,max_width=1000,max_height=1000"  // another way
        // ],


        // ];     


        // if i need to customize error messages
        // $messages =[
        // 'required' => ':attribute is importent', //  :attribute return the name of input
        // 'name.required'=>"the name is required", // if i need a specific input like name
        // 'cover_image.max'=>"Image size is greater than ... ",

        // ];

        $validated = $request->validated(); // it return validated inputs from ClassroomRequest



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
            $file = $request->file("cover_image");  // file to get file (retuen upLoadedFile object)
            // now $file have myltiple methods and properties to get info about the file

            $path = Classroom::uploadCoverImage($file); // uploadCoverImage() this is method i declare it in Classroom model class

            //alter way // $path=$file->store("/",["disk"=>"public"]);

            //  $request->merge([
            //   'cover_img_path' => $path,
            //  ]);
            $validated["cover_img_path"] = $path;
        } else {
            $cover_namber = rand(1, 3);
            $validated["cover_img_path"] = "/covers/$cover_namber.jpg";
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
        // $request->merge(["code"=>Str::random(8)]);



        // $validated["code"]=Str::random(8);
        // $validated["user_id"]=Auth::id();
        DB::beginTransaction();
        try {
            // --way2-- this way  depend on fillable property  -- mass assignment
            $classroom = Classroom::create($validated); // if we use form fields names similer to fields names in the table

            $classroom->join(Auth::id(), "teacher");




            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            return back()->with("error", $e->getMessage())
                ->withInput();
        }


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

    public function show(Classroom $classroom)
    { // the objects that i need it from laravel ,i put it first

        // i use Classroom $classroom in resouce so i will not use this
        // $classroom=Classroom::findOrFail($id);
        //  alter way to get classroom -->  Classroom:where("id","=",$id)->first();

        
        $invitation_link = URL::signedRoute("classrooms.join.create", [ // signedRoute protect the route with singnture // but you should to add signed middleware in route defenation
            "classroom" => $classroom->id,
            "code" => $classroom->code // this will showed as query string 
        ]);

        $classworks=$classroom->classworks->load("topic")->groupBy("topic_id");
        return view("classrooms.show",compact(
            "classroom","classworks", "invitation_link"
        ));
    }
    public function edit($id)
    {
        $classroom = Classroom::find($id);

        return view("classrooms.edit", ["classroom" => $classroom]);
    }



    public function update(Request $request, Classroom $classroom)
    {


        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'section' => ['nullable', 'string', 'max:255'],
            'subject' => ['nullable', 'string', 'max:255'],
            'room' => ['nullable', 'string', 'max:255'],
            'cover_image' => ['nullable', 'image', Rule::dimensions([
                "min_width" => 200,
                "min_height" => 200,
                "max_width" => 1000,
                "max_height" => 1000,
            ])],

        ]);



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

            $file = $request->file("cover_image");


            $path = Classroom::uploadCoverImage($file);


            // solution 1 to replace img 
            //$name = $classroom->cover_img_path ?? (Str::random(40).".".$file->getClientOriginalExtension());
            //   $path=$file->storeAs("/",$name,"public"); 


            $request->merge([
                'cover_img_path' => $path,
            ]);

            if ($classroom->cover_img_path) { // to ensure that img is exist
                // solution 2 to replace img 
                Classroom::deleteCoverImage($classroom->cover_img_path);
            }
        }
        $classroom->update($request->all());



        // 3- $classroom->fill($request->all());


        return  redirect()->route("classrooms.index")->with("success", "The opreation done");
    }


    public function destroy(Classroom $classroom)
    {
        // delete classroom first to ensure there in no problems
        $classroom->delete();

        //             if($classroom->cover_img_path != null){
        //   Classroom::deleteCoverImage($classroom->cover_img_path);

        // }  soft delete will not delete record -> just declare it as deleted


        //2- Classroom::where("id","=",$id)->delete();


        //3- $classroom=Classroom::find($id);
        // $classroom->delete();


        // flash messages =>> to retuen messages to view (it stored in the session )
        // example ==> session()->flash('success',"The class room has been deleted successfully!");
        // if i need to send messages with redirect , i will use with()
        // flash message is message stored in session to the next request (مش دائمة بتنحذف لما تعمل ريكوست تاني)
        return  redirect()->route("classrooms.index")->with("success", "The opreation done");

        // i will access this message in view by use $success var or call session("success") or session()->get("success") or Session::get("success")
        // Session::put(key,value) ==> put message in session بشكل دائم
        // Session::flash(key,value) ==> put flash message
        //Session::remove(value) ==> remove message from session


        // Session::reflash()  تحتقظ بكل الفلاش مسجس لريكوست اضافي

    }



    public function trashed()
    {
        $classrooms = Classroom::onlyTrashed()->latest("deleted_at")->get();

        return view("classrooms.trashed", compact("classrooms"));
    }

    public function restore($id)
    {
        $classroom = Classroom::onlyTrashed()->findOrFail($id);
        $classroom->restore();
        redirect()->route("classrooms.index")->with("success", "Classroom ({$classroom->name}) restored");
    }
    public function forceDelete($id)
    {
        $classroom = Classroom::withTrashed()->findOrFail($id);
        $classroom->forceDelete();


      //  now i can delete image
                    if($classroom->cover_img_path != null){
                        if(substr($classroom->cover_img_path,1,6)!="covers"){

                            Classroom::deleteCoverImage($classroom->cover_img_path);
                        }

        } 




      return  back()->with("success", "Classroom ({$classroom->name}) deleted forever");
    }
}
