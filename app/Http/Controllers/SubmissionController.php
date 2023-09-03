<?php

namespace App\Http\Controllers;

use App\Models\Classwork;
use App\Models\ClassworkUser;
use App\Models\Submission;
use App\Rules\excludedFiles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

use function PHPUnit\Framework\isEmpty;

class SubmissionController extends Controller
{


public function store(Request $request,Classwork $classwork){
        $this->authorize("create", [Submission::class, $classwork]);

 try{


            $request->validate([
                "files" => 'required|array',
                "files.*" => ['file', new excludedFiles("application/x-msdownload", "text/x-php")],
            ]);

                $insertions=[];


            foreach($request->file("files") as $file){

                array_push($insertions,
                [
                    "user_id"=>Auth::id(),
                    "content"=>$file->store("submissions\\"."classwork".$classwork->id."\\"),
                    "type"=>"file"
                ]
                );
            }

// dd($insertions);
             DB::transaction(function () use ($classwork , $insertions) {
                     $classwork->submissions()->createMany($insertions);
                    ClassworkUser::where([
                        "user_id"=>Auth::id(),
                        "classwork_id"=>$classwork->id,
                    ])->update([
                        "status"=> "submitted",
                        "submitted_at"=> now()
                    ]);
             });

 } catch (Throwable $ex)   {
   return back()->with("error",$ex->getMessage());
 }



   return Back()->with("success",__('The opreation done'));
}




public function file( Submission $submission){
        $classwork = $submission->classwork;
        $this->authorize("view", [$submission, $classwork]);
// $isTeacher= DB::select("
// select * from classroom_user
//  where role='teacher'
//  and user_id=?
//  and exists (
//     select 1 from classworks where classworks.classroom_id =classroom_user.classroom_id  and exists (
//     select 1 from submissions where submissions.classwork_id =classworks.id and id=?
//  )
//  )

// ",[Auth::id(),$submission->id]);


// $isOwner=$submission->user_id == Auth::id();

// if(!$isOwner &&  count($isTeacher)==0 ){
//     abort(403);
// }

return response()->file(storage_path("app\\".$submission->content));
}


}
