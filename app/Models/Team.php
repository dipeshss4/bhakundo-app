<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    protected $fillable = ['id','name','logo','location','coach','coach_image','remarks','status','league_id'];
    public function league()
    {
        return $this->belongsTo(League::class);
    }

    public function players()
    {
        return $this->hasMany(Player::class);
    }

    public function homeMatches()
    {
        return $this->hasMany(Matche::class, 'home_team_id');
    }

    public function awayMatches()
    {
        return $this->hasMany(Matche::class, 'away_team_id');
    }

    public function points()
    {
        return $this->hasMany(Point::class);
    }

}
