<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Domaine;
use App\Models\Organisation;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use App\Notifications\PartnershipRequestNotification;

class PartenaireAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (Gate::denies('viewAny', User::class)) {
            return abort(404);
        }

        if (auth()->user()->isUser()) {
            return abort(404);
        }

        $partenaires = $this->filter($request);

        return view(
            'admin.partenaire.index',
            [
                'partenaires' => $partenaires,
                'query' => [
                    'search' => $request['search'],
                    'filter' => $request['filter']
                ],
            ]
        );
    }

    private function filter(Request $request)
    {
        $filter = $request['filter'];
        $search = $request['search'];

        $query = User::where('active', true)
            ->where('role', 'partenaire')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('nom', 'LIKE', "%$search%")
                        ->orWhere('prenom', 'LIKE', "%$search%")
                        ->orWhere('phone', 'LIKE', "%$search%")
                        ->orWhere('email', 'LIKE', "%$search%");
                });
            });

        switch ($filter) {
            case 'approuved':
                $query->where('status', 2);
                break;
            case 'declined':
                $query->where('status', 3);
                break;
            case 'delete':
                $query->where('active', false);
                break;
            default:
                $query->where('status', 1);
                break;
        }

        $partenaires = $query->orderBy('created_at', 'desc')->paginate(25);

        return $partenaires;
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
        if (Gate::denies('view', $partenaireAdmin)) {
            return abort(404);
        }
        $organisation = Organisation::where('user_id', $partenaireAdmin->id)->get();

        $domaines = Domaine::where('estPartenaire', 1)->get();

        return view(
            'admin.partenaire.show',
            [
                'partenaire' => $partenaireAdmin,
                'organisation' => $organisation->first(),
                'domaines' => $domaines,
                'notifications' => $partenaireAdmin->notifications()
                    ->whereJsonContains('data->partenaire_id', $partenaireAdmin->id)
                    ->whereJsonContains('data', 'motif')
                    ->get()
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $partenaire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $partenaireAdmin)
    {
        if (Gate::denies('update', $partenaireAdmin)) {
            return back()->with("error", Gate::inspect('update', $partenaireAdmin)->message());
        }
        // dump($request->all());
        $data = $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'phone' => ['required', 'integer', Rule::unique(User::class)->ignore($partenaireAdmin->id)],
            'email' => ['required', 'email', Rule::unique(User::class)->ignore($partenaireAdmin->id)],
            'old_password' => ['nullable', 'string', 'current_password'],
            'new_password' => ['nullable', 'string', Rule::requiredIf(function () use ($request) {
                return !empty($request->input('old_password'));
            }), 'min:6'],
            // 'new_password_confirmation' => 'required_if:new_password,|nullable|string|min:6',
        ]);

        // dd($data);

        if ($request->input('new_password')) {

            $partenaireAdmin->update(array_merge(
                $data,
                [
                    'password' => Hash::make($data['new_password'])
                ]
            ));
        } else {
            $partenaireAdmin->update($data);
        }

        return back()->with('success', 'Modifcation réussie');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $partenaire)
    {
        //
    }

    public function approuved(User $partenaire)
    {

        $approuveBy = auth()->user()->id;

        $partenaire->update([
            'approuved_at' => now(),
            'approuved_by' => $approuveBy,
            'status' => 2
        ]);

        $partenaire->notify(new PartnershipRequestNotification('approved'));

        return back();
    }

    public function declined(Request $request, User $partenaire)
    {

        $request->validate([
            'motif' => ['required', 'string']
        ]);

        $declinedBy = auth()->user()->id;

        // article en decliné
        $partenaire->update([
            'declined_at' => now(),
            'declined_by' => $declinedBy,
            'status' => 3,
        ]);

        $partenaire->notify(new PartnershipRequestNotification('declined_at', $request->input('motif')));
        return back();
    }
}
