<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class News extends Model implements  HasMedia
{
    use HasFactory,InteractsWithMedia;
    protected $fillable = ['title','content','image_url','video_url','author_id','news_category_id','is_trending','recommend','featured','status','meta_description'];
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function category()
    {
        return $this->belongsTo(News_Category::class, 'news_category_id');
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
