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
        $search = $request['search'];

        $prestations = Prestation::when($search, function ($query) use ($search) {
            return $query->where('nom', 'LIKE', "%$search%");
        })
            ->where('active', true)
            ->orderBy('created_at', 'desc')
            ->paginate(25);

        return view(
            'admin.prestation.index',
            [
                'prestations' => $prestations,
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
            'nom' => ['required', 'string', 'max:245', 'unique:prestations,nom']
        ]);

        prestation::create($data);

        return to_route('prestation.index')->with('success', 'Nouvelle catégorie enregistré');
    }

    /**
     * Display the specified resource.
     */
    public function show(prestation $prestation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(prestation $prestation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, prestation $prestation)
    {
        // dump($prestation->id);
        $key = "Prestations_{$prestation->id}_nom";
        // dump($key);

        // dd($request->all());
        // Rule::unique(prestation::class, 'nom')->ignore($prestation->id)
        $request->validate([
            $key => ['required', 'string', 'max:245', Rule::unique(prestation::class, 'nom')->ignore($prestation->id)],
        ]);

        $prestation->update([
            'nom' => $request->input($key),
        ]);

        return to_route('prestation.index')->with('success', 'Nouvelle prestation ajouté !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(prestation $prestation)
    {
    }
}
