<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\House;
use App\Models\User;
use Illuminate\Http\Request;

class HouseController extends Controller
{
    public function index(Request $request)
    {

        $query = House::query();

        $sortType = $request->query('sortType', 0);
        $type = $request->type;
        $priceMin = $request->priceMin;
        $priceMax = $request->priceMax;
        $areaMin = $request->areaMin;
        $areaMax = $request->areaMax;
        $district = $request->district;
        $ward = $request->ward;
        $street = $request->street;
        $userId = $request->user_id;
        //sort:
        switch ($sortType) {
            case 1:
                $query->orderBy('created_at', 'desc');
                break;
            case 2:
                $query->orderBy('price', 'asc');
                break;
            case 3:
                $query->orderBy('price', 'desc');
                break;
            case 4:
                $query->orderBy('land_area', 'asc');
                break;
            case 5:
                $query->orderBy('land_area', 'desc');
        }
        //filter:
        // type
        if (isset($type))
            $query->whereIn('type', $type);

        // price
        if ($priceMin || $priceMax)
            $query->comparePrice($priceMin, $priceMax);

        // area
        if ($areaMin || $areaMax)
            $query->compareArea($areaMin, $areaMax);

        // district
        if ($district)
            $query->where('district', 'LIKE', "%$district%");

        if ($ward)
            $query->where('ward', 'LIKE', "%$ward%");

        if ($street)
            $query->where('street', 'LIKE', "%$street%");

        $houses = $query->with(['images', 'videos'])->get();

        foreach ($houses as $house) {

            $house['fullname'] = $house->user->name;
            $house['phone'] = $house->user->phone;
            unset($house['user']);

            foreach ($house->images as $image) {
                unset($image['created_at'], $image['updated_at']);
            }
        }

        // xác định các house có trong bookmark hay k ?
        $user = User::find($userId);

        if($user) {
            $bookmarkedHouses = $user->bookmarks()->pluck('house_id')->toArray();

            foreach ($houses as $house) {
                $house['isSaved'] = in_array($house->id, $bookmarkedHouses);
            }
        }

        return $houses;
    }

    public function show(Request $request, $id)
    {
        $userId = $request->user_id;

        $house = House::with(['user', 'images', 'videos'])->find($id);

        $house->view_number++;
        $house->save();

        // house đã thêm vào bookmark hay chưa
        $user = User::find($userId);
        if($user) {
            $bookmarkedHouses = $user->bookmarks()->pluck('house_id')->toArray();

            $house->isSaved = in_array($house->id, $bookmarkedHouses);
        }

        // thêm review
        $reviewController = new ReviewController();
        $house['reviews'] = $reviewController->index($userId, $house->id);

        return $house;
    }

    public function featured()
    {
        $featuredHouses = House::with('images')
            ->orderBy('view_number', 'desc')
            ->limit(5)
            ->get();
        return $featuredHouses;
    }

    public function similar(Request $request) {
        $id = $request->id;
        $price = $request->price;
        $district = $request->district;
        $ward = $request->ward;

        $query = House::query()->with(['images', 'videos'])->whereNot('id', $id);

        // district
        if ($district && $ward)
        $query
            ->where('district', 'LIKE', "%$district%")
            ->where('ward', 'LIKE', "%$ward%");

        $query1 = $query;
        $res1 = $query1->get();

        // price
        if ($price){
            $query->whereBetween('price', [$price - 500000, $price + 500000]);
        }
        $res = $query->get();

        if(count($res) > 2)
            return $res;
        else
            return $res1;
    }

    public function filter(Request $request) {

        $type = $request->type;
        $priceMin = $request->priceMin;
        $priceMax = $request->priceMax;
        $areaMin = $request->areaMin;
        $areaMax = $request->areaMax;
        $district = $request->district;
        $ward = $request->ward;
        $street = $request->street;

        $query = House::query();
//        return $type;
        // type
        if (isset($type))
            $query->whereIn('type', $type);

        // price
        $query->comparePrice($priceMin, $priceMax);

        // area
        $query->compareArea($areaMin, $areaMax);

        // district
        if ($district)
            $query->where('district', 'LIKE', "%$district%");

        if ($ward)
            $query->where('ward', 'LIKE', "%$ward%");

        if ($street)
            $query->where('street', 'LIKE', "%$street%");

        $result = $query->with(['images', 'videos'])->get();

        return $result;

    }
}
