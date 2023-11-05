<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategorieController extends Controller
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

        $categories = Categorie::when($search, function ($query) use ($search) {
            return $query->where('nom', 'LIKE', "%$search%");
        })
            ->where('active', true)
            ->orderBy('created_at', 'desc')
            ->paginate(25);

        return view(
            'admin.categorie.index',
            [
                'categories' => $categories,
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
            'nom' => ['required', 'string', 'max:245', 'unique:categories,nom']
        ]);

        Categorie::create($data);

        return to_route('categorie.index')->with('success', 'Nouvelle catégorie enregistré');
    }

    /**
     * Display the specified resource.
     */
    public function show(Categorie $categorie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categorie $categorie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categorie $categorie)
    {
        // dump($categorie->id);
        $key = "categories_{$categorie->id}_nom";
        // dump($key);

        // dd($request->all());
        // Rule::unique(categorie::class, 'nom')->ignore($categorie->id)
        $request->validate([
            $key => ['required', 'string', 'max:245', Rule::unique(Categorie::class, 'nom')->ignore($categorie->id)],
        ]);

        $categorie->update([
            'nom' => $request->input($key),
        ]);

        return to_route('categorie.index')->with('success', 'Modification reussie !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categorie $categorie)
    {
        $categorie->delete();

        return to_route('categorie.index')->with('success', ' Suppression réussie !');
    }
}
