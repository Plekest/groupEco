<?php

namespace App\Http\Controllers;

use App\Models\Flag;

class FlagsController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $flags = collect(Flag::all());
        return view('flags.index', compact('flags'));
    }
}
