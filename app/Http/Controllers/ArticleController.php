<?php

namespace App\Http\Controllers;

use DOMDocument;
use App\Models\Article;
use App\Models\Categorie;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::where('active', true)
        ->whereNotNull('approuved_at')
        ->whereNotNull('approuved_by')
        ->orderBy('created_at', 'DESC')
        ->get();

        return view('publiRecentes', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        $relatedArticles = Article::where('active', true)
        ->whereNotNull('approuved_at')
        ->whereNotNull('approuved_by')
        ->where('categorie_article_id', $article->categorie_article_id)
        ->where('id', '!=', $article->id) // Excluez l'article actuel
        ->orderBy('created_at', 'desc')
        ->limit(3)
        ->get();

        $article->imgInit();

        $categories = Categorie::all();


        return view('blog-detail',compact('article','relatedArticles', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        return view('', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {

    }
}
