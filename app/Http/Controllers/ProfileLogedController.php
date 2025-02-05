<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileLogedController extends Controller
{
    public function index (Request $request)
    {
        return view('profile.index', [
            'user' => $request->user(),
        ]);
    }
}
