<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class ImagesHouseController extends Controller
{
    public function storeImagesHouse($request, $house)
    {
        $url = "houses/$house->id";
        $imageFiles = $request->file('imageAlbum');

        if (!empty($imageFiles)) {

            $count = 0;
            foreach ($imageFiles as $image) {
                $imageUrl = Storage::disk('s3')->put('houses', $image);
                $house->images()->create(['url' => Storage::url($imageUrl)]);
                $count++;
            }
        }
    }
}
