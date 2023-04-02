<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class League extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'country','start_year','year_ending','format','logo','status'];
    public function teams()
    {
        return $this->hasMany(Team::class);
    }

    public function matches()
    {
        return $this->hasMany(Matche::class);
    }

    public function points()
    {
        return $this->hasMany(Point::class);
    }

}
