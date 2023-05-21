<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\service\ImageService;
use App\Models\League;
use App\Models\News;
use App\Models\Team;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected ImageService $imageService ;
    public function __construct(ImageService $imageService)
    {
        $this->imageService=$imageService;
    }

    public  function  viewProfile(){
        $authenticatedUser = \Auth::user();

        $article = $this->getAllNewsOfAuthor();

        return view('pages.profile.view-user-profile',compact('authenticatedUser','article'));
    }
    public  function  getAllNewsOfAuthor(){
        $user_id = Auth::user()->id;
        return News::with(['author.user', 'category'])
            ->whereHas('author.user', function($query) use ($user_id) {
                $query->where('user_id', $user_id)
                    ->whereHas('roles', function($query) {
                        $query->where('name', 'editor');
                    });
            })->orderBy('created_at','DESC')
            ->get();
    }
    public function editProfile($id){
          $user=  User::find($id);
        return view('pages.profile.edit-user-profile',compact('user'));
    }
    public  function numberOfUsers(){
       $users= User::count();
       return $users;
    }
    public function numbersOfTeams(){
        $teamsCount =Team::count();
        return $teamsCount;
    }
    public function numberofLeague(){
        $count =League::count();
        return $count;
    }
    public function numberOfNews(){
        $count =News::count();
        return $count;
    }
    public  function updateUser(UserUpdateRequest $request,$id){
        $userUpdate = User::where('id',$id)->update([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' =>  $request->get('email'),
            'password' => bcrypt($request->get('password')),
            'country' => $request->get('country'),
            'image'    =>$this->imageService->uploadImage($request,'image','/users-image')

        ]);
        if ($userUpdate){
            return redirect()->route('editProfile',$id)->with('success','Successfully Profile Updated');
        }
        else{
            return  redirect()->back()->with('error','cannot update profile');
        }
    }
    public  function performLogout(){
       $logout= Auth::logout();
       if ($logout){
           return redirect()->route('/dashboard')->with('successfully logout');
       }
    }
    public function getDashBoard(){
        $leagueCount =$this->numberofLeague();
        $usersCount =$this->numberOfUsers();
        $teamsCount =$this->numbersOfTeams();
        $newsCount = $this->numberOfNews();
        return view('dashboard',compact('leagueCount','usersCount','teamsCount','newsCount'));
    }
}
