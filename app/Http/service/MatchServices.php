<?php

namespace App\Http\service;

use App\Models\Matche;
use App\Models\PlayerStat;
use App\Models\Point;
use App\Models\Team;

class MatchServices
{
    public  function store($request){
       return Matche::create([
            'home_team_id' => $request->get('home_team_id'),
            'away_team_id' =>$request->get('away_team_id'),
            'stadium_name' =>$request->get('stadium_name'),
            'location' =>$request->get('location'),
            'status' =>$request->get('status'),
            'match_date_time' =>$request->get('match_date'),
        ]);
    }
    public  function  updateMatch($request,$id){


        $matchUpdate= Matche::where('id',$id)->update([
            'home_team_id' => $request->get('home_team_id'),
            'away_team_id' =>$request->get('away_team_id'),
            'stadium_name' =>$request->get('stadium_name'),
            'location' =>$request->get('location'),
            'home_team_score' =>$request->get('home_team_score'),
            'away_team_score' =>$request->get('away_team_score'),
            'status' =>$request->get('status'),
            'match_date_time' =>$request->get('match_date'),
        ]);

         $point = Point::where('match_id',$id)->exists();
         if ($point){
             return $matchUpdate;
         }
         else{
             $this->updateScore();
             return $matchUpdate;
         }

    }
    public function updateScore(): void
    {
        // Get all the matches
        $matches = Matche::with('homeTeam.league','awayTeam.League')->get();
// Define an empty array to store the team points
        $teamPoints = [];
// Loop through all the matches and update the points for each team
        foreach ($matches as $match) {
            $homeTeam = $match->home_team_id;
            $awayTeam = $match->away_team_id;
            $hometeamLeague = $match->homeTeam->league->id;
            $awayTeamLeague = $match->awayTeam->league->id;
            $match_id = $match->id;
            // Check if the home team already has points
            if (isset($teamPoints[$homeTeam])) {
                $points = $teamPoints[$homeTeam];
            } else {
                $points = new Point;
                $points->team_id = $homeTeam;
                $points->league_id = $hometeamLeague;
                $points->match_id=$match_id;
                $points->wins = 0; // set default value for wins column
                $points->draws = 0;
                $points->losses = 0;
                $points->goals_for = 0;
                $points->goals_against = 0;
                $points->goal_difference = 0;
                $points->points = 0;
                $points->form = '';

            }
            // Calculate the home team points
            $points->goals_for += $match->home_team_score;
            $points->goals_against += $match->away_team_score;
            $points->goal_difference = $points->goals_for - $points->goals_against;
            // Calculate the home team points based on the match result
            if ($match->home_team_score > $match->away_team_score) {
                $points->wins++;
                $points->points += 3;
                $points->form .= 'W';
            } elseif ($match->home_team_score == $match->away_team_score) {
                $points->draws++;
                $points->points += 1;
                $points->form .= 'D';
            } else {
                $points->losses++;
                $points->form .= 'L';
            }
            // Save the home team points
            $points->save();
            $teamPoints[$homeTeam] = $points;
            // Check if the away team already has points
            if (isset($teamPoints[$awayTeam])) {
                $points = $teamPoints[$awayTeam];
            } else {
                $points = new Point;
                $points->team_id = $awayTeam;

                $points->league_id = $awayTeamLeague;
                $points->match_id=$match_id;
                $points->wins = 0; // set default value for wins column
                $points->draws = 0;
                $points->losses = 0;
                $points->goals_for = 0;
                $points->goals_against = 0;
                $points->goal_difference = 0;
                $points->points = 0;
                $points->form = '';

            }
            // Calculate the away team points
            $points->goals_for += $match->away_team_score;
            $points->goals_against += $match->home_team_score;
            $points->goal_difference = $points->goals_for - $points->goals_against;
            // Calculate the away team points based on the match result
            if ($match->away_team_score > $match->home_team_score) {
                $points->wins++;
                $points->points += 3;
                $points->form .= 'W';
            } elseif ($match->away_team_score == $match->home_team_score) {
                $points->draws++;
                $points->points += 1;
                $points->form .= 'D';
            } else {
                $points->losses++;
                $points->form .= 'L';
            }
            // Save the away team points
            $points->save();
            $teamPoints[$awayTeam] = $points;

        }
    }
    public function insertPlayerStats($request,$match){
        PlayerStat::create([
            'player_id' =>$request->get('player_id'),
            'match_id' => $match->id,
            'goals'  => $request->goals,
            'assists' => $request->assists,
            'yellow_cards' => $request->yellow_cards,
            'red_cards' => $request->red_cards,
        ]);
    }

}
