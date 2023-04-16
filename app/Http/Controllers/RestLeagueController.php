<?php

namespace App\Http\Controllers;

use App\Models\League;
use Illuminate\Http\Request;

class RestLeagueController extends Controller
{
    public  function  getAllLeague(){
        $league = League::with('teams')->where('status',1)->get();
        if ($league){
            return response()->json([
                'success' => true,
                'data'   =>$league

            ],200) ;
        }

    }
    public  function  getLeague($id){
        $leagueWithTeams = League::with('teams')->find($id);
        if ($leagueWithTeams){
            return response()->json([
                'success' => true,
                'data'   => $leagueWithTeams
            ]);
        }
    }

}
