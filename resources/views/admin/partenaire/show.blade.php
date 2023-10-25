@extends('admin.layout')

@section('titre', 'Partenaire detail')

@section('css')
    <style>
        .notification {
            height: 10px;
            width: 10px;
            opacity: 1;
            position: relative;
            left: 55px;
            padding: 5px;
            background-color: red;
            border: red solid 5px;
            border-radius: 100%;
            z-index: 2;
            bottom: 10px
        }

        #btn-card {
            height: 75px;
            width: 75px;
            top: 80vh;
            left: 70vw;
        }

        #btn-action {
            opacity: 0.3;
        }

        #btn-action:hover {
            opacity: 1;

        }

        /* // Small devices (landscape phones, 576px and up) */
        @media (min-width: 576px) {
            #btn-card {
                left: 85vw;
            }
        }

        /* Extra large devices (large desktops, 1200px and up) */
        @media (min-width: 1200px) {
            #btn-card {
                left: 90vw;
            }
        }

        // Large devices (desktops, less than 1200px)
        @media (max-width: 1199.98px) {
            #btn-card {
                left: 95vw;
            }
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        @if (auth()->user()->isAdmin())
            <div class="btn-group fixed-top" id="btn-card" style="">
                @if ($partenaire->isDeclined())
                    <span class="notification"></span>
                @endif
                <button type="button" class="btn btn-info  rounded-circle text-light fw-bold" data-toggle="dropdown"
                    id="btn-action">Actions</button>
                <div class="dropdown-menu" role="menu">
                    <div class="dropdown-item">
                        <button class="btn btn-primary w-100 action-btn" data-toggle="modal" data-target="#motif-modal">
                            Motif(s)
                            <span class="badge badge-danger">{{ $notifications->count() }}</span>
                        </button>
                    </div>
                    @if ($partenaire->isStandBy())
                        <form action="{{ route('partenaireAdmin.declined', $partenaire) }}" method="post"
                            class="form-action dropdown-item" id="declinedForm">
                            @csrf
                            <input type="hidden" name="motif" id="motifHidden">
                            <button type="button" class="btn btn-danger w-100 action-btn" data-toggle="modal"
                                data-target="#modal-declined">
                                <i class="fas fa-times-circle"></i> Refuser
                            </button>
                        </form>

                        <form action="{{ route('partenaireAdmin.approuved', $partenaire) }}" method="post"
                            class="form-action dropdown-item">
                            @csrf
                            <button type="button" class="btn btn-primary w-100 action-btn" data-toggle="modal"
                                data-target="#modal-approuved">
                                <i class="fas fa-check-circle"></i> Approuver
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-md-3">
                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                src="{{ asset('admin/dist/img/user4-128x128.jpg') }}" alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center">{{ $partenaire->nom . ' ' . $partenaire->prenom }}</h3>
                        <p class="text-muted">Role : {{ $partenaire->role }}</p>
                        <p class="text-muted">Domaine : {{ $organisation->domaine->nom }}</p>
                        <p class="text-muted"> Statut : {{ $partenaire->partenaireStatus() }}</p>

                        <a href="#" class="btn btn-primary btn-block"><b>Prestations</b></a>
                        <ul class="list-group list-group-unbordered mb-3">
                            @foreach ($partenaire->prestations as $prestation)
                                <li class="list-group-item">
                                    <b>{{ $prestation->nom }}</b>
                                </li>
                            @endforeach
                        </ul>

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- About Me Box -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">A propos</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <strong><i class="fas fa-book mr-1"></i> Articles</strong> <a class="float-right">
                            {{ $partenaire->articles->count() }}</a>
                        <hr>
                        <strong><i class="fas fa-shop mr-1"></i> Produits</strong> <a
                            class="float-right">{{ $partenaire->produits->count() }}</a>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active " href="#profile" data-toggle="tab">Profile</a>
                            </li>
                            <li class="nav-item"><a class="nav-link " href="#activity" data-toggle="tab">Contacter</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Paramètre</a>
                            </li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="profile">
                                <div class="card">
                                    <div class="card-body">
                                        <fieldset class="border p-3 mb-5">
                                            <legend>Informations personnel</legend>
                                            <table class="table">
                                                <tr>
                                                    <th>Nom</th>
                                                    <td>{{ $partenaire->nom . ' ' . $partenaire->prenom }}</td>
                                                </tr>
                                                <tr>
                                                    <th>E-mail</th>
                                                    <td>{{ $partenaire->email }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Téléphone</th>
                                                    <td>{{ $partenaire->phone }}</td>
                                                </tr>
                                            </table>
                                        </fieldset>
                                        <fieldset class="border p-3">
                                            <legend>Informations de l'entreprise</legend>
                                            <div>
                                                <img src="{{ asset('storage/'.$organisation->logo) }}" alt="{{ 'logo de '.$organisation->nom }}" height="100px">
                                            </div>
                                            <table class="table">
                                                <tr>
                                                    <th>Nom</th>
                                                    <td>{{ $organisation->nom }}</td>
                                                </tr>
                                                <tr>
                                                    <th>E-mail</th>
                                                    <td>{{ $organisation->email }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Téléphone</th>
                                                    <td>{{ $organisation->phone }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Domaine</th>
                                                    <td>{{ $organisation->domaine->nom }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Description</th>
                                                    <td>{{ $organisation->description }}</td>
                                                </tr>
                                                <tr>
                                                    <th>RCCM</th>
                                                    <td><a
                                                            href="{{ asset('storage/' . $organisation->val_doc_1) }}">Ouvrir</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Doc 2</th>
                                                    <td><a
                                                            href="{{ asset('storage/' . $organisation->val_doc_2) }}">Ouvrir</a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                            <div class=" tab-pane" id="activity">
                                <!-- Post -->
                                <div class="post">
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg"
                                            alt="user image">
                                        <span class="username">
                                            <a href="#">Jonathan Burke Jr.</a>
                                            <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                                        </span>
                                        <span class="description">Shared publicly - 7:30 PM today</span>
                                    </div>
                                    <!-- /.user-block -->
                                    <p>
                                        Lorem ipsum represents a long-held tradition for designers,
                                        typographers and the like. Some people hate it and argue for
                                        its demise, but others ignore the hate as they create awesome
                                        tools to help create filler text for everyone from bacon lovers
                                        to Charlie Sheen fans.
                                    </p>

                                    <p>
                                        <a href="#" class="link-black text-sm mr-2"><i
                                                class="fas fa-share mr-1"></i>
                                            Share</a>
                                        <a href="#" class="link-black text-sm"><i
                                                class="far fa-thumbs-up mr-1"></i>
                                            Like</a>
                                        <span class="float-right">
                                            <a href="#" class="link-black text-sm">
                                                <i class="far fa-comments mr-1"></i> Comments (5)
                                            </a>
                                        </span>
                                    </p>

                                    <input class="form-control form-control-sm" type="text"
                                        placeholder="Type a comment">
                                </div>
                                <!-- /.post -->

                                <!-- Post -->
                                <div class="post clearfix">
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm" src="../../dist/img/user7-128x128.jpg"
                                            alt="User Image">
                                        <span class="username">
                                            <a href="#">Sarah Ross</a>
                                            <a href="#" class="float-right btn-tool"><i
                                                    class="fas fa-times"></i></a>
                                        </span>
                                        <span class="description">Sent you a message - 3 days ago</span>
                                    </div>
                                    <!-- /.user-block -->
                                    <p>
                                        Lorem ipsum represents a long-held tradition for designers,
                                        typographers and the like. Some people hate it and argue for
                                        its demise, but others ignore the hate as they create awesome
                                        tools to help create filler text for everyone from bacon lovers
                                        to Charlie Sheen fans.
                                    </p>

                                    <form class="form-horizontal">
                                        <div class="input-group input-group-sm mb-0">
                                            <input class="form-control form-control-sm" placeholder="Response">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-danger">Send</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.post -->

                                <!-- Post -->
                                <div class="post">
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm" src="../../dist/img/user6-128x128.jpg"
                                            alt="User Image">
                                        <span class="username">
                                            <a href="#">Adam Jones</a>
                                            <a href="#" class="float-right btn-tool"><i
                                                    class="fas fa-times"></i></a>
                                        </span>
                                        <span class="description">Posted 5 photos - 5 days ago</span>
                                    </div>
                                    <!-- /.user-block -->
                                    <div class="row mb-3">
                                        <div class="col-sm-6">
                                            <img class="img-fluid" src="../../dist/img/photo1.png" alt="Photo">
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <img class="img-fluid mb-3" src="../../dist/img/photo2.png"
                                                        alt="Photo">
                                                    <img class="img-fluid" src="../../dist/img/photo3.jpg"
                                                        alt="Photo">
                                                </div>
                                                <!-- /.col -->
                                                <div class="col-sm-6">
                                                    <img class="img-fluid mb-3" src="../../dist/img/photo4.jpg"
                                                        alt="Photo">
                                                    <img class="img-fluid" src="../../dist/img/photo1.png"
                                                        alt="Photo">
                                                </div>
                                                <!-- /.col -->
                                            </div>
                                            <!-- /.row -->
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->

                                    <p>
                                        <a href="#" class="link-black text-sm mr-2"><i
                                                class="fas fa-share mr-1"></i> Share</a>
                                        <a href="#" class="link-black text-sm"><i
                                                class="far fa-thumbs-up mr-1"></i> Like</a>
                                        <span class="float-right">
                                            <a href="#" class="link-black text-sm">
                                                <i class="far fa-comments mr-1"></i> Comments (5)
                                            </a>
                                        </span>
                                    </p>

                                    <input class="form-control form-control-sm" type="text"
                                        placeholder="Type a comment">
                                </div>
                                <!-- /.post -->
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="settings">
                                <main class="d-flex">
                                    <div class="container">
                                        <div class="card login-card">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="card-body">
                                                        <form action="{{ route('partenaireAdmin.update', $partenaire) }}"
                                                            method="post" class="form-action">
                                                            @method('put')
                                                            @csrf
                                                            <fieldset class="border p-3">
                                                                <legend>Informations personnelles</legend>
                                                                <fieldset class="border p-3">
                                                                    <legend>Données</legend>
                                                                    <div class="form-group">
                                                                        {{-- <label for="nom">Nom</label> --}}
                                                                        <input type="text"
                                                                            class="form-control @error('nom') is-invalid @enderror"
                                                                            name="nom" id="nom"
                                                                            placeholder="Nom"
                                                                            value="{{ old('nom', $partenaire->nom) }}">
                                                                        @error('nom')
                                                                            <p class="text-danger">{{ $message }}</p>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="form-group">
                                                                        {{-- <label for="prenom">Prénoms</label> --}}
                                                                        <input type="text"
                                                                            class="form-control @error('prenom') is-invalid @enderror"
                                                                            name="prenom" id="prenom"
                                                                            placeholder="Prénoms"
                                                                            value="{{ old('prenom', $partenaire->prenom) }}">
                                                                        @error('prenom')
                                                                            <p class="text-danger">{{ $message }}</p>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="form-group">
                                                                        {{-- <label for="telephone">Téléphone</label> --}}
                                                                        <input type="tel"
                                                                            class="form-control @error('phone') is-invalid @enderror"
                                                                            name="phone" id="phone"
                                                                            placeholder="Téléphone"
                                                                            value="{{ old('phone', $partenaire->phone) }}">
                                                                        @error('phone')
                                                                            <p class="text-danger">{{ $message }}</p>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="form-group">
                                                                        {{-- <label for="email">Email</label> --}}
                                                                        <input type="email"
                                                                            class="form-control @error('email') is-invalid @enderror"
                                                                            name="email" id="email"
                                                                            placeholder="E-mail"
                                                                            value="{{ old('email', $partenaire->email) }}">
                                                                        @error('email')
                                                                            <p class="text-danger">{{ $message }}</p>
                                                                        @enderror
                                                                    </div>
                                                                </fieldset>
                                                                <fieldset class="border p-3">
                                                                    <legend>Changer de mot de passe</legend>
                                                                    <div class="form-group mb-2">
                                                                        {{-- <label for="password">Mot de passe</label> --}}
                                                                        <input type="password"
                                                                            class="form-control @error('old_password') is-invalid @enderror"
                                                                            name="old_password" id="old_password"
                                                                            placeholder="Ancien mot de passe"
                                                                            value="{{ old('old_password') }}">
                                                                        @error('old_password')
                                                                            <p class="text-danger">{{ $message }}</p>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="form-group mb-2">
                                                                        {{-- <label for="password">Mot de passe</label> --}}
                                                                        <input type="password"
                                                                            class="form-control @error('new_password') is-invalid @enderror"
                                                                            name="new_password" id="new_password"
                                                                            placeholder="Nouveau mot de passe"
                                                                            value="{{ old('new_password') }}">
                                                                        @error('new_password')
                                                                            <p class="text-danger">{{ $message }}</p>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="form-group mb-2">
                                                                        {{-- <label for="password">Mot de passe</label> --}}
                                                                        <input type="password"
                                                                            class="form-control @error('new_password_confirmation') is-invalid @enderror"
                                                                            name="new_password_confirmation"
                                                                            id="new_password_confirmation"
                                                                            placeholder="Confirmé le mot de passe"
                                                                            value="{{ old('new_password_confirmation') }}">
                                                                        @error('new_password_confirmation')
                                                                            <p class="text-danger">{{ $message }}</p>
                                                                        @enderror
                                                                    </div>
                                                                </fieldset>
                                                                <div class="mt-3 float-right">
                                                                    <button type="button"
                                                                        class="btn btn-primary w-100 action-btn"
                                                                        data-toggle="modal" data-target="#modal-update">
                                                                        Modifié
                                                                    </button>
                                                                </div>
                                                            </fieldset>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="card-body">
                                                        <form action="{{ route('organisation.update', $organisation) }}"
                                                            method="post" class="form-action"
                                                            enctype="multipart/form-data">
                                                            @method('put')
                                                            @csrf
                                                            <fieldset class="border p-3 mt-5 mb-4">
                                                                <legend>Informations de l'entreprise</legend>
                                                                {{ $organisation->imgInit() }}
                                                                <div class="row">
                                                                    <div class="form-group p-1 my-2 border col-8 mb-3">
                                                                        <label for="logo" class="form-label">Logo
                                                                        </label>
                                                                        <input type="file" id="logo"
                                                                            name="logo" value="{{ old('logo') }}">
                                                                        {{-- <input type="file" name="photograph" id="photo" required="true" /> --}}
                                                                        @error('logo')
                                                                            <p class="text-danger">{{ $message }}</p>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="col-4 text-center">
                                                                        {{-- <img src="#" alt="pic" /> --}}
                                                                        <img src="{{ $organisation->logo }}"
                                                                            id="imgPreview" alt="Logo"
                                                                            height="100" />
                                                                        {{-- <img src="{{ asset('assets/img/550x550.jpg') }}"
                                                                            id="imgPreview" alt="Logo" height="100" /> --}}
                                                                    </div>
                                                                </div>

                                                                <div class="form-group mb-3">
                                                                    <label for="nom_pro"> Nom</label>
                                                                    <input type="text"
                                                                        class="form-control @error('nom_pro') is-invalid @enderror"
                                                                        name="nom_pro" id="nom_pro"
                                                                        placeholder="Raison sociale"
                                                                        value="{{ old('nom_pro', $organisation->nom) }}" />
                                                                    @error('nom_pro')
                                                                        <p class="text-danger">{{ $message }}</p>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group mb-3">
                                                                    <label for="phone_pro">Numéro</label>
                                                                    <input type="tel"
                                                                        class="form-control @error('phone_pro') is-invalid @enderror"
                                                                        name="phone_pro" id="phone_pro"
                                                                        placeholder="Téléphone entrepise"
                                                                        value="{{ old('phone_pro', $organisation->phone) }}" />
                                                                    @error('phone_pro')
                                                                        <p class="text-danger">{{ $message }}</p>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group mb-3">
                                                                    <label for="email_pro">E-mail</label>
                                                                    <input type="email"
                                                                        class="form-control @error('email_pro') is-invalid @enderror"
                                                                        name="email_pro" id="email_pro"
                                                                        placeholder="E-mail entreprise"
                                                                        value="{{ old('email_pro', $organisation->email) }}">
                                                                    @error('email_pro')
                                                                        <p class="text-danger">{{ $message }}</p>
                                                                    @enderror
                                                                </div>

                                                                <div class="form-group  mb-3">
                                                                    <label for="domaine">Domaine d'activité</label>
                                                                    <select
                                                                        class="form-control p-2 @error('domaine') is-invalid @enderror"
                                                                        name="domaine" id="domaine"
                                                                        placeholder="Choisir"
                                                                        @foreach ($domaines as $item)
                                                                        value="{{ old('domaine', $item->id) }}">
                                                                            <option value="{{ $item->id }}">
                                                                                {{ $item->nom }}</option> @endforeach
                                                                        </select>
                                                                        @error('domaine')
                                                                            <p class="text-danger">{{ $message }}</p>
                                                                        @enderror
                                                                </div>

                                                                <div class="form-group  mb-3">
                                                                    <label for="description">Description</label>
                                                                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                                                                        placeholder="Decrivez brievement les services de votre entreprise" cols="30" rows="3">{{ old('description', $organisation->description) }}</textarea>
                                                                    @error('description')
                                                                        <p class="text-danger text-center">{{ $message }}
                                                                        </p>
                                                                    @enderror
                                                                </div>

                                                                <div class="form-group p-1 my-2 border">
                                                                    <label for="val_doc_1" class="form-label">RCCM:
                                                                    </label>
                                                                    <input type="file" id="val_doc_1" name="val_doc_1"
                                                                        value="{{ old('val_doc_1') }}">
                                                                    @error('val_doc_1')
                                                                        <p class="text-danger">{{ $message }}</p>
                                                                    @enderror
                                                                    <a
                                                                        href="{{ asset('storage/' . $organisation->val_doc_1) }}">Ouvrir
                                                                        le PDF</a>
                                                                </div>
                                                                <div class="form-group p-1 my-2 border">
                                                                    <label for="val_doc_2" class="form-label">DOC2:
                                                                    </label>
                                                                    <input type="file" id="val_doc_2" name="val_doc_2"
                                                                        value="{{ old('val_doc_2') }}">
                                                                    @error('val_doc_2')
                                                                        <p class="text-danger">{{ $message }}</p>
                                                                    @enderror
                                                                    <a
                                                                        href="{{ asset('storage/' . $organisation->val_doc_2) }}">Ouvrir
                                                                        le PDF</a>
                                                                </div>
                                                            </fieldset>
                                                            <div class="mt-3">
                                                                <button type="button"
                                                                    class="btn btn-primary float-right action-btn"
                                                                    data-toggle="modal" data-target="#modal-update">
                                                                    Modifié
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </main>
                            </div>
                            <!-- /.tab-pane -->

                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <div class="modal fade" id="modal-approuved">
        <div class="modal-dialog">
            <div class="modal-content bg-default">
                <div class="modal-header">
                    <h4 class="modal-title">Confirmation</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Voullez vous Publier cette article ?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-outline-primary" id="confirmApprouvation">Oui</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="modal-declined">
        <div class="modal-dialog modal-lg">
            <div class="modal-content bg-danger">
                <div class="modal-header">
                    <h4 class="modal-title">Décliné un article</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="motif">Motif de refus</label>
                        <textarea id="motifModal" id="motif" rows="15" id="motif" class="form-control">{{ old('motif') }}</textarea>
                    </div>
                    @error('motif')
                        <span class="text-light">Erreur : {{ $message }}</span>
                    @enderror
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-outline-light" id="confirmRefus">Oui</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="modal-update">
        <div class="modal-dialog">
            <div class="modal-content bg-default">
                <div class="modal-header">
                    <h4 class="modal-title">Confirmation</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Voullez vous modifié ces données ?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-outline-primary" id="confirmUpdate">Oui</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="motif-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Motif de refus</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @forelse ($notifications as $notification)
                        @if (isset($notification->data['motif']))
                            <div>
                                <span>{{ $partenaire->getActionDate() }}</span>
                                <p class="lead">{{ $notification->data['motif'] }}</p>
                            </div>
                            <hr>
                        @endif
                    @empty
                        <p>Votre article n'a jamais été décliné</p>
                    @endforelse
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $(function() {
            $('.action-btn').on('click', function() {
                var form = $(this).closest('.form-action');

                $('#confirmUpdate').on('click', function() {
                    // Soumettre le formulaire
                    form.submit();
                });

                $('#confirmRelaunch').on('click', function() {
                    // Soumettre le formulaire
                    form.submit();
                });
            });

            $('#modal-declined').on('show.bs.modal', function(event) {

                $('#confirmRefus').on('click', function() {
                    let motif = $('#motifModal').val();

                    $('#motifHidden').val(motif);

                    $('#declinedForm').submit();
                });
            });

            @if ($errors->has('motif'))
                $('#modal-declined').modal('show')
            @endif
        });
    </script>
@endsection
