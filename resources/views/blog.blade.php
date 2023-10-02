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
                        <li><a href="#">Publications</a></li>
                    </ul>
                    <h1 data-animate="fadeInUp" data-delay="1.3">Publications</h1>
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

    <!-- Blog -->
    <section class="blog pt-7 pb-7">
        <div class="container">
            <div class="row">
                <div class="col-md-8 order-last">
                    <!-- Posts -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="single-post" data-animate="fadeInUp" data-delay=".1">
                                <div class="image-hover-wrap">
                                    <img src="{{asset('assets/img/posts/post1.jpg')}}" alt="">
                                    <div class="image-hover-content d-flex justify-content-center align-items-center text-center">
                                        <ul class="list-inline">
                                            <li><a href="#"><i class="fas fa-eye"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <span>Publié le <a href="#">19/09/2017</a></span>
                                <h4>Torrent Pirates Prefer To Pay For Video Streaming Services</h4>
                                <a href="#">Consulter<i class="fas fa-caret-right"></i></a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="single-post" data-animate="fadeInUp" data-delay=".2">
                                <div class="image-hover-wrap">
                                    <img src="{{asset('assets/img/posts/post2.jpg')}}" alt="">
                                    <div class="image-hover-content d-flex justify-content-center align-items-center text-center">
                                        <ul class="list-inline">
                                            <li><a href="#"><i class="fas fa-eye"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <span>Publié le <a href="#">19/09/2017</a></span>
                                <h4>How to Watch Emmett VS Stephens at UFC Fight Night FOX 28</h4>
                                <a href="#">Consulter<i class="fas fa-caret-right"></i></a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="single-post" data-animate="fadeInUp" data-delay=".1">
                                <div class="image-hover-wrap">
                                    <img src="{{asset('assets/img/posts/post3.jpg')}}" alt="">
                                    <div class="image-hover-content d-flex justify-content-center align-items-center text-center">
                                        <ul class="list-inline">
                                            <li><a href="#"><i class="fas fa-eye"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <span>Publié le <a href="#">19/09/2017</a></span>
                                <h4>Web Hosting Powerhouse Go Daddy to Expand Its Civil Service</h4>
                                <a href="#">Consulter<i class="fas fa-caret-right"></i></a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="single-post" data-animate="fadeInUp" data-delay=".2">
                                <div class="image-hover-wrap">
                                    <img src="{{asset('assets/img/posts/post4.jpg')}}" alt="">
                                    <div class="image-hover-content d-flex justify-content-center align-items-center text-center">
                                        <ul class="list-inline">
                                            <li><a href="#"><i class="fas fa-eye"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <span>Publié le <a href="#">19/09/2017</a></span>
                                <h4>Encryption Must Not Be Compromised by Backdoors-Redux</h4>
                                <a href="#">Consulter<i class="fas fa-caret-right"></i></a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="single-post" data-animate="fadeInUp" data-delay=".1">
                                <div class="image-hover-wrap">
                                    <img src="{{asset('assets/img/posts/post5.jpg')}}" alt="">
                                    <div class="image-hover-content d-flex justify-content-center align-items-center text-center">
                                        <ul class="list-inline">
                                            <li><a href="#"><i class="fas fa-eye"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <span>Publié le <a href="#">19/09/2017</a></span>
                                <h4>How to Watch Smith VS Holzken Live Online From Anywhere</h4>
                                <a href="#">Consulter<i class="fas fa-caret-right"></i></a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="single-post" data-animate="fadeInUp" data-delay=".2">
                                <div class="image-hover-wrap">
                                    <img src="{{asset('assets/img/posts/post6.jpg')}}" alt="">
                                    <div class="image-hover-content d-flex justify-content-center align-items-center text-center">
                                        <ul class="list-inline">
                                            <li><a href="#"><i class="fas fa-eye"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <span>Publié le <a href="#">19/09/2017</a></span>
                                <h4>UK Children Being Subjected To Invasive Data Retention</h4>
                                <a href="#">Consulter<i class="fas fa-caret-right"></i></a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="single-post" data-animate="fadeInUp" data-delay=".1">
                                <div class="image-hover-wrap">
                                    <img src="{{asset('assets/img/posts/post7.jpg')}}" alt="">
                                    <div class="image-hover-content d-flex justify-content-center align-items-center text-center">
                                        <ul class="list-inline">
                                            <li><a href="#"><i class="fas fa-eye"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <span>Publié le <a href="#">19/09/2017</a></span>
                                <h4>Privatix Makes It Possible to Share Unused Broadband and Get Cryptocurrency</h4>
                                <a href="#">Consulter<i class="fas fa-caret-right"></i></a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="single-post" data-animate="fadeInUp" data-delay=".2">
                                <div class="image-hover-wrap">
                                    <img src="{{asset('assets/img/posts/post8.jpg')}}" alt="">
                                    <div class="image-hover-content d-flex justify-content-center align-items-center text-center">
                                        <ul class="list-inline">
                                            <li><a href="#"><i class="fas fa-eye"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <span>Publié le <a href="#">19/09/2017</a></span>
                                <h4>Individuals can access VPNs in the UAE, with caution</h4>
                                <a href="#">Consulter<i class="fas fa-caret-right"></i></a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="single-post" data-animate="fadeInUp" data-delay=".1">
                                <div class="image-hover-wrap">
                                    <img src="{{asset('assets/img/posts/post9.jpg')}}" alt="">
                                    <div class="image-hover-content d-flex justify-content-center align-items-center text-center">
                                        <ul class="list-inline">
                                            <li><a href="#"><i class="fas fa-eye"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <span>Publié le <a href="#">19/09/2017</a></span>
                                <h4>How to Watch Bellator 194: Nelson VS Mitrione 2 live Online</h4>
                                <a href="#">Consulter<i class="fas fa-caret-right"></i></a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="single-post" data-animate="fadeInUp" data-delay=".2">
                                <div class="image-hover-wrap">
                                    <img src="{{asset('assets/img/posts/post10.jpg')}}" alt="">
                                    <div class="image-hover-content d-flex justify-content-center align-items-center text-center">
                                        <ul class="list-inline">
                                            <li><a href="#"><i class="fas fa-eye"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <span>Publié le <a href="#">19/09/2017</a></span>
                                <h4>How to Watch Bundesliga Live Streams Online with a VPN</h4>
                                <a href="#">Consulter<i class="fas fa-caret-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- Pagination -->
                    <ul class="custom-pagination list-inline text-center text-uppercase mt-4" data-animate="fadeInUp" data-delay=".1">
                        <li class="float-left disabled"><a href="#"><i class="fas fa-caret-left"></i> Prev</a></li>
                        <li class="active"><a href="#">01</a></li>
                        <li><a href="#">02</a></li>
                        <li><a href="#">03</a></li>
                        <li><a href="#">04</a></li>
                        <li><a href="#">05</a></li>
                        <li class="float-right"><a href="#">Next <i class="fas fa-caret-right"></i></a></li>
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
                            <h3 data-animate="fadeInUp" data-delay=".2">Categories</h3>
                            <ul class="widget-categories list-unstyled mb-0">
                                <li data-animate="fadeInUp" data-delay=".25"><a href="#"><span>Droit du travail</span><span class="count">55</span></a></li>
                                <li data-animate="fadeInUp" data-delay=".3"><a href="#"><span>Droit du commerce</span><span class="count">10</span></a></li>
                                <li data-animate="fadeInUp" data-delay=".35"><a href="#"><span>Droit civil</span><span class="count">23</span></a></li>
                                <li data-animate="fadeInUp" data-delay=".4"><a href="#"><span>Droit penal</span><span class="count">46</span></a></li>
                               
                            </ul>
                        </div>

                        {{-- <div class="single-widget" data-animate="fadeInUp" data-delay=".1">
                            <h3 data-animate="fadeInUp" data-delay=".2">Publications Récentes</h3>
                            <ul class="recent-posts list-unstyled mb-0">
                                <li data-animate="fadeInUp" data-delay=".25"><a href="#">How to Watch Smith VS Holzken Live Online From Anywhere?</a></li>
                                <li data-animate="fadeInUp" data-delay=".3"><a href="#">In Major Hiring Push, Web Hosting Powerhouse Go Daddy to Expand</a></li>
                                <li data-animate="fadeInUp" data-delay=".35"><a href="#">Lorem ipsum dolor sit amet, consectetur adipisicing elit fastus.</a></li>
                                <li data-animate="fadeInUp" data-delay=".4"><a href="#">How to Watch Emmett VS Stephens at UFC Fight Night FOX 28?</a></li>
                                <li data-animate="fadeInUp" data-delay=".45"><a href="#">UK children being subjected to invasive data retention</a></li>
                            </ul>
                        </div> --}}

                        <div class="single-widget text-center" data-animate="fadeInUp" data-delay=".1">
                            <h3 data-animate="fadeInUp" data-delay=".2">Publicité</h3>
                            <img src="{{asset('assets/img/camera.jpg')}}" alt="" data-animate="fadeInUp" data-delay=".25">
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </section>
    <!-- End of Blog -->
@endsection