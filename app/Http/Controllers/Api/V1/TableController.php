<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $tables = Table::all();
        return $this->success($tables, 'Tables retrieved successfully');
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
            'numero_table' => 'required|string|unique:tables,numero_table',
            'capacite' => 'required|integer|min:1',
            'emplacement' => 'required|string|max:255',
            'statut' => 'required|string|in:disponible,occupée,réservée',
            'description' => 'nullable|string',
        ]);

        $table = Table::create($validatedData);

        return $this->success($table, 'Table created successfully', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $table = Table::find($id);

        if (!$table) {
            return $this->error('Table not found', 404);
        }

        return $this->success($table, 'Table retrieved successfully');
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
        $table = Table::find($id);

        if (!$table) {
            return $this->error('Table not found', 404);
        }

        $validatedData = $request->validate([
            'numero_table' => 'sometimes|required|string|unique:tables,numero_table,'.$table->id,
            'capacite' => 'sometimes|required|integer|min:1',
            'emplacement' => 'sometimes|required|string|max:255',
            'statut' => 'sometimes|required|string|in:disponible,occupée,réservée',
            'description' => 'nullable|string',
        ]);

        $table->update($validatedData);

        return $this->success($table, 'Table updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $table = Table::find($id);

        if (!$table) {
            return $this->error('Table not found', 404);
        }

        $table->delete();

        return $this->success(null, 'Table deleted successfully');
    }

    /**
     * Get available tables
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function available()
    {
        $tables = Table::where('statut', 'disponible')->get();
        return $this->success($tables, 'Available tables retrieved successfully');
    }
}