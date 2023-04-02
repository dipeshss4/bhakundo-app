<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class RestTeamController extends Controller
{
    public  function  getAllTeams(){
        $teams= Team::where('status',1)->get();
    }
}
