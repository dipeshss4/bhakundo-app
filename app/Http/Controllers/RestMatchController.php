<?php

namespace App\Http\Controllers;

use App\Models\League;
use App\Models\Matche;
use App\Models\Team;
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

        $league_id = $leagueId; // replace with your desired league id

// Get all teams in the league
        $teams = Team::where('league_id', $league_id)->get();
// Get all matches for the teams in the league
        $matches = Matche::with(
            'homeTeam','awayTeam'
        )->whereIn('home_team_id', $teams->pluck('id'))
            ->orWhereIn('away_team_id', $teams->pluck('id'))
            ->where('status', 1)
            ->get();

        $response = [];
        foreach ($matches as $match) {
            $response[] = [
                'date' => $match->match_date_time,
                'team1' => $match->homeTeam->name,
                'team2' => $match->awayTeam->name,
                'team1_logo' => $match->homeTeam->logo,
                'team2_logo' => $match->awayTeam->logo,
                'isOver' => ($match->status == 1) ? true : false,
                'score' => [
                    'team1' => $match->home_team_score,
                    'team2' => $match->away_team_score,
                ],
                'city' => $match->location,
                'stadium' => $match->stadium_name,
            ];
        }
        return response()->json([
            'success' =>true,
            'data'  =>$response
        ]);


    }


}
