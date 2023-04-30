<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\service\ImageService;
use Auth;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Laravel\Passport\Token;

class LoginController extends Controller
{
    protected  $imageService;
    public function __construct(ImageService $imageService )
    {
        $this->imageService=$imageService;

    }

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
            $userData =[];
            $userData=[
                'first_name' =>auth()->user()->first_name,
                'last_name' => auth()->user()->last_name,
                'email'     =>auth()->user()->email,
                'user_id'  =>auth()->user()->id,
                'user_type' =>auth()->user()->hasRole('admin') ? 'admin': 'user',
                'avatar' => auth()->user()->image
            ];
            return response()->json(['token' => $token,'data' =>$userData], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }
    public  function logout(){
        $accessToken = auth()->user()->token();
        Token::where('id', $accessToken->id)->update(['revoked' => true]);
        $accessToken->revoke();
        return response()->json(['message' => 'Successfully logged out']);
    }
    public  function   editProfile(Request $request,$id){

        $usersUpdate= \App\Models\User::where('id',$id)->update([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' =>  $request->get('email'),
            'address' => $request->get('address'),
            'country' => $request->get('country'),
            'contact_no' => $request->get('contact_no'),
            'password' => bcrypt($request->get('password')),
            'image'   =>$this->imageService->updateImage(\App\Models\User::find($id),'/image','/userImage',$request),
        ]);
        if ($usersUpdate){
            return response()->json([
                'success' => true,
                'data' =>'successfully updated'
            ]);
        }
    }
}
