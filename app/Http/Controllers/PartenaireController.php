<?php

namespace App\Http\Controllers;

use App\Models\Domaine;
use App\Models\Partenaire;
use App\Models\Organisation;
use Illuminate\Http\Request;

class PartenaireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $domaines = Domaine::where('estPartenaire',true)->paginate(15);
        return view('partenaires',compact('domaines'));
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
    public function show($id)
    {
        $domaine = Domaine::find($id);
        $domaines = Domaine::where('estPartenaire',1)->get();
        $partenaires = Organisation::where('domaine_id',$id)->paginate(15);
        return view('partenaire',compact('partenaires','domaine','domaines'));
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
