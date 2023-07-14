<?php
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\TopicController;
use Illuminate\Support\Facades\Route;

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


Route::get('/',[ClassroomController::class , "index"])->name("home");




Route::resource("/classrooms",ClassroomController::class);

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





Route::resource("/topics",TopicController::class)->where([ "topic" => "[0-9]+"]);


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