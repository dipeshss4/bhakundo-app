<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $fillable = ['title','content','image_url','video_url','author_id','news_category_id'];
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function category()
    {
        return $this->belongsTo(NewsCategory::class, 'category_id');
    }

    public function socialShares()
    {
        return $this->hasMany(SocialShare::class);
    }
    public function incrementViewCount()
    {
        $this->increment('score', 1);
    }

    public function incrementLikeCount()
    {
        $this->increment('score', 5);
    }

    public function incrementShareCount()
    {
        $this->increment('score', 10);
    }

}
