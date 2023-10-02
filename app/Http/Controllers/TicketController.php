<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Organisation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        if($p){
            $partenaire = Organisation::findOrFail($p);
        }
        return view('new-ticket',compact('q','partenaire'));
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
            'user_id' => Auth::user()->id,
            'target_user_id' => $request->input('target_user_id'),
        ]);

    //   flasher()addSuccess('Votre requête à été prise en compte');

      return redirect()->route('home.index');
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
