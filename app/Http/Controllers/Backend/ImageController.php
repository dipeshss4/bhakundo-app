<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class ImageController extends Controller
{
    /**
     * @throws FileIsTooBig
     * @throws FileDoesNotExist
     */
    public  function uploadImage(Request $request){
        $news= new News();
        $news->id =0;
        $news->exists =true;

        if ($request->hasFile('upload') && $request->file('upload')->isValid()){
            // Add the media file to the saved News object
            $image = $news->addMediaFromRequest('upload')->toMediaCollection('upload');
            // Get the URL of the uploaded image
            $url = $image->getUrl();
            // Return the URL
            return  response()->json([
                'uploaded' =>true,
                'url'=>$url,
            ],200);
        } else {
            // Return an error message if no valid file was uploaded
            return 'Error: No valid file uploaded';
        }


    }
}
