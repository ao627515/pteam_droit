<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Organisation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SendrequeteRequest;
use App\Notifications\EnvoieRequteNotification;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $partenaire = null;
        $q = $request->input('q');
        $p = $request->input('p');
        if ($p) {
            $partenaire = Organisation::findOrFail($p);
        }
        return view('new-ticket', compact('q', 'partenaire'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SendrequeteRequest $request)
    {
        try {
            // Obtenir l'utilisateur connecté
            /** @var $user App\Model\User */
            $user = Auth::user();

            // Valider les données de la requête
            $data = $request->validated();

            // Ajouter l'ID de l'utilisateur aux données
            $data['user_id'] = $user->id;

            // Récupérer le message du formulaire
            $data['message'] = $request->input('msg');

            // Créer un nouveau ticket avec les données
            $ticket = Ticket::create($data);

            // Vérifier si le ticket est créé avec succès
            if ($ticket) {
                $nom = $user->nom;
                $prenom = $user->prenom;
                $objet = $ticket->objet;
                // Envoyer la notification par courriel à l'utilisateur
                $user->notify(new EnvoieRequteNotification($nom, $prenom, $objet));

                // Rediriger l'utilisateur vers la page d'accueil avec un message de succès
                return redirect()->route('home.index')->with('success', 'Ticket créé avec succès!');
            } else {
                // Rediriger avec un message d'erreur si le ticket n'est pas créé
                return redirect()->route('home.index')->with('error', 'Erreur lors de la création du ticket.');
            }
        } catch (\Exception $e) {
            // Enregistrez l'erreur dans les journaux de l'application
            Log::error($e->getMessage());

            // Rediriger avec un message d'erreur en cas d'exception
            return redirect()->route('home.index')->with('error', 'Erreur lors de la création du ticket.');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
}
