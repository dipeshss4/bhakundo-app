<?php

namespace App\Http\service;

use App\Models\News;

class NewsService
{
    private  ImageService $imageService;
    public function __construct(ImageService $imageService)
    {
        $this->imageService=$imageService;
    }

    public  function    addNews($request){

        return News::create([
             'title' =>$request->get('news_title'),
             'content' =>$request->get('content'),
             'image_url' =>$this->imageService->uploadImage($request,'image','/newsImage'),
             'video_url' =>$request->get('video_url'),
             'author_id' =>$request->get('author_id'),
             'news_category_id' =>$request->get('news_category'),
             'score'    =>$request->get('score'),
             'status'  =>$request->get('status'),
             'is_trending' =>$request->get('is_trending'),
             'featured'  =>$request->get('is_featured'),
             'recommend' =>$request->get('is_recommended'),
             'meta_description' =>$request->get('meta_description')
         ]);


    }
    public  function  getAllNews(){
        return News::with(['author.user', 'category'])
            ->whereHas('author.user', function($query) {
                $query->whereHas('roles', function($query) {
                    $query->where('name', 'editor');
                });
            })
            ->get();


    }
    public function  editNews($id){
        return News::find($id);
    }
    public function update($request,$id){
      return News::Where('id',$id)->update([
          'title' =>$request->get('news_title'),
          'content' =>$request->get('content'),
          'image_url' =>$this->imageService->updateImage(News::find($id),'image','/newsImage',$request),
          'video_url' =>$request->get('video_url'),
          'author_id' =>$request->get('author_id'),
          'news_category_id' =>$request->get('news_category'),
          'score'    =>0,
          'status'  =>$request->get('status'),
          'is_trending' =>$request->get('is_trending'),
          'featured'  =>$request->get('is_featured'),
          'recommend' =>$request->get('is_recommended'),
           'meta_description' =>$request->get('meta_description')
      ]);
    }


}
