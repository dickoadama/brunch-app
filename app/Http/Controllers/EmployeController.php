<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use Illuminate\Http\Request;

class EmployeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employes = Employe::latest()->paginate(10);
        return view('employes.index', compact('employes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employes.create');
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
            'prenom' => 'required|string|max:255',
            'email' => 'nullable|email|max:255|unique:employes',
            'telephone' => 'nullable|string|max:20',
            'poste' => 'required|string|max:255',
            'salaire' => 'nullable|numeric|min:0',
            'date_embauche' => 'required|date'
        ]);

        Employe::create($request->all());

        return redirect()->route('employes.index')->with('success', 'Employé créé avec succès.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employe  $employe
     * @return \Illuminate\Http\Response
     */
    public function show(Employe $employe)
    {
        return view('employes.show', compact('employe'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employe  $employe
     * @return \Illuminate\Http\Response
     */
    public function edit(Employe $employe)
    {
        return view('employes.edit', compact('employe'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employe  $employe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employe $employe)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'nullable|email|max:255|unique:employes,email,'.$employe->id,
            'telephone' => 'nullable|string|max:20',
            'poste' => 'required|string|max:255',
            'salaire' => 'nullable|numeric|min:0',
            'date_embauche' => 'required|date'
        ]);

        $employe->update($request->all());

        return redirect()->route('employes.index')->with('success', 'Employé mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employe  $employe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employe $employe)
    {
        $employe->delete();
        return redirect()->route('employes.index')->with('success', 'Employé supprimé avec succès.');
    }
}
