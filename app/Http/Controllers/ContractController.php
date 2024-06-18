<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateContractRequest;
use App\Models\Contract;

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
}
