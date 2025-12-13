<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Menu;
use App\Models\Categorie;
use Illuminate\Http\Request;

class MenuController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $menus = Menu::with('categorie')->get();
        return $this->success($menus, 'Menus retrieved successfully');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date_menu' => 'required|date',
            'prix' => 'required|numeric|min:0',
            'type' => 'required|string|in:brunch,déjeuner,dîner',
            'categorie_id' => 'required|exists:categories,id',
        ]);

        $menu = Menu::create($validatedData);

        return $this->success($menu, 'Menu created successfully', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $menu = Menu::with('categorie')->find($id);

        if (!$menu) {
            return $this->error('Menu not found', 404);
        }

        return $this->success($menu, 'Menu retrieved successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $menu = Menu::find($id);

        if (!$menu) {
            return $this->error('Menu not found', 404);
        }

        $validatedData = $request->validate([
            'nom' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'date_menu' => 'sometimes|required|date',
            'prix' => 'sometimes|required|numeric|min:0',
            'type' => 'sometimes|required|string|in:brunch,déjeuner,dîner',
            'categorie_id' => 'sometimes|required|exists:categories,id',
        ]);

        $menu->update($validatedData);

        return $this->success($menu, 'Menu updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $menu = Menu::find($id);

        if (!$menu) {
            return $this->error('Menu not found', 404);
        }

        $menu->delete();

        return $this->success(null, 'Menu deleted successfully');
    }

    /**
     * Get menus by category
     *
     * @param  int  $categoryId
     * @return \Illuminate\Http\JsonResponse
     */
    public function byCategory($categoryId)
    {
        $category = Categorie::find($categoryId);

        if (!$category) {
            return $this->error('Category not found', 404);
        }

        $menus = Menu::where('categorie_id', $categoryId)->get();

        return $this->success($menus, 'Menus retrieved successfully');
    }
}