<?php

namespace App\Http\Controllers;

use App\Models\EconomicGroup;

class EconomicGroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $economicGroups = collect(EconomicGroup::all());
        return view('economic_groups.index', compact('economicGroups'));
    }
}
