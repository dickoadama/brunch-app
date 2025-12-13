<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tables = Table::withCount('reservations')->latest()->paginate(10);
        return view('tables.index', compact('tables'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tables.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'numero_table' => 'required|integer|unique:tables',
            'capacite' => 'required|integer|min:1',
            'emplacement' => 'nullable|string|max:255',
            'statut' => 'required|in:disponible,occupée,réservée',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except('image');
        
        // Gérer le téléchargement de l'image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('tables', 'public');
            $data['image_path'] = $imagePath;
        }

        Table::create($data);

        return redirect()->route('tables.index')->with('success', 'Table créée avec succès.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function show(Table $table)
    {
        $table->load('reservations');
        return view('tables.show', compact('table'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function edit(Table $table)
    {
        return view('tables.edit', compact('table'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Table $table)
    {
        $request->validate([
            'numero_table' => 'required|integer|unique:tables,numero_table,'.$table->id,
            'capacite' => 'required|integer|min:1',
            'emplacement' => 'nullable|string|max:255',
            'statut' => 'required|in:disponible,occupée,réservée',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except('image');
        
        // Gérer le téléchargement de l'image
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($table->image_path) {
                Storage::disk('public')->delete($table->image_path);
            }
            
            $imagePath = $request->file('image')->store('tables', 'public');
            $data['image_path'] = $imagePath;
        }

        $table->update($data);

        return redirect()->route('tables.index')->with('success', 'Table mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Table  $table
     * @return \Illuminate\Http\Response
     */
    public function destroy(Table $table)
    {
        // Supprimer l'image si elle existe
        if ($table->image_path) {
            Storage::disk('public')->delete($table->image_path);
        }
        
        $table->delete();
        return redirect()->route('tables.index')->with('success', 'Table supprimée avec succès.');
    }
}