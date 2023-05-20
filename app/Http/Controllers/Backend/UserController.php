<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Http\Request;
use Laravel\Passport\Bridge\UserRepository;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $users= User::with('roles')->get();
        return  view('pages.users.view-users',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {    $roles=Role::all();
        return  view('pages.users.create-users',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request)
    {
       $users= User::create([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' =>  $request->get('email'),
            'address' => $request->get('address'),
            'country' => $request->get('country'),
            'contact_no' => $request->get('contact_no'),
            'password' => bcrypt($request->get('password'))
        ]);

        $user = User::findOrFail($users->id);
        $roleIds = explode(',', $request->input('roles'));
        $roles = Role::whereIn('id', $roleIds)->get();
        $user->syncRoles($roles);
        if ($users){
            return  redirect()->route('users.index')->with('success','User Successfully Created');
        }
        else{
            return  redirect()->back()->with('error','cannot Create users');
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
        $users=User::with('roles')->find($id);
        $roles=Role::all();
        return  view('pages.users.edit-rolesanduser',compact('users','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request, $id)
    {
        $usersUpdate=User::where('id',$id)->update([
           'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' =>  $request->get('email'),
            'address' => $request->get('address'),
            'country' => $request->get('country'),
            'contact_no' => $request->get('contact_no'),
            'password' => bcrypt($request->get('password'))
        ]);
        $user = User::findOrFail($id);
        $roleIds = explode(',', $request->input('roles'));
        $roles = Role::whereIn('id', $roleIds)->get();
        $user->syncRoles($roles);
        if ($usersUpdate){
            return  redirect()->route('users.index')->with('success','User Successfully Updated');
        }
        else{
            return  redirect()->back()->with('error','Cannot Updated User');
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
