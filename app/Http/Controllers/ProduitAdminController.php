<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;
use App\Notifications\MonitoringStatusNotification;

class ProduitAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $produits = $this->filter($request);

        return view('admin.produit.index', [
            'produits' => $produits,
            'query' => ['search' => $request['search'], 'filter' => $request['filter']],
        ]);
    }

    private function filter(Request $request)
    {
        $filter = $request['filter'];
        $search = $request['search'];

        /** @var $user App\Model\User */
        $user = auth()->user();
        $isPartenaire = $user->isPartenaire() ? true : false;

        switch ($filter) {
            case 'approuved':
                $produits = Produit::where('active', true)
                    ->when($isPartenaire, function ($query) use ($user) {
                        return $query->where('author_id', $user->id);
                    })
                    ->where('status', 2)
                    ->when($search, function ($query) use ($search) {
                        return $query->where('nom', 'LIKE', "%$search%");
                    })
                    ->orderBy('created_at', 'desc')
                    ->paginate(25);
                break;
            case 'declined':
                $produits = Produit::where('active', true)
                    ->when($isPartenaire, function ($query) use ($user) {
                        return $query->where('author_id', $user->id);
                    })
                    ->where('status', 3)
                    ->when($search, function ($query) use ($search) {
                        return $query->where('nom', 'LIKE', "%$search%");
                    })
                    ->orderBy('created_at', 'desc')
                    ->paginate(25);
                break;
                case 'draft':
                    $produits = Produit::where('active', true)
                        ->when($isPartenaire, function ($query) use ($user) {
                            return $query->where('author_id', $user->id);
                        })
                        ->where('status', 5)
                        ->when($search, function ($query) use ($search) {
                            return $query->where('nom', 'LIKE', "%$search%");
                        })
                        ->orderBy('created_at', 'desc')
                        ->paginate(25);
                    break;
            case 'delete':
                $produits = Produit::where('active', false)
                    ->when($isPartenaire, function ($query) use ($user) {
                        return $query->where('author_id', $user->id);
                    })
                    ->when($search, function ($query) use ($search) {
                        return $query->where('nom', 'LIKE', "%$search%");
                    })
                    ->orderBy('created_at', 'desc')
                    ->paginate(25);
                break;
            default:
                $produits = Produit::where('active', true)
                    ->when($isPartenaire, function ($query) use ($user) {
                        return $query->where('author_id', $user->id);
                    })
                    ->when($search, function ($query) use ($search) {
                        return $query->where('nom', 'LIKE', "%$search%");
                    })
                    // A supprimer
                    ->where('author_id', 2)
                    ->where('status', 1)
                    ->orderBy('created_at', 'desc')
                    ->paginate(25);
                break;
        }

        return $produits;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.produit.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nom' => ['required', 'string', 'max:245'],
            'short_desc' => ['required', 'string'],
            'description' => ['required', 'string'],
            'stock' => ['required', 'integer'],
            'image' => ['nullable', 'image'],
            'status' => ['required', 'integer',]
        ]);

        $status = $data['status'] == 1 ? 1 : 5;

        $produit = Produit::create(array_merge($data, [
            'author_id' => auth()->user()->id,
            'status' => $status
        ]));

        if ($request['image']) {
            $imagePath = $data['image']->store("produits/$produit->id", 'public');

            $produit->update([
                'image' => $imagePath
            ]);
        }

        return to_route('produitAdmin.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produit $produitAdmin)
    {
        return view('admin.produit.show', [
            'produit' => $produitAdmin
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produit $produitAdmin)
    {
        return view('admin.produit.edit', [
            'produit' => $produitAdmin
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produit $produitAdmin)
    {
        $data = $request->validate([
            'nom' => ['required', 'string', 'max:245'],
            'short_desc' => ['required', 'string'],
            'description' => ['required', 'string'],
            'stock' => ['required', 'integer'],
        ]);

        $produitAdmin->update($data);

        return to_route('produitAdmin.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produit $produitAdmin)
    {
        $parentDirectory = dirname($produitAdmin->image);

        // dd($parentDirectory);

        Storage::disk('public')->deleteDirectory($parentDirectory);

        $produitAdmin->update([
            'active' => false
        ]);

        return to_route('produitAdmin.index')->with('sucess', 'Produits publié');
    }

    public function featured_image(Request $request, Produit $produit)
    {
        $data = $request->validate([
            'image' => ['required', 'image', 'max:2000']
        ]);

        Storage::disk('public')->delete($produit->image);

        $produit->image = $data['image']->store('produits/' . $produit->id, 'public');

        $produit->save();

        return back();
    }

    public function approuved(Produit $produit)
    {

        $approuveBy = auth()->user()->id;

        $produit->update([
            'approuved_at' => now(),
            'approuved_by' => $approuveBy,
            'status' => 2
        ]);

        Notification::send($produit->author, new MonitoringStatusNotification($produit, 'approved'));


        return back();
    }

    public function declined(Request $request, Produit $produit)
    {


        $data = $request->validate([
            'motif' => ['required', 'string']
        ]);

        $declinedBy = auth()->user()->id;

        $produit->update([
            'declined_at' => now(),
            'declined_by' => $declinedBy,
            'status' => 3,
        ]);

        Notification::send($produit->author, new MonitoringStatusNotification($produit, 'declined', $data['motif']));

        return back();
    }

    public function relaunch(Produit $produit)
    {
        // produit en attente
        $produit->update([
            'status' => 1,
            'declined_at' => null,
            'declined_by' => null,
        ]);

        return to_route('articleAdmin.index')->with('Produit relancé !');
    }

    // private function drafts (Produit $produit) {
    //     $produit;
    // }

    private function publish(Produit $produit)
    {
        // produit en attente
        $produit->update([
            'status' => 1
        ]);

        return to_route('articleAdmin.index')->with('Produit publié !, En attente de validation par les administrateurs');
    }
}
