<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Support\Facades\Hash;


class Login_controller extends Controller
{


    public function singup(Request $request){
        $request->validate([
            "name"=>"required",
            "email"=>"required",
            "password"=>"required",


        ]);
        if(User::where('email',$request->email)->exists()){
            return response()->json([
                "succes"=>false,
                "message"=>"email already exist",
            ], 400);

        }
        User::create($request->all());
        return response()->json(
            [
                "succes"=>true,
                "message"=>"email created succesfully",
            ]
            , 200);

    }
    public function singin(Request $request){
        $request->validate([
            "email"=>"required",
            "password"=>"required"
        ]);
        $user = User::where('email', $request->email)->first();
        if($user){
            if (Hash::check($request->password, $user->password)){
                return response()->json(
                        [
                            "succes"=>true,
                            "email"=>$request->email,
                            "password"=>$request->password,
                            'message' => 'Login successful'
                        ]
                        , 200);}
            else{
                return response()->json([
                    "succes"=>false,
                    "message"=>"wrong password",
                ], 400);

            }}
        else{
                 return response()->json([
                "succes"=>false,
                "message"=>"unauthenticated",
            ], 400);


        }
    }


        // if(!auth()->Auth::attempt($request->all())){
        //     return response()->json([
        //         "succes"=>false,
        //         "message"=>"unauthenticated",
        //     ], 400);

        // }
        // $user = auth()->Auth::user();
        // $token = $user->createToken("auth");
        // $accesToken =$token->plainTextToken;
        // return response()->json(
        //     [
        //         "succes"=>true,
        //         "user"=>$user,
        //         "acces_token"=>$accesToken
        //     ]
        //     , 200);
}
