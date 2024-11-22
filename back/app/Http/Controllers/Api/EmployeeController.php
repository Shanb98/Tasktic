<?php

namespace App\Http\Controllers\Api;
use App\Models\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Employee::with('project')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string',
            'username' => 'required|string',
            'position' => 'required|string',
            'project_id' => 'required|exists:projects,id',
        ]);

        return Employee::create($validated);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $employee->load('project');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'full_name' => 'string',
            'username' => 'string',
            'position' => 'string',
            'project_id' => 'exists:projects,id',
        ]);

        $employee->update($validated);

        return $employee;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee->delete();

        return response()->noContent();
    }
}
