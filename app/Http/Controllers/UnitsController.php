<?php

namespace App\Http\Controllers;

use App\Models\Unit;

class UnitsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $units = collect(Unit::all());
        return view('units.index', compact('units'));
    }
}
