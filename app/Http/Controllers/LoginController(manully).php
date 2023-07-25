<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

public function __construct()
{
    $this->middleware("guest"); 
    // if i need to apply the middleware on some methods
    // $this->middleware("guest")->except("index"); 
    // $this->middleware("guest")->only("index"); 
}


   public function create(){
    return view('login');
   }

public function store(Request $request){
    $request->validate([
       "email"=>"required", 
       "password"=>"required", 
    ]);


$creadentioals=[
        "email"=> $request->email,
        "password"=> $request->password,
        "status"=>"active"
];

$result=Auth::attempt( $creadentioals
// $request->only(["email","password","status"])  short way another of $creadentioals
,$request->boolean("remember"));

//------------- Auth::attempt is short way to achive this -------------
// $user=User::where("email","=",$request->email)->first();

// if($user && Hash::check($request->password,$user->password)){
//     Auth::login($user,$request->boolean("remember"));

//     return redirect()->route("classrooms.index");
// }

// return back()->withInput()->withErrors([
//     "email"=>"invalid credentials"
// ]);



if($result){
    return redirect()->intended("/"); // redirect user to the page that he went to deliver it << / failback route >>
}else{
return back()->withInput()->withErrors([
    "email"=>"invalid credentials"
]);
}

}

}
