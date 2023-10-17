@extends('admin.layout')

@section('title', 'Gestion des catégories')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="card">
        <div class="card-header bg-secondary">
            <h1 class="w-100 text-center text-light">Gestion des domaines</h1>
        </div>
        <div class="card-header d-flex justify-content-end">
            <button class="btn btn-primary" id="btnCreate">
                {{-- <i class="nav-icon fa-solid fa-plus"></i> --}}
                Créer
            </button>
        </div>
        <div class="card-header" id="cardCreate" style="display: @if ($errors->has('nom') or $errors->has('icon')) block @else none @endif">
            <div class="card">
                <div class="card-header  bg-secondary">
                    <h3 class="text-center w-100 text-center text-light">Creer un ouveau domaine</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('domaine.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row row-cols-1">
                            <div class="col col-sm-4">
                                <input type="text" name="nom" id="domaine"
                                    placeholder="Entrer le nom de la nouvel catégorie"
                                    class="form-control @error('nom') is-invalid @enderror" value="{{ old('nom') }}">
                                @error('nom')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col col-sm-4">
                                <div class="form-group">
                                    <input type="file" class="form-control-file @error('icon') is-invalid @enderror"
                                        id="icon" name="icon" required>
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
                <input type="search" name="search" placeholder="Recherche 'nom de la catégorie'  " class="form-control"
                    value="{{ old('search', request()->search) }}" @if ($errors->has('search')) disabled @endif>
            </div>
        </form>
        <div class="card-body">
            <table class="table table-striped responsive">
                <thead>
                    <th></th>
                    <th>Nom</th>
                    <th>Partenaire ?</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    @foreach ($domaines as $domaine)
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
                            <td>
                                {{ $domaine->estPartenaire }}
                            </td>
                            <td>
                                <ul class="nav nav-fill">
                                    <li class="nav-item">
                                        <i class="nav-icon fa-solid fa-pen btnEdit" title="Modifer"></i>
                                    </li>
                                    <li class="nav-item">
                                        <i class="nav-icon fa-solid fa-eye" title="Voir" style="color: blue"></i>
                                    </li>
                                    <li class="nav-item">
                                        <form action="{{ route('domaine.destroy', $domaine) }}" method="post"
                                            class="form-action nav-link" title="Supprimer">
                                            @csrf
                                            @method('delete')
                                            <i class="nav-icon fa-solid fa-trash action-btn" style="color: red"
                                                data-target="#modal-destroy" data-toggle="modal"></i>
                                        </form>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                        <tr class="formUpdate" style="display: none">
                            <form action="{{ route('domaine.update', $domaine) }}" method="post">
                                @csrf
                                @method('put')
                                <td>
                                    <div class="form-group">
                                        <input type="file" class="form-control-file @error('icon') is-invalid @enderror"
                                            id="icon" name="{{ "icon.$domaine->id" }}">
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
                                            name="{{ "estPartenaire.$domaine->id" }}" class="custom-control-input" value="1"
                                            @if ($domaine->estPartenaire == 1) checked @endif>
                                        <label class="custom-control-label"
                                            for="{{ "estPartenaire1.$domaine->id" }}">Oui</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="{{ "estPartenaire2.$domaine->id" }}"
                                            name="{{ "estPartenaire.$domaine->id" }}" class="custom-control-input" value="0"
                                            @if ($domaine->estPartenaire == 0) checked @endif>
                                        <label class="custom-control-label"
                                            for="{{ "estPartenaire2.$domaine->id" }}">Non</label>
                                    </div>
                                </td>
                                <td>
                                    <button type="submit" class="btn btn-success">Valider</button>
                                </td>
                            </form>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer px-3 py-0">
            {{ $domaines->appends($query)->links() }}
        </div>
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
                    <p>Voullez vous supprimé cet utilisateur ?</p>
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
    <script>
        $(document).ready(function() {
            $('.action-btn').on('click', function() {
                let form = $(this).closest('.form-action');

                $('#confirmDestroy').on('click', function() {
                    // Soumettre le formulaire
                    form.submit();
                });
            });
        });
    </script>
    <script>
        const btnCreate = document.getElementById('btnCreate');
        const cardCreate = document.getElementById('cardCreate');

        btnCreate.addEventListener('click', function() {

            const bool = cardCreate.style.display == 'block' ? true : false;
            const search = document.querySelector('input[name="search"]');
            console.log(search);
            if (bool) {
                btnCreate.textContent = 'Créer';
                cardCreate.style.display = 'none';
                search.removeAttribute('disabled');
            } else {
                cardCreate.style.display = 'block';
                btnCreate.textContent = 'Annuler';
                search.setAttribute('disabled', 'true');
            }
        });
    </script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Gérer le clic sur .btnEdit
        document.body.addEventListener("click", function(event) {
            var target = event.target;
            if (target.classList.contains("btnEdit")) {
                var parentTR = target.closest("tr").nextElementSibling;
                if (parentTR.style.display === "none") {
                    // Cacher tous les éléments .formUpdate
                    var formUpdateElements = document.querySelectorAll(".formUpdate");
                    formUpdateElements.forEach(function(formUpdateElement) {
                        formUpdateElement.style.display = "none";
                    });

                    // Afficher le .formUpdate frère du tr parent de .btnEdit
                    parentTR.style.display = "table-row";

                    // Remplacer le contenu du td parent de .btnEdit par un bouton Annuler
                    var parentTD = target.closest("td");
                    parentTD.innerHTML = '<button class="btnCancel btn btn-secondary">Annuler</button>';

                    // Gérer le clic sur le bouton Annuler
                    var btnCancel = parentTD.querySelector(".btnCancel");
                    btnCancel.addEventListener("click", function(e) {
                        e.preventDefault();
                        // Cacher le .formUpdate
                        parentTR.style.display = "none";

                        // Restaurer le contenu d'origine du td parent
                        parentTD.innerHTML = `
                            <ul class="nav nav-fill">
                                <li class="nav-item">
                                    <i class="nav-icon fa-solid fa-pen btnEdit" title="Modifer"></i>
                                </li>
                                <li class="nav-item">
                                    <i class="nav-icon fa-solid fa-eye" title="Voir" style="color: blue"></i>
                                </li>
                                <li class="nav-item">
                                    <form action="{{ route('domaine.destroy', $domaine) }}" method="post"
                                        class="form-action nav-link" title="Supprimer">
                                        @csrf
                                        @method('delete')
                                        <i class="nav-icon fa-solid fa-trash action-btn" style="color: red"
                                            data-target="#modal-destroy" data-toggle="modal"></i>
                                    </form>
                                </li>
                            </ul>`;
                    });
                }
            }
        });
    });
