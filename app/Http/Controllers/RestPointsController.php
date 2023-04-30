<?php

namespace App\Http\Controllers;

use App\Models\Point;
use Illuminate\Http\Request;

class RestPointsController extends Controller
{
    public  function  getPointsTable($leagueId){

        $pointsTable = Point::with('team', 'league')
            ->where('league_id', $leagueId)
            ->orderByDesc('points')
            ->orderByDesc('goal_difference')
            ->get();

        $response = [];
        foreach ($pointsTable as $row) {
            $team = $row->team->name;
            $league = $row->league->name;
            $gp = $row->played;
            $w = $row->wins;
            $d = $row->draws;
            $l = $row->losses;
            $gf = $row->goals_for;
            $ga = $row->goals_against;
            $gd = $gf - $ga;
            $pts = $row->points;
            $form = [$row->form];

            $response[] = [
                'teamname' => $team,
                'league' => $league,
                'GP' => $gp,
                'W' => $w,
                'D' => $d,
                'L' => $l,
                'GF' => $gf,
                'GA' => $ga,
                'GD' => $gd,
                'PTS' => $pts,
                'FORM' => $form,
            ];
        }

        return response()->json([
            'success' => true,
            'data'   =>$response
        ]);


    }
}
