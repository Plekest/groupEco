<?php

namespace App\Http\Controllers;

use App\Models\EconomicGroup;
use Illuminate\Http\Request;

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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $economicGroup = EconomicGroup::create([
            'name' => $request->name
        ]);

        return response()->json($economicGroup);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
