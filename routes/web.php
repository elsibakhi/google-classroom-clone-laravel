<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\ClassroomPeopleController;
use App\Http\Controllers\ClassworkController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// dd(Auth::id());



Route::get('/dashboard',[ClassroomController::class,"index"])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile', [ProfileController::class, 'extraUpdate'])->name('profile.update.extra');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


use App\Http\Controllers\JoinClassroomController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\TopicController;
use App\Models\Comment;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::match(['get'],'/', function () {
//     return view('welcome');
// });


// Route::get('/',[ClassroomController::class , "index"])->name("home");


// this way to grouping routes
// Route::group(["middleware"=>'auth'],function(){
//     Route::get("/classrooms/trashed",[ClassroomController::class,"trashed"])->name("classrooms.trashed");
//     Route::put("/classrooms/trashed/{classroom}",[ClassroomController::class,"restore"])->name("classrooms.restore");
//     Route::delete("/classrooms/forceDelete/{classroom}",[ClassroomController::class,"forceDelete"])->name("classrooms.force.delete");
// });

Route::middleware('auth')->group(function () {

    Route::prefix("/classrooms/trashed")->as('classrooms.')->controller(ClassroomController::class)->group(function(){
        Route::get("/","trashed")->name("trashed");
        Route::put("/{classroom}","restore")->name("restore");
        Route::delete("/forceDelete/{classroom}","forceDelete")->name("force.delete");



    });


    Route::prefix("/classrooms/{classroom}/topics/trashed")->as('topics.')->controller(TopicController::class)->group(function(){
        Route::get("/","trashed")->name("trashed");
        Route::put("/{topic}","restore")->name("restore");
        Route::delete("forceDelete/{topic}","forceDelete")->name("force.delete");
    });

  Route::post("/classwork/{classwork}/submission",[SubmissionController::class,"store"])->name("submissions.store");
  Route::get("/classwork/submission/{submission}",[SubmissionController::class,"file"])->name("submissions.file");

});





Route::get("classrooms/{classroom}/join",[JoinClassroomController::class,"create"])->middleware("signed")->name("classrooms.join.create");
Route::post("classrooms/{classroom}/join",[JoinClassroomController::class,"store"])->name("classrooms.join.store");


Route::resource("/classrooms",ClassroomController::class);

// Route::get("/classroom/{classroom}/people",ClassroomPeopleController::class)->name("classrooms.people"); // because i used __invoke magic method i used just ClassroomPeopleController::class
Route::delete("/classroom/{classroom}/people/delete",[ClassroomPeopleController::class,"destroy"])->name("classrooms.people.destroy");
// Route::get("/classrooms",[ClassroomController::class,"index"])->name("classrooms.index");
// Route::get("/classrooms/create",[ClassroomController::class,"create"])->name("classrooms.create");
// Route::post("/classrooms/store",[ClassroomController::class,"store"])->name("classrooms.store");
// Route::get("/classrooms/edit/{id?}",[ClassroomController::class,"edit"])->name("classrooms.edit");
// Route::put("/classrooms/update/{id}",[ClassroomController::class,"update"])->name("classrooms.update");
// Route::delete("/classrooms/delete/{id}",[ClassroomController::class,"destroy"])->name("classrooms.destroy");
// Route::get("/classrooms/{classroom}",[ClassroomController::class,"show"])->name("classrooms.show") // the routes that have optinal parameter , we should put it in the last
// ->where("classroom","[0-9]+"); // if i need  intger parameter

// if there multi parameter
// ->where(["classroom"=>"[0-9]+" ,
//          "edit"=>"[0-9]+"    ])





// topics routes





// Route::resource("/topics",TopicController::class)->where([ "topic" => "[0-9]+"]);

Route::get("/classrooms/{classroom}/topics",[TopicController::class,"index"])->name("topics.index");
Route::get("/classrooms/{classroom}/topics/create",[TopicController::class,"create"])->name("topics.create");
Route::post("/classrooms/{classroom}/topics",[TopicController::class,"store"])->name("topics.store");
Route::get("/classrooms/{classroom}/{topic}/edit",[TopicController::class,"edit"])->name("topics.edit");
Route::put("/classrooms/{classroom}/topics/{topic}",[TopicController::class,"update"])->name("topics.update");
Route::delete("/classrooms/{classroom}/topics/{topic}",[TopicController::class,"destroy"])->name("topics.destroy");
Route::get("/classrooms/{classroom}/topics/{topic}",[TopicController::class,"show"])->name("topics.show") // the routes that have optinal parameter , we should put it in the last
->where("topic","[0-9]+");







// if i need to change routes names
// Route::resource("/topics",TopicController::class)->names(
//     [
//      "index"=>"topics.index",
//      "show"=>'topics.show',
//      'create'=>'topics.create',
//      'edit'=>"topics.edit",
//      'update'=>"topics.update",
//      'destroy'=>"topics.destroy",

//     ]
// );



// short for multiple resouces
// Route::resources([
//     "/classroom"=>ClassroomController::class,
//     "/topics"=>TopicController::class
// ]);







// to create nasted routes
Route::resource('classrooms.classworks', ClassworkController::class); // way 1
// Route::resource('classrooms.classworks', ClassworkController::class)->shallow();  // way 2




Route::resource("comments",CommentController::class);




    Route::get('/',



       function () {
         if(Auth::check()){
            return redirect()->route("classrooms.index");

         }
        return view('welcome');

    }
    )->name("home");
