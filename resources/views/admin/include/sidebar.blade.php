<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href=" index3.html" class="brand-link">
        <img src="{{ asset('admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Mon droit</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('user.show', auth()->user()) }}" class="d-block">{{ auth()->user()->nom . ' ' . auth()->user()->prenom }}</a>
                <small class="d-block text-light">Rôle : {{ auth()->user()->role }}</small>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
                @if (auth()->user()->isAdmin())
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}"
                            class="nav-link @if (Str::startsWith(request()->route()->getName(),
                                    'dashboard')) active @endif ">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                @endif
                {{-- <li class="nav-header">REQUETES UTILISATEUR</li> --}}
                <li class="nav-item @if (Str::startsWith(request()->route()->getName(),
                        '')) menu-open @endif">
                    <a href="#" class="nav-link @if (Str::startsWith(request()->route()->getName(),
                            '')) active @endif">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>
                            Requêtes utilisateur
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        {{-- <li class="nav-item">
                                <a href="{{ route('user.create') }}"
                                    class="nav-link @if (Request::routeIs('user.create')) active @endif">
                                    <i class="fa-solid fa-user-plus nav-icon"></i>
                                    <p>Créer</p>
                                </a>
                            </li> --}}
                        <li class="nav-item">
                            <a href="#" class="nav-link  @if (Request::routeIs('')) active @endif">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Listes</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- <li class="nav-header">ARTICLES</li> --}}
                <li class="nav-item @if (Str::startsWith(request()->route()->getName(),
                        'articleAdmin.')) menu-open @endif">
                    <a href="#" class="nav-link @if (Str::startsWith(request()->route()->getName(),
                            'articleAdmin.')) active @endif">
                        <i class="nav-icon fa-regular fa-newspaper"></i>

                        <p>
                            Articles
                            @if (Request::routeIs('articleAdmin.edit'))
                                <i class=" fa-solid fa-pen"></i>
                            @endif
                            @if (Request::routeIs('articleAdmin.show'))
                                <i class=" fa-solid fa-eye"></i>
                            @endif
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('articleAdmin.create') }}"
                                class="nav-link @if (Request::routeIs('articleAdmin.create')) active @endif">
                                <i class="nav-icon fa-solid fa-plus"></i>
                                <p>Créer</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('articleAdmin.index') }}"
                                class="nav-link  @if (Request::routeIs('articleAdmin.index')) active @endif">
                                <i class="nav-icon fa-regular fa-newspaper"></i>
                                <p>Liste</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- <li class="nav-header">PRODUITS</li> --}}
                <li class="nav-item @if (Str::startsWith(request()->route()->getName(),
                        'produitAdmin.')) menu-open @endif">
                    <a href="#" class="nav-link @if (Str::startsWith(request()->route()->getName(),
                            'produitAdmin.')) active @endif">
                        <i class="nav-icon fa-solid fa-store"></i>
                        <p>
                            Produits
                            @if (Request::routeIs('produitAdmin.edit'))
                                <i class=" fa-solid fa-pen"></i>
                            @endif
                            @if (Request::routeIs('produitAdmin.show'))
                                <i class=" fa-solid fa-eye"></i>
                            @endif
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('produitAdmin.create') }}"
                                class="nav-link @if (Request::routeIs('produitAdmin.create')) active @endif">
                                <i class="nav-icon fa-solid fa-plus"></i>
                                <p>Créer</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('produitAdmin.index') }}"
                                class="nav-link  @if (Request::routeIs('produitAdmin.index')) active @endif">
                                <i class="nav-icon fa-solid fa-store"></i>
                                <p>Liste</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @if (auth()->user()->isAdmin())
                    {{-- <li class="nav-header">UTILISATEURS</li> --}}
                    <li class="nav-item @if (Str::startsWith(request()->route()->getName(),
                            'user.') or
                            Str::startsWith(request()->route()->getName(),
                                'partenaireAdmin.')) menu-open @endif">
                        <a href="#" class="nav-link @if (Str::startsWith(request()->route()->getName(),
                                'user.') or
                                Str::startsWith(request()->route()->getName(),
                                    'partenaireAdmin.')) active @endif">
                            <i class="nav-icon fa-solid fa-users"></i>
                            <p>
                                Uitilisateurs
                                @if (Request::routeIs('user.edit'))
                                    <i class=" fa-solid fa-pen"></i>
                                @endif
                                @if (Request::routeIs('user.show') or Request::routeIs('partenaireAdmin.show'))
                                    <i class=" fa-solid fa-eye"></i>
                                @endif
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('user.create') }}"
                                    class="nav-link @if (Request::routeIs('user.create')) active @endif">
                                    <i class="fa-solid fa-user-plus nav-icon"></i>
                                    <p>Créer</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('partenaireAdmin.index') }}"
                                    class="nav-link @if (Request::routeIs('partenaireAdmin.index')) active @endif">
                                    <i class="fa-solid fa-user-tie nav-icon"></i>
                                    <p>Partenaires en attente</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('user.index') }}"
                                    class="nav-link  @if (Request::routeIs('user.index')) active @endif">
                                    <i class="nav-icon fa-solid fa-user-secret"></i>
                                    <p>Listes</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                {{-- <li class="nav-header">PARAMETRES</li> --}}
                <li class="nav-item @if (str_contains(request()->route()->getName(),
                        'domaine') ||
                        str_contains(request()->route()->getName(),
                            'categorie') ||
                        str_contains(request()->route()->getName(),
                            'typeCompte') ||
                        str_contains(request()->route()->getName(),
                            'prestation')) menu-open @endif">
                    <a href="#" class="nav-link @if (Str::startsWith(request()->route()->getName(),
                            '')) active @endif">
                        <i class="nav-icon fas fa-cogs"></i> <!-- FontAwesome 5 gear icon -->
                        <p>
                            Paramètres
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if (auth()->user()->role == 'administrateur')
                            <li class="nav-item">
                                <a href="{{ route('categorie.index') }}"
                                    class="nav-link @if (Request::routeIs('categorie.index')) active @endif">
                                    <i class="nav-icon fas fa-folder"></i> <!-- FontAwesome 5 folder icon -->
                                    <p>Categories</p>
                                </a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a href="{{ route('domaine.index') }}"
                                class="nav-link @if (Request::routeIs('domaine.index')) active @endif">
                                <i class="nav-icon fas fa-globe"></i> <!-- FontAwesome 5 globe icon -->
                                <p>Domaines</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('prestation.index') }}"
                                class="nav-link  @if (Request::routeIs('prestation.index')) active @endif">
                                <i class="nav-icon fas fa-store-alt"></i> <!-- FontAwesome 5 store-alt icon -->
                                <p>Prestations</p>
                            </a>
                        </li>
                        @if (auth()->user()->role == 'administrateur')
                            <li class="nav-item">
                                <a href="{{ route('typeCompte.index') }}"
                                    class="nav-link  @if (Request::routeIs('typeCompte.index')) active @endif">
                                    <i class="nav-icon fas fa-id-card"></i> <!-- FontAwesome 5 id-card icon -->
                                    <p>Type de comptes</p>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('notifications') }}"
                        class="nav-link @if (Str::startsWith(request()->route()->getName(),
                                'notifications')) active @endif ">
                        <i class="nav-icon fas fa-bell"></i>
                        <p>
                            Notifications <span
                                class="badge badge-light">{{ auth()->user()->unreadNotifications->count() }}</span>
                            <span class="sr-only">unread messages</span>
                        </p>
                    </a>
                </li>
                <li class="nav-header">DECONNEXION</li>
                <li class="nav-item ">
                    <a href="{{ route('disconnect') }}" class="nav-link ">
                        <i class="fa-solid fa-power-off nav-icon" style="color: #ff0000;"></i>
                        <p class="text-light">Déconnexion</p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
