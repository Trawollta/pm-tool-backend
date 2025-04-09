<?php

namespace App\Http\Controllers; // ✅ DAS FEHLTE

use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'sender_id' => 'required|integer',
            'content' => 'required|string',
            'conversation_type' => 'required|in:channel,direct',
            'conversation_id' => 'required|integer',
            'timestamp' => 'required|date'
        ]);

        $message = Message::create($validated);

        return response()->json($message, 201);
    }

    public function index(Request $request)
    {
        $validated = $request->validate([
            'conversation_type' => 'required|in:channel,direct',
            'conversation_id' => 'required|integer'
        ]);

        $messages = Message::where('conversation_type', $validated['conversation_type'])
                            ->where('conversation_id', $validated['conversation_id'])
                            ->orderBy('timestamp')
                            ->get();

        return response()->json($messages);
    }
}
