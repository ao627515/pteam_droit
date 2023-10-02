
        <header class="header">
            <div class="header-top bg-info" data-animate="fadeInDown" data-delay=".5">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-9">
                            <!-- Header info -->
                            <ul class="header-info list-inline text-white mb-md-0">
                                <li>Email : info@xxxx.com</li>
                                <li>Téléphone : (+226) 05 XX XX XX</li>
                            </ul>
                        </div>
                        <div class="col-md-3 d-none d-md-block">
                            <!-- Header social icons -->
                            <ul class="social-icons text-right list-inline m-0">
                                <li>Suivez nous</li>
                                <li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="#" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="main-header">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-2 col-md-3 col-sm-3 col-9">
                            <!-- Logo -->
                            <div class="logo" data-animate="fadeInUp" data-delay=".7">
                                <a href="{{route('home.index')}}">
                                    <img src="{{asset('assets/img/logo-small.png')}}" alt="logo">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-5 col-sm-3 col-3">
                            <nav data-animate="fadeInUp" data-delay=".9">
                                <!-- Header-menu -->
                                <div class="header-menu">
                                    <ul>
                                        <li class="{{ Request::routeIs('home.index') ? 'active' : '' }}">
                                            <a href="{{route('home.index')}}">Accueil</a>
                                        </li>
                                        <li><a href="#services">Services</a></li>
                                        <li class="{{ Request::routeIs('categorie.show') ? 'active' : '' }}">
                                            <a href="#">Publications <i
                                                    class="fas fa-caret-down"></i></a>
                                            <ul>
                                                <li>
                                                    <a href="{{route('categorie.show',1)}}">Droit du travail</a>
                                                </li>
                                                <li>
                                                    <a href="{{route('categorie.show',2)}}">Droit du commerce</a>
                                                </li>
                                                <li>
                                                    <a href="{{route('categorie.show',3)}}">Droit Civil</a>
                                                </li>
                                                <li>
                                                    <a href="{{route('categorie.show',4)}}">Etc...</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="{{ Request::routeIs('partenaire.index') ? 'active' : '' }}">
                                            <a href="{{route('partenaire.index')}}">Cabinets Partenaire</a></li>
                                        {{-- <li><a href="#">Contact</a></li> --}}
                                        <li>
                                            <a href="#">A propos </a>
                                        </li>
                                        <li class="d-sm-none d-md-none d-lg-none d-xl-none">
                                            <a href="{{route('auth.loginform')}}">Mon compte
                                                <i class="fas fa-caret-down"></i>
                                            </a>
                                            <ul>
                                                <li><a href="#">Profil</a></li>
                                                <li><a href="#">Mes requêtes</a></li>
                                                {{-- <li><a href="#">Mes commandes</a></li> --}}
                                                <li><a href="{{route('disconnect')}}">
                                                    <i class="fas fa-sign-out-alt fa-lg"></i>
                                                    Se déconnecter 
                                                  </a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                <!-- End of Header-menu -->
                            </nav>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 d-none d-sm-block">
                            <!-- Client area -->
                            
                            @if (Auth::user())
                            <div class="header-menu">
                                <ul class="text-right m-0" data-animate="fadeInUp" data-delay=".5">
                                    <li>
                                        <a class="btn btn-primary p-2 text-white" href="#">Mon compte
                                            <i class="fas fa-caret-down"></i>
                                        </a>
                                        <ul>
                                            <li><a href="#">Profil</a></li>
                                            <li><a href="#">Mes requêtes</a></li>
                                            {{-- <li><a href="#">Mes commandes</a></li> --}}
                                            <li><a href="{{route('disconnect')}}">
                                                <i class="fas fa-sign-out-alt fa-lg"></i>
                                                Se déconnecter 
                                              </a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                                
                            @else
                            <ul class="client-area text-right list-inline m-0" data-animate="fadeInUp" data-delay="1.1">
                                <li>
                                    <a class="btn btn-primary" href="{{route('auth.loginform')}}">Se connecter</a>
                                </li>
                            </ul>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </header>