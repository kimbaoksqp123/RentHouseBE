<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateContractRequest;
use App\Models\Contract;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Enums\House\HouseStatus;
use Illuminate\Support\Facades\Storage;

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
            $fileUrl = Storage::disk('s3')->put('contracts',$file);
            $contract->file = Storage::url($fileUrl);
            $contract->save();
        }

        if ($contract->post) {
            $contract->post->status = HouseStatus::Hidden;
            $contract->post->save();
        }
        return response()->json($contract);
    }

    public function getContractWithID(Request $request)
    {
        $id = $request->id;
        $contract = Contract::findOrFail($id);
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
        foreach ($tenantContracts as $tenantContract) {
            $post = Post::where('id', $tenantContract->house_id)->first();
            if ($post) {
                $tenantContract->rent_id = $post->user_id;
            } else {
                // Handle the case where no post is found for the given house_id
                $tenantContract->rent_id = null; // Or any default value you prefer
            }
        }
        return response()->json($tenantContracts);
    }
}
