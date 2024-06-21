<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateContractRequest;
use App\Models\Contract;
use App\Models\Post;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    public function store(CreateContractRequest $request) {
        $contract = Contract::create([
            'house_id' => $request->houseID,
            'tenant_id' => $request->tenantID,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date
        ]);
        $file = $request->file("file");
        if (!empty($file)) {
            $fileOriginalExtension = 'ContractFile' . '.' . $file->getClientOriginalExtension();
            $url = 'contract/' . $contract->id;
            $fileUrl = $file->storeAs($url, $fileOriginalExtension, 'public');
            $contract->file = $fileUrl;
            $contract->save();
        }
        return response()->json($contract);
    }

    public function getRentContract(Request $request)
    {
        $user_id = $request->userID;
        $postIDs = Post::where('user_id', $user_id)->pluck('id');
        $rentContracts = Contract::whereIn('house_id', $postIDs)->get();
        return response()->json($rentContracts);
    }

    public function getTenantContract(Request $request)
    {
        $user_id = $request->userID;
        $tenantContracts = Contract::where('tenant_id', $user_id)->get();
        return response()->json($tenantContracts);
    }
}
