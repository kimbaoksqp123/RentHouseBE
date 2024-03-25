<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Utility;

class UtilityController extends Controller
{
    public function index() {
        $utilities = Utility::all();
        return $utilities;
    }
}
