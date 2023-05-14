<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use App\Models\News;
use App\Models\News_Category;
use App\Models\Reactions;
use Illuminate\Http\Request;

class FrontendNewsController extends Controller
{
   public function getAllNews(){
       $restNews = News::with(['author.user', 'category'])
           ->whereHas('author.user', function($query) {
               $query->whereHas('roles', function($query) {
                   $query->where('name', 'editor');
               });
           })->orderBy('updated_at','DESC')
           ->get();

       if ($restNews){
           return response()->json([
               'success' =>true,
               'data' =>$restNews
           ],200);
       }

   }
    public function getTrendingNews(){
        $restNews = News::select('id','author_id','news_category_id','title','image_url','video_url','created_at')->with(['author.user', 'category'])
            ->whereHas('author.user', function($query) {
                $query->whereHas('roles', function($query) {
                    $query->where('name', 'editor');
                });
            })->where('is_trending',1)
            ->get();

        if ($restNews){
            return response()->json([
                'success' =>true,
                'data' =>$restNews
            ],200);
        }

    }
    public function getRecommendNews(){
       $restRecommendNews = News::with(['author.user', 'category'])
           ->whereHas('author.user', function($query) {
               $query->whereHas('roles', function($query) {
                   $query->where('name', 'editor');
               });
           })->where('recommended',1)
           ->latest();
       if ($restRecommendNews){
           return response()->json([
               'success' => true,
               'data'  =>$restRecommendNews
           ]);

       }
       else{
           return  response()->json([
               'success' => false,
               'data' => "No any data avaiable"
           ]);
       }
    }

    public  function  getNewsCategory(){
       $newsCategory =News_Category::where('status',1)->get();
       if ($newsCategory){
           return response()->json([
               'success' =>true,
               'data'   =>$newsCategory
           ],200);

       }
       else{
           return response()->json([
               'success' =>false,
               'data'   =>'no any category'
           ],500);
       }
    }
    public function getNews($id){
        $restNews = News::with(['author.user', 'category'])
            ->whereHas('author.user', function($query) {
                $query->whereHas('roles', function($query) {
                    $query->where('name', 'editor');
                });
            })->where('id',$id)->orderBy('updated_at','DESC')
            ->get();

        if ($restNews){
            return response()->json([
                'success' =>true,
                'data' =>$restNews
            ],200);
        }
    }

    public  function getFeaturedNews(){
        $restNews = News::select('id','author_id','news_category_id','title','image_url','video_url','created_at','content')->with(['author.user', 'category'])
            ->whereHas('author.user', function($query) {
                $query->whereHas('roles', function($query) {
                    $query->where('name', 'editor');
                });
            })->where('featured',1)
            ->where('status',1)
            ->get();

        if ($restNews){
            return response()->json([
                'success' =>true,
                'data' =>$restNews
            ],200);
        }
    }
    public function getPopularNews(){
        $restNews = News::select('id','author_id','news_category_id','score','title','image_url','video_url','created_at','content')->with(['author.user', 'category'])
            ->whereHas('author.user', function($query) {
                $query->whereHas('roles', function($query) {
                    $query->where('name', 'editor');
                });
            })->where('status',1)
            ->orderBy('score','DESC')
            ->get();

        if ($restNews){
            return response()->json([
                'success' =>true,
                'data' =>$restNews
            ],200);
        }
    }
    public function getLatestNews(){
        $restNews = News::select('id','author_id','news_category_id','title','image_url','video_url','created_at','content')->with(['author.user', 'category'])
            ->whereHas('author.user', function($query) {
                $query->whereHas('roles', function($query) {
                    $query->where('name', 'editor');
                });
            })
            ->where('status',1)
            ->orderBy('updated_at','Desc')
            ->get();
        if ($restNews){
            return response()->json([
                'success' => true,
                'data' =>$restNews
            ],200);
        }
    }
    public function insertComment(Request $request){
       $comment = Comments::create([
           'news_id' => $request->get('news_id'),
           'user_id' => \Auth::user()->id,
           'content' => $request->get('content')
       ]);
       if ($comment){
           return response()->json([
               'success' => true,
               'data'  =>'Successfully Comment Added'
           ],200);
       }
       else{
           return response()->json([
               'success' => true,
               'data'  =>'Comment Could not be be Added'
           ],401);
       }
    }
    public  function insertReaction(Request $request){
       $reactionExists =Reactions::where('news_id',$request->get('news_id'))->where('user_id',\Auth::user()->id)->exists();
       if ($reactionExists){
           Reactions::where('news_id',$request->get('news_id'))->where('user_id',\Auth::user()->id)->update([
               'type' => $request->get('reactions') =='like' ? 'like' :'dislike'
           ]);
       }
       else{
           Reactions::create([
               'news_id' => $request->get('news_id'),
               'user_id' => \Auth::user()->id,
               'type' => $request->get('reactions') =='like' ? 'like' :'dislike'
           ]);
       }
    }
    public  function  getNewsAccordingCategory($id){
       $news = News::with('author.user')
           ->where('news_category_id',$id)
           ->where('status',1)
           ->get();
       if($news){
           return response()->json([
               'success'=>true,
               'data'  =>$news
           ]);
           }
       else{
        return response()->json([
            'success' => false,
            'data'    =>'No any data'
        ]);
       }
    }
    public  function getAuthorPost($id){
        $news = News::with('author.user')
            ->where('author_id',$id)
            ->where('status',1)
            ->get();
        if($news){
            return response()->json([
                'success'=>true,
                'data'  =>$news
            ]);
        }
        else{
            return response()->json([
                'success' => false,
                'data'    =>'No any data'
            ]);
        }
    }
}
