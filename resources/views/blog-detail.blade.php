@php
    use App\Models\Article;
@endphp
@extends('layout')

@section('content')
    <section class="page-title-wrap position-relative bg-light">
        <div id="particles_js"></div>
        <div class="container">
            <div class="row">
                <div class="col-11">
                    <div class="page-title position-relative pt-5 pb-5">
                        <ul class="custom-breadcrumb roboto list-unstyled mb-0 clearfix" data-animate="fadeInUp"
                            data-delay="1.2">
                            <li><a href="home.html">Home</a></li>
                            <li><i class="fas fa-angle-double-right"></i></li>
                            <li><a href="#">Details</a></li>
                        </ul>
                        <h1 data-animate="fadeInUp" data-delay="1.3">details</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End of Banner -->
    <section class="blog pt-7 pb-7">
        <div class="container">
            <div class="row">
                <div class="col-md-8 order-last">
                    <!-- Posts -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="single-post" data-animate="fadeInUp">
                                <div class="image-hover-wrap">
                                    <img src="{{ $article->image }} " alt=" ">
                                </div>
                                {{-- <span>publie le {{ $article->created_at }}</span> --}}
                                <h5 class="text-center my-3">{{ $article->titre }}</h5>
                                <span class="text-success text-center">Publie le {{ $article->created_at }}</span><br>
                                @if ($article->isFActory())
                                    {{ $article->contenu }} <!-- Affiche le contenu Summernote sans échappement -->
                                @else
                                    {!! $article->contenu !!}
                                @endif
                            </div>
                        </div>

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

                        <div class="single-widget mt-3" data-animate="fadeInUp" data-delay=".1">
                            <h3 data-animate="fadeInUp" data-delay=".1">Articles recents</h3>

                            @foreach ($relatedArticles as $relatedArticle)
                                {{ $relatedArticle->imgInit() }}
                                <div class="card mt-3">
                                    <div class="row">
                                        <div class="col ">
                                            <a href="{{ route('article.show', $relatedArticle) }}"><img
                                                    src="{{ $article->image }}" alt=""></a>
                                        </div>
                                        <div class="col">
                                            <a
                                                href="{{ route('article.show', $relatedArticle) }}"></a>{{ $relatedArticle->titre }}
                                            <br>
                                            <a href="{{ route('article.show', $relatedArticle) }}" class="text-primary">lire
                                                la
                                                suite</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>


                        <div class="single-widget mt-3" data-animate="fadeInUp" data-delay=".1">
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
                        <div class="single-widget text-center" data-animate="fadeInUp" data-delay=".1">
                            <h3 data-animate="fadeInUp" data-delay=".2">Advertisement</h3>
                            <img src="img/camera.jpg" alt="" data-animate="fadeInUp" data-delay=".25">
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </section>
@endsection
