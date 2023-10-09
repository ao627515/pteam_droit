@extends('layout')
@section('css')
    <script defer src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
    <script defer type="text/javascript"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/profileStyle.css') }}">
    {{-- <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script> --}}
@endsection
@section('content')
    <div class="container light-style flex-grow-1 container-p-y">
        <div class="card overflow-hidden">
            <div class="row no-gutters row-bordered row-border-light">
                <div class="col-md-3 pt-0">
                    <div class="list-group list-group-flush account-settings-links">
                        <a class="list-group-item list-group-item-action active" data-toggle="list" href="#account-requetes">Mes
                            requetes/Demandes </a>
                            <a class="list-group-item list-group-item-action" data-toggle="list" href="#commandes">Mes commandes</a>
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
                                <div class="form-group">
                                    <label class="form-label">Nom</label>
                                    <input type="text" class="form-control mb-1" value="">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Prenom (s)</label>
                                    <input type="text" class="form-control" value="">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Téléphone</label>
                                    <input type="number" class="form-control mb-1" value="">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">E-mail</label>
                                    <input type="email" class="form-control" value="">
                                </div>
                                <div class="text-start mt-3">
                                    <button type="button" class="btn btn-primary">Mettre à jour</button>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="account-change-password">
                            <div class="card-body pb-2">
                                <div class="form-group">
                                    <label class="form-label">Ancien mot de passe</label>
                                    <input type="password" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Nouveau mot de passe</label>
                                    <input type="password" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Confirmer le mot de passe</label>
                                    <input type="password" class="form-control">
                                </div>
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
    </div>
@endsection
