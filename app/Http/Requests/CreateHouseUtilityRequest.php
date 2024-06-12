<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateHouseUtilityRequest extends FormRequest
{
   public function rules()
    {
        return [
            'utilities' => 'required|array',
            'utilities.*.houseID' => 'required|integer|exists:posts,id',
            'utilities.*.price' => 'required|integer|min:0',
            'utilities.*.quantity' => 'required|integer|min:1',
            'utilities.*.utility_id' => 'required|integer|exists:utilities,id',
            'utilities.*.image' => 'nullable|image|max:2048',
        ];
    }
}
