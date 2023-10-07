@extends('admin.layout')

@section('titre', 'article')

@section('content')
    <div class="container">
        <div class="py-3">
            <article class="article">
                <h1 class="article-titre text-center fw-bold ">{{$article->titre }}</h1>

                <p class="article-date text-center">publié le </p>

                <div class="article-image mb-3 d-flex justify-content-center">
                    <img src="{{$article->imageLink() }}" alt="{{$article->titre }}" class="img-fluid" style="height: 300px">
                </div>
                <div class="article-content">
                    {!!$article->contenu !!} <!-- Affiche le contenu Summernote sans échappement -->
                </div>
            </article>

        </div>
    </div>
@endsection

@section('script')

@endsection
