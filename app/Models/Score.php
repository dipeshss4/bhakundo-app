<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;
    protected $fillable = [
        'match_id',
        'team_id',
        'score',
    ];

    public function match()
    {
        return $this->belongsTo(Matche::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
