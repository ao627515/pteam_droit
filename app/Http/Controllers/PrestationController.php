<?php

namespace App\Http\Controllers;

use App\Models\Prestation;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PrestationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = auth()->user();

        $search = $request['search'];

        if ($user->role == 'administrateur') {
            $prestations = Prestation::when($search, function ($query) use ($search) {
                return $query->where('nom', 'LIKE', "%$search%");
            })
                ->where('active', true)
                ->orderBy('created_at', 'desc')
                ->paginate(25);

            $view = 'admin.prestation.index';
        }else{
            $allPrestations = Prestation::all();
            $prestations = $user->prestations;
            $view = 'admin.partenaire.prestation.index';
        }

        return view(
            $view,
            [
                'prestations' => $prestations,
                'query' => ['search' => $search],
                'allPrestations' => $allPrestations
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
        $user = auth()->user();

        if($user->role == "administrateur"){
            $data = $request->validate([
                'nom' => ['required', 'string', 'max:245', 'unique:prestations,nom']
            ]);

            Prestation::create($data);
        }else{
            $data = $request->validate([
                'prestation' => ['required', 'array']
            ]);

            $user->prestations()->sync($data['prestation']);
        }

        return to_route('prestation.index')->with('success', 'Nouvelle catégorie enregistré');
    }

    /**
     * Display the specified resource.
     */
    public function show(Prestation $prestation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prestation $prestation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prestation $prestation)
    {
        // dump($prestation->id);
        $key = "prestations_{$prestation->id}_nom";
        // dump($key);

        // dd($request->all());
        // Rule::unique(prestation::class, 'nom')->ignore($prestation->id)
        $request->validate([
            $key => ['required', 'string', 'max:245', Rule::unique(Prestation::class, 'nom')->ignore($prestation->id)],
        ]);

        $prestation->update([
            'nom' => $request->input($key),
        ]);

        return to_route('prestation.index')->with('success', 'Modification réussie !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prestation $prestation)
    {
        $prestation->delete();

        return to_route('prestation.index')->with('success', 'Suppression réussie !');
    }

    public function detach(Request $request, Prestation $prestation){


        $user = auth()->user();

        $user->prestations()->detach($prestation->id);

        return to_route('prestation.index')->with('success', 'Suppression réussie !');
    }
}
