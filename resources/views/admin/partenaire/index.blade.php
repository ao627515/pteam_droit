@extends('admin.layout')

@section('title', 'Gestion des administrateur')

@section('content')
    <x-message-flash/>
    <div class="card">
        <div class="card-header bg-secondary">
            <h1 class="w-100 text-center text-light">Gestion des utilisateurs</h1>
        </div>
        <div class="card-header d-flex justify-content-end">
            <a href="{{ route('partenaireAdmin.create') }}" class="btn btn-primary">
                <i class="nav-icon fa-solid fa-plus"></i>
                Créer
            </a>
        </div>
        <form action="" method="get" id="search" class="search filter-form">
            @csrf
            <div class="card-header">
                <input type="search" name="search" id="search" placeholder="Nom de l'article" class="form-control"
                    value="{{ old('search', request()->search) }}">
            </div>
            <div class="card-header px-5">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="filter" id="authorize" value="authorize"
                        @if (!request()->filter or request()->filter === 'authorize') checked @endif>
                    <label class="form-check-label" for="authorize">En attente</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="filter" id="approuved" value="approuved"
                        @if (request()->filter === 'approuved') checked @endif>
                    <label class="form-check-label" for="approuved">Approuvé</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="filter" id="declined" value="declined"
                        @if (request()->filter === 'declined') checked @endif>
                    <label class="form-check-label" for="declined">Décliné</label>
                </div>
                {{-- <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="filter" id="delete" value="delete"
                        @if (request()->filter === 'delete') checked @endif>
                    <label class="form-check-label" for="delete">Supprimé</label>
                </div> --}}
            </div>
        </form>
        <div class="card-body">
            <table class="table table-striped responsive">
                <thead>
                    <th>Nom</th>
                    <th>Téléphone</th>
                    <th>E-mail</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    @forelse ($partenaires as $partenaire)
                        <tr>
                            <td>
                                <div class="d-flex">
                                    <div class="mr-3 pt-1">
                                        <img class="rounded-circle"
                                            src="{{ 'https://eu.ui-avatars.com/api/?name=' . $partenaire->nom . '+' . $partenaire->prenom . '&background=random&size=40' }}">
                                    </div>
                                    <p class="lead mt-1">{{ $partenaire->nom . ' ' . $partenaire->prenom }}</p>
                                </div>
                            </td>
                            <td>
                                {{ $partenaire->phone }}
                            </td>
                            <td>
                                {{ $partenaire->email }}
                            </td>
                            <td>
                                <span class="badge badge-info p-2">{{ $partenaire->partenaireStatus() }}</span>
                            </td>
                            <td>
                                <ul class="nav nav-fill">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('partenaireAdmin.show', $partenaire) }}"
                                            title="Voir">
                                            <i class="nav-icon fa-solid fa-eye"></i>
                                            {{-- Voir --}}
                                        </a>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    @empty
                    <tr>
                        <td colspan="5"><p class="lead text-center">Aucun partenaire trouvé</p></td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer px-3 py-0">
            {{ $partenaires->appends($query)->links() }}
        </div>
    </div>
@endsection

@section('script')
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
