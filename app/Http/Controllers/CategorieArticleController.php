<?php

namespace App\Http\Controllers;

use App\Models\CategorieArticle;
use Illuminate\Http\Request;

class CategorieArticleController extends Controller
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
    public function show($categorieArticle)
    {
        // $articles = Article::where('categorie_article_id',$categorieArticle)->get();
        // return view("blog",$articles);
        return view("blog");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CategorieArticle $categorieArticle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CategorieArticle $categorieArticle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategorieArticle $categorieArticle)
    {
        //
    }
}
