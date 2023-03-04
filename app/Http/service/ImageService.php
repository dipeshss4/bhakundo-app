<?php

namespace App\Http\service;

use Spatie\ImageOptimizer\OptimizerChainFactory;

class ImageService
{
    public function uploadImage($request ,$fileName,$uploadPath,) {
        try{
            $fileData = $request->get($fileName);
            $newFileName = time() . '_' . uniqid() . '.' . $fileData->getClientOriginalExtension();
            $path = $fileData->store('public');
            $optimizerChain = OptimizerChainFactory::create();
            $optimizerChain->optimize(storage_path('app/' . $path));
            $imageUrl = asset($uploadPath . $path);
            return  $imageUrl;


        }
        catch (\Exception $exception){
            return $exception->getMessage();
        }
    }
}
