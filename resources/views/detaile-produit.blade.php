@extends('layout')

@section('content')
    <section class="content form-group">
        <!-- Default box -->
        <div class="form-group">
            <div class="card card-solid">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <h3 class="d-inline-block d-sm-none">Description</h3>
                            <h3 class="d-inline-block d-sm-none">Stocke : {{ $produit->stock }}</h3>
                            <div class="col-12">
                                {{ $produit->imgInit() }}
                                <img src="{{ $produit->image }}" alt="logo" width="50%">

                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <h3 class="my-3">Stocke : {{ $produit->stock }}</h3>
                            <h3 class="my-3">Description</h3>
                            <p>
                                {{ $produit->description }}
                            </p>

                            <hr>
                        </div>
                        <div class="single-widget" data-animate="fadeInUp" data-delay=".1">
                            <h3 data-animate="fadeInUp" data-delay=".2">Categories</h3>
                            <ul class="widget-categories list-unstyled mb-0">
                                <li data-animate="fadeInUp" data-delay=".25"><a href="#"><span>Droit du
                                            travail</span><span class="count">55</span></a></li>
                                <li data-animate="fadeInUp" data-delay=".3"><a href="#"><span>Droit du
                                            commerce</span><span class="count">10</span></a></li>
                                <li data-animate="fadeInUp" data-delay=".35"><a href="#"><span>Droit civil</span><span
                                            class="count">23</span></a></li>
                                <li data-animate="fadeInUp" data-delay=".4"><a href="#"><span>Droit penal</span><span
                                            class="count">46</span></a></li>
                            </ul>
                        </div>
                        <div class="single-widget text-center" data-animate="fadeInUp" data-delay=".1">
                            <h3 data-animate="fadeInUp" data-delay=".2">Publicité</h3>
                            <img src="{{ asset('assets/img/camera.jpg') }}" alt="" data-animate="fadeInUp"
                                data-delay=".25">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
