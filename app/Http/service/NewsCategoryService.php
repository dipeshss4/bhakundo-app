<?php

namespace App\Http\service;

use App\Models\News_Category;
use http\Env\Request;

class NewsCategoryService
{
    private  $imageService;
    public function __construct(ImageService $imageService)
    {
        $this->imageService =$imageService;
    }

    public function addNewsCategory($request){
       try {
        return   News_Category::create([
               'category_name' => $request->get('category_name'),
               'description'  => $request->get('description'),
               'image_url'   => $this->imageService->uploadImage($request,'categoryImage','newsCategory'),
               'status'     => $request->get('status'),

           ]);
       }
       catch (\Exception $exception) {
           return $exception->getMessage();
       }
   }

   public  function  getAllNewsCategory(){
       return News_Category::OrderBy('created_at','DESC')->first();
   }
   public  function getNewsCategory($id){
        return News_Category::find($id);
   }
   public  function  updateNewsCategory($request,$id){
         return   News_Category::where('id',$id)->update([
            'category_name' => $request->get('category_name'),
            'description'  => $request->get('description'),
            'image_url'   => $this->imageService->uploadImage($request,'categoryImage','newsCategory'),
            'status'     => $request->get('status'),
        ]);

   }
}
