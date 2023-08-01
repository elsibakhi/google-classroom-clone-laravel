<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Classwork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ClassworkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Classroom $classroom)
    {
        
  $classworks = $classroom->classworks;
  //   $classworks = $classroom->classworks()->get(); // this code is the same of privous line
  
//   $classworks = $classroom->classworks()->where("type","=",Classwork::TYPE_ASSIGNNMENT)->get(); //get assignment classworks just
// if you need to implement addtional queries use <<classworks()>> instaed of <<classworks>>

return view("classworks.index",compact("classworks","classroom"));


    }

    /**
     * Show the form for creating a new resource.
     */
protected function getType(Request $request){
    $type=$request->query("type");
    $allowed_types =[
        Classwork::TYPE_ASSIGNNMENT,
        Classwork::TYPE_MATERIAL,
        Classwork::TYPE_QUESTION,
    ];

    if(!in_array($type,$allowed_types)){
        $type = Classwork::TYPE_ASSIGNNMENT;
    }

    return $type;
}


    public function create( Request $request, Classroom $classroom)
    {
        $type = $this->getType($request);
        $topics=$classroom->topics;
        return view("classworks.create",compact("classroom","type","topics"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,Classroom $classroom)
    {

        $type = $this->getType($request);
                $request->validate([
                    "title"=>["required","string","max:255"],
                    "description"=>["nullable","string"],
                    "topic_id"=>["nullable","int","exists:topics,id"],

                ]);
$request->merge([
    "user_id"=>Auth::id(),
    // "classroom_id"=>$classroom->id,
    "type"=>$type

]);


                // Classwork::create($request->all());
                $classroom->classworks()->create($request->all()); // this code will auto pass classroom_id 
    
    return back()
    ->with("success","Classwork created");
    
            }

    /**
     * Display the specified resource.
     */
    public function show(Classroom $classroom,Classwork $classwork)
    {
$classroom_user=DB::table("classroom_user")->where("user_id","=",Auth::id())->where("classroom_id","=",$classroom->id)->first();
$role=$classroom_user->role;


        return view("classworks.".$role.".show",compact("classroom","classwork"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classroom $classroom,Classwork $classwork)
    {
  
       
        return view("classworks.teacher.edit",compact("classroom","classwork"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Classroom $classroom,Classwork $classwork)
    {
        
     
                $request->validate([
                    "title"=>["nullable","string","max:255"],
                    "description"=>["nullable","string"],
                    "topic_id"=>["nullable","int","exists:topics,id"],

                ]);

               $classwork ->update(
                    $request->all()
                );
              $classwork->save();
    return back()
    ->with("success","Classwork updated");


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classroom $classroom,Classwork $classwork)
    {
        $classwork->delete();

        return redirect()->route("classrooms.show",[$classroom])
        ->with("success","Classwork deleted");
    }
}
