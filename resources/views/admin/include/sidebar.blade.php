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
                <a href="" class="d-block">{{ auth()->user()->nom . ' ' . auth()->user()->prenom }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
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
                <li class="nav-header">Articles</li>
                {{-- Administrateur --}}
                <li class="nav-item @if (Str::startsWith(request()->route()->getName(),
                        'articleAdmin.')) menu-open @endif">
                    <a href="#" class="nav-link @if (Str::startsWith(request()->route()->getName(),
                            'articleAdmin.')) active @endif">
                        <i class="nav-icon fa-regular fa-newspaper"></i>

                        <p>
                            Articles
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
                <li class="nav-header">Produits</li>
                <li class="nav-item @if (Str::startsWith(request()->route()->getName(),
                        'produitAdmin.')) menu-open @endif">
                    <a href="#" class="nav-link @if (Str::startsWith(request()->route()->getName(),
                            'produitAdmin.')) active @endif">
                                <i class="nav-icon fa-solid fa-store"></i>
                        <p>
                            Produits
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
