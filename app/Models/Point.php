<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    use HasFactory;

    /**
     * @var \Illuminate\Database\Eloquent\HigherOrderBuilderProxy|int|mixed
     */

    protected $fillable = ['id','team_id','league_id','points','wins','losses','draws','goals_for','goals_against','goal_difference','match_id'];
    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function league()
    {
        return $this->belongsTo(League::class);
    }
    public  function match(){
        return $this->belongsTo(Matche::class);
    }

}
