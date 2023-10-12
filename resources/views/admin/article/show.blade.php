@extends('admin.layout')

@section('titre', 'article')

@section('content')
    <div class="container">
        <div class="py-3">
            <article class="article">
                <h1 class="article-titre text-center fw-bold ">{{ $article->titre }}</h1>

                <p class="article-date text-center">publié le </p>

                <div class="article-image mb-3 d-flex justify-content-center">
                    @if ($article->isFactory())
                        <img src="{{ $article->image }}" alt="{{ $article->titre }}" class="img-fluid" style="height: 300px">
                    @else
                        <img src="{{ $article->imageLink() }}" alt="{{ $article->titre }}" class="img-fluid"
                            style="height: 300px">
                    @endif
                </div>
                <div class="article-content">
                    @if ($article->isFActory())
                        {!! $article->contenu !!} <!-- Affiche le contenu Summernote sans échappement -->
                    @else
                        {{ $article->contenu }}
                    @endif
                </div>
            </article>

        </div>
    </div>
@endsection

@section('script')

@endsection
