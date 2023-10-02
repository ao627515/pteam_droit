@extends("layout")

@section("content")

<section class="page-title-wrap position-relative bg-light">
    <div id="particles_js"></div>
    <div class="container">
        <div class="row">
            <div class="col-11">
                <div class="page-title position-relative pt-5 pb-5">
                    <ul class="custom-breadcrumb roboto list-unstyled mb-0 clearfix" data-animate="fadeInUp" data-delay="1.2">
                        <li><a href="index.html">Accueil</a></li>
                        <li><i class="fas fa-angle-double-right"></i></li>
                        <li><a href="#">Cabinets Partenaires</a></li>
                    </ul>
                    <h1 data-animate="fadeInUp" data-delay="1.3">Cabinets Partenaires</h1>
                </div>
            </div>
            <div class="col-1">
                <div class="world-map position-relative">
                    <img src="img/map.svg" alt="" alt="" data-no-retina class="svg">>
                </div>
            </div>
        </div>
    </div>
</section>

    <section class="pt-7 pb-7 bg-light">
        <div class="container">
            <div class="row align-items-lg-end">
                <div class="col-md-12">
                    <div class="section-title">
                        {{-- <h2 data-animate="fadeInUp" data-delay=".1" class="text-primary">Dommaine d'activité</h2> --}}
                        <p data-animate="fadeInUp" data-delay=".2" class="text-primary">Selectionnez le domaine dans la liste ci-dessous pour voir la listes des partenaires disponibles pour ce domaine </p>
                    </div>
                    <div class="queries-wrap">
                        <div class="row">
                            @foreach ($domaines as $item)
                                
                            <div class="col-lg-4 col-md-12">
                                <div class="single-query bg-white d-flex align-items-center" data-animate="fadeInUp" data-delay=".05">
                                    <div class="query-icon w-50">
                                        <img src="{{asset($item->icon)}}" alt="" alt="" data-no-retina class="svg">
                                    </div>
                                    <div class="query-info">
                                        <h4>{{$item->nom}}</h4>
                                        <a href="{{route('partenaire.show',$item->id)}}">Consultez la liste >></a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection