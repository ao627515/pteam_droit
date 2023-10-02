@extends('layout')

@section('content')
<style>
    .image-hover-wrap {
       text-align: center;
    }
    .image-hover-wrap img{
        height: 220px !important;
    }
</style>
<section class="page-title-wrap position-relative bg-light">
    <div id="particles_js"></div>
    <div class="container">
        <div class="row">
            <div class="col-2 pt-5 pb-5">
                <img src="{{asset($domaine->icon)}}" alt="" alt="" data-no-retina class="svg">
            </div>
            <div class="col-9">
                <div class="page-title position-relative pt-5 pb-5">
                    <ul class="custom-breadcrumb roboto list-unstyled mb-0 clearfix" data-animate="fadeInUp" data-delay="1.2">
                        <li><a href="index.html">Accueil</a></li>
                        <li><i class="fas fa-angle-double-right"></i></li>
                        <li><a href="#">Cabinets Partenaires</a></li>
                    </ul>
                    <h1 data-animate="fadeInUp" data-delay="1.3">{{$domaine->nom}}</h1>
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
                <div class="col-md-8 order-last">
                    <!-- Posts -->
                    <div class="row">

                @foreach ($partenaires as $item)
                        <div class="col-md-6">
                            <div class="single-post" data-animate="fadeInUp" data-delay=".1">
                                <div class="image-hover-wrap">
                                    <img src="{{asset($item->logo)}}" alt="">
                                    <div class="image-hover-content d-flex justify-content-center align-items-center text-center">
                                        <ul class="list-inline">
                                            <li><a href="{{route('organisation.show',$item->id)}}"><i class="fas fa-eye"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                {{-- <span>Posted on <a href="#">Jan 19, 2017</a></span> --}}
                                <h4>{{$item->nom}}</h4>
                                <span class="text-dark">{{$item->short_description}}</span>
                                <a href="{{route('organisation.show',$item->id)}}" class="btn btn-warning p-2"><i class="fas fa-eye"></i>Voir profil</a>
                                <a href="{{route('ticket.create',['p'=>$item->id])}}" class="btn btn-primary p-2 float-right">Contacter<i class="fas fa-phone"></i></a>
                            </div>
                        </div>
                @endforeach
                    </div>

                    <!-- Pagination -->
                    <ul class="custom-pagination list-inline text-center text-uppercase mt-4" data-animate="fadeInUp" data-delay=".1">
                        <li class="float-left disabled"><a href="#"><i class="fas fa-caret-left"></i> Precedent</a></li>
                        <li class="active"><a href="#">01</a></li>
                        <li><a class="text-secondary" href="#">02</a></li>
                        <li><a class="text-secondary" href="#">03</a></li>
                        <li><a class="text-secondary" href="#">04</a></li>
                        <li><a class="text-secondary" href="#">05</a></li>
                        <li class="float-right"><a class="text-secondary" href="#">Suivant <i class="fas fa-caret-right"></i></a></li>
                    </ul>
                </div>

                <!-- Sidebar -->
                <div class="col-md-4">
                    <aside>
                        <div class="single-widget" data-animate="fadeInUp" data-delay=".1">
                            <form action="#">
                                <div class="form-group position-relative mb-0">
                                    <input class="form-control" type="text" placeholder="Rechercher" data-parsley-required-message="Please type at least one word." data-parsley-minlength="3" data-parsley-minlength-message="Please type at least one word." required>
                                    <button type="submit"><i class="fas fa-search"></i></button>
                                </div>
                            </form>
                        </div>

                        <div class="single-widget" data-animate="fadeInUp" data-delay=".1">
                            <h3 data-animate="fadeInUp" data-delay=".2">Catégories</h3>
                            <ul class="mb-0">

                                @foreach ($domaines as $item)
                                    <li data-animate="fadeInUp" data-delay=".25"><a href="{{route('partenaire.show',$item->id)}}"><span>{{$item->nom}}</span></a></li>
                                @endforeach
                            </ul>
                        </div>


                        <div class="single-widget text-center" data-animate="fadeInUp" data-delay=".1">
                            <h3 data-animate="fadeInUp" data-delay=".2">Publicité</h3>
                            <img src="img/camera.jpg" alt="" data-animate="fadeInUp" data-delay=".25">
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </section>
    <!-- End of Blog -->

@endsection