</script>
{{-- <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Récupérer tous les éléments .formUpdate une seule fois
        var formUpdateElements = document.querySelectorAll(".formUpdate");

        // Gérer le clic sur .btnEdit
        var btnEditElements = document.querySelectorAll(".btnEdit");
        btnEditElements.forEach(function(btnEditElement) {
            btnEditElement.addEventListener("click", function() {
                // Cacher tous les éléments .formUpdate
                formUpdateElements.forEach(function(formUpdateElement) {
                    formUpdateElement.style.display = "none";
                });

                // Afficher le .formUpdate frère du tr parent de .btnEdit
                var parentTR = this.closest("tr").nextElementSibling;
                parentTR.style.display = "table-row";

                // Remplacer le contenu du td parent de .btnEdit par un bouton Annuler
                var parentTD = this.closest("td");
                parentTD.innerHTML = '<button class="btnCancel btn btn-secondary">Annuler</button>';

                // Gérer le clic sur le bouton Annuler
                var btnCancel = parentTD.querySelector(".btnCancel");
                btnCancel.addEventListener("click", function(event) {
                    event.preventDefault();
                    // Cacher le .formUpdate
                    parentTR.style.display = "none";

                    // Restaurer le contenu d'origine du td parent
                    parentTD.innerHTML = `
                        <ul class="nav nav-fill">
                            <li class="nav-item">
                                <i class="nav-icon fa-solid fa-pen btnEdit" title="Modifer"></i>
                            </li>
                            <li class="nav-item">
                                <i class="nav-icon fa-solid fa-eye" title="Voir" style="color: blue"></i>
                            </li>
                            <li class="nav-item">
                                <form action="{{ route('domaine.destroy', $domaine) }}" method="post"
                                    class="form-action nav-link" title="Supprimer">
                                    @csrf
                                    @method('delete')
                                    <i class="nav-icon fa-solid fa-trash action-btn" style="color: red"
                                        data-target="#modal-destroy" data-toggle="modal"></i>
                                </form>
                            </li>
                        </ul>`;
                });
            });
        });
    });
</script> --}}

@endsection
