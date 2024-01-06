<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(Request $request) {
        $username = $request->username;
        $password = $request->password;

        $user = User::where('username', $username)->where('password', $password)->first();

        if(!$user)
            return response([], 404);

        return $user;
    }
}
