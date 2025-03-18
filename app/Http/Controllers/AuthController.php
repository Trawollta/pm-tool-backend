<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // Stelle sicher, dass der Pfad korrekt ist

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validierung der Eingabedaten
        $validatedData = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6'
        ]);

        // Neuen Benutzer erstellen, Passwort hashen
        $user = User::create([
            'name'     => $validatedData['name'],
            'email'    => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        // Token generieren, falls du Laravel Sanctum verwendest
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user'  => $user,
            'token' => $token,
        ], 201);
    }
}
