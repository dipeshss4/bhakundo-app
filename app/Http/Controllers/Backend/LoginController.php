<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use http\Client\Curl\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public  function  register(Request $request){
     $validator = \Validator::make($request->all(),[
         'first_name' => 'required|string',
         'last_name' => 'required|string',
         'email'  =>'required|email',
         'password' => 'required|min:8',
         'c_password' => 'required|same:password'
     ]);
     if ($validator->fails()){
         return response()->json([
             'success' => false,
             'data' =>$validator->errors()
         ]);
     }
        $user = \App\Models\User::create([
            'first_name' => $request->first_name,
            'last_name' =>$request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        $token = $user->createToken('Token')->accessToken;
        return response()->json(['token' => $token], 200);
    }
    public function login(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('Token')->accessToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }
}
