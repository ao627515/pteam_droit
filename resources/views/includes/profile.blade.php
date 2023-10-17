@extends('layout')
@section('css')
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script defer src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script defer src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="{{ asset('assets/profile/css/style.css') }}">
    {{-- <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script> --}}
@endsection
@section('content')
    <section class="py-5 my-5">
        <div class="container">
            <div class="bg-white shadow rounded d-block d-sm-flex">
                <div class="profile-tab-nav border-right">
                    <div class="p-4">
                        <div class="img-circle text-center mb-3">
                            <img src="{{ asset('assets/profile/img/user2.jpg') }}" alt="Image" class="shadow">
                        </div>
                        <h4 class="text-center">Kiran Acharya</h4>
                    </div>
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical"
                        style="width: 16rem">
                        <a class="nav-link active" id="notification-tab" data-toggle="pill" href="#notification"
                            role="tab" aria-controls="notification" aria-selected="false">
                            <i class="fa fa-bell text-center mr-1"></i>
                            Mes requtes / Demandes
                        </a>
                        <a class="nav-link" id="commandes-tab" data-toggle="pill" href="#commandes" role="tab"
                            aria-controls="commandes" aria-selected="false">
                            <i class="fa fa-bell text-center mr-1"></i>
                            Mes Commandes
                        </a>
                        <a class="nav-link" id="account-tab" data-toggle="pill" href="#account" role="tab"
                            aria-controls="account" aria-selected="true">
                            <i class="fa fa-home text-center mr-1"></i>
                            Infos Personnel
                        </a>
                        <a class="nav-link" id="password-tab" data-toggle="pill" href="#password" role="tab"
                            aria-controls="password" aria-selected="false">
                            <i class="fa fa-key text-center mr-1"></i>
                            Changer de mot de passe
                        </a>
                    </div>
                </div>
                <div class="tab-content p-md-5" id="v-pills-tabContent">
                    <div class="tab-pane fade show active container" id="notification" role="tabpanel"
                        aria-labelledby="notification-tab">
                        {{-- <h3 class="mb-4 mt-2 text-center">Mes requtes / Demandes</h3> --}}
                        <div class="row row-cols-2">
                            @foreach ($tickets as $i)
                                <div class=col">
                                    <div class="user-block mb-2">
                                        <span class="description">Envoyer le {{ $i->created_at->isoFormat('Do MMMM YYYY') }}
                                        </span>
                                    </div>
                                    <!-- /.user-block -->
                                    <div class="text-start mb-2">
                                        <h3>
                                            Objet: {{ $i->objet }}
                                        </h3>
                                        <h5 class="text-dark" style="font-weight: 500">
                                            Message: {{ $i->message }}
                                        </h5>
                                    </div>
                                    <hr>
                                </div>
                            @endforeach
                        </div>
                        <!-- /.post -->
                    </div>
                    <div class="tab-pane fade container" id="commandes" role="tabpanel" aria-labelledby="commandes-tab">
                        {{-- <h3 class="mb-4 mt-2 text-center">Mes requtes / Demandes</h3> --}}
                        <div class="text-justify mt-5">
                            <h4>Aucune Commandes disponibles...</h4>
                        </div>
                        <!-- /.post -->
                    </div>
                    <div class="tab-pane fade container " id="account" role="tabpanel" aria-labelledby="account-tab">
                        {{-- <h3 class="mb-4 mt-2 text-center">Mes Infos Personnels</h3> --}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nom :</label>
                                    <input type="text" class="form-control" value="{{ $user->nom }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Prenom (s):</label>
                                    <input type="text" class="form-control" value="{{ $user->prenom }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Téléphone:</label>
                                    <input type="text" class="form-control" value="{{ $user->phone }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email:</label>
                                    <input type="email" class="form-control" value="{{ $user->email }}" readonly>
                                </div>
                            </div>
                            {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label>Domaine</label>
                                    <input type="text" class="form-control" value="{{ $user->nom }}" readonly>
                                </div>
                            </div> --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Type compte:</label>
                                    <input type="text" class="form-control" value="{{ $user->type_compte }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button class="btn btn-primary">Modifier</button>
                        </div>
                    </div>
                    <div class="tab-pane fade  container" id="password" role="tabpanel" aria-labelledby="password-tab">
                        {{-- <h3 class="mb-4 mt-2 text-center">Changer de mot de passe</h3> --}}
                        <form action="{{ route('user.update_password') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Ancier mot de passe:</label>
                                        <input type="password" name="old_password" class="form-control"
                                            value="********">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nouveau mot de passe:</label>
                                        <input type="password" name="new_password" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Confirmer le mot de passe:</label>
                                        <input type="password" name="new_password_confirmation" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">Confirmer</button>
                                <button type="reset" class="btn btn-light">Annuler</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    {{-- <div class="container light-style flex-grow-1 container-p-y">
        <div class="card overflow-hidden mt-5 mb-5">
            <div class="row no-gutters row-bordered row-border-light">
                <div class="col-md-3 pt-0">
                    <div class="list-group list-group-flush account-settings-links">
                        <a class="list-group-item list-group-item-action active" data-toggle="list"
                            href="#account-requetes">Mes
                            requetes/Demandes </a>
                        <a class="list-group-item list-group-item-action" data-toggle="list" href="#commandes">Mes
                            commandes</a>
                        <a class="list-group-item list-group-item-action" data-toggle="list" href="#favorit">Favorit</a>
                        <a class="list-group-item list-group-item-action " data-toggle="list" href="#info-connection">Mes
                            infos de connections</a>
                        <a class="list-group-item list-group-item-action" data-toggle="list"
                            href="#account-change-password">Changer de mot de passe</a>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane fade  " id="info-connection">
                            <hr class="border-light m-0">
                            <div class="card-body">
                                <form action="{{ route('user.update', ['user' => $user->id]) }}" method="POST">
                                    @csrf
                                    @method('put')
                                    <div class="form-group">
                                        <label class="form-label">Nom</label>
                                        <input type="text" name="nom" class="form-control mb-1"
                                            value="{{ $user->nom }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Prenom (s)</label>
                                        <input type="text" name="prenom" class="form-control"
                                            value="{{ $user->prenom }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Téléphone</label>
                                        <input type="number" name="phone" class="form-control mb-1"
                                            value="{{ $user->phone }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">E-mail</label>
                                        <input type="email" name="email" class="form-control"
                                            value="{{ $user->email }}">
                                    </div>
                                    <div class="text-start mt-3">
                                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
                                    </div>
                            </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="account-change-password">
                            <div class="card-body pb-2">
                                <form action="{{route('user.update_password')}}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label class="form-label">Ancien mot de passe</label>
                                        <input type="password" name="old_password" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Nouveau mot de passe</label>
                                        <input type="password" name="new_password" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Confirmer le mot de passe</label>
                                        <input type="password" name="new_password_confirmation" class="form-control">
                                    </div>
                                    <div class="text-start mt-3">
                                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade active show" id="account-requetes">
                            <div class="card-body pb-2">
                                <div class="text-center">
                                    <h2>Aucune Requetes disponibles...</h2>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="favorit">
                            <div class="card-body pb-2">
                            </div>
                        </div>
                        <div class="tab-pane fade" id="commandes">
                            <div class="card-body pb-2">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
