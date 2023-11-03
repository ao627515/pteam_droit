@extends('admin.layout')

@section('title', 'Gestion des catégories')

@section('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

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
                Ajouter
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
                            <div class="col col-sm-11">
                                <div class="form-group">
                                    <select class="select2 @error('categorie') is-invalid @enderror" multiple
                                        data-placeholder="Select a State" style="width: 100%;" name="prestation[]"
                                        id="prestation">
                                        @foreach ($allPrestations as $prestation)
                                            <option value="{{ $prestation->id }}"
                                                @if ($prestations->contains($prestation->id)) selected @endif>
                                                {{ Str::ucfirst($prestation->nom) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('prestation')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col col-sm-1">
                                <button type="submit" class="btn btn-success">Ajouter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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
                                <p class="lead">{{ $prestation->description }}</p>
                            </td>
                            <td class="25">
                                <ul class="nav nav-fill">
                                    <li class="nav-item">
                                        <form action="{{ route('prestation.detach', $prestation) }}" method="post"
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
        {{-- <div class="card-footer px-3 py-0">
            {{ $prestations->appends($query)->links() }}
        </div> --}}
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
    {{-- <script src="{{ asset('admin/dist/js/parameterSearchBar.js') }}"></script> --}}
    <script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('admin/dist/js/modalScript.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2()

        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const btnCreate = document.getElementById('btnCreate');
            const cardCreate = document.getElementById('cardCreate');

            btnCreate.addEventListener('click', function() {

                const bool = cardCreate.style.display == 'block' ? true : false;

                if (bool) {
                    btnCreate.textContent = 'Ajouter';
                    cardCreate.style.display = 'none';
                } else {
                    cardCreate.style.display = 'block';
                    btnCreate.textContent = 'Annuler';
                }
            });
        });
    </script>
@endsection
