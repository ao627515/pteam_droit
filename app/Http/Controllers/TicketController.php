<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Prestation;
use App\Models\Commentaire;
use App\Models\Organisation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function mettreAjourStatutTicket($ticketId)
    {
        // Vérifiez si le ticket a au moins un commentaire
        $ticket = Ticket::find($ticketId);
        if ($ticket) {
            $commentCount = Commentaire::where('ticket_id', $ticket->id)->count();
            if ($commentCount > 0 && $ticket->status == 0) {
                $ticket->status = 2; // Mettre à jour le statut en cours
                $ticket->save();
            }
        }
    }
    public function index(Request $request)
    {

        if (auth()->user()->isUser()) {
            return abort(404);
        }

        $tickets = $this->filter($request);

        return view(
            'admin.ticket.liste-ticket',
            [
                'tickets' => $tickets,
                'query' => ['search' => $request['search'], 'filter' => $request['filter']],
            ]
        );
    }

    private function filter(Request $request)
    {
        $filter = $request['filter'];

        $search = $request['search'];

        switch ($filter) {
            case '2':
                $tickets = Ticket::where('active', true)
                    ->where('status', '2')
                    ->when($search, function ($query) use ($search) {
                        $query->where('type', 'LIKE', "%$search%");
                        return $query;
                    })
                    ->orderBy('created_at', 'desc')
                    ->paginate(15);
                break;
            case '3':
                $tickets = Ticket::where('active', true)
                    ->where('status', '3')
                    ->when($search, function ($query) use ($search) {
                        $query->where('type', 'LIKE', "%$search%");
                        return $query;
                    })
                    ->orderBy('created_at', 'desc')
                    ->paginate(15);
                break;
            default:
                $tickets = Ticket::where('active', true)
                    ->where('status', '1')
                    ->when($search, function ($query) use ($search) {
                        $query->where('type', 'LIKE', "%$search%");

                        return $query;
                    })
                    ->orderBy('created_at', 'desc')
                    ->paginate(15);
                break;
        }

        return $tickets;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $prestations = Prestation::all();
        $partenaire = null;
        $q = $request->input('q');
        $p = $request->input('p');
        if ($p) {
            $partenaire = Organisation::findOrFail($p);
            if ($partenaire->owner) {
                $prestations = $partenaire->owner->prestations;
            }
        }
        return view('new-ticket', compact('q', 'partenaire', 'prestations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'objet' => 'required',
            'msg' => 'required',
        ]);

        $ticket = Ticket::create([
            'objet' => $request->input('objet'),
            'message' => $request->input('msg'),
            'type' => $request->input('type'),
            'ticket_id' => Auth::ticket()->id,
            'status' => 0,
            'target_ticket_id' => $request->input('target_ticket_id'),
        ]);
        $ticket->save();
        // $ticket = new Ticket([
        //     'objet' => $request->input('objet'),
        //     'message' => $request->input('msg'),
        //     'statut' => 0, // Statut "En attente"
        //     // Assurez-vous d'ajouter ici d'autres données nécessaires pour le ticket
        // ]);

        // $ticket->save();

        //   flasher()addSuccess('Votre requête à été prise en compte');

        return redirect()->route('home.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $ticket = Ticket::find($id);
        $commentaires = $ticket->commentaire;
        return view('admin.ticket.voir-ticket', compact('ticket', 'commentaires'));
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



    public function changer(Request $request)
    {
        $ticketId = $request->input('id');
        $newStatus = $request->input('status');

        $ticket = Ticket::find($ticketId);

        if (!$ticket) {
            return redirect()->back()->with('error', 'Ticket non trouvé.');
        }

        $ticket->status = $newStatus;
        $ticket->save();


        return to_route('ticket.index')->with('success', 'Statut du ticket modifié avec succès.');
    }


    //
}
