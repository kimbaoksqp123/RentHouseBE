<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Enums\House\HouseStatus;

class PostController extends Controller
{
    public function index(Request $request)
    {

        $query = Post::query();

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

        $posts = $query->with(['images', 'videos'])->get();

        foreach ($posts as $post) {

            $post['fullname'] = $post->user->name;
            $post['phone'] = $post->user->phone;
            unset($post['user']);

            foreach ($post->images as $image) {
                unset($image['created_at'], $image['updated_at']);
            }
        }

        // xác định các post có trong bookmark hay k ?
        $user = User::find($userId);

        if ($user) {
            $bookmarkedPosts = $user->bookmarks()->pluck('post_id')->toArray();

            foreach ($posts as $post) {
                $post['isSaved'] = in_array($post->id, $bookmarkedPosts);
            }
        }

        return $posts;
    }

    public function show(Request $request, $id)
    {
        $userId = $request->user_id;

        $post = Post::with(['user', 'images', 'videos','houseUtilities'])->find($id);

        if ($post) {
            $post->view_number++;
            $post->save();

            // post đã thêm vào bookmark hay chưa
            $user = User::find($userId);
            if ($user) {
                $bookmarkedPosts = $user->bookmarks()->pluck('post_id')->toArray();

                $post->isSaved = in_array($post->id, $bookmarkedPosts);
            }

            // thêm review
            $reviewController = new ReviewController();
            $post['reviews'] = $reviewController->index($userId, $post->id);
        }

        return $post;
    }

    public function featured()
    {
        $featuredPosts = Post::with('images')
            ->orderBy('view_number', 'desc')
            ->limit(5)
            ->get();
        return $featuredPosts;
    }

    public function similar(Request $request)
    {
        $id = $request->id;
        $price = $request->price;
        $district = $request->district;
        $ward = $request->ward;

        $query = Post::query()->with(['images', 'videos'])->whereNot('id', $id);

        // district
        if ($district && $ward)
            $query
                ->where('district', 'LIKE', "%$district%")
                ->where('ward', 'LIKE', "%$ward%");

        $query1 = $query;
        $res1 = $query1->get();

        // price
        if ($price) {
            $query->whereBetween('price', [$price - 500000, $price + 500000]);
        }
        $res = $query->get();

        if (count($res) > 2)
            return $res;
        else
            return $res1;
    }

    public function filter(Request $request)
    {

        $type = $request->type;
        $priceMin = $request->priceMin;
        $priceMax = $request->priceMax;
        $areaMin = $request->areaMin;
        $areaMax = $request->areaMax;
        $district = $request->district;
        $ward = $request->ward;
        $street = $request->street;

        $query = Post::query();
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

    public function store(Request $request)
    {
        $imagesHouseController = new ImagesHouseController();
        $imageFiles = $request->file("images");
        $house = Post::create([
            'user_id' => $request->userID,
            'title' => $request->title,
            'address' => $request->address,
            'ward' => $request->ward,
            'district' => $request->district,
            'price' => $request->price,
            'land_area' => $request->land_area,
            'type' => $request->type,
            'view_number' => 1,
            'description' => $request->description,
            'bedroom_num' => $request->bedroom_num,
            'bathroom_num' => $request->bathroom_num,
            'latitude' => 21.016964117655,
            'longitude' => 105.85215587642,
            'status' => HouseStatus::Empty,

        ]);
        // Lưu album ảnh

        $imagesHouseController->storeImagesHouse($request, $house);
        return response()->json($house);
    }

    // Get rent house data
    public function getRentHouse(Request $request)
    {
        $user_id = $request->userID;
        $rent_houses = Post::getRentHouse($user_id);
        return response()->json($rent_houses);
    }

    public function actionHouse(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'action' => 'required|string|in:hiden,delete,edit,unhiden,unrent'
        ]);

        $house = Post::find($request->id);
        if (!$house) {
            return response()->json(['error' => 'House not found'], 404);
        }

        switch ($request->action) {
            case 'hiden':
                $house->status = 3;
                break;
            case 'unhiden':
                $house->status = 1;
                break;
            case 'unrent':
                $house->status = 1;
                break;
            case 'delete':
                $house->delete();
                return response()->json(['message' => 'House deleted successfully']);
        }
        $house->save();
        return response()->json(['message' => 'House updated successfully']);
    }
}
