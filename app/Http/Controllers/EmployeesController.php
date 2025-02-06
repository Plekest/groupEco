<?php

namespace App\Http\Controllers;

use App\Models\Employee;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = collect(Employee::all());
        return view('employees.index', compact('employees'));
    }
}
