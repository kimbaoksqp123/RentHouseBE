<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateHouseUtilityRequest;
use App\Models\HouseUtility;
use Illuminate\Http\Request;

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
                $imageOriginalExtension = 'HouseUtility_' . $house_utility->id . '.' . $image->getClientOriginalExtension();
                $url = 'image/' . $houseID;
                $imageUrl = $image->storeAs($url, $imageOriginalExtension, 'public');
                $house_utility->image = $imageUrl;
                $house_utility->save();
            }
        }
    }
}
