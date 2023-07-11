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


Route::view('/',"welcome")->name("home");


Route::get("/classrooms",[ClassroomController::class,"index"])->name("classrooms.index");
Route::get("/classrooms/create",[ClassroomController::class,"create"])->name("classrooms.create");
Route::post("/classrooms/store",[ClassroomController::class,"store"])->name("classrooms.store");
Route::get("/classrooms/edit/{id?}",[ClassroomController::class,"edit"])->name("classrooms.edit");
Route::put("/classrooms/update/{id}",[ClassroomController::class,"update"])->name("classrooms.update");
Route::delete("/classrooms/delete/{id}",[ClassroomController::class,"destroy"])->name("classrooms.destroy");
Route::get("/classrooms/{classroom}",[ClassroomController::class,"show"])->name("classrooms.show") // the routes that have optinal parameter , we should put it in the last
->where("classroom","[0-9]+"); // if i need  intger parameter 

// if there multi parameter
// ->where(["classroom"=>"[0-9]+" ,
//          "edit"=>"[0-9]+"    ]) 


Route::post("/topics/store/{id}",[TopicController::class,"store"])->name("topics.store");

Route::get("/topics/show",[TopicController::class,"show"])->name("topics.show") 
->where("id","[0-9]+"); 
Route::get("/topics/edit/{id}",[TopicController::class,"edit"])->name("topics.edit");
Route::delete("/topics/delete/{id}",[TopicController::class,"destroy"])->name("topics.destroy");
Route::put("/topics/update/{id}",[TopicController::class,"update"])->name("topics.update");