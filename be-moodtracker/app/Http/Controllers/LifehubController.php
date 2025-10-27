<?php

namespace App\Http\Controllers;

use App\Models\lifehub;
use Illuminate\Http\Request;

class LifehubController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(lifehub::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tugas' => 'required|string',
            'kategori' => 'required|string',
            'tanggal' => 'required|string',
            'completed' => 'nullable|boolean'
        ]);

        $lifehub = lifehub::create($request->all());

       return response()->json([
            'message' => 'Tugas has been added',
            'data' => $lifehub,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lifehub = lifehub::FindOrfail($id);
        return response()->json([
            'data' => $lifehub,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(lifehub $lifehub)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $lifehub = lifehub::findOrFail($id);

        $request->validate([
            'tugas' => 'required|string',
            'kategori' => 'required|string',
            'tanggal' => 'required|string',
            'completed' => 'nullable|boolean'
        ]);

        $lifehub->update($request->all());
        return response()->json([
            'message' => 'Tugas has been updated',
            'data' => $lifehub,
        ], 200);
    }

    public function toggleStatus(string $id)
    {
        $lifehub = lifehub::findOrFail($id);
        $lifehub->completed = !$lifehub->completed;
        $lifehub->update();

        return response()->json([
            'message' => 'Status updated',
            'data' => $lifehub,
        ]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $lifehub = lifehub::findOrFail($id);
        $lifehub->delete();
        return response()->json([
            'message' => 'Tugas has been deleted',
        ], 200);
    }
}
