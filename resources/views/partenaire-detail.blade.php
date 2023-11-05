@extends('layout')

@section('content')
    <style>
        .image-hover-wrap {
            text-align: center;
        }

        .image-hover-wrap img {
            height: 220px !important;
        }

        .truncate-title {
            -webkit-line-clamp: 2;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
    <section class="page-title-wrap position-relative bg-light">
        <div id="particles_js"></div>
        <div class="container">
            <div class="row">
                <div class="col-2 pt-5 pb-5">
                    <img src="{{ asset($organisation->logo) }}" alt="" alt="" data-no-retina class="svg">
                </div>
                <div class="col-9">
                    <div class="page-title position-relative pt-5 pb-5">
                        <ul class="custom-breadcrumb roboto list-unstyled mb-0 clearfix" data-animate="fadeInUp"
                            data-delay="1.2">
                            <li><a href="index.html">Accueil</a></li>
                            <li><i class="fas fa-angle-double-right"></i></li>
                            <li><a href="#">{{ $domaine->nom }}</a></li>
                        </ul>
                        <h1 data-animate="fadeInUp" data-delay="1.3" class="bg-light">{{ $organisation->nom }}</h1>
                        <span class="badge badge-light mt-1" style="font-size: 1.2em">{{ strtoupper($domaine->nom) }}</span>
                        <br><a href="{{ route('ticket.create', ['p' => $organisation->id]) }}"
                            class="btn btn-primary m-2">Contacter <i class="fas fa-phone"></i></a>
                    </div>
                </div>
                <div class="col-1">
                    <div class="world-map position-relative">
                        <img src="img/map.svg" alt="" alt="" data-no-retina class="svg">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog -->
    <section class="blog pt-3 pb-7">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card pb-4 mb-4">
                        <div class="card-header">
                            <h2 class="card-title">Description</h2>
                        </div>
                        <div class="card-body">
                            <p class="text-justify">{{ $organisation->description }}</p>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <h2 class="card-title">Prestations de {{ $organisation->nom }}</h2>
                        </div>
                        <div class="card-body">
                            <div class="row ">
                                @foreach ($prestations as $prestation)
                                    <div class="col">
                                        <p class="badge badge-secondary" style="font-size: 16px">{{ $prestation->nom }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>


                    <div class="card pb-4 mb-4">
                        <div class="card-header">
                            <h2 class="card-title">Produits récents</h2>
                        </div>
                        <div class="card-body">

                            <div class="row">
                                @foreach ($produits as $produit)
                                    {{ $produit->imgInit() }}
                                    <div class=" col-lg-3 col-md-6">
                                        <div class="single-post" data-delay=".1">
                                            <div class="image-hover-wrap">
                                                <img src="{{ $produit->image }}">
                                                <div
                                                    class="image-hover-content d-flex justify-content-center align-items-center text-center">
                                                    <ul class="list-inline">
                                                        <li><a href="{{ route('produit.show', $produit) }}"><i class="fas fa-eye"></i></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <span class="text-dark">{{ $produit->getActionDate() }}</span>

                                            <a href="{{ route('produit.show', $produit) }}" class="text-primary"> {{ $produit->nom }}</a>
                                            <h4 class="text-warning">
                                                {{ $produit->prix }} Franc cfa
                                            </h4>
                                            <h4> stock : <a>{{ $produit->stock }}</a> </h4>
                                            <div>
                                                <div class="btn btn-primary btn-flat"> <a
                                                        href="{{ route('paiement.create') }}">Payer</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            </p>
                        </div>
                        <div class="card-footer">
                            <a href="" class="btn btn-sm btn-warning float-right">Consulter la liste <i
                                    class="fas fa-caret-right"></i></a>
                        </div>
                    </div>
                    <div class="card pb-4 mb-4">
                        <div class="card-header">
                            <h2 class="card-title">Publications récentes</h2>
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-lg-3 col-md-6">
                                    <div class="single-post" data-animate="fadeInUp" data-delay=".1">
                                        <div class="image-hover-wrap">
                                            <img src="{{ asset('assets/img/posts/post1.jpg') }}" alt="">
                                        </div>
                                        <h4 class="truncate-title">Torrent Pirates Prefer To Pay For Video Streaming
                                            Services</h4>
                                        <a href="#">Lire l'article<i class="fas fa-caret-right"></i></a>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="single-post" data-animate="fadeInUp" data-delay=".2">
                                        <div class="image-hover-wrap">
                                            <img src="{{ asset('assets/img/posts/post2.jpg') }}" alt="">
                                        </div>
                                        <h4 class="truncate-title">How to Watch Emmett VS Stephens at UFC Fight Night FOX
                                        </h4>
                                        <a href="#">Lire l'article<i class="fas fa-caret-right"></i></a>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="single-post" data-animate="fadeInUp" data-delay=".3">
                                        <div class="image-hover-wrap">
                                            <img src="{{ asset('assets/img/posts/post3.jpg') }}" alt="">
                                        </div>
                                        <h4 class="truncate-title">Web Hosting Powerhouse Go Daddy to Expand Its Civil
                                            Service</h4>
                                        <a href="#">Lire l'article<i class="fas fa-caret-right"></i></a>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="single-post" data-animate="fadeInUp" data-delay=".1">
                                        <div class="image-hover-wrap">
                                            <img src="{{ asset('assets/img/posts/post4.jpg') }}" alt="">
                                        </div>
                                        {{-- <span class="text-secondary">Par Autheur le 19 Jan 2022</span> --}}
                                        <h4 class="truncate-title">Encryption Must Not Be Compromised by Backdoors</h4>
                                        <a href="#">Lire l'article<i class="fas fa-caret-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            </p>
                        </div>
                        <div class="card-footer">
                            <a href="" class="btn btn-sm btn-warning float-right">Consulter la liste <i
                                    class="fas fa-caret-right"></i></a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- End of Blog -->
@endsection
