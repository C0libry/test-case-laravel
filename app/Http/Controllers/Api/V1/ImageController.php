<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Image;

class ImageController extends Controller
{
    public function findImage($imageId)
    {
        return response()->json(['success' => true, 'data' => Image::find($imageId)]);
    }
    public function getImagesInfo()
    {
        return response()->json(['success' => true, 'data' => Image::paginate(5)]);
    }
}
