<?php

namespace App\Http\Controllers;

use App\Models\TypeCompte;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TypeCompteController extends Controller
{
/**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if(auth()->user()->isUser()){
            return abort(404);
        }
        
        $search = $request['search'];

        $typeComptes = TypeCompte::when($search, function ($query) use ($search) {
            return $query->where('nom', 'LIKE', "%$search%");
        })
            ->where('active', true)
            ->orderBy('created_at', 'desc')
            ->paginate(25);

        return view(
            'admin.type_compte.index',
            [
                'typeComptes' => $typeComptes,
                'query' => ['search' => $search],
            ]
        );
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
        $data = $request->validate([
            'nom' => ['required', 'string', 'max:245', 'unique:typeCompte,nom']
        ]);

        TypeCompte::create($data);

        return to_route('prestation.index')->with('success', 'Nouvelle catégorie enregistré');
    }

    /**
     * Display the specified resource.
     */
    public function show(TypeCompte $typeCompte)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TypeCompte $typeCompte)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TypeCompte $typeCompte)
    {
        // dump($prestation->id);
        $key = "typeComptes_{$typeCompte->id}_frais";
        // dump($key);

        // dd($request->all());

        $request->validate([
            $key => ['required', 'integer'],
        ]);

        $typeCompte->update([
            'frais' => $request->input($key),
        ]);

        return to_route('typeCompte.index')->with('success', 'Modification réussie !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TypeCompte $typeCompte)
    {
        $typeCompte->delete();

        return to_route('typeCompte.index')->with('success', 'Suppression réussi !');
    }
}
