<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bookmark;
use App\Models\House;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getBm(Request $request)
    {
        $userId = $request->user_id;

        $user = User::find($userId);

        return $user->bookmarks()->with(['user', 'images', 'videos'])->get();
    }
    public function storeBm(Request $request)
    {
        $userId = $request->user_id;
        $houseId = $request->house_id;

        $user = User::find($userId);
        $house = House::find($houseId);

        if(!$user || !$house)
        {
            response()->json(['error' => 'invalid'], 401);
        }

        if(Bookmark::where('user_id', $userId)->where('house_id', $houseId)->first() != null) {
            return response()->json(['error' => 'already exist'], 404);
        }

        $item = Bookmark::create(['user_id' => $userId, 'house_id' => $houseId]);
        return response()->json(['status' => 'success'], 200);
    }

    public function deleteBm(Request $request)
    {
        $userId = $request->user_id;
        $houseId = $request->house_id;

        $item = Bookmark::where('user_id', $userId)->where('house_id', $houseId)->first();

        if($item)
        {
            $item->delete();
            return response()->json(['status' => 'success'], 200);
        }
        else
            return response()->json(['error' => 'invalid'], 401);
    }
}
