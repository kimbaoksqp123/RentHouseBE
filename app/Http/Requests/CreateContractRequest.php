<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateContractRequest extends FormRequest
{
    public function authorize()
    {
        return true; 
    }

    public function rules()
    {
        return [
            'tenantID' => [
                'required',
                'exists:users,id' 
            ],
            'houseID' => [
                'required',
                'exists:posts,id' 
            ],
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'file' => 'required|file|max:4096', // Dung lượng tối đa là 4 MB (4096 KB)
        ];
    }

    public function messages()
    {
        return [
            'tenantID.exists' => 'ID người thuê không hợp lệ.',
            'end_date.after' => 'Thời gian kết thúc phải sau thời gian bắt đầu.',
            'file.max' => 'Dung lượng file không được vượt quá 4MB.'
        ];
    }
}
