<?php

namespace App\Http\service;

use App\Models\League;

class LeaugeService
{
    private $ImageService;
    public function __construct(ImageService $ImageService)
    {
        $this->ImageService= $ImageService;
    }

    public function storeLeauge($request ){
       return League::create([
           'name' => $request->get('name'),
          'country' =>$request->get('country'),
          'start_year' => $request->get('start_year'),
          'year_ending' =>$request->get('year_ending'),
          'logo' => $this->ImageService->uploadImage($request,'logo','/LeagueLogo'),
          'status' =>$request->get('status')
       ]);
   }
   public  function updateLeague($request,$id){
        return League::where('id',$id)->update([
            'name' => $request->get('name'),
            'country' =>$request->get('country'),
            'start_year' => $request->get('start_year'),
            'year_ending' =>$request->get('year_ending'),
            'logo' => $this->ImageService->updateImage(League::find($id),'logo','/LeagueLogo',$request),
            'status' =>$request->get('status')
        ]);
   }

}
