<?php

namespace App\Http\Controllers;

use App\Models\Point;
use Illuminate\Http\Request;

class RestPointsController extends Controller
{
    public  function  getPointsTable(){
        $points =Point::with('team','league')->get();
        if ($points){
            return response()->json([
                'success' =>true,
                'data' =>$points
            ]);
        }


    }
}
