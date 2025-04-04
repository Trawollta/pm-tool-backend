<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Alle Boards laden, inkl. zugehöriger Tasks
        $boards = Board::with('tasks')->get();
        return response()->json($boards);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validierung
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'creator' => 'nullable|exists:users,id',
        ]);

        // Neues Board erstellen
        $board = Board::create($validated);

        return response()->json($board, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Ein einzelnes Board inkl. Tasks laden
        $board = Board::with('tasks')->findOrFail($id);
        return response()->json($board);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Board finden
        $board = Board::findOrFail($id);

        // Validierung
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Board aktualisieren
        $board->update($validated);

        return response()->json($board);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Board finden und löschen
        $board = Board::findOrFail($id);
        $board->delete();

        return response()->json(['message' => 'Board deleted']);
    }
}
