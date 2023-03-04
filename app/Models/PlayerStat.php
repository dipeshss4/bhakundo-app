<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerStat extends Model
{
    use HasFactory;
    protected $fillable = ['player_id','team_id','match_id','goals','assists','yellow_cards','red_cards'];

}
