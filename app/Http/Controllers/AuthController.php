<?php

namespace App\Http\Controllers;

use App\Enums\User\UserType;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CreateUserRequest;

class AuthController extends Controller
{
    public function login(Request $request) {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Xác thực thành công, trả về thông tin người dùng
            return Auth::user();
        }

        // Xác thực thất bại, trả về mã lỗi 404
        return response([], 404);
    }

    public function register(CreateUserRequest $request) {
        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address' => $request->address,
            'cccd_number' => $request->cccd_number,
            'type' => UserType::USER,
        ]);
        $avatar = $request->file("avatar");
        if (!empty($avatar)) {
            $imageOriginalExtension = 'UserAvatar' . '.' . $avatar[0]->getClientOriginalExtension();
            $url = 'image/user/' . $user->id;
            $imageUrl = $avatar[0]->storeAs($url, $imageOriginalExtension, 'public');
            $user->avatar = $imageUrl;
            $user->save();
        }
        return response()->json($user);
    }
}
