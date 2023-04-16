<?php

namespace App\Http\Controllers;

use App\Models\League;
use App\Models\Matche;
use Illuminate\Http\Request;

class RestMatchController extends Controller
{
    public function getAllMatches()
    {
        $match = Matche::with('homeTeam', 'awayTeam', 'league')->where('status', 1)->get();
        if ($match) {
            return response()->json([
                'success' => true,
                'data' => $match
            ], 200);
        } else {
            return response()->json([
                'success' => true,
                'data' => 'no any Data'
            ], 404);
        }
    }

    public function getMatch($id)
    {
        $match = Matche::with('homeTeam', 'awayTeam', 'league')
            ->find($id)
            ->where('status', 1);

        if ($match) {
            return response()->json([
                'success' => true,
                'data' => $match,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'data' => 'no any data'
            ], 404);
        }

    }
    public  function  getMatchLeague($leagueId){

        $match = League::with('teams.matches',)->find($leagueId);
        return $match;

    }


}
