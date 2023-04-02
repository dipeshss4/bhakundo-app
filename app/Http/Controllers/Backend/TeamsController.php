<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeamRequest;
use App\Http\service\TeamsService;
use App\Models\League;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamsController extends Controller
{
    protected $TeamsService;
    public function __construct(TeamsService $TeamsService)
    {
        $this->TeamsService=$TeamsService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {

        $teams = Team::with('league')->get();
        return  view('pages.teams.view-teams',compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $league =League::where('status',1)->get();
        return  view('pages.teams.create-teams',compact('league'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
       $teams = $this->TeamsService->storeTeams($request);
       if ($teams){
           return  redirect()->route('teams.index')->with('success','Successfully Inserted Teams');
       }
       else{
           return  redirect()->back()->with('error','Cannot Insert Team');
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
        $editTeams = Team::find($id);
        $league = League::where('status',1)->get();
        return  view('pages.teams.edit-teams',compact('editTeams','league'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(TeamRequest $request, $id)
    {
        $updateTeams = $this->TeamsService->updateTeams($request,$id);
        if ($updateTeams){
            return  redirect()->route('teams.index')->with('success','Successfully Updated');

        }
        else{
            return  redirect()->back()->with('error','cannot update Data');
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
