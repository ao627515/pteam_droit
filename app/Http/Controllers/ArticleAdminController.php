<?php

namespace App\Http\Controllers;

use DOMDocument;
use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ArticleAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $articles = $this->filter($request);

        return view(
            'admin.article.index',
            [
                'articles' => $articles,
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
                $articles = Article::where('titre', 'LIKE', "%$search%")
                    ->where('approuved_at', '!=', null)
                    ->where('approuved_by', '!=', null)
                    ->where('active', true)
                    ->orderBy('created_at', 'desc')
                    ->paginate(25);
                break;
                // case 'declined':
                //     break;
            case 'delete':
                $articles = Article::where('titre', 'LIKE', "%$search%")
                    ->where('active', false)
                    ->orderBy('created_at', 'desc')
                    ->paginate(25);
                break;
            default:
                $articles = Article::where('titre', 'LIKE', "%$search%")
                    ->where('approuved_at', null)
                    ->where('approuved_by', null)
                    ->where('active', true)
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
        return view('admin.article.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dump($request->all());
        // Validation des données reçues
        $dataValidated = $request->validate([
            'titre' => ['required', 'string', 'max:245'],
            'image' => ['required', 'image',],
            'description' => ['required', 'string', 'max:245'],
            'contenu' => ['required', 'string'],
        ]);

        // dd(array_merge($dataValidated, ['slug' => Str::slug($dataValidated['titre'])]));

        // Création de l'article
        $article = Article::create(array_merge($dataValidated, [
            'slug' => Str::slug($dataValidated['titre']),
            'author_id' => auth()->user()->id
        ]));

        if (!$article) {
            return back()->with('error', 'Échec de l\'enregistrement, veuillez réessayer.');
        }

        // Traitement du contenu HTML
        $contenu = $dataValidated['contenu'];

        $dom = new DOMDocument();
        $dom->loadHTML('<?xml encoding="utf-8" ?>' . $contenu, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        if ($images = $dom->getElementsByTagName('img')) {
            foreach ($images as $key => $img) {
                $src = $img->getAttribute('src');
                $data = base64_decode(explode(',', explode(';', $img->getAttribute('src'))[1])[1]);
                $image_name = "articles/" . $article->id . '/contenu/' . time() . $key . '.png';
                Storage::disk('public')->put($image_name, $data);

                $img->removeAttribute('src');
                $img->setAttribute('src', '/storage/' . $image_name);
                $img->setAttribute('class', 'img-fluid');
            }

            $contenu = $dom->saveHTML();
            $article->contenu = $contenu;
        }

        // Traitement de l'image de couverture
        $article->image = $dataValidated['image']->store('articles/' . $article->id, 'public');
        $article->save();

        return redirect()->route('articleAdmin.index')->with('success', 'Article publié avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $articleAdmin)
    {
        return view('admin.article.show', [
            'article' => $articleAdmin
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $articleAdmin)
    {
        return view('admin.article.edit', [
            'article' => $articleAdmin
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $articleAdmin)
    {
        $dataValidated = $request->validate([
            'titre' => ['required', 'string'],
            'description' => ['required', 'string', 'max:255'],
            'contenu' => ['required', 'string'],
        ]);

        $originalContent = $articleAdmin->contenu; // Contenu d'origine
        $updatedContent = $dataValidated['contenu']; // Contenu mis à jour

        $originalDom = new DOMDocument();
        $originalDom->loadHTML($originalContent, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        $updatedDom = new DOMDocument();
        $updatedDom->loadHTML('<?xml encoding="utf-8" ?>' . $updatedContent, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        // dd($updatedDom);


        $originalImages = $originalDom->getElementsByTagName('img');

        foreach ($originalImages as $img) {
            $src = $img->getAttribute('src');

            // Vérifier si l'image d'origine n'est pas présente dans le contenu mis à jour
            if (strpos($updatedContent, $src) === false) {
                // Supprimer l'image du stockage
                $imagePath = str_replace('/storage/', '', $src);
                Storage::disk('public')->delete($imagePath);
            }
        }

        $newImages = $updatedDom->getElementsByTagName('img');

        foreach ($newImages as $key => $img) {

            // Check if the image is a new one
            if (strpos($img->getAttribute('src'), 'data:image/') === 0) {

                $data = base64_decode(explode(',', explode(';', $img->getAttribute('src'))[1])[1]);
                $image_name = "articles/" . $articleAdmin->id . '/contenu/' . time() . $key . '.png';
                Storage::disk('public')->put($image_name, $data);

                $img->removeAttribute('src');
                $img->setAttribute('src', '/storage/' . $image_name);
                $img->setAttribute('class', 'img-fluid');
            }
        }

        $dataValidated['contenu'] =  $updatedDom->saveHTML();

        $articleAdmin->update($dataValidated);

        return to_route('articleAdmin.index')->with('success', 'Articles Modifier');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $articleAdmin)
    {
        $parentDirectory = dirname($articleAdmin->image);

        Storage::disk('public')->deleteDirectory($parentDirectory);

        $articleAdmin->update([
            'active' => false
        ]);

        return to_route('articleAdmin.index')->with('sucess', 'Articles publié');
    }

    public function featured_image(Request $request, Article $article)
    {
        $data = $request->validate([
            'image' => ['required', 'image', 'max:2000']
        ]);

        Storage::disk('public')->delete($article->image);

        $article->image = $data['image']->store('articles/' . $article->id, 'public');

        $article->save();

        return back();
    }

    public function approuved(Article $article)
    {

        $approuveBy = auth()->user()->id;

        // dd($article);

        $article->update([
            'approuved_at' => now(),
            'approuved_by' => $approuveBy
        ]);

        return back();
    }
}
