@extends('admin.layout')

@section('title', 'Gestion des administrateur')

@section('content')
    <div class="card">
        <div class="card-header bg-secondary">
            <h1 class="w-100 text-center text-light">Gestion des utilisateurs</h1>
        </div>
        <div class="card-header d-flex justify-content-end">
            <a href="{{ route('user.create') }}" class="btn btn-primary">
                <i class="nav-icon fa-solid fa-plus"></i>
                Créer
            </a>
        </div>
        <form action="" method="get" id="search" class="search filter-form">
            @csrf
            <div class="card-header">
                <input type="search" name="search" id="search"
                    placeholder="Recherche 'nom' 'prenom' 'télephone' 'email' " class="form-control"
                    value="{{ old('search', request()->search) }}">
            </div>
            @if (auth()->user()->role === 'administrateur')
                <div class="card-header px-5">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="filter" id="administrators"
                            value="administrators" @if (!request()->filter or request()->filter === 'administrators') checked @endif>
                        <label class="form-check-label" for="administrators">Administrateurs</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="filter" id="partenaires" value="partenaires"
                            @if (request()->filter === 'partenaires') checked @endif>
                        <label class="form-check-label" for="partenaires">Partenaires</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="filter" id="followers" value="followers"
                            @if (request()->filter === 'followers') checked @endif>
                        <label class="form-check-label" for="followers">Abonnés</label>
                    </div>
                </div>
            @endif
        </form>
        <div class="card-body">
            <table class="table table-striped responsive">
                <thead>
                    <th>Nom</th>
                    <th>Téléphone</th>
                    <th>E-mail</th>
                    <th>Rôle</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>
                                <div class="d-flex">
                                    <div class="mr-3 pt-1">
                                        <img class="rounded-circle"
                                            src="{{ 'https://eu.ui-avatars.com/api/?name=' . $user->nom . '+' . $user->prenom . '&background=random&size=40' }}">
                                    </div>
                                    <p class="lead mt-1">{{ $user->nom . ' ' . $user->prenom }}</p>
                                </div>
                            </td>
                            <td>
                                {{ $user->phone }}
                            </td>
                            <td>
                                {{ $user->email }}
                            </td>
                            <td>
                                <span class="badge badge-info p-2">{{ $user->role }}</span>
                            </td>
                            <td>
                                <ul class="nav nav-fill">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="{{ route('user.edit', $user) }}" title="Modifer">
                                            <i class="nav-icon fa-solid fa-pen"></i>
                                            {{-- Modifer --}}
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('user.show', $user) }}" title="Voir">
                                            <i class="nav-icon fa-solid fa-eye"></i>
                                            {{-- Voir --}}
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <form action="{{ route('user.destroy', $user) }}" method="post"
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
            {{ $users->appends($query)->links() }}
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
        document.addEventListener('DOMContentLoaded', () => {
            // Filtre
            const filters = document.getElementsByName('filter');
            const filterForm = document.querySelector('form.filter-form');

            filters.forEach(filter => {
                filter.addEventListener('change', () => {
                    filterForm.submit();
                });
            });
        })
    </script>
@endsection
