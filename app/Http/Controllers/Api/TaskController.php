<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Alle Tasks abrufen
    public function index()
    {
        $tasks = Task::all();
        return response()->json($tasks);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date'    => 'nullable|date',
            'assignees'   => 'nullable|array',
            'labels'      => 'nullable|array',
            'progress'    => 'nullable|integer|min:0|max:100',
            'creator'     => 'required|integer',
        ]);

        $task = Task::create($validated);
        return response()->json($task, 201);
    }

    // Einen Task anzeigen
    public function show(string $id)
    {
        $task = Task::findOrFail($id);
        return response()->json($task);
    }

    // Einen Task aktualisieren
    public function update(Request $request, string $id)
    {
        $task = Task::findOrFail($id);

        $validated = $request->validate([
            'title'       => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'due_date'    => 'nullable|date',
            'assignees'   => 'nullable|array',
            'labels'      => 'nullable|array',
            'progress'    => 'nullable|integer|min:0|max:100',
            'creator'     => 'sometimes|required|integer',
        ]);

        $task->update($validated);
        return response()->json($task);
    }

    // Einen Task löschen
    public function destroy(string $id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return response()->json(null, 204);
    }
}
