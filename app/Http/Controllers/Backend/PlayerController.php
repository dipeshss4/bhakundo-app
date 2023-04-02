<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlayerRequest;
use App\Http\service\PlayerService;
use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected  $playerService;
    public function __construct(PlayerService $playerService)
    {
        $this->playerService=$playerService;
    }

    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $teams =Team::where('status',1)->get();
        $jsonString = Storage::get('countries.json');
        $country =  json_decode($jsonString,false);
        return  view('pages.player.create-player',compact('teams','country'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PlayerRequest $request)
    {
      $storePlayer = $this->playerService->storePlayer($request);
      if ($storePlayer){
          return  redirect()->route('players.index')->with('success','Successfully Player Created');
      }
      else{
          return  redirect()->back()->with('error','Cannot Create Player ');
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
       $player= Player::find($id);
       return  view('pages.player.edit-player');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PlayerRequest $request, $id)
    {
        $updatePlayer = $this->playerService->updatePlayer($request,$id);
        if ($updatePlayer){
            return  redirect()->route('players.index')->with('success','successfully Updated');
        }
        else{
            return  redirect()->back()->with('error','cannot update');
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
