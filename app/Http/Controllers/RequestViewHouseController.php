<?php

namespace App\Http\Controllers;

use App\Models\RequestViewHouse;
use Illuminate\Http\Request;

class RequestViewHouseController extends Controller
{
    public function store(Request $request)
    {
        $request_view_house = RequestViewHouse::create([
            'user_id' => $request->userID,
            'house_id' => $request->houseID,
            'view_time' => $request->view_time,
            'status' => 1,
            'tenant_message' => $request->tenant_message
        ]);
    }
}
