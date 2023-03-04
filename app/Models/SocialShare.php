<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialShare extends Model
{
    use HasFactory;
    protected $fillable = ['news_id','facebook_shares','twitter_shares','linkedin_shares'];
}
