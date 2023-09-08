<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccessTokensController extends Controller
{


    public function index(){
        return Auth::guard("sanctum")->user()->tokens;
    }
    public function store(Request $request){

        $request->validate([
            "email"=>["required","email"],
            "password"=>["required"],
            "device_name"=>["sometimes","required"],
        ]);

        $user = User::whereEmail($request->email)->first();
        if($user){
                if(Hash::check($request->password,$user->password)){
                $name = $request->post("device_name", $request->userAgent());
                $abilities = ['*'];
                $expired_at = now()->addDays(90);
                $token = $user->createToken($name,$abilities,$expired_at);

                return response()->json([
                    "token" => $token->plainTextToken,
                    "user" => $user
                ], 201);
                }
                     return response()->json([
                    "message" => "Invalid credentials",

                ], 401);
        }
      return response()->json([
                    "message" => "Invalid credentials",

                ], 401);

    }


        public function destroy ($id=null){

        $user = Auth::guard("sanctum")->user();

                if($id){
                    if($id=="current"){
                $user->currentAccessToken()->delete();
                    }else{
                $user->tokens()->findOrFail($id)->delete();
                    }

                }else{
            $user->tokens()->delete();
                }


        }

}
