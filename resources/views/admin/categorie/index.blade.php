@extends('admin.layout')

@section('title', 'Gestion des catégories')

@section('content')
    @if (session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif
    <div class="card">
        <div class="card-header bg-secondary">
            <h1 class="w-100 text-center text-light">Gestion des categories</h1>
        </div>
        <div class="card-header d-flex justify-content-end">
            <button class="btn btn-primary" id="btnCreate">
                {{-- <i class="nav-icon fa-solid fa-plus"></i> --}}
                Créer
            </button>
        </div>
        <div class="card-header" id="cardCreate" style="display: @if (!$errors->has('nom')) none @else block @endif">
            <div class="card">
                <div class="card-header  bg-secondary">
                    <h3 class="w-100 text-center text-ligh"> Créer une nouvelle catégorie</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('categorie.store') }}" method="post">
                        @csrf
                        <div class="row row-cols-1">
                            <div class="col col-sm-11">
                                <input type="text" name="nom" id="categorie"
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
            </div>
        </div>
        <form action="" method="get" id="search" class="search filter-form">
            @csrf
            <div class="card-header">
                <input type="search" name="search" placeholder="Recherche 'nom de la catégorie'  " class="form-control"
                    value="{{ old('search', request()->search) }}" @if ($errors->has('nom')) disabled @endif>
                @error('search')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </form>
        <div class="card-body">
            <table class="table table-striped table-responsive-sm">
                <thead>
                    <th>Nom</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    @foreach ($categories as $categorie)
                        <tr>
                            <td>
                                <form action="{{ route('categorie.update', $categorie) }}" method="post">
                                    @csrf
                                    @method('put')
                                    <div class="form-group">
                                        <input type="text" name="{{ "categories.$categorie->id.nom" }}"
                                            placeholder="Entrer le nom de la nouvelle catégorie"
                                            class="form-control @error("categories.$categorie->id.nom") is-invalid @enderror"
                                            value="{{ old("categories.$categorie->id.nom", $categorie->nom) }}"
                                            @if (!$errors->has("categories.$categorie->id.nom")) disabled @endif>
                                        @error("categories.$categorie->id.nom")
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
                                        <form action="{{ route('categorie.destroy', $categorie) }}" method="post"
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
            {{ $categories->appends($query)->links() }}
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
                    <p>Voullez vous supprimé cette catégorie ?</p>
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
    <script src="{{ asset('admin/dist/js/parameterEditBtnV1.js') }}"></script>
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
            enableEditButtons(
                '.btnEdit',
                "input[type='text']",
            );
        </script>
@endsection
