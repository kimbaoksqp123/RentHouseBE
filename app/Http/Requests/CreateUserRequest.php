<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
   public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'address' => 'required|string|max:255',
            'cccd_number' => 'required|string|max:20',
            'avatar' => 'nullable|array',
            'avatar.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Hãy nhập họ và tên của bạn',
            'phone.required' => 'Hãy nhập số điện thoại của bạn',
            'email.required' => 'Hãy nhập địa chỉ email của bạn',
            'email.email' => 'Địa chỉ email không hợp lệ',
            'email.unique' => 'Địa chỉ email đã tồn tại',
            'password.required' => 'Hãy nhập mật khẩu',
            'password.min' => 'Mật khẩu phải dài ít nhất 6 ký tự',
            'password.confirmed' => 'Mật khẩu xác nhận chưa giống với mật khẩu',
            'address.required' => 'Hãy nhập địa chỉ của bạn',
            'cccd_number.required' => 'Hãy nhập số CCCD của bạn',
            'avatar.array' => 'Avatar phải là một mảng',
            'avatar.*.image' => 'Tất cả các file avatar phải là ảnh',
            'avatar.*.mimes' => 'Ảnh avatar phải có định dạng: jpeg, png, jpg, gif, svg',
            'avatar.*.max' => 'Ảnh avatar không được vượt quá 2048KB',
        ];
    }
}
