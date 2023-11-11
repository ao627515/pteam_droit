@extends('layout')

@php
    use App\Models\Article;
@endphp

@section('content')
    <section class="blog pt-7 pb-7">
        <div class="container">
            <div class="row">
                <div class="col-md-8 order-last">
                    <!-- Posts -->
                    <div class="row">
                        @foreach ($articles as $article)
                            {{ $article->imgInit() }}
                            <div class="col-md-6">
                                <div class="single-post" data-animate="fadeInUp">
                                    <div class="image-hover-wrap">
                                        <a href="{{ route('article.show', $article) }}">
                                            <img src="{{ $article->image }} " alt=" ">
                                        </a>
                                    </div>
                                    {{-- <span>publie le {{ $article->created_at }}</span> --}}
                                    <h3 class="text-justify my-3">{{ $article->titre }}</h3>
                                    <span class="text-success">Publie le {{ $article->created_at }}</span>
                                    <p class="text-start mb-2">{{ $article->description }}</p>
                                    <a href="{{ route('article.show', $article) }}" class="text-primary">lire la
                                        suite</a>
                                </div>
                            </div>
                        @endforeach

                    </div>



                </div>

                <!-- Sidebar -->
                <div class="col-md-4">
                    <aside>
                        <div class="single-widget" data-animate="fadeInUp" data-delay=".1">
                            <form action="#">
                                <div class="form-group position-relative mb-0">
                                    <input class="form-control" type="text" placeholder="Search"
                                        data-parsley-required-message="Please type at least one word."
                                        data-parsley-minlength="3"
                                        data-parsley-minlength-message="Please type at least one word." required>
                                    <button type="submit"><i class="fas fa-search"></i></button>
                                </div>
                            </form>
                        </div>

                        <div class="single-widget" data-animate="fadeInUp" data-delay=".1">
                            <h3 data-animate="fadeInUp" data-delay=".2">Categories</h3>
                            <ul class="widget-categories list-unstyled mb-0">
                                @foreach ($categories as $categorie)
                                    <li data-animate="fadeInUp" data-delay=".25"><a
                                            href="{{ route('categorieArticle.show', $categorie->id) }}"><span>{{ $categorie->nom }}</span><span
                                                class="count">{{ Article::where('active', true)->where('status', 2)->where('categorie_article_id', $categorie->id)->get()->count() }}</span></a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </section>
    <div class="custom-pagination list-inline text-center text-uppercase mt-4">
        {{ $articles->links() }}
    </div>

    {{-- sidebar --}}
@endsection
