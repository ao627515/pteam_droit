<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ProduitStatusNotification;

class ProduitAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (Gate::denies('viewAny', Produit::class)) {
            return abort(404);
        }

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

        $query = Produit::where('active', true)
            ->when($isPartenaire, function ($query) use ($user) {
                return $query->where('author_id', $user->id);
            })
            ->when($search, function ($query) use ($search) {
                return $query->where('nom', 'LIKE', "%$search%");
            })
            ->orderBy('created_at', 'desc');

        switch ($filter) {
            case 'approuved':
                $query->where('status', 2);
                break;
            case 'declined':
                $query->where('status', 3);
                break;
            case 'draft':
                $query->where('status', 5);
                break;
            case 'delete':
                $query = Produit::where('active', false);
                break;
            default:
                $query->where('status', 1);
                break;
        }

        return $query->paginate(25);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Gate::denies('create', Produit::class)) {
            return abort(404);
        }

        return view('admin.produit.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Gate::denies('create', Produit::class)) {
            return back()->with("error", Gate::inspect('create', Produit::class)->message());
        }

        $data = $request->validate([
            'nom' => ['required', 'string', 'max:245'],
            'short_desc' => ['required', 'string'],
            'description' => ['required', 'string'],
            'stock' => ['required', 'integer'],
            'image' => ['nullable', 'image'],
            'status' => ['required', 'integer',],
            'prix' => ['required', 'integer',]
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
        if (Gate::denies('view', $produitAdmin)) {
            return abort(404);
        }

        /** @var $user App\Model\User  */
        $user = auth()->user();

        $notifications = $user->notifications()
            ->whereJsonContains('data->produit_id', $produitAdmin->id)
            ->whereJsonContains('data', 'motif')
            ->get();

        return view('admin.produit.show', [
            'produit' => $produitAdmin,
            'notifications' => $notifications,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produit $produitAdmin)
    {
        if (Gate::denies('update', $produitAdmin)) {
            return abort(404);
        }

        return view('admin.produit.edit', [
            'produit' => $produitAdmin
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produit $produitAdmin)
    {
        if (Gate::denies('update', $produitAdmin)) {
            return back()->with("error", Gate::inspect('update', $produitAdmin)->message());
        }

        $data = $request->validate([
            'nom' => ['required', 'string', 'max:245'],
            'short_desc' => ['required', 'string'],
            'description' => ['required', 'string'],
            'stock' => ['required', 'integer'],
            'prix' => ['required', 'integer',]
        ]);

        $produitAdmin->update($data);

        return to_route('produitAdmin.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produit $produitAdmin)
    {
        if (Gate::denies('delete', $produitAdmin)) {
            return back()->with("error", Gate::inspect('delete', $produitAdmin)->message());
        }

        // $parentDirectory = dirname($produitAdmin->image);

        // // dd($parentDirectory);

        // Storage::disk('public')->deleteDirectory($parentDirectory);

        $produitAdmin->update([
            'active' => false
        ]);

        return to_route('produitAdmin.index')->with('success', 'Produits publié');
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
        if (Gate::denies('approuved', $produit)) {
            return back()->with("error", Gate::inspect('approuved', $produit)->message());
        }

        $approuveBy = auth()->user()->id;

        $produit->update([
            'approuved_at' => now(),
            'approuved_by' => $approuveBy,
            'status' => 2
        ]);

        Notification::send($produit->author, new ProduitStatusNotification($produit, 'approved'));


        return back();
    }

    public function declined(Request $request, Produit $produit)
    {

        if (Gate::denies('declined', $produit)) {
            return back()->with("error", Gate::inspect('declined', $produit)->message());
        }

        $data = $request->validate([
            'motif' => ['required', 'string']
        ]);

        $declinedBy = auth()->user()->id;

        $produit->update([
            'declined_at' => now(),
            'declined_by' => $declinedBy,
            'status' => 3,
        ]);

        Notification::send($produit->author, new ProduitStatusNotification($produit, 'declined', $data['motif']));

        return back();
    }

    public function relaunch(Produit $produit)
    {
        if (Gate::denies('relaunch', $produit)) {
            return back()->with("error", Gate::inspect('relaunch', $produit)->message());
        }

        // produit en attente
        $produit->update([
            'status' => 1,
            'declined_at' => null,
            'declined_by' => null,
        ]);

        return to_route('produitAdmin.index')->with('Produit relancé !');
    }

    public function publish(Produit $produit)
    {
        if (Gate::denies('publish', $produit)) {
            return back()->with("error", Gate::inspect('publish', $produit)->message());
        }

        // produit en attente
        $produit->update([
            'status' => 1
        ]);

        return to_route('produitAdmin.index')->with('Produit publié !, En attente de validation par les administrateurs');
    }
}
