<?php

namespace App\Http\Controllers;

use App\Models\League;
use Illuminate\Http\Request;

class RestLeagueController extends Controller
{
    public  function  getAllLeague(){
        $league = League::where('status',1)->get();
        if ($league){
            return response()->json([
                'success' => true,
                'data'   =>$league

            ],200) ;
        }

    }
    public  function  getLeague($id){
        $league =League::where('id',$id)->where('status',1)->first();
        if ($league){
            return response()->json([
                'success' => true,
                'data'   => $league
            ]);
        }



    }

}
