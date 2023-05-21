<?php

namespace App\Http\service;


use App\Models\News;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Spatie\ImageOptimizer\OptimizerChainFactory;

class ImageService
{
    public function uploadImage($request ,$fileName,$uploadPath,) {
        try{
            $fileData = $request->file($fileName);

            //$newFileName = time() . '_' . uniqid() . '.' . $fileData->getClientOriginalExtension();
            $path = $fileData->store('public'.$uploadPath);
            $optimizerChain = OptimizerChainFactory::create();
            $optimizerChain->optimize(storage_path('app/' . $path));
            $imageUrl = URL::to('/') . Storage::url($path);
            return  $imageUrl;


        }
        catch (\Exception $exception){
            return $exception->getMessage();
        }

    }
    public function updateImage($updateData,$fileName,$uploadPath,$request)
    {
        if ($request->hasFile($fileName)) {
            // Get the previous file path and delete it
            $previous_file_path = $updateData->image_url;

            if (file_exists($previous_file_path) && !$previous_file_path == null && ($previous_file_path)) {
                unlink($previous_file_path);
            }
            $fileData = $request->file($fileName);
            //$newFileName = time() . '_' . uniqid() . '.' . $fileData->getClientOriginalExtension();
            $path = $fileData->store('public' . $uploadPath);
            $optimizerChain = OptimizerChainFactory::create();
            $optimizerChain->optimize(storage_path('app/' . $path));
            $imageUrl = URL::to('/') . Storage::url($path);
            return $imageUrl;
            // Upload the new file
        }
    }


}
