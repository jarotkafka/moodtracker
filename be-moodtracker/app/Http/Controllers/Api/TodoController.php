<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        return response()->json(Todo::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'mood' => 'required|string|min:3',
            'kategori' => 'required|string',
            'tanggal' => 'required|string',
            'completed' => 'nullable|boolean'
        ]);

        $mood = Todo::create($request->all());

        return response()->json([
            'message' => 'Mood has been added',
            'data' => $mood,
        ], 201);
    }

    public function show(string $id)
    {
        $mood = Todo::findOrFail($id);

        return response()->json([
            'data' => $mood
        ]);
    }

    public function update(Request $request, string $id)
    {
        $mood = Todo::findOrFail($id);

        $request->validate([
            'mood' => 'required|string|min:3',
            'kategori' => 'required|string',
            'tanggal' => 'required|string',
            'completed' => 'nullable|boolean'
        ]);

        $mood->update($request->all());

        return response()->json([
            'message' => 'Mood updated',
            'data' => $mood,
        ], 200);
    }

    public function toggleStatus(string $id)
    {
        $mood = Todo::findOrFail($id);
        $mood->completed = !$mood->completed;
        $mood->update();

        return response()->json([
            'message' => 'Status updated',
            'data' => $mood,
        ]);
    }

    public function destroy(string $id)
    {
        $mood = Todo::findOrFail($id);
        $mood->delete();

        return response()->json([
            'message' => 'Mood deleted',
        ], 200);
    }
}
