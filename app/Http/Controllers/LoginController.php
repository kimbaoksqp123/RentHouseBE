<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(Request $request) {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Xác thực thành công, trả về thông tin người dùng
            return Auth::user();
        }

        // Xác thực thất bại, trả về mã lỗi 404
        return response([], 404);
    }
}
