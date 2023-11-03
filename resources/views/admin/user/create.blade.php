@extends('admin.layout')

@section('title', 'Créer un administrateur')

@section('content')
    <div class="card">
        <div class="card-header bg-secondary">
            <h1 class="text-center w-100 text-light">Créer un administrateur</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('user.store') }}" method="post" id="formCreate">
                @csrf
                <div class="row row-cols-1">
                    <div class="col mb-3">
                        <div class="form-group">
                            <label for="nom">Nom</label>
                            <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom"
                                name="nom" required value="{{ old('nom') }}">
                            @error('nom')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col mb-3">
                        <div class="form-group">
                            <label for="prenom">Prénom(s)</label>
                            <input type="text" class="form-control @error('prenom') is-invalid @enderror" id="prenom"
                                name="prenom" required value="{{ old('prenom') }}">
                            @error('prenom')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col mb-3">
                        <div class="form-group">
                            <label for="phone">Téléphone</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"
                                name="phone" required value="{{ old('phone') }}">
                            @error('phone')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col mb-3">
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" required value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col mb-3">
                        <div class="form-group">
                            <label for="password">Mot de passe</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                                name="password" required value="{{ old('password') }}">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                </div>
                <button type="button" class="btn btn-primary w-100 " data-toggle="modal" data-target="#modal-default">
                    Créer
                </button>
            </form>
        </div>
    </div>


    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content bg-default">
                <div class="modal-header">
                    <h4 class="modal-title">Success Modal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Voullez vous créer un nouvel administrateur ?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-outline-primary" id="confirmCreate">Enregistré</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#confirmCreate').on('click', function() {
                // Soumettre le formulaire
                $('form').submit();
            });
        });
    </script>
@endsection
