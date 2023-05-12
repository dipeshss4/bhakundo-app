<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\service\ImageService;
use Auth;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Laravel\Passport\Token;
use Laravel\Socialite\Facades\Socialite;
use Str;


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
        $data = [
            'email' => $user->email,
            'password' => $user->password
        ];
        auth()->attempt($data);
        $userData =[];
        $userData=[
            'first_name' =>$user->first_name,
            'last_name' => $user->last_name,
            'email'     =>$user->email,
            'user_id'  =>$user->id,
            'user_type' =>"",

        ];
        $token = $user->createToken('Token')->accessToken;
        return response()->json(['token' => $token,'data' =>$userData], 200);
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
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback(Request $request)
    {
        $socialiteUser = Socialite::driver('facebook')->user();

        // Check if user already exists in your database
        $user = \App\Models\User::where('email', $socialiteUser->getEmail())->first();

        if (!$user) {
            // User does not exist, create new user
            $user = new \App\Models\User();
            $user->first_name = $socialiteUser->getName();
            $user->last_name =$socialiteUser->getName();
            $user->email = $socialiteUser->getEmail();
            $user->image=$socialiteUser->getAvatar();
            $user->password = bcrypt(Str::random(40)); // Random password for social logins
            $user->save();
        }

        // Issue access token with Passport
        $token = $user->createToken('Social Login')->accessToken;

        return response()->json([
            'access_token' => $token,
            'user' => $user
        ]);
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(Request $request)
    {
        $socialiteUser = Socialite::driver('google')->user();

        // Check if user already exists in your database
        $user = \App\Models\User::where('email', $socialiteUser->getEmail())->first();

        if (!$user) {
            // User does not exist, create new user
            $user = new \App\Models\User();
            $user->first_name = $socialiteUser->getName();
            $user->last_name = $socialiteUser->getName();
            $user->email = $socialiteUser->getEmail();
            $user->image =$socialiteUser->getAvatar();
            $user->password = bcrypt(Str::random(40)); // Random password for social logins
            $user->save();
        }

        // Issue access token with Passport
        $token = $user->createToken('Social Login')->accessToken;

        return response()->json([
            'access_token' => $token,
            'user' => $user
        ]);
    }
}
