<?php

namespace App\Http\Controllers;

use App\Models\News;
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
        $restNews = News::with(['author.user', 'category'])
            ->whereHas('author.user', function($query) {
                $query->whereHas('roles', function($query) {
                    $query->where('name', 'editor');
                });
            })->where('is_trending',1)
            ->latest();

        if ($restNews){
            return response()->json([
                'success' =>true,
                'data' =>$restNews
            ],200);
        }

    }
}
