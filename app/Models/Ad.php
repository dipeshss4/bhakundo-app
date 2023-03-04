<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;
    protected $fillable = [
        'ad_name',
        'ad_image',
        'ad_link',
        'start_date',
        'end_date',
        'ad_position',
    ];
}
