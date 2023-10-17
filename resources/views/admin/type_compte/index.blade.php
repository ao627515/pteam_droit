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
            <h1 class="w-100 text-center text-light">Gestion des typeComptes</h1>
        </div>
        <div class="card-header d-flex justify-content-end">
            <button class="btn btn-primary" id="btnCreate">
                {{-- <i class="nav-icon fa-solid fa-plus"></i> --}}
                Créer
            </button>
        </div>
        <div class="card-header" id="cardCreate" style="display: @if(!$errors->has("nom")) none @else block @endif">
            <h3 class="text-center">Nouvelle catégorie</h3>
            <form action="{{ route('typeCompte.store') }}" method="post">
                @csrf
                <div class="row row-cols-1">
                    <div class="col col-sm-11">
                        <input type="text" name="nom" id="typeCompte"
                            placeholder="Entrer le nom de la nouvel catégorie"
                            class="form-control @error('nom') is-invalid @enderror" value="{{ old('nom') }}">
                        @error('nom')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col col-sm-1">
                        <button type="submit" class="btn btn-success">Valider</button>
                    </div>
                </div>
            </form>
        </div>
        <form action="" method="get" id="search" class="search filter-form">
            @csrf
            <div class="card-header">
                <input type="search" name="search"  placeholder="Recherche 'nom de la catégorie'  "
                    class="form-control" value="{{ old('search', request()->search) }}"  @if($errors->has("search")) disabled  @endif>
            </div>
        </form>
        <div class="card-body">
            <table class="table table-striped responsive">
                <thead>
                    <th>Nom</th>
                    <th>Nom court</th>
                    <th>Frais (Franc cfa)</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    @foreach ($typeComptes as $typeCompte)
                        <tr>
                            <td>
                                {{ $typeCompte->nom }}
                            </td>
                            <td>
                                {{ $typeCompte->short_name }}
                            </td>
                            <td>
                                <form action="{{ route('typeCompte.update', $typeCompte) }}" method="post">
                                    @csrf
                                    @method('put')
                                    <div class="form-group">
                                        <input type="number" name="{{ "typeComptes.$typeCompte->id.frais" }}"
                                            class="form-control @error("typeComptes.$typeCompte->id.frais") is-invalid @enderror"
                                            value="{{ old("typeComptes.$typeCompte->id.frais", $typeCompte->frais) }}"
                                            @if(!$errors->has("typeComptes.$typeCompte->id.frais")) disabled @endif >
                                        @error("typeComptes.$typeCompte->id.frais")
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </form>
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
                                        <form action="{{ route('typeCompte.destroy', $typeCompte) }}" method="post"
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
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer px-3 py-0">
            {{ $typeComptes->appends($query)->links() }}
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
                var form = $(this).closest('.form-action');

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
        // Sélectionnez tous les boutons "btnEdit" par leur classe
        var editButtons = document.querySelectorAll('.btnEdit');

        // Parcourez tous les boutons et ajoutez un gestionnaire d'événement de clic
        editButtons.forEach(function(button) {
            // Suivi de l'état d'édition pour chaque ligne
            var isEditing = false;

            button.addEventListener('click', function() {
                // Trouvez l'élément parent (la ligne <tr>) du bouton cliqué
                var row = button.closest('tr');

                // Trouvez l'élément <input> à l'intérieur de cette ligne
                var input = row.querySelector('input[type="number"]');

                // Vérifiez l'état d'édition actuel
                if (isEditing) {
                    // Si l'édition est active, réactivez l'attribut "disabled"
                    input.setAttribute('disabled', 'true');
                    // Changez l'icône en 'annuler' (FontAwesome)
                    button.classList.remove('fa-times-circle');
                    button.classList.add('fa-pencil');
                    button.style.color = "black";
                } else {
                    // Si l'édition n'est pas active, supprimez l'attribut "disabled"
                    input.removeAttribute('disabled');
                    // Changez l'icône en 'édition' (FontAwesome)
                    button.classList.remove('fa-pencil');
                    button.classList.add('fa-times-circle');
                    button.style.color = "red";
                }

                // Inversez l'état d'édition
                isEditing = !isEditing;
            });
        });
    </script>



@endsection
