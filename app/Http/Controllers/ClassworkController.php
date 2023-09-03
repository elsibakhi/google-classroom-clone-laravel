<?php

namespace App\Http\Controllers;

use App\Enums\ClassworkType;
use App\Events\Classwork\Create;
use App\Models\Classroom;
use App\Models\Classwork;
use App\Models\Scopes\UserClassworkScope;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ClassworkController extends Controller
{
    /**
     * Display a listing of the resource.
     */


     public function index(Classroom $classroom)
    {

  $classworks = $classroom->classworks()->with("topics");
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
        ClassworkType::ASSIGNNMENT->value,
        ClassworkType::MATERIAL->value,
        ClassworkType::QUESTION->value,

    ];

    if(!in_array($type,$allowed_types)){
        $type = ClassworkType::ASSIGNNMENT->value;
    }

    return $type;
}


    public function create( Request $request, Classroom $classroom)
    {
        $this->authorize("create", [Classwork::class, $classroom]);
        $type = $this->getType($request);
        $topics=$classroom->topics;
        return view("classworks.create",compact("classroom","type","topics"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,Classroom $classroom)
    {
        $this->authorize("create", [Classwork::class, $classroom]);
        $type = $this->getType($request);
                $request->validate([
                    "title"=>["required","string","max:255"],
                    "description"=>["nullable","string"],
                    "published_at"=>["nullable","date"],
                    "options.grade"=>[Rule::requiredIf(fn () => $type == "assignment" ),"numeric","min:0"],
                    "options.due"=>["nullable","date","after:now"],

                ]);
$request->merge([
    "user_id"=>Auth::id(),
    // "classroom_id"=>$classroom->id,
    "type"=>$type

]);
// try{

    DB::transaction( function () use ($request,$classroom){
        // $data=[
        //     "user_id"=>Auth::id(),

        //     "type"=>$type,
        //     "title"=>$request->input("title"),
        //     "description"=>$request->input("description"),
        //     "published_at"=>$request->input("published_at"),
        //     "topic_id"=>$request->input("topic_id"),
        //     "options"=> $request->input("options")

            //json_encode(
        //         [
        //       "grade" => $request->input("grade"),
        //       "due" => $request->input("due"),
        // ]
     //)
    // ,

      //  ];

                        // Classwork::create($request->all());
                     $classwork = $classroom->classworks()->create($request->all()); // this code will auto pass classroom_id

                     $classwork->users()->attach($request->students);

            event(new Create($classwork));

    } );

// }catch(QueryException  $ex){
//             return "eroorrrrrrrrrrrrrrrrrrrrrrrrrrrrr";
// }
    return back()
    ->with("success",__('The opreation done'));

            }

    /**
     * Display the specified resource.
     */
    public function show(Classroom $classroom,Classwork $classwork)
    {
        $this->authorize("view", $classwork); // but this is protected by scope
$classroom_user=DB::table("classroom_user")->where("user_id","=",Auth::id())->where("classroom_id","=",$classroom->id)->first();

        $submissions= $classwork->submissions()->where("user_id",Auth::id())->get();
     return view("classworks.show",compact("classroom","classwork", "submissions"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classroom $classroom,Classwork $classwork)
    {
        $this->authorize("update", [Classwork::class, $classroom]);
        $type = $classwork->type->value;

        return view("classworks.edit",compact("classroom","classwork","type"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Classroom $classroom,Classwork $classwork)
    {
        $this->authorize("update", [Classwork::class, $classroom]);
        $type = $classwork->type->value;

        $request->validate([
            "title"=>["required","string","max:255"],
            "description"=>["nullable","string"],
            "published_at"=>["nullable","date"],
            "options.grade"=>[Rule::requiredIf(fn () => $type == "assignment" ),"numeric","min:0"],
            "options.due"=>["nullable","date","after:now"],

        ]);

               $classwork ->update(
                    $request->all()
                );


              $classwork->users()->sync($request->students);


    return back()
    ->with("success",__('The opreation done'));


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classroom $classroom,Classwork $classwork)
    {
        $this->authorize("delete", $classwork);
        $classwork->delete();

        return redirect()->route("classrooms.show",[$classroom])
        ->with("success",__('The opreation done'));
    }
}
