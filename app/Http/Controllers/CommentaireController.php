<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Commentaire;
use Illuminate\Http\Request;

class CommentaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */


    public function index()
    {
        //
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

        $newcomment = new Commentaire();
        $newcomment->contenu = $request->input('contenu');
        $newcomment->ticket_id = $request->input('ticket_id');
        $newcomment->non_lu = true;
        $newcomment->save();

        $ticket = Ticket::findOrFail($request->input('ticket_id'));
        if ($ticket->commentaire->count() > 0) {
            $ticket->status = 1;
            $ticket->save();
        }


        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $ticket = Ticket::findOrFail($id);
        $commentaires = $ticket->commentaire;
        return view('admin.ticket.conversation', compact('ticket', 'commentaires'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
