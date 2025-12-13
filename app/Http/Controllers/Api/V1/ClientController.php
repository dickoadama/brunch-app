<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ClientController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $clients = Client::all();
        return $this->success($clients, 'Clients retrieved successfully');
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
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email',
            'telephone' => 'nullable|string|max:20',
            'adresse' => 'nullable|string|max:500',
            'date_naissance' => 'nullable|date',
        ]);

        $client = Client::create($validatedData);

        return $this->success($client, 'Client created successfully', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $client = Client::find($id);

        if (!$client) {
            return $this->error('Client not found', 404);
        }

        return $this->success($client, 'Client retrieved successfully');
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
        $client = Client::find($id);

        if (!$client) {
            return $this->error('Client not found', 404);
        }

        $validatedData = $request->validate([
            'nom' => 'sometimes|required|string|max:255',
            'prenom' => 'sometimes|required|string|max:255',
            'email' => [
                'sometimes',
                'required',
                'email',
                Rule::unique('clients')->ignore($client->id)
            ],
            'telephone' => 'nullable|string|max:20',
            'adresse' => 'nullable|string|max:500',
            'date_naissance' => 'nullable|date',
        ]);

        $client->update($validatedData);

        return $this->success($client, 'Client updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $client = Client::find($id);

        if (!$client) {
            return $this->error('Client not found', 404);
        }

        $client->delete();

        return $this->success(null, 'Client deleted successfully');
    }
}