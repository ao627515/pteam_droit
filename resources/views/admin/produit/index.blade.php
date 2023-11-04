@extends('admin.layout')

@section('title', 'LIste des produits')

@section('css')
    <style>
        .produit-card .produit-author {
            display: none;
            transition: display 1s ease;
        }

        .produit-card.active:hover .produit-author {
            display: block;
            transition: display 1s ease;
        }
    </style>
@endsection

@section('content')

    <x-message-flash/>

    <div class="card">
        <div class="card-header bg-secondary">
            <h1 class="w-100 text-center text-light">Gestion des produits</h1>
        </div>
        <div class="card-header d-flex justify-content-end">
            <a href="{{ route('produitAdmin.create') }}" class="btn btn-primary">
                <i class="nav-icon fa-solid fa-plus"></i>
                Créer
            </a>
        </div>
        <form action="" method="get" id="search" class="search filter-form">
            @csrf
            <div class="card-header">
                <input type="search" name="search" id="search" placeholder="Nom du produit" class="form-control"
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
                @foreach ($produits as $produit)
                    {{ $produit->imgInit() }}
                    <div class="col">
                        <div class="card produit-card">
                            <img src="{{ $produit->image }}" class="card-img-top" alt="Image" style="height: 150px">
                            <div class="card-body">
                                <h6 class="card-subtitle font-weight-bold mb-2" style="font-size: 13.5px">
                                    {{ $produit->nom }}
                                </h6>
                                <small><Span class="badge badge-info">Staut</Span> :
                                    {{ $produit->getProduitStatus() }}</small><br>
                                <small>{{ $produit->getActionDate() }}</small>
                                <h6 class="card-subtitle mt-2" style="font-size: 13.5px">
                                    stock : {{ $produit->stock }}
                                </h6>
                                <h6 class="card-subtitle mt-2" style="font-size: 13.5px">
                                    Prix : {{ $produit->prix . ' Franc cfa' }}
                                </h6>
                                <p class="card-text mt-1" style="font-size: 13px">
                                    {{ $produit->short_desc }}
                                </p>
                            </div>
                            @if (auth()->user()->isAdmin())
                                <ul class="list-group list-group-flush produit-author">
                                    <li class="list-group-item border-top px-3 py-1">
                                        <div class="d-flex">
                                            <div class="mr-3 pt-1">
                                                <img class="rounded-circle"
                                                    src="{{ 'https://eu.ui-avatars.com/api/?name=' . $produit->author->nom . '+' . $produit->author->prenom . '&background=random&size=40' }}">
                                            </div>
                                            <div class="">
                                                <small class="d-block">Publier par </small>
                                                <small
                                                    class="d-block">{{ $produit->author->nom . ' ' . $produit->author->prenom }}</small>
                                            </div>
                                        </div>
                                    </li>
                                    @if ($produit->approuvedBy)
                                        <li class="list-group-item px-3 py-1">
                                            <div class="d-flex justify-content-end">
                                                <div class="">
                                                    <small class="d-block">Aprouvé par</small>
                                                    <small>{{ $produit->approuvedBy->nom . ' ' . $produit->approuvedBy->prenom }}</small>
                                                </div>
                                                <div class="pt-1 ml-3">
                                                    <img class="rounded-circle"
                                                        src="{{ 'https://eu.ui-avatars.com/api/?name=' . $produit->approuvedBy->nom . '+' . $produit->approuvedBy->prenom . '&background=random&size=40' }}">
                                                </div>
                                            </div>
                                        </li>
                                    @elseif($produit->declinedBy)
                                        <li class="list-group-item px-3 py-1">
                                            <div class="d-flex justify-content-end">
                                                <div class="">
                                                    <small class="d-block">Décliné par</small>
                                                    <small>{{ $produit->declinedBy->nom . ' ' . $produit->declinedBy->prenom }}</small>
                                                </div>
                                                <div class="pt-1 ml-3">
                                                    <img class="rounded-circle"
                                                        src="{{ 'https://eu.ui-avatars.com/api/?name=' . $produit->declinedBy->nom . '+' . $produit->declinedBy->prenom . '&background=random&size=40' }}">
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                </ul>
                            @endif
                            <div class="card-footer d-flex justify-content-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-info text-light fw-bold">Actions</button>
                                    <button type="button" class="btn btn-info dropdown-toggle dropdown-icon"
                                        data-toggle="dropdown">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        @if ($produit->isDeclined() and ($produit->author_id === auth()->user()->id))
                                            <form action="{{ route('produitAdmin.relaunch', $produit) }}" method="post"
                                                class="form-action dropdown-item">
                                                @csrf
                                                <button type="button" class="btn btn-success w-100 action-btn"
                                                    data-toggle="modal" data-target="#modal-relaunch">
                                                    <i class="fas fa-check-circle"></i> Relancé
                                                </button>
                                            </form>
                                        @endif
                                        @if ($produit->isDraft())
                                            <form action="{{ route('produitAdmin.publish', $produit) }}" method="post"
                                                class="form-action dropdown-item">
                                                @csrf
                                                <button type="button" class="btn btn-success w-100 action-btn"
                                                    data-toggle="modal" data-target="#modal-approuved">
                                                    <i class="fas fa-check-circle"></i> Publier
                                                </button>
                                            </form>
                                        @endif

                                        @if (
                                            $produit->isStandby() and
                                                auth()->user()->isAdmin())
                                            <form action="{{ route('produitAdmin.declined', $produit) }}" method="post"
                                                class="form-action dropdown-item" id="declinedForm">
                                                @csrf
                                                <input type="hidden" name="motif" id="motifHidden">
                                                <button type="button" class="btn btn-danger w-100 action-btn"
                                                    data-toggle="modal" data-target="#modal-declined">
                                                    <i class="fas fa-times-circle"></i> Refuser
                                                </button>
                                            </form>

                                            <form action="{{ route('produitAdmin.approuved', $produit) }}" method="post"
                                                class="form-action dropdown-item">
                                                @csrf
                                                <button type="button" class="btn btn-primary w-100 action-btn"
                                                    data-toggle="modal" data-target="#modal-approuved">
                                                    <i class="fas fa-check-circle"></i> Approuver
                                                </button>
                                            </form>
                                        @endif

                                        <ul class="nav nav-fill">
                                            <li class="nav-item">
                                                <a class="nav-link active"
                                                    href="{{ route('produitAdmin.edit', $produit) }}" title="Modifer">
                                                    <i class="nav-icon fa-solid fa-pen"></i>
                                                    {{-- Modifer --}}
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('produitAdmin.show', $produit) }}"
                                                    title="Voir">
                                                    <i class="nav-icon fa-solid fa-eye"></i>
                                                    {{-- Voir --}}
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <form action="{{ route('produitAdmin.destroy', $produit) }}"
                                                    method="post" class="form-action nav-link" title="Supprimer">
                                                    @csrf
                                                    @method('delete')
                                                    <i class="nav-icon fa-solid fa-trash action-btn" style="color: red"
                                                        data-target="#modal-destroy" data-toggle="modal"></i>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="card-footer px-3 py-0">
            {{ $produits->appends($query)->links() }}
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
                        <p>Voullez vous supprimé cette produit ?</p>
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
                        <p>Voullez vous Publier cette produit ?</p>
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
                        <p>Voullez vous Relancé ce produit ?</p>
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
                        <h4 class="modal-title">Décliné un produit</h4>
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

            const cards = document.querySelectorAll('.produit-card');
            cards.forEach(card => {
                card.addEventListener('mouseenter', () => {
                    card.classList.add('active');
                });

                card.addEventListener('mouseleave', () => {
                    card.classList.remove('active');
                });
            });

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
    {{-- <script src="{{ asset('admin/dist/js/adminproduit.js') }}"></script> --}}
@endsection
