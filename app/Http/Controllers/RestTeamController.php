<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class RestTeamController extends Controller
{
    public  function  getAllTeams(){
        $teams= Team::with('league')->where('status',1)->get();
        if ($teams){
            return response()->json([
                'success' => true,
                'data'  =>$teams
            ]);

        }
        else{
            return response()->json([
                'success' => false,
                'data'  =>'No any Team'
            ]);
        }
    }

    public  function  getTeams($id){
        $teams = Team::with('league')->where('id',$id)->get();
        if ($teams){
            return response()->json([
                'success' => true,
                'data'  =>$teams
            ]);
        }
        else{
            return response()->json([
                'success' => false,
                'data'  =>'No Any Teams'
            ]);
        }

    }
    public  function  getNationTeams(){
        $teams =Team::where('is_nation','1')->get();
        if ($teams->count()>0){
            return response()->json([
                'success' =>true,
                'data'   =>$teams
            ]);
        }
        else{
            return response()->json([
                'success' =>true,
                'data'   =>'No any Data'
            ]);
        }
    }
}
