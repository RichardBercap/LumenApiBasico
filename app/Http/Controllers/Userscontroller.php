<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    function index(Request $request){
        //peticiones solo en json
        if($request->isJson()){
            $users = User::all();
            return response()->json([$users], 200);
        }
        
        return response()->json(['error'=>'Unauthorized'],401);// para no permitir reuqest solo desde el browser
     
    }
    function createUser(Request $request)
    {
        if($request->isJson()){
            $data = $request->json()->all();

            $user = User::create([
                'name'=>$data['name'],
                'username'=>$data['username'],
                'email'=>$data['email'],
                'password'=>Hash::make($data['password']),
                'api_token'=>str_random(60)
            ]);

            return response()->json($user, 201);
        }
        return response()->json(['error'=>'Unauthorized'],401);
    }
}
