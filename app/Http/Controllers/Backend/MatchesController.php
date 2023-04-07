<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MatchRequest;
use App\Http\service\MatchServices;
use App\Models\Matche;
use App\Models\Team;
use Illuminate\Http\Request;

class MatchesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $matchservices;
    public function __construct(MatchServices $matchServices)
    {
        $this->matchservices=$matchServices;
    }

    public function index()
    {
        $matches = Matche::with('homeTeam','awayTeam')->get();
        return view('pages.matches.view-match',compact('matches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $teams =Team::where('status',1)->get();
        return  view('pages.matches.create-match',compact('teams'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MatchRequest $request)
    {
        $matchinsert=$this->matchservices->store($request);
        if ($matchinsert){
            return redirect()->route('match.index')->with('success','Match Successfully Created');
        }
        else{
            return redirect()->back()->with('error','Cannot Created Match');
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
        $MatchEdit=Matche::with('homeTeam','awayTeam')->find($id);
        $teams = Team::where('status',1)->get();
        return view('pages.matches.edit-match',compact('MatchEdit','teams'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $matchUpdate = $this->matchservices->updateMatch($request,$id);

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
