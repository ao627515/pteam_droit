@extends('admin.layout')

@section('titre', 'article')
{{ $article->imgInit() }}
@section('content')
    <div class="container">
        <div class="py-3">
            <article class="article">
                <h1 class="article-titre text-center fw-bold ">{{ $article->titre }}</h1>

                @if ($article->approuvedBy)
                    <p class="article-date text-center">publié le : {{ $article->approuved_at }}</p>
                    @else
                    <p class="lead text-center">Article non publié</p>
                @endif

                <div class="article-image mb-3 d-flex justify-content-center">
                    <img src="{{ $article->image }}" alt="{{ $article->titre }}" class="img-fluid" style="height: 300px">
                </div>
                <div class="article-content">
                    @if ($article->isFActory())
                        {{ $article->contenu }} <!-- Affiche le contenu Summernote sans échappement -->
                    @else
                        {!! $article->contenu !!}
                    @endif
                </div>
            </article>

        </div>
    </div>
@endsection

@section('script')

@endsection
