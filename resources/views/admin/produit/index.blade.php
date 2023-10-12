@extends('admin.layout')

@section('title', 'LIste des produits')

@section('content')
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

    <div class="card">
        <div class="card-header">
            <form action="" method="post">
                <input type="search" name="search" id="search" placeholder="Recherche" class="form-control">
            </form>
        </div>
        <div class="card-header px-5">
            <form action="" method="get" id="filter-form">
                @csrf
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="filter" id="authorize" value="authorize"  @if(!request()->filter or request()->filter === 'authorize') checked  @endif>
                    <label class="form-check-label" for="authorize">Autorisation</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="filter" id="approuved" value="approuved"  @if(request()->filter === 'approuved') checked  @endif>
                    <label class="form-check-label" for="approuved">Approuvé</label>
                </div>
                {{-- <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="filter" id="declined" value="declined"  @if(request()->filter === 'declined') checked  @endif>
                    <label class="form-check-label" for="declined">Décliné</label>
                </div> --}}
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="filter" id="delete" value="delete" @if(request()->filter === 'delete') checked  @endif>
                    <label class="form-check-label" for="delete">Supprimé</label>
                </div>
            </form>
        </div>
        <div class="card-body">
            <div class="row row-cols-1 row-cols-sm-2  row-cols-md-2 row-cols-lg-2  row-cols-xl-4 row-cols-xll-6">
                @foreach ($produits as $produit)
                    <div class="col">
                        <div class="card produit-card">
                            <img src="{{ asset('admin/dist/img/default-150x150.png') }}" class="card-img-top" alt="Image"
                                style="height: 150px">
                            <div class="card-body">
                                <h6 class="card-subtitle font-weight-bold mb-2" style="font-size: 13.5px">
                                    {{ $produit->nom }}
                                </h6>
                                <h6 class="card-subtitle" style="font-size: 13.5px">
                                    stock : {{ $produit->stock }}
                                </h6>
                                <p class="card-text mt-1" style="font-size: 13px">
                                    {{ $produit->short_desc }}
                                </p>
                            </div>
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
                                @endif
                            </ul>
                            {{-- @if (!$produit->approuvedBy)
                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                    <form action="" method="get" class="form-action w-50">
                                        @csrf
                                        <button type="button" class="btn btn-danger w-100 action-btn">Décliné</button>
                                    </form>
                                    <form action="{{ route('produitAdmin.approuved', $produit) }}" method="get"
                                        class="form-action w-50">
                                        @csrf
                                        <button type="button" class="btn btn-success w-100 action-btn" data-toggle="modal"
                                            data-target="#modal-approuve">
                                            Approuvé
                                        </button>
                                    </form>
                                </div>
                            @endif --}}
                            <div class="card-footer">
                                <ul class="nav nav-fill">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="{{ route('produitAdmin.edit', $produit) }}"
                                            title="Modifer">
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
                                        <form action="{{ route('produitAdmin.destroy', $produit) }}" method="post"
                                            class="form-action nav-link" title="Supprimer">
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
                @endforeach
            </div>
        </div>
        <div class="card-footer px-3 py-0">
            {{ $produits->links() }}
        </div>

        <div class="modal fade" id="modal-destroy">
            <div class="modal-dialog">
                <div class="modal-content bg-danger">
                    <div class="modal-header">
                        <h4 class="modal-title">Success Modal</h4>
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

        <div class="modal fade" id="modal-approuve">
            <div class="modal-dialog">
                <div class="modal-content bg-success">
                    <div class="modal-header">
                        <h4 class="modal-title">Success Modal</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Voullez vous Publier cette produit ?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Annuler</button>
                        <button type="button" class="btn btn-outline-light" id="confirmApprouvation">Oui</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <div class="modal fade" id="modal-decline">
            <div class="modal-dialog">
                <div class="modal-content bg-warning">
                    <div class="modal-header">
                        <h4 class="modal-title">Success Modal</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Ete vous surs de vouloir refusé cette produit ?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Annuler</button>
                        <button type="button" class="btn btn-outline-light" id="confirmApprouvation">Oui</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(function() {
            $('.action-btn').on('click', function() {
                var form = $(this).closest('.form-action');

                $('#confirmDestroy').on('click', function() {
                    // Soumettre le formulaire
                    form.submit();
                });

                $('#confirmApprouvation').on('click', function() {
                    // Soumettre le formulaire
                    form.submit();
                });

                // $('input[name=filter]').on('change', function() {
                //     $('#filter-form').submit();
                // })
            });
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
            const filterForm = document.querySelector('#filter-form');

            filters.forEach(filter => {
                filter.addEventListener('change', () => {
                    filterForm.submit();
                });
            });
        })
    </script>
    {{-- <script src="{{ asset('admin/dist/js/adminproduit.js') }}"></script> --}}
@endsection
