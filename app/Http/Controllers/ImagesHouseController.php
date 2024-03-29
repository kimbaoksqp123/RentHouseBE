<?php

namespace App\Http\Controllers;

class ImagesHouseController extends Controller
{
    public function storeImagesHouse($request, $house)
    {
        $url = "houses/$house->id";
        $imageFiles = $request->file('imageAlbum');

        if (!empty($imageFiles)) {

            $count = 0;
            foreach ($imageFiles as $image) {
                // Lưu file vào storage/app/public/image -> file được link tới thư mục public/storage/image
                $imageOriginalExtension = 'House_' . $house->id . '_' . $count . '.' . $image->getClientOriginalExtension();
                $url = 'image/'.$house->id;
                $imageUrl = $image->storeAs($url, $imageOriginalExtension, 'public');
                $house->images()->create(['url' => $imageUrl]);
                $count++;
            }
        }
    }
}
