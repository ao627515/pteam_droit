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
            <h1 class="w-100 text-center text-light">Gestion des prestations</h1>
        </div>
        <div class="card-header d-flex justify-content-end">
            <button class="btn btn-primary" id="btnCreate">
                {{-- <i class="nav-icon fa-solid fa-plus"></i> --}}
                Créer
            </button>
        </div>
        <div class="card-header" id="cardCreate" style="display: @if (!$errors->has('nom')) none @else block @endif">
            <div class="card">
                <div class="card-header bg-secondary">
                    <h3 class="text-center w-100 text-center text-light">Enregistré une nouvelle prestation</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('prestation.store') }}" method="post">
                        @csrf
                        <div class="row row-cols-1">
                            <div class="col col-sm-5">
                                <input type="text" name="nom" id="prestation"
                                    placeholder="Entrer le nom de la nouvelle prestaion"
                                    class="form-control @error('nom') is-invalid @enderror" value="{{ old('nom') }}">
                                @error('nom')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col col-sm-5">
                                <div class="form-group">
                                    <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                                        value="{{ old('description') }}" placeholder="Description"></textarea>
                                    @error('description')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
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
                <input type="search" name="search" placeholder="Recherche 'nom de la prestation'  " class="form-control"
                    value="{{ old('search', request()->search) }}" @if ($errors->has('nom')) disabled @endif>
            </div>
        </form>
        <div class="card-body">
            <table class="table table-striped responsive">
                <thead>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    @foreach ($prestations as $prestation)
                        <tr>
                            <td class="w-25">
                                {{ $prestation->nom }}
                            </td>
                            <td class="w-50">
                                <p class="lead">
                                    {{ $prestation->description }}
                                </p>
                            </td>
                            <td class="w-25">
                                <ul class="nav nav-fill">
                                    <li class="nav-item">
                                        <i class="nav-icon fa-solid fa-pen btnEdit" title="Modifer"></i>
                                    </li>
                                    <li class="nav-item">
                                        <form action="{{ route('prestation.destroy', $prestation) }}" method="post"
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
                        <tr class="formUpdate" style="display: @if ($errors->has("prestations.$prestation->id.nom") or $errors->has("prestations.$prestation->id.description")) block @else none @endif">

                            <form action="{{ route('prestation.update', $prestation) }}" method="post">
                                @csrf
                                @method('put')
                                <td>
                                    <div class="form-group">
                                        <input type="text" name="{{ "prestations.$prestation->id.nom" }}"
                                            class="form-control @error("prestations.$prestation->id.nom") is-invalid @enderror"
                                            value="{{ old("prestations.$prestation->id.nom", $prestation->nom) }}">
                                        @error("prestations.$prestation->id.nom")
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <textarea name="{{ "prestations.$prestation->id.description" }}"
                                            class="form-control @error("prestations.$prestation->id.description") is-invalid @enderror">{{ old("prestations.$prestation->id.description", $prestation->description) }}</textarea>
                                        @error("prestations.$prestation->id.description")
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
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer px-3 py-0">
            {{ $prestations->appends($query)->links() }}
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
                    <p>Voullez vous supprimé cette prestation ?</p>
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
    {{-- <script>
        enableEditButtons(
            '.btnEdit',
            "input[type='text']",
        );
    </script> --}}
@endsection
