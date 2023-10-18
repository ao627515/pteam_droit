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
            <h1 class="w-100 text-center text-light">Gestion des type de comptes</h1>
        </div>
        <form action="" method="get" id="search" class="search filter-form">
            @csrf
            <div class="card-header">
                <input type="search" name="search" placeholder="Recherche 'nom du type de compte'  " class="form-control"
                    value="{{ old('search', request()->search) }}" @if ($errors->has('nom')) disabled @endif>
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
                                            @if (!$errors->has("typeComptes.$typeCompte->id.frais")) disabled @endif>
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
                                    {{-- <li class="nav-item">
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
                                    </li> --}}
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
            "input[type='number']",
        );
    </script>



@endsection
