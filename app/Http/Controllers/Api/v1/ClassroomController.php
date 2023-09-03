<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClassroomCollection;
use App\Http\Resources\ClassroomResource;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classrooms = Classroom::all()->load("user");
     //       return  ClassroomResource::collection($classrooms); // this if i use basic resource to show collection or multiple records
           return new ClassroomCollection($classrooms); // this if i use collection resource to show basic resource collection with meta data to all collection as block

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      $vaildated=  $request->validate([
            "name"=>"required|string|max:255",
        ]);

       $classroom= Classroom::create($vaildated);
 return new ClassroomResource($classroom); // this if i use basic resource to show single model or record

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {


    $classroom =Classroom::findOrFail($id);

            return  new ClassroomResource($classroom);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
     $validated=   $request->validate([
            "name"=>"sometimes|required|string|max:255",
            "subject"=>"sometimes|required|string|max:255",
        ]);

        $classroom = Classroom::findOrFail($id);
        $classroom->update($validated);

        return response(["message" => "The classroom updated successfully"],204);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        Classroom::destroy($id);

           return response(["message" => "The classroom deleted successfully"],204);
    }
}
