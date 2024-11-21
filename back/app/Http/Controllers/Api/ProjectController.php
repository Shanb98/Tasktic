<?php

namespace App\Http\Controllers\Api;
use App\Models\Project;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        // Fetch all projects
        $projects = Project::all();

        // Return the list of projects
        return response()->json([
            'message' => 'Projects retrieved successfully!',
            'projects' => $projects,
        ], 200);
    }
        /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate incoming data
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'duedate' => 'required|date', // Validate as a date
        ]);

        // Create a new project using the validated data
        $newProject = Project::create($data);

        // Return a response
        return response()->json([
            'message' => 'Project created successfully!',
            'project' => $newProject,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
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
