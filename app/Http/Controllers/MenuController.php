<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::all();
        return view('menus.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('menus.create');
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
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date_menu' => 'required|date',
            'prix' => 'required|numeric|min:0',
            'type' => 'required|string|max:50',
            'categorie_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except('image');
        
        // Gérer le téléchargement de l'image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('menus', 'public');
            $data['image_path'] = $imagePath;
        }

        Menu::create($data);

        return redirect()->route('menus.index')
                        ->with('success', 'Menu créé avec succès.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        $menu->load('recettes');
        return view('menus.show', compact('menu'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        return view('menus.edit', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date_menu' => 'required|date',
            'prix' => 'required|numeric|min:0',
            'type' => 'required|string|max:50',
            'categorie_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except('image');
        
        // Gérer le téléchargement de l'image
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($menu->image_path) {
                Storage::disk('public')->delete($menu->image_path);
            }
            
            $imagePath = $request->file('image')->store('menus', 'public');
            $data['image_path'] = $imagePath;
        }

        $menu->update($data);

        return redirect()->route('menus.index')
                        ->with('success', 'Menu mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        // Supprimer l'image si elle existe
        if ($menu->image_path) {
            Storage::disk('public')->delete($menu->image_path);
        }
        
        $menu->delete();

        return redirect()->route('menus.index')
                        ->with('success', 'Menu supprimé avec succès.');
    }
}