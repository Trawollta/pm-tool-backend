<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Channel;
use Illuminate\Http\Request;

class ChannelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Alle Channels abrufen
        $channels = Channel::all();
        return response()->json($channels);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validierung der eingehenden Daten
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'creator'     => 'required|integer',
            'members'     => 'nullable|array',
        ]);

        // Einen neuen Channel erstellen
        $channel = Channel::create($validated);

        return response()->json($channel, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Channel anhand der ID abrufen oder 404 zurückgeben
        $channel = Channel::findOrFail($id);
        return response()->json($channel);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Den Channel abrufen
        $channel = Channel::findOrFail($id);

        // Validierung der aktualisierten Daten
        $validated = $request->validate([
            'name'        => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'creator'     => 'sometimes|required|integer',
            'members'     => 'nullable|array',
        ]);

        // Den Channel aktualisieren
        $channel->update($validated);

        return response()->json($channel);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Den Channel abrufen und löschen
        $channel = Channel::findOrFail($id);
        $channel->delete();

        return response()->json(null, 204);
    }
}
