<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateHouseUtilityRequest;
use App\Models\HouseUtility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HouseUtilityController extends Controller
{
    public function store($request, $house)
    {
        $houseID = $house->id;
        $utilities = $request->utilities;
        //utility/housID/Utility_utility_id_...
        foreach ($utilities as $utility) {
            $house_utility = HouseUtility::create([
                'house_id' => $houseID,
                'price' => $utility['price'],
                'quantity' => $utility['quantity'],
                'utility_id' => $utility['utility_id'],
            ]);
            $image = $utility['image'];
            if (!empty($image)) {
                $imageUrl = Storage::disk('s3')->put('utilities', $image);
                $house_utility->image = Storage::url($imageUrl);
                $house_utility->save();
            }
        }
    }
    public function update($request, $house)
    {
        $utilities = $request->utilities;
        foreach ($utilities as $utility) {
            if (!empty($utility['id'])) {
                $house_utility = HouseUtility::findOrFail($utility['id']);
                $house_utility->update([
                    'price' => $utility['price'],
                    'quantity' => $utility['quantity'],
                    'utility_id' => $utility['utility_id'],
                ]);
                $image = $utility['image'];
                if (!empty($image)) {
                    $oldImage = $house_utility->image;
                    Storage::disk('s3')->delete($oldImage);
                    $imageUrl = Storage::disk('s3')->put('utilities', $image);
                    $house_utility->image = Storage::url($imageUrl);
                    $house_utility->save();
                }
            } else {
                $house_utility = HouseUtility::create([
                    'house_id' => $house->id,
                    'price' => $utility['price'],
                    'quantity' => $utility['quantity'],
                    'utility_id' => $utility['utility_id'],
                ]);
                $image = $utility['image'];
                if (!empty($image)) {
                    $imageUrl = Storage::disk('s3')->put('utilities', $image);
                    $house_utility->image = Storage::url($imageUrl);
                    $house_utility->save();
                }
            }
        }
    }
}
