<?php

namespace App\Http\Controllers;

use App\Models\RequestViewHouse;
use Illuminate\Http\Request;
use App\Enums\RequestViewHouse\RequestStatus;

class RequestViewHouseController extends Controller
{
    public function store(Request $request)
    {
        $request_view_house = RequestViewHouse::create([
            'user_id' => $request->userID,
            'house_id' => $request->houseID,
            'view_time' => $request->view_time,
            'status' => RequestStatus::Pending,
            'tenant_message' => $request->tenant_message
        ]);
    }
    // Get tenant request view house data
    public function getTenantRequestViewHouse(Request $request)
    {
        $user_id = $request->userID;
        $tenant_request_view_houses = RequestViewHouse::getTenantRequestViewHouse($user_id);
        return response()->json($tenant_request_view_houses);
    }

    public function actionTenantRequestViewHouse(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'id' => 'required|integer',
            'action' => 'required|string|in:accept,reject,delete, cacncel'
        ]);

        $rentRequest = RequestViewHouse::find($request->id);
        if (!$rentRequest) {
            return response()->json(['error' => 'Request not found'], 404);
        }
        switch ($request->action) {
            case 'accept':
                $rentRequest->status = RequestStatus::Approved;
                break;
            case 'reject':
                $rentRequest->status = RequestStatus::Rejected;
                break;
            case 'delete':
                $rentRequest->delete();
                return response()->json(['message' => 'Request deleted successfully']);
            case 'cancel':
                $rentRequest->status = RequestStatus::Canceled;
                break;
            default:
                return response()->json(['error' => 'Invalid action'], 400);
        }
        $rentRequest->rent_message = $request->message;
        $rentRequest->save();
        return response()->json(['message' => 'Request updated successfully']);
    }
    // Get your request view house data
    public function getRentRequestViewHouse(Request $request)
    {

        $user_id = $request->userID;
        $tenant_request_view_houses = RequestViewHouse::getRentRequestViewHouse($user_id);
        return response()->json($tenant_request_view_houses);
    }

    public function actionRentRequestViewHouse(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'id' => 'required|integer',
            'action' => 'required|string|in:delete,cancel'
        ]);

        $rentRequest = RequestViewHouse::find($request->id);
        if (!$rentRequest) {
            return response()->json(['error' => 'Request not found'], 404);
        }
        switch ($request->action) {
            case 'cancel':
                $rentRequest->status = RequestStatus::Canceled;
                $rentRequest->rent_message = null;
                break;

            case 'delete':
                $rentRequest->delete();
                return response()->json(['message' => 'Request deleted successfully']);
            default:
                return response()->json(['error' => 'Invalid action'], 400);
        }
        $rentRequest->tenant_message = $request->message;
        $rentRequest->save();
        return response()->json(['message' => 'Request updated successfully']);
    }
}
