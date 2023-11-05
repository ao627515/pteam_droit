@extends('admin.layout')

@section('title', 'Gestion des catégories')

@section('content')
    <x-message-flash />
    <div class="card">
        <div class="card-header bg-secondary">
            <h1 class="w-100 text-center text-light">Gestion des domaines</h1>
        </div>
        @if (auth()->user()->role == 'administrateur')
            <div class="card-header d-flex justify-content-end">
                <button class="btn btn-primary" id="btnCreate">
                    {{-- <i class="nav-icon fa-solid fa-plus"></i> --}}
                    Créer
                </button>
            </div>
            <div class="card-header" id="cardCreate"
                style="display: @if ($errors->has('nom') or $errors->has('icon') or $errors->has('estPartenaire')) block @else none @endif">
                <div class="card">
                    <div class="card-header bg-secondary">
                        <h3 class="text-center w-100 text-center text-light">Creer un nouveau domaine</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('domaine.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row row-cols-1">
                                <div class="col col-sm-4">
                                    <input type="text" name="nom" id="domaine"
                                        placeholder="Entrer le nom du nouveau domaine"
                                        class="form-control @error('nom') is-invalid @enderror" value="{{ old('nom') }}"
                                        required>
                                    @error('nom')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col col-sm-4">
                                    <div class="form-group">
                                        <input type="file" class="form-control-file @error('icon') is-invalid @enderror"
                                            id="icon" name="icon">
                                        @error('icon')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col col-sm-3">
                                    Partenaire :
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="isPartenaire1" name="estPartenaire"
                                            class="custom-control-input" value="1">
                                        <label class="custom-control-label" for="isPartenaire1">Oui</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="isPartenaire2" name="estPartenaire"
                                            class="custom-control-input" value="0" checked>
                                        <label class="custom-control-label" for="isPartenaire2">Non</label>
                                    </div>
                                    @error('estPartenaire')
                                        <div>
                                            <small class="text-danger"> {{ $message }} </small>
                                        </div>
                                    @enderror
                                </div>
                                <div class="col col-sm-1">
                                    <button type="submit" class="btn btn-success">Valider</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <form action="" method="get" id="search" class="search filter-form">
                @csrf
                <div class="card-header">
                    <input type="search" name="search" placeholder="Recherche 'nom du domaine'  " class="form-control"
                        value="{{ old('search', request()->search) }}" @if ($errors->has('nom') or $errors->has('icon')) disabled @endif>
                </div>
            </form>
        @endif
        <div class="card-body">
            <table class="table table-striped table-responsive-sm">
                <thead>
                    <th></th>
                    <th>Nom</th>
                    @if (auth()->user()->isAdmin())
                        <th>Partenaire ?</th>
                    @endif
                    <th>Actions</th>
                </thead>
                <tbody>
                    @forelse ($domaines as $domaine)
                        {{ $domaine->imgInit() }}
                        <tr>
                            <td>
                                <div class="" style="width: 50px; height: 50px">
                                    <img src="{{ $domaine->icon }}" alt="" width="100%" height="100%"
                                        class="rounded-circle">
                                </div>
                            </td>
                            <td>
                                {{ $domaine->nom }}
                            </td>
                            @if (auth()->user()->isAdmin())
                                <td>
                                    @if ($domaine->estPartenaire)
                                        {{-- <i class="fa-regular fa-circle-check" style="color: #00ff00;"></i> --}}
                                        Oui
                                    @else
                                        {{-- <i class="fa-regular fa-circle-xmark" style="color: #ff0000;"></i> --}}
                                        Non
                                    @endif
                                </td>
                            @endif
                            <td>
                                <ul class="nav nav-fill">
                                    <li class="nav-item">
                                        <i class="nav-icon fa-solid fa-pen btnEdit" title="Modifer"></i>
                                    </li>
                                    @if (auth()->user()->role == 'administrateur')
                                        <li class="nav-item">
                                            <form action="{{ route('domaine.destroy', $domaine) }}" method="post"
                                                class="form-action nav-link" title="Supprimer">
                                                @csrf
                                                @method('delete')
                                                <i class="nav-icon fa-solid fa-trash action-btn" style="color: red"
                                                    data-target="#modal-destroy" data-toggle="modal"></i>
                                            </form>
                                        </li>
                                    @endif
                                </ul>
                            </td>
                        </tr>
                        @if (auth()->user()->isAdmin())
                            <tr class="formUpdate"
                                style="display: @if (
                                    $errors->has("icon.$domaine->id") or
                                        $errors->has("domaines.$domaine->id.nom") or
                                        $errors->has("estPartenaire1.$domaine->id")) block @else none @endif">
                                <form action="{{ route('domaine.update', $domaine) }}" method="post">
                                    @csrf
                                    @method('put')
                                    <td>
                                        <div class="form-group">
                                            <input type="file"
                                                class="form-control-file @error('icon') is-invalid @enderror" id="icon"
                                                name="{{ "icon.$domaine->id" }}">
                                            @error('icon')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" name="{{ "domaines.$domaine->id.nom" }}"
                                                placeholder="Entrer le nom de la nouvelle catégorie"
                                                class="form-control @error("domaines.$domaine->id.nom") is-invalid @enderror"
                                                value="{{ old("domaines.$domaine->id.nom", $domaine->nom) }}">
                                            @error("domaines.$domaine->id.nom")
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </td>
                                    <td>
                                        Partenaire :
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="{{ "estPartenaire1.$domaine->id" }}"
                                                name="{{ "estPartenaire.$domaine->id" }}" class="custom-control-input"
                                                value="1" @if ($domaine->estPartenaire == 1) checked @endif>
                                            <label class="custom-control-label"
                                                for="{{ "estPartenaire1.$domaine->id" }}">Oui</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="{{ "estPartenaire2.$domaine->id" }}"
                                                name="{{ "estPartenaire.$domaine->id" }}" class="custom-control-input"
                                                value="0" @if ($domaine->estPartenaire == 0) checked @endif>
                                            <label class="custom-control-label"
                                                for="{{ "estPartenaire2.$domaine->id" }}">Non</label>
                                        </div>
                                    </td>
                                    <td>
                                        <button type="submit" class="btn btn-success">Valider</button>
                                    </td>
                                </form>
                            </tr>
                        @else
                            <tr class="formUpdate"
                                style="display: @if ($errors->has('domaine')) block @else none @endif">
                                <form action="{{ route('domaine.change') }}" method="post">
                                    @csrf
                                    <td colspan="2">
                                        <div class="form-group">
                                            <select class="form-control @error('domaine') is-invalid @enderror"
                                                name="domaine" id="domaine" value="{{ old('domaine') }}">
                                                @foreach ($allDomaines as $item)
                                                    <option value="{{ $item->id }}"
                                                        @if ($domaine->id === $item->id) selected @endif>
                                                        {{ Str::ucfirst($item->nom) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('domaine')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </td>
                                    <td>
                                        <button type="submit" class="btn btn-success">Valider</button>
                                    </td>
                                </form>
                            </tr>
                        @endif
                    @empty
                        <tr>
                            <td colspan="@if(auth()->user()->isAdmin()) 4 @else 3 @endif"><p class="w-100 lead text-center">Aucun domaine trouvé</p></td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if (auth()->user()->role == 'administrateur')
            <div class="card-footer px-3 py-0">
                {{ $domaines->appends($query)->links() }}
            </div>
        @endif
    </div>


    <div class="modal fade" id="modal-destroy">
        <div class="modal-dialog">
            <div class="modal-content bg-danger">
                <div class="modal-header">
                    <h4 class="modal-title">Confirmation</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Voullez vous supprimé ce domaine ?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-outline-light" id="confirmDestroy">Oui</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


@endsection

@section('script')
    <script src="{{ asset('admin/dist/js/parameterSearchBar.js') }}"></script>
    <script src="{{ asset('admin/dist/js/parameterEditBtnV2.js') }}"></script>
    <script src="{{ asset('admin/dist/js/modalScript.js') }}"></script>
@endsection
