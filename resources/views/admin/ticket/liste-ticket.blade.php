@extends('admin.layout')

@section('content')
    <x-message-flash />

    <div class="card">
        <div class="card-header bg-secondary">
            <h1 class="w-100 text-center text-light">Liste des requetes</h1>
        </div>
        <form action="{{ route('ticket.index') }}" method="get" id="search-form" class="search filter-form">
            @csrf
            <div class="card-header">
                <input type="search" name="search" id="search-input" placeholder=" " class="form-control"
                    value="{{ old('search', request()->search) }}">
            </div>
            {{-- <div class="card-header px-5">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="0" name="filter" value="0"
                        @if (!request()->filter or request()->input('status') === '0') checked @endif>
                    <label class="form-check-label" for="0">en attente</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="filter" id="2" value="2"
                        @if (request()->input('status') === '2') checked @endif>
                    <label class="form-check-label" for="2">en cours</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="filter" id="1" value="1"
                        @if (request()->input('status') === '1') checked @endif>
                    <label class="form-check-label" for="1">annuler</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="filter" id="3" value="3"
                        @if (request()->input('status') === '3') checked @endif>
                    <label class="form-check-label" for="3">terminer</label>
                </div>
            </div> --}}

            <div class="card-header px-5">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="filter" id="1" value="0"
                        @if (!request()->filter or request()->filter === '1') checked @endif>
                    <label class="form-check-label" for="1">en attente</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="filter" id="2" value="2"
                        @if (request()->filter === '2') checked @endif>
                    <label class="form-check-label" for="2">en cours</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="filter" id="3" value="3"
                        @if (request()->filter === '3') checked @endif>
                    <label class="form-check-label" for="3">terminer</label>
                </div>
            </div>
        </form>

        <div class="card-body">
            <table class="table table-striped responsive">
                <thead>
                    <th>objet</th>
                    <th>message</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    @forelse ($tickets as $ticket)
                        <tr>
                            <td>
                                {{ $ticket->objet }}

                            </td>
                            <td>
                                {{ $ticket->message }}
                            </td>
                            <td>
                                <ul class="nav nav-fill">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="{{ route('ticket.show', $ticket) }}"
                                            title="converser">
                                            <i class="nav-icon fa-solid fa-pen"></i>
                                            {{-- Modifer --}}
                                        </a>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    @empty
                     <tr><td colspan="3"><p class="lead text-center">Aucune requête trouvé</p></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $tickets->links() }}
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
