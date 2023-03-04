<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News_tag extends Model
{
    use HasFactory;
    protected $fillable = ['news_id','tag_id'];
}
