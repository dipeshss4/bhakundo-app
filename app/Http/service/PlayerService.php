<?php

namespace App\Http\service;

use App\Models\Player;

class PlayerService
{
    protected  $ImageService;
    public function __construct(ImageService $ImageService)
    {
        $this->ImageService=$ImageService;
    }

    public  function storePlayer($request){
        return Player::create([
            'player_name' =>$request->get('player_name'),
            'country'     => $request->get('country'),
            'position'    => $request->get('position'),
            'date_of_birth' =>$request->get('dob'),
            'team_id'      =>$request->get('team_id'),
            'status'       =>$request->get('status'),
            'player_image' =>$this->ImageService->uploadImage($request,'player_image','/playerImage')
        ]);
    }
    public  function updatePlayer($request,$id){
        return Player::where('id',$id)->update([
            'player_name' =>$request->get('player_name'),
            'country'     => $request->get('country'),
            'position'    => $request->get('position'),
            'date_of_birth' =>$request->get('dob'),
            'team_id'      =>$request->get('team_id'),
            'status'       =>$request->get('status'),
            'player_image' =>$this->ImageService->updateImage(Player::find($id),'player_image','/playerImage',$request)
        ]);
    }

}
