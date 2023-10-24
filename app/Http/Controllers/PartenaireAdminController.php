<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Domaine;
use App\Models\Partenaire;
use App\Models\Organisation;
use Illuminate\Http\Request;

class PartenaireAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $partenaires = $this->filter($request);

        return view(
            'admin.partenaire.index',
            [
                'partenaires' => $partenaires,
                'query' => ['search' => $request['search'], 'filter' => $request['filter']],
            ]
        );
    }

    private function filter(Request $request)
    {
        $filter = $request['filter'];

        $search = $request['search'];

        switch ($filter) {
            case 'approuved':
                $articles = User::where('active', true)
                    ->where('role', 'partenaire')
                    ->where('status', 2)
                    ->when($search, function ($query) use ($search) {
                        $query->where('nom', 'LIKE', "%$search%")
                            ->orWhere('prenom', 'LIKE', "%$search%")
                            ->orWhere('phone', 'LIKE', "%$search%")
                            ->orWhere('email', 'LIKE', "%$search%");
                        return $query;
                    })
                    ->orderBy('created_at', 'desc')
                    ->paginate(25);
                break;
            case 'declined':
                $articles = User::where('active', true)
                    ->where('role', 'partenaire')
                    ->where('status', 3)
                    ->when($search, function ($query) use ($search) {
                        $query->where('nom', 'LIKE', "%$search%")
                            ->orWhere('prenom', 'LIKE', "%$search%")
                            ->orWhere('phone', 'LIKE', "%$search%")
                            ->orWhere('email', 'LIKE', "%$search%");
                        return $query;
                    })
                    ->orderBy('created_at', 'desc')
                    ->paginate(25);
                break;
            case 'delete':
                $articles = User::where('active', false)
                    ->where('role', 'partenaire')
                    ->when($search, function ($query) use ($search) {
                        $query->where('nom', 'LIKE', "%$search%")
                            ->orWhere('prenom', 'LIKE', "%$search%")
                            ->orWhere('phone', 'LIKE', "%$search%")
                            ->orWhere('email', 'LIKE', "%$search%");
                        return $query;
                    })
                    ->orderBy('created_at', 'desc')
                    ->paginate(25);
                break;
            default:
                $articles = User::where('active', true)
                    ->where('role', 'partenaire')
                    ->where('status', 1)
                    ->when($search, function ($query) use ($search) {
                        $query->where('nom', 'LIKE', "%$search%")
                            ->orWhere('prenom', 'LIKE', "%$search%")
                            ->orWhere('phone', 'LIKE', "%$search%")
                            ->orWhere('email', 'LIKE', "%$search%");
                        return $query;
                    })
                    ->orderBy('created_at', 'desc')
                    ->paginate(25);
                break;
        }

        return $articles;
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $partenaireAdmin)
    {

        $organisation = Organisation::where('user_id', $partenaireAdmin->id)->get();

        return view('admin.partenaire.show',
        [
            'partenaire' => $partenaireAdmin,
            'organisation' => $organisation->first(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Partenaire $partenaire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Partenaire $partenaire)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Partenaire $partenaire)
    {
        //
    }
}
