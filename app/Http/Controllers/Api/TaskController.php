<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    
    public function index()
    {
        $tasks = Task::with(['category', 'subtasks'])->get();
        // Debug:
        foreach ($tasks as $task) {
            \Log::info('Task '.$task->id.' => category_id: '.$task->category_id);
        }
        return response()->json($tasks);
    }

    public function store(Request $request)
    {
        \Log::info('Incoming Task:', $request->all());

        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'description'  => 'nullable|string',
            'due_date'     => 'nullable|date',
            'assignees'    => 'nullable|array',
            'labels'       => 'nullable|array',
            'progress'     => 'nullable|integer|min:0|max:100',
            'creator'      => 'required|integer',
            'category_id'  => 'nullable|integer|exists:categories,id',
            'board_id'     => 'required|integer|exists:boards,id',
        ]);
    
        $task = Task::create($validated);
    
        return response()->json(
            $task->fresh()->load('category'),
            201
        );
    }

    public function show(string $id)
    {
        $task = Task::with('category')->findOrFail($id);
        return response()->json($task);
    }

    public function update(Request $request, string $id)
    {
        $task = Task::findOrFail($id);

        $validated = $request->validate([
            'title'        => 'sometimes|required|string|max:255',
            'description'  => 'nullable|string',
            'due_date'     => 'nullable|date',
            'assignees'    => 'nullable|array',
            'labels'       => 'nullable|array',
            'progress'     => 'nullable|integer|min:0|max:100',
            'creator'      => 'sometimes|required|integer',
            'category_id'  => 'nullable|integer|exists:categories,id',
        ]);

        $task->update($validated);
        return response()->json($task->fresh()->load('category'));
    }

    public function destroy(string $id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return response()->json(null, 204);
    }
}
