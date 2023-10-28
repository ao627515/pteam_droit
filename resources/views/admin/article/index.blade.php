@extends('admin.layout')

@section('title', 'LIste des articles')

@section('content')
    <style>
        .article-card .article-author {
            display: none;
            transition: display 1s ease;
        }

        .article-card.active:hover .article-author {
            display: block;
            transition: display 1s ease;
        }
    </style>

    <div class="card">
        <div class="card-header bg-secondary">
            <h1 class="w-100 text-center text-light">Gestion des articles</h1>
        </div>
        <div class="card-header d-flex justify-content-end">
            <a href="{{ route('articleAdmin.create') }}" class="btn btn-primary">
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
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="filter" id="draft" value="draft"
                        @if (request()->filter === 'draft') checked @endif>
                    <label class="form-check-label" for="draft">Brouillons</label>
                </div>
                {{-- @if (auth()->user()->isAdmin())
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="filter" id="delete" value="delete"
                            @if (request()->filter === 'delete') checked @endif>
                        <label class="form-check-label" for="delete">Supprimé</label>
                    </div>
                @endif --}}
            </div>
        </form>
        <div class="card-body">
            <div class="row row-cols-1 row-cols-sm-2  row-cols-md-2 row-cols-lg-2  row-cols-xl-4 row-cols-xll-6">
                @foreach ($articles as $article)
                    {{ $article->imgInit() }}
                    <div class="col">
                        <x-admin.article-admin-card :article="$article" />
                    </div>
                @endforeach
            </div>
        </div>
        <div class="card-footer px-3 py-0">
            {{ $articles->appends($query)->links() }}
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
                        <p>Voullez vous supprimé cette article ?</p>
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

        <div class="modal fade" id="modal-approuved">
            <div class="modal-dialog">
                <div class="modal-content bg-default">
                    <div class="modal-header">
                        <h4 class="modal-title">Confirmation</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Voullez vous Publier cette article ?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Annuler</button>
                        <button type="button" class="btn btn-outline-primary" id="confirmApprouvation">Oui</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        <div class="modal fade" id="modal-relaunch">
            <div class="modal-dialog">
                <div class="modal-content bg-default">
                    <div class="modal-header">
                        <h4 class="modal-title">Confirmation</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Voullez vous Relancé cette article ?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Annuler</button>
                        <button type="button" class="btn btn-outline-primary" id="confirmRelaunch">Oui</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        <div class="modal fade" id="modal-declined">
            <div class="modal-dialog modal-lg">
                <div class="modal-content bg-danger">
                    <div class="modal-header">
                        <h4 class="modal-title">Décliné un article</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="motif">Motif de refus</label>
                            <textarea id="motifModal" id="motif" rows="15" id="motif" class="form-control">{{ old('motif') }}</textarea>
                        </div>
                        @error('motif')
                            <span class="text-light">Erreur : {{ $message }}</span>
                        @enderror
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Annuler</button>
                        <button type="button" class="btn btn-outline-light" id="confirmRefus">Oui</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

    </div>
@endsection

@section('script')
    <script src="{{ asset('admin/dist/js/modalScript.js') }}"></script>
    <script>
        $(function() {
            @if ($errors->has('motif'))
                $('#modal-declined').modal('show')
            @endif
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const cards = document.querySelectorAll('.article-card');
            if (cards) {
                cards.forEach(card => {
                    card.addEventListener('mouseenter', () => {
                        card.classList.add('active');
                    });

                    card.addEventListener('mouseleave', () => {
                        card.classList.remove('active');
                    });
                });
            }

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
    {{-- <script src="{{ asset('admin/dist/js/adminArticle.js') }}"></script> --}}
@endsection
