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
        try {
        return News::create([
             'title' =>$request->get('title'),
             'content' =>$request->get('content'),
             'image_url' =>$this->imageService->uploadImage($request,'image_url','/news'),
             'video_url' =>$request->get('video_url'),
             'score'    =>$request->get('score')
         ]);
        }
        catch (\Exception $exception){
            return $exception->getMessage();
        }
    }
    public  function  getAllNews(){
        return News::all();

    }
    public function  editNews($id){
        return News::find($id);
    }
    public function update(){

    }

}
