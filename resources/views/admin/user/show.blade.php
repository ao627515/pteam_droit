@extends('admin.layout')

@section('titre', 'produit')

@section('css')

@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                src="{{ asset('admin/dist/img/user4-128x128.jpg') }}" alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center">{{ $user->nom . ' ' . $user->prenom }}</h3>
                        <p class="text-muted">Role : {{ $user->role }}</p>
                        <p class="text-muted">E-mail : {{ $user->email }}</p>
                        <p class="text-muted">Téléphone : {{ $user->phone }}</p>
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
                            {{ $user->articles->count() }}</a>
                        <hr>
                        <strong><i class="fas fa-shop mr-1"></i> Produits</strong> <a
                            class="float-right">{{ $user->produits->count() }}</a>
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
                            <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Paramètre</a>
                            </li>
                            <li class="nav-item"><a class="nav-link " href="#activity" data-toggle="tab">Contacter</a>
                            </li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="settings">
                                <main class="d-flex">
                                    <div class="container">
                                        <div class="card">
                                            <div class="card-body">
                                                <fieldset class="border p-3">
                                                    <legend>Informations personnelles</legend>
                                                    <form action="{{ route('user.update', $user) }}" method="post"
                                                        class="form-action mb-3">
                                                        @method('put')
                                                        @csrf
                                                        <fieldset class="border p-3">
                                                            <legend>Données</legend>
                                                            <div class="form-group">
                                                                {{-- <label for="nom">Nom</label> --}}
                                                                <input type="text"
                                                                    class="form-control @error('nom') is-invalid @enderror"
                                                                    name="nom" id="nom" placeholder="Nom"
                                                                    value="{{ old('nom', $user->nom) }}">
                                                                @error('nom')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                {{-- <label for="prenom">Prénoms</label> --}}
                                                                <input type="text"
                                                                    class="form-control @error('prenom') is-invalid @enderror"
                                                                    name="prenom" id="prenom" placeholder="Prénoms"
                                                                    value="{{ old('prenom', $user->prenom) }}">
                                                                @error('prenom')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                {{-- <label for="telephone">Téléphone</label> --}}
                                                                <input type="tel"
                                                                    class="form-control @error('phone') is-invalid @enderror"
                                                                    name="phone" id="phone" placeholder="Téléphone"
                                                                    value="{{ old('phone', $user->phone) }}">
                                                                @error('phone')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                {{-- <label for="email">Email</label> --}}
                                                                <input type="email"
                                                                    class="form-control @error('email') is-invalid @enderror"
                                                                    name="email" id="email" placeholder="E-mail"
                                                                    value="{{ old('email', $user->email) }}">
                                                                @error('email')
                                                                    <p class="text-danger">{{ $message }}</p>
                                                                @enderror
                                                            </div>
                                                            <div class="mt-3">
                                                                <button type="button"
                                                                    class="btn btn-primary w-100 action-btn float-right"
                                                                    data-toggle="modal" data-target="#modal-update">
                                                                    Modifié
                                                                </button>
                                                            </div>
                                                        </fieldset>
                                                    </form>
                                                    <form action="{{ route('user.update_password') }}" method="get"
                                                        class="form-action mt-3">
                                                        @csrf
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
                                                            <div class="mt-3">
                                                                <button type="button"
                                                                    class="btn btn-primary w-100 action-btn float-right"
                                                                    data-toggle="modal" data-target="#modal-update">
                                                                    Modifié
                                                                </button>
                                                            </div>
                                                        </fieldset>
                                                    </form>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                </main>
                            </div>
                            <!-- /.tab-pane -->
                            <div class=" tab-pane" id="activity">
                                <!-- Post -->
                                <div class="post">
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg"
                                            alt="user image">
                                        <span class="username">
                                            <a href="#">Jonathan Burke Jr.</a>
                                            <a href="#" class="float-right btn-tool"><i
                                                    class="fas fa-times"></i></a>
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
            });
        });
    </script>
@endsection
