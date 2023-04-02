<?php

namespace App\Http\service;

use App\Models\Team;

class TeamsService
{

    protected $ImageService;

    public function __construct(ImageService $ImageService)
    {
        $this->ImageService=$ImageService;
    }

    public  function  storeTeams($request){
      return Team::create([
         'name' =>$request->get('name'),
         'logo' =>$this->ImageService->uploadImage($request,'logo','/teamLogo'),
         'location' =>$request->get('location'),
         'coach'   =>$request->get('coach_name'),
         'coach_image' => $this->ImageService->uploadImage($request,'coach_image','/coachImage'),
          'status'  =>$request->get('status'),
          'league_id' =>$request->get('league_id'),
      ]);
   }
   public  function updateTeams($request,$id){
        return Team::where('id',$id)->update([
            'name' =>$request->get('name'),
            'logo' =>$this->ImageService->updateImage(Team::find($id),'logo','/teamLogo',$request),
            'location' =>$request->get('location'),
            'coach'   =>$request->get('coach_name'),
            'coach_image' => $this->ImageService->updateImage(Team::find($id),'coach_image','/coachImage',$request),
            'status'  =>$request->get('status'),
            'league_id' =>$request->get('league_id'),
        ]);
   }
}
