<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthorRequest;
use App\Models\Author;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
      $author=  Author::with('user')->whereHas('user', function($query) {
            $query->whereHas('roles', function($query) {
                $query->where('name', 'editor');
            });
        })->get();
      return  view('pages.author.index-author',compact('author'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'editor');
        })->get();
        return  view('pages.author.create-author',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AuthorRequest $request)
    {
        $author = Author::create([
            'user_id' =>$request->get('author_id'),
            'status' =>$request->get('status'),
            'meta_description' =>$request->get('meta-description'),
            'facebook_links' =>$request->get('facebook_links'),
            'twitter_links' =>$request->get('twitter_links'),
            'instagram_links' =>$request->get('instagram_links'),
            'tiktok_links'  =>$request->get('tiktok_links')
        ]);
        if ($author){
            return  redirect()->route('author.index')->with('success','Successfully Author Created');
        }
        else{
            return  redirect()->back()->with('error','Cannot Insert Data');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $author=Author::find($id);
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', 'editor');
        })->get();
        return view('pages.author.edit-author',compact('author','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AuthorRequest $request, $id)
    {
        $author =Author::where('id',$id)->update([
            'user_id' =>$request->get('author_id'),
            'status' =>$request->get('status'),
            'meta_description' =>$request->get('meta-description'),
            'facebook_links' =>$request->get('facebook_links'),
            'twitter_links' =>$request->get('twitter_links'),
            'instagram_links' =>$request->get('instagram_links'),
            'tiktok_links'  =>$request->get('tiktok_links')
        ]);
        if ($author){
            return  redirect()->route('author.index')->with('success','successfully updated authors');
        }
        else{
            return  redirect()->back()->with('error','cannot update the author');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
