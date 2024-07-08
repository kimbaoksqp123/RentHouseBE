<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class ImagesHouseController extends Controller
{
    public function storeImagesHouse($request, $house)
    {
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

    public function updateImagesHouse($request, $house)
    {
        $oldImages = $house->images;
        $imageAlbum = $request->input('imageAlbum');
        $newImageFiles = $request->file('imageAlbum'); 
        $noChanceImages = array_filter($imageAlbum, function ($imageData) {
            return isset($imageData['url']);
        });
        $noChanceImageUrls = array_map(function ($imageData) {
            return $imageData['url'];
        }, $noChanceImages);

        foreach ($oldImages as $image) {
            $imageUrl = $image->url;
            if (!in_array($imageUrl, $noChanceImageUrls)) {
                Storage::disk('s3')->delete($imageUrl);
                $image->delete();
            }
        }

        if (!empty($newImageFiles)) {
            foreach ($newImageFiles as $image) {
                $imageUrl = Storage::disk('s3')->put('houses', $image);
                $house->images()->create(['url' => Storage::url($imageUrl)]);
            }
        }
    }
}
