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
    <x-message-flash/>
    <section class="py-5 my-5">
        <div class="container">
            <div class="bg-white shadow rounded d-block d-sm-flex">
                <div class="profile-tab-nav border-right">
                    <div class="p-4">
                        <div class="img-circle text-center mb-3">
                            <img src="{{ asset('assets/profile/img/user2.jpg') }}" alt="Image" class="shadow">
                        </div>
                        <h4 class="text-center">{{ $user->nom . ' ' . $user->prenom }}</h4>
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
                        @if ($user->type_compte === 'morale')
                            <div class="card-body">
                                <form action="{{ route('organisation.update', $organisation) }}" method="post"
                                    class="form-action" enctype="multipart/form-data">
                                    @method('put')
                                    @csrf
                                    <fieldset class="border p-3 mt-5 mb-4">
                                        <legend>Informations de l'entreprise</legend>
                                        {{ $organisation->imgInit() }}
                                        <div class="row">
                                            <div class="form-group p-1 my-2 border col-8 mb-3">
                                                <label for="logo" class="form-label">Logo
                                                </label>
                                                <input type="file" id="logo" name="logo"
                                                    value="{{ old('logo') }}">
                                                {{-- <input type="file" name="photograph" id="photo" required="true" /> --}}
                                                @error('logo')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="col-4 text-center">
                                                {{-- <img src="#" alt="pic" /> --}}
                                                {{ $organisation->imgInit() }}
                                                <img src="{{ $organisation->logo }}" id="imgPreview" alt="Logo"
                                                    height="100" />
                                                {{-- <img src="{{ asset('assets/img/550x550.jpg') }}"
                                                id="imgPreview" alt="Logo" height="100" /> --}}
                                            </div>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label for="nom_pro"> Nom</label>
                                            <input type="text"
                                                class="form-control @error('nom_pro') is-invalid @enderror" name="nom_pro"
                                                id="nom_pro" placeholder="Raison sociale"
                                                value="{{ old('nom_pro', $organisation->nom) }}" />
                                            @error('nom_pro')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="phone_pro">Numéro</label>
                                            <input type="tel"
                                                class="form-control @error('phone_pro') is-invalid @enderror"
                                                name="phone_pro" id="phone_pro" placeholder="Téléphone entrepise"
                                                value="{{ old('phone_pro', $organisation->phone) }}" />
                                            @error('phone_pro')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="email_pro">E-mail</label>
                                            <input type="email"
                                                class="form-control @error('email_pro') is-invalid @enderror"
                                                name="email_pro" id="email_pro" placeholder="E-mail entreprise"
                                                value="{{ old('email_pro', $organisation->email) }}">
                                            @error('email_pro')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="form-group  mb-3">
                                            <label for="domaine">Domaine d'activité</label>
                                            <select class="form-control p-2 @error('domaine') is-invalid @enderror"
                                                name="domaine" id="domaine" placeholder="Choisir"
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
                                            <a href="{{ asset('storage/' . $organisation->val_doc_1) }}">Ouvrir
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
                                            <a href="{{ asset('storage/' . $organisation->val_doc_2) }}">Ouvrir
                                                le PDF</a>
                                        </div>
                                    </fieldset>
                                    <div class="mt-3">
                                        <button type="button" class="btn btn-primary float-right action-btn"
                                            data-toggle="modal" data-target="#modal-update">
                                            Modifié
                                        </button>
                                    </div>
                                </form>
                            </div>
                        @endif
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

@section('custom_script')
    <script src="{{ asset('admin/dist/js/modalScript.js') }}"></script>
@endsection
