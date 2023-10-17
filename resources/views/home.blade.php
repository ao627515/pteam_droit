@extends("layout")

@section("content")
<style>
    .image-hover-wrap img{
        width: 300px !important;
        height: 150px !important;
    }


    .truncate-title {
        -webkit-line-clamp: 2;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
        <!-- Banner -->
        <section class="position-relative bg-light">
            <div id="particles_js"></div>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <!-- Banner content -->
                        <div class="banner-content">
                            <h1 data-animate="fadeInUp" data-delay="1.2">Mondroit.bf</h1>
                            <h2 data-animate="fadeInUp" data-delay="1.3"><span class="typed"></span></h2>
                            <ul class="list-inline" data-animate="fadeInUp" data-delay="1.4">

                            @if (Auth::user())
                            <li><a href="{{route('ticket.create',['q'=>0])}}" class="btn btn-primary p-2 text-white">Demander assistance<i class="fas fa-caret-right"></i></a></li>
                            @else
                            <li><button onclick="goToPlan()" class="btn btn-danger">Créer un compte</button></li>
                            <li><a href="{{route('auth.loginform')}}" class="btn btn-primary p-2 text-white">Se connecter<i class="fas fa-caret-right"></i></a></li>
                            @endif
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 d-block">
                        <!-- Banner image -->
                        <div class="banner-image">
                            <div id="carouselExampleControls" id="carousel1" class="carousel slide" data-ride="carousel"
                                data-interval="4000">
                                <ol class="carousel-indicators">
                                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                </ol>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img class="d-block w-100" src="{{asset('assets/img/justice3.jpg')}}" style="height: 450px"
                                            alt="First slide">
                                        <div class="carousel-caption d-none d-md-block  bg-light"
                                            style="opacity: 0.8;">
                                            <h5>Carousel 1 </h5>
                                            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. </p>
                                        </div>
                                    </div>

                                    <div class="carousel-item">
                                        <img class="d-block w-100" src="{{asset('assets/img/justice1.png')}}" style="height: 450px"
                                            alt="First slide">
                                        <div class="carousel-caption d-none d-md-block  bg-light"
                                            style="opacity: 0.8;">
                                            <h5>Carousel 1 </h5>
                                            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. </p>
                                        </div>
                                    </div>

                                    <div class="carousel-item">
                                        <img class="d-block w-100" src="{{asset('assets/img/justice2.png')}}"
                                            style="height: 450px" alt="Second slide">
                                        <div class="carousel-caption d-none d-md-block  bg-light"
                                            style="opacity: 0.8;">
                                            <h5>Carousel 2 </h5>
                                            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. </p>
                                        </div>
                                    </div>
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleControls" role="button"
                                    data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleControls" role="button"
                                    data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End of Banner -->


    <!-- Contact page content -->
    <section class="pt-7 pb-7 bg-light" id="services">
        <div class="container">
            <div class="row align-items-lg-end">
                <div class="col-md-12">
                    <div class="section-title">
                        <h2 data-animate="fadeInUp" data-delay=".1" class="text-primary">Comment pouvons nous vous aidez ?</h2>
                        <p data-animate="fadeInUp" data-delay=".2" class="text-danger">Selectionnez votre préocupation dans la liste ci-dessous et l'un de nos expert vous assistera au plus vite </p>
                    </div>
                    <div class="queries-wrap">
                        <div class="row">
                            <div class="col-lg-4 col-md-12">
                                <div class="single-query bg-white d-flex align-items-center" data-animate="fadeInUp" data-delay=".05">
                                    <div class="query-icon">
                                        <img src="{{asset('assets/img/icons/general-query.svg')}}" alt="" alt="" data-no-retina class="svg">
                                    </div>
                                    <div class="query-info">
                                        <h4>Besoin d'un actes juridiques </h4>
                                        <span>Assistance pour redaction de contrats, conventions, avis juridiques etc</span>
                                        <a class="btn btn-primary" href="{{route('ticket.create',['q'=>1])}}">Nous contactez</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="single-query bg-white d-flex align-items-center" data-animate="fadeInUp" data-delay=".15">
                                    <div class="query-icon">
                                        <img src="{{asset('assets/img/icons/support-query.svg')}}" alt="" alt="" data-no-retina class="svg">
                                    </div>
                                    <div class="query-info">
                                        <h4>Procédure judiciaire</h4>
                                        <span>Besoin d'information sur la procedure judiciare à suivre</span>
                                        <a class="btn btn-primary" href="{{route('ticket.create',['q'=>2])}}">Nous contactez</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="single-query bg-white d-flex align-items-center" data-animate="fadeInUp" data-delay=".25">
                                    <div class="query-icon">
                                        <img src="{{asset('assets/img/icons/a-query.svg')}}" alt="" alt="" data-no-retina class="svg">
                                    </div>
                                    <div class="query-info">
                                        <h4>Besoin d'un avocat</h4>
                                        <span>Je souhaite me faire representer par un avocat</span>
                                        <a class="btn btn-primary" href="{{route('ticket.create',['q'=>3])}}">Nous contactez</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="single-query bg-white d-flex align-items-center" data-animate="fadeInUp" data-delay=".35">
                                    <div class="query-icon">
                                        <img src="{{asset('assets/img/icons/business-query.svg')}}" alt="" alt="" data-no-retina class="svg">
                                    </div>
                                    <div class="query-info">
                                        <h4>Documents de société</h4>
                                        <span>Assistance pour la création, fusion et scission de société</span>
                                        <a class="btn btn-primary" href="{{route('ticket.create',['q'=>4])}}">Nous contactez</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="single-query bg-white d-flex align-items-center" data-animate="fadeInUp" data-delay=".55">
                                    <div class="query-icon">
                                        <img src="{{asset('assets/img/icons/press-query.svg')}}" alt="" alt="" data-no-retina class="svg">
                                    </div>
                                    <div class="query-info">
                                        <h4>Je souhaite discuter par appel</h4>
                                        <span>Un conseillé vous contactera directement par appel</span>
                                        <a class="btn btn-primary" href="{{route('ticket.create',['q'=>5])}}">Faire la demande</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-12">
                                <div class="single-query bg-white d-flex align-items-center" data-animate="fadeInUp" data-delay=".45">
                                    <div class="query-icon">
                                        <img src="{{asset('assets/img/icons/affiliate-query.svg')}}" alt="" alt="" data-no-retina class="svg">
                                    </div>
                                    <div class="query-info">
                                        <h4>Autre type de services</h4>
                                        <span>J'ai besoin d'un service en particulier</span>
                                        <a class="btn btn-primary" href="{{route('ticket.create',['q'=>6])}}">Nous contactez</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-lg-4 col-md-5">
                    <div class="contact-form-wrap" data-animate="fadeInUp" data-delay=".55">
                        <div class="text-center">
                            <p data-animate="fadeInUp" data-delay=".2">Fill up the form. Your e-mail will not be published. Required fields are marked by <span class="text-danger font-weight-bold">*</span></p>
                        </div>
                        <form class="contact-form" action="sendmail.php" method="post">
                            <div class="position-relative" data-animate="fadeInUp" data-delay=".3">
                                <input type="text" name="name" placeholder="Name*" required class="form-control">
                            </div>
                            <div class="position-relative" data-animate="fadeInUp" data-delay=".4">
                                <input type="email" name="email" placeholder="E-mail*" required class="form-control">
                            </div>
                            <div class="position-relative" data-animate="fadeInUp" data-delay=".5">
                                <input type="text" name="telephone" placeholder="Telephone*" data-parsley-pattern="^[\d\+\-\.\(\)\/\s]*$" data-parsley-minlength="10" data-parsley-minlength-message="Minimum 10 characters." required class="form-control">
                            </div>
                            <div class="position-relative" data-animate="fadeInUp" data-delay=".6">
                                <input type="url" name="website" placeholder="Website" class="form-control">
                            </div>
                            <div class="position-relative" data-animate="fadeInUp" data-delay=".7">
                                <textarea name="message" placeholder="Write message*" required class="form-control"></textarea>
                            </div>
                            <button class="btn btn-primary btn-square btn-block" data-animate="fadeInUp" data-delay=".8">Send message</button>
                        </form>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>
    <!-- End of Contact page content -->
    <div id="register"></div>

        <section class="mt-3">
            <div class="container">

                <!-- carousel -->
                <div id="carouselExampleControls" id="carousel2" class="carousel slide carousel-fade"
                    data-ride="carousel" data-interval="2000">

                    <div class="carousel-inner" id="pub1">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="https://via.placeholder.com/750x100.png" alt="First slide">
                        </div>

                        <div class="carousel-item">
                            <img class="d-block w-100" src="https://via.placeholder.com/750x100.png" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="https://via.placeholder.com/750x100.png" alt="Third slide">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <!-- end carousel -->
            </div>
        </section>


        @if (!Auth::user())
        <!-- Pricing plans -->
        <section class="pricing-plans pt-7 pb-7 bg-info text-white">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5">
                        <!-- Section title -->
                        <div class="section-title">
                            <h2 data-animate="fadeInUp" data-delay=".1" class="text-light">Formules d'abonnement</h2>
                            <p data-animate="fadeInUp" data-delay=".3" class="text-light">Lorem ipsum dolor sit amet consectetur
                                adipisicing
                                elit. Tenetur, ipsa! Sint, dolore perspiciatis autem possimus fuga quaerat, alias unde
                                consectetur ullam nulla obcaecati dolorem sed cum ad, impedit temporibus repellat.</p>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-lg-5">
                        <!-- Features list -->
                        <div class="pricing-features">
                            <h3 class="cabin text-light" data-animate="fadeInUp" data-delay=".5">Votre inscription vous donne droit
                                aux
                                services ci-dessous</h3>
                            <ul class="list-unstyled list-item clearfix">
                                <li data-animate="fadeInUp" data-delay=".1"><i class="fas fa-check-circle"></i>Accès aux
                                    documents de droit</li>
                                <li data-animate="fadeInUp" data-delay=".15"><i class="fas fa-check-circle"></i>Accès
                                    aux
                                    textes de lois</li>
                                <li data-animate="fadeInUp" data-delay=".25"><i class="fas fa-check-circle"></i>Conseils
                                    et
                                    assistance</li>
                                <li data-animate="fadeInUp" data-delay=".35"><i class="fas fa-check-circle"></i>Suivit
                                    de
                                    .....</li>
                                <li data-animate="fadeInUp" data-delay=".4"><i
                                        class="fas fa-check-circle"></i>Protection
                                    ......</li>
                                <li data-animate="fadeInUp" data-delay=".45"><i
                                        class="fas fa-check-circle"></i>consectetur
                                </li>
                                <li data-animate="fadeInUp" data-delay=".5"><i class="fas fa-check-circle"></i>enetur,
                                    ipsa
                                </li>
                                <li data-animate="fadeInUp" data-delay=".55"><i class="fas fa-check-circle"></i>nulla
                                    obcaecati</li>
                                <li data-animate="fadeInUp" data-delay=".6"><i
                                        class="fas fa-check-circle"></i>perspiciatis
                                </li>
                            </ul>
                             <a href="{{route('auth.registerform',['t'=>'partenaire'])}}" class="text-primary bg-light mt-2 p-2" data-animate="fadeInUp" data-delay=".7">Proposer mes services en tant que partenaire <i class="fas fa-caret-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="swiper-slide single-pricing-slide">
                                    <div class="single-pricing-plan">
                                        <img src="{{asset('assets/img/icons/bandwidth.svg')}}" alt="" alt="" data-no-retina class="svg">
                                        <h4>Personne <br> Physique</h4>
                                        <span class="time roboto">Plan annuel</span>
                                        <strong class="roboto">1000 <sub class="text-warning">FCFA/an</sub></strong>
                                        {{-- <p class="text-primary">Billed <span>15.000 FCFA</span> Per Moth <br>30 Days Money Back Guarantee</p> --}}
                                        <a href="{{route('auth.registerform',['t'=>'physique'])}}" class="btn btn-primary">Souscrire</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="swiper-slide single-pricing-slide">
                                    <div class="single-pricing-plan">
                                        <img src="{{asset('assets/img/icons/enterprise.svg')}}" alt="" alt="" data-no-retina class="svg">
                                        <h4>Personne <br> Morale</h4>
                                        <span class="time roboto">Plan annuel</span>
                                        <strong class="roboto">50.000 <sub class="text-warning">FCFA/an</sub></strong>
                                        <!-- <p>Billed <span>$114</span> Per Moth <br>30 Days Money Back Guarantee</p> -->
                                        <a href="{{route('auth.registerform',['t'=>'morale'])}}" class="btn btn-primary">Souscrire</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- End of Pricing slider -->
                </div>
            </div>
        </section>
        <!-- End of Pricing plans -->
        @endif

        <!-- Features -->
        <section class="pt-7 pb-5-5">
            <div class="container">

                <div class="section-title">
                    <h2 data-animate="fadeInUp" data-delay=".1" class="text-primary">Publications récentes</h2>
                </div>

            <div class="row">
                @foreach ($articles as $article)
                {{ $article->imgInit() }}
                <div class="col-lg-3 col-md-6">
                    <div class="single-post" data-animate="fadeInUp" data-delay=".1">
                        <div class="image-hover-wrap">
                            <img src=" {{ $article->image }}" alt="">
                            <div class="image-hover-content d-flex justify-content-center align-items-center text-center">
                                <ul class="list-inline">
                                    <li><a href="#"><i class="fas fa-eye"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <span class="text-info">Publie le {{$article->created_at}}</span>
                        <h4 class="truncate-title"> {{$article->titre}}</h4>
                        <a href="#">Lire l'article<i class="fas fa-caret-right"></i></a>
                    </div>
                </div>

                @endforeach
                <div class="col-md-12 text-right"> <a href="{{route('article.index')}}" class="btn btn-default">Voir plus</a></div>
            </div>
            </div>
        </section>
        <!-- End of Features -->

        <!-- Our services -->
        <section>
            <div class="services-title position-relative pt-7 bg-info">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-6 col-lg-8">
                            <!-- Section title -->
                            <div class="section-title text-center">
                                <h2 class="text-white" data-animate="fadeInUp" data-delay=".1">Cabinets partenaires
                                </h2>
                                <p class="text-white" data-animate="fadeInUp" data-delay=".3">Nous reunissons les meilleurs sur notre plateforme afin de vous proposser le meilleur service qu'il soit</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="services-wrap bg-primary position-relative pt-5 pb-5">
                <div class="container">
                    <!-- All services -->
            <div class="row">
                @foreach ($partenaires as $item)
                <div class="col-lg-3 col-md-4 col-sm-6">

                    <div class="single-member" data-animate="fadeInUp" data-delay="0">
                        <div class="image-hover-wrap">
                            <img src="{{asset($item->logo)}}" height="90" alt="">
                            <div class="image-hover-content d-flex justify-content-center align-items-center text-center">
                                <ul class="list-inline">
                                    <li><a  href="{{route('organisation.show',$item->id)}}"><i class="fas fa-eye"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="single-member-info bg-light">
                            <h4 class="truncate-title">{{$item->nom}}</h4>
                            <span style="height: 75px">{{$item->short_description}}</span>
                            <a  href="{{route('organisation.show',$item->id)}}" class="btn btn-link text-warning">Consulter <i class="fas fa-caret-right"></i></a>
                        </div>
                    </div>
                </div>
                @endforeach


                <div class="col-md-12 text-right"> <a href="{{route('partenaire.index')}}" class="btn btn-default">Voir plus</a></div>
            </div>
                </div>
            </div>
        </section>
        <!-- End of Our services -->


        <!-- Reviews -->
        <section class="pt-7 pb-7 bg-white">
            <div class="container">
                <div class="section-title text-center">
                    <h2 class="text-primary" data-animate="fadeInUp" data-delay=".1">Ce que disent nos specialistes</h2>
                </div>
                <div class="swiper-container review-slider">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide single-review-slide">
                            <h4>Marsha C. Meyer
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </h4>
                            <span>Melbourne, Australia</span>
                            <p>I must explain to you how all this mistaken idea of denouncing pleasure and praising pain
                                was
                                born and I will give complete account of the system, and expound the actual teachings of
                                happiness. No one rejects, dislikes, or avoids.</p>
                        </div>

                        <div class="swiper-slide single-review-slide">
                            <h4>Bns H. Jabed
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </h4>
                            <span>Noakhali, Bangladesh</span>
                            <p>I must explain to you how all this mistaken idea of denouncing pleasure and praising pain
                                was
                                born and I will give complete account of the system, and expound the actual teachings of
                                happiness. No one rejects, dislikes, or avoids.</p>
                        </div>

                        <div class="swiper-slide single-review-slide">
                            <h4>Cathy S. Knight
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </h4>
                            <span>California, United States</span>
                            <p>I must explain to you how all this mistaken idea of denouncing pleasure and praising pain
                                was
                                born and I will give complete account of the system, and expound the actual teachings of
                                happiness. No one rejects, dislikes, or avoids.</p>
                        </div>

                        <div class="swiper-slide single-review-slide">
                            <h4>Cathy S. Knight
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </h4>
                            <span>California, United States</span>
                            <p>I must explain to you how all this mistaken idea of denouncing pleasure and praising pain
                                was
                                born and I will give complete account of the system, and expound the actual teachings of
                                happiness. No one rejects, dislikes, or avoids.</p>
                        </div>

                        <div class="swiper-slide single-review-slide">
                            <h4>Cathy S. Knight
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </h4>
                            <span>California, United States</span>
                            <p>I must explain to you how all this mistaken idea of denouncing pleasure and praising pain
                                was
                                born and I will give complete account of the system, and expound the actual teachings of
                                happiness. No one rejects, dislikes, or avoids.</p>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination review-pagination position-static"></div>
            </div>
        </section>
        <!-- End of Reviews -->

        {{-- Mobile app
        <section class="pt-7 pb-7">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-4 d-none d-md-block">
                        <div class="text-center" data-animate="fadeInUp" data-delay=".1">
                            <img src="{{asset('assets/img/mobile.png')}}" alt="">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-8">
                        <div class="app-info">
                            <h2 data-animate="fadeInUp" data-delay=".1">Télécharger notre application</h2>
                            <p data-animate="fadeInUp" data-delay=".3">Sed ut perspiciatis unde omnis iste natus error
                                sit
                                voluptatem accusantium inventore veritatis et quasi architecto beatae vitae dicta sunt
                                explicabo. Nemo enim ipsam voluptatem</p>
                            <ul class="apps-list list-inline">
                                <li data-animate="fadeInUp" data-delay=".5"><a href="#"><img src="{{asset('assets/img/play-store.png')}}"
                                            alt=""></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
         End of Mobile app --}}

        <!-- Servers -->
        <section class="servers pt-7 bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-lg-5">
                        <div class="section-title">
                            <h2 data-animate="fadeInUp" data-delay=".1">Couverture nationnal</h2>
                            <p data-animate="fadeInUp" data-delay=".2" class="text-info">Nos spécialistes sont repartis et competent pour
                                intervenir sur l'ensemble du territoire du national</p>
                        </div>
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia rem quis, maiores minus
                            commodi cumque consequuntur blanditiis aut nam. Temporibus, quas! Sunt ex ducimus
                            repellendus maxime inventore. Fugiat, cupiditate explicabo!
                        </p>
                        <a href="#" class="btn server-btn" data-animate="fadeInUp" data-delay=".7">Consulter un
                            professionel <i class="fas fa-caret-right"></i></a>
                    </div>
                    <div class="col-xl-8 col-lg-7 d-none d-lg-block">
                        <div class="server-map">
                            <img src="{{asset('assets/img/servers.png')}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Servers -->

        <!-- Our clients -->
        {{-- <section class="clients-wrap pt-4 pb-4">
            <div class="container">
                <h2 data-animate="fadeInUp" data-delay=".1">Partenaires/Clients</h2>
                <ul class="our-clients list-unstyled d-md-flex align-items-md-center justify-content-md-between m-0">
                    <li data-animate="fadeInUp" data-delay=".1">
                        <a href="#" target="_blank"><img src="{{asset('assets/img/brands/brand1.png')}}" alt=""></a>
                    </li>
                    <li data-animate="fadeInUp" data-delay=".2">
                        <a href="#" target="_blank"><img src="{{asset('assets/img/brands/brand2.png')}}" alt=""></a>
                    </li>
                    <li data-animate="fadeInUp" data-delay=".3">
                        <a href="#" target="_blank"><img src="{{asset('assets/img/brands/brand3.png')}}" alt=""></a>
                    </li>
                    <li data-animate="fadeInUp" data-delay=".4">
                        <a href="#" target="_blank"><img src="{{asset('assets/img/brands/brand4.png')}}" alt=""></a>
                    </li>
                    <li data-animate="fadeInUp" data-delay=".5">
                        <a href="#" target="_blank"><img src="{{asset('assets/img/brands/brand5.png')}}" alt=""></a>
                    </li>
                    <li data-animate="fadeInUp" data-delay=".6">
                        <a href="#" target="_blank"><img src="{{asset('assets/img/brands/brand6.png')}}" alt=""></a>
                    </li>
                    <li data-animate="fadeInUp" data-delay=".7">
                        <a href="#" target="_blank"><img src="{{asset('assets/img/brands/brand7.png')}}" alt=""></a>
                    </li>
                    <li data-animate="fadeInUp" data-delay=".8">
                        <a href="#" target="_blank"><img src="{{asset('assets/img/brands/brand8.png')}}" alt=""></a>
                    </li>
                    <li data-animate="fadeInUp" data-delay=".9">
                        <a href="#" target="_blank"><img src="{{asset('assets/img/brands/brand9.png')}}" alt=""></a>
                    </li>
                </ul>
            </div>
        </section> --}}
        <!-- End of Our clients -->

@endsection

@section('custom_script')
    <script>

        function goToPlan(){
            $([document.documentElement, document.body]).animate({
                scrollTop: $("#register").offset().top
            }, 1000);
        }

      </script>
@endsection
