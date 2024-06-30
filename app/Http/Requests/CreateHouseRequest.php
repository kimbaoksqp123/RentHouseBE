<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateHouseRequest extends FormRequest
{
    public function rules()
    {
        return [
            'userID' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'ward' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'price' => 'required|integer',
            'land_area' => 'required|integer',
            'type' => 'required|integer',
            'description' => 'required|string',
            'bedroom_num' => 'required|integer',
            'bathroom_num' => 'required|integer',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'utilities' => 'required|array',
            'utilities.*.price' => 'required|integer|min:0',
            'utilities.*.quantity' => 'required|integer|min:1',
            'utilities.*.utility_id' => 'required|integer|exists:utilities,id',
            'utilities.*.image' => 'nullable|image|max:2048',
        ];
    }
}
