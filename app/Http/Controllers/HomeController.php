<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Prestation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   $user = Auth::user();
        $prestations = Prestation::where('active', true)->orderBy('created_at', 'desc')->limit(6)->get();
        $articles = Article::where('active', true)
            ->whereNotNull('approuved_at')
            ->whereNotNull('approuved_by')
            ->orderBy('created_at', 'DESC')
            ->limit(4)
            ->get();

        $partenaires = DB::table('domaines')
            ->join('organisations', 'domaines.id', '=', 'organisations.domaine_id')
            ->where('domaines.estPartenaire', 1)->orderBy('organisations.created_at', 'DESC')->limit(8)->get();
        // dd($partenaires);
        return view('home', compact('articles', 'partenaires', 'prestations','user'));
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
    public function show(string $id)
    {
        //
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
