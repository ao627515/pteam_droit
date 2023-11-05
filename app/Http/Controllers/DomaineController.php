<?php

namespace App\Http\Controllers;

use App\Models\Domaine;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class DomaineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if(auth()->user()->isUser()){
            return abort(404);
        }
        
        $user = auth()->user();
        if ($user->role === "administrateur") {
            $search = $request['search'];

            $domaines = Domaine::when($search, function ($query) use ($search) {
                return $query->where('nom', 'LIKE', "%$search%");
            })
                ->where('active', true)
                ->orderBy('created_at', 'desc')
                ->paginate(25);

            return view(
                'admin.domaine.index',
                [
                    'domaines' => $domaines,
                    'query' => ['search' => $search],
                ]
            );
        }

        $domaines = [$user->organisation->domaine,];

        $allDomaines = Domaine::where('active', true)
            ->where('estPartenaire', 1)
            ->orderBy('created_at', 'desc')
            ->paginate(25);

        return view(
            'admin.domaine.index',
            [
                'domaines' => $domaines,
                "allDomaines" => $allDomaines
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
        // dd($request->all());
        $data = $request->validate([
            'nom' => ['required', 'string', 'max:245', 'unique:domaines,nom'],
            'icon' => ['nullable', 'image'],
            'estPartenaire' => ['required', 'boolean']
        ]);

        $domaine = Domaine::create($data);

        if ($request->icon) {

            $iconPath = $data['icon']->store("domaines/icons/$domaine->id", 'public');
            $domaine->update([
                'icon' => $iconPath
            ]);
        }

        return to_route('domaine.index')->with('success', 'Nouveau domaine enregistré');
    }

    /**
     * Display the specified resource.
     */
    public function show(Domaine $domaine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Domaine $domaine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Domaine $domaine)
    {
        // dump($domaine->id);
        $nom = "domaines_{$domaine->id}_nom";
        $icon = "icon_{$domaine->id}";
        $estPartenaire = "estPartenaire_{$domaine->id}";

        // dump($nom);
        // dump($icon);
        // dump($estPartenaire);
        // dd($request->all());

        $request->validate([
            $nom => ['required', 'string', 'max:245', Rule::unique(Domaine::class, 'nom')->ignore($domaine->id)],
            $icon => ['nullable', 'image'],
            $estPartenaire => ['required', 'boolean']
        ]);

        if ($request->input($icon)) {
            $domaine->update([
                'nom' => $request->input($nom),
                'icon' => $request->input($icon),
                'estPartenaire' => $request->input($estPartenaire),
            ]);
        } else {
            $domaine->update([
                'nom' => $request->input($nom),
                'estPartenaire' => $request->input($estPartenaire),
            ]);
        }

        return to_route('domaine.index')->with('success', 'Modification réussie !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Domaine $domaine)
    {
        $parentDirectory = dirname($domaine->image);

        Storage::disk('public')->deleteDirectory($parentDirectory);

        $domaine->delete();
        return to_route('domaine.index')->with('success', 'Suppression reussie !');
    }

    public function change(Request $request)
    {
        $data = $request->validate([
            'domaine' => 'required|integer|exists:domaines,id'
        ]);

        $user = auth()->user();

        $user->organisation->update([
            'domaine_id' => $data['domaine']
        ]);

        return back();
    }
}
