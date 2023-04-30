<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{


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
}
