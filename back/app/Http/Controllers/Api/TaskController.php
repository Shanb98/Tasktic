<?php

namespace App\Http\Controllers\Api;
use App\Models\Task;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Task::with('project', 'category', 'employee')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|string|max:50',
            'project_id' => 'required|exists:projects,id',
            'category_id' => 'required|exists:categories,id',
            'employee_id' => 'required|exists:employees,id',
        ]);

        // Create a new task
        $task = Task::create($validatedData);

        // Return the created task with a success message
        return response()->json([
            'message' => 'Task created successfully!',
            'data' => $task
        ], 201);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Fetch the task with its related data
        $task = Task::with(['project', 'category', 'employee'])->findOrFail($id);

        // Return the task
        return response()->json($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'type' => 'nullable|string|max:50',
            'project_id' => 'nullable|exists:projects,id',
            'category_id' => 'nullable|exists:categories,id',
            'employee_id' => 'nullable|exists:employees,id',
        ]);

        // Find the task
        $task = Task::findOrFail($id);

        // Update the task
        $task->update($validatedData);

        // Return the updated task with a success message
        return response()->json([
            'message' => 'Task updated successfully!',
            'data' => $task
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the task
        $task = Task::findOrFail($id);

        // Delete the task
        $task->delete();

        // Return a success message
        return response()->json([
            'message' => 'Task deleted successfully!'
        ]);
    }
}
