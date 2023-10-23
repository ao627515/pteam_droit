@extends('admin.layout')

@section('titre', 'produit')

@section('css')
    <style>
        .notification {
            height: 10px;
            width: 10px;
            opacity: 1;
            position: relative;
            left: 30px;
            bottom: 18px;
            /* padding: 1px; */
            background-color: red;
            border: red solid 1px;
            border-radius: 100%;
            z-index: 2;
            display: inline-block;
        }
    </style>
@endsection

@section('content')
    {{ $produit->imgInit() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <div class="col-12">
                        <div class="card">
                            {{-- <img src="{{ asset('assets/img/produit.jpg') }}" alt="logo" width="50%" class="card-img-top"> --}}
                            <img src="{{ $produit->image }}" class="card-img-top" alt="Image">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <h1 class="text-center">{{ $produit->nom }}</h1> <br>
                    <h3 class="my-3">Description</h3>
                    <p>
                        {{ $produit->description }}
                    </p>
                    <hr>
                    <div>
                        <ul class="list-group list-group-horizontal produit-author d-flex justify-content-center">
                            <li class="list-group-item px-3 py-1">
                                <div class="d-flex ">
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
                                <li class="list-group-item px-3 py-1 ">
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
                    </div>
                    <div class="d-flex justify-content-center mt-5">
                        <div class="btn-group">

                            <button type="button" class="btn btn-info text-light fw-bold">Actions</button>
                            <button type="button" class="btn btn-info dropdown-toggle dropdown-icon"
                                data-toggle="dropdown">
                                @if ($produit->isDeclined())
                                    <span class="notification"></span>
                                @endif
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" role="menu">
                                <div class="dropdown-item">
                                    <button class="btn btn-primary w-100 action-btn" data-toggle="modal"
                                        data-target="#motif-modal">
                                        Motif(s)
                                        <span class="badge badge-danger">{{ $notifications->count() }}</span>
                                    </button>
                                </div>
                                @if ($produit->isDeclined())
                                    <form action="{{ route('produitAdmin.relaunch', $produit) }}" method="post"
                                        class="form-action dropdown-item">
                                        @csrf
                                        <button type="button" class="btn btn-success w-100 action-btn" data-toggle="modal"
                                            data-target="#modal-relaunch">
                                            <i class="fas fa-check-circle"></i> Relancé
                                        </button>
                                    </form>
                                @endif
                                @if ($produit->isDraft())
                                    <form action="{{ route('produitAdmin.publish', $produit) }}" method="post"
                                        class="form-action dropdown-item">
                                        @csrf
                                        <button type="button" class="btn btn-success w-100 action-btn" data-toggle="modal"
                                            data-target="#modal-approuved">
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
                                        <button type="button" class="btn btn-danger w-100 action-btn" data-toggle="modal"
                                            data-target="#modal-declined">
                                            <i class="fas fa-times-circle"></i> Refuser
                                        </button>
                                    </form>

                                    <form action="{{ route('produitAdmin.approuved', $produit) }}" method="post"
                                        class="form-action dropdown-item">
                                        @csrf
                                        <button type="button" class="btn btn-primary w-100 action-btn" data-toggle="modal"
                                            data-target="#modal-approuved">
                                            <i class="fas fa-check-circle"></i> Approuver
                                        </button>
                                    </form>
                                @endif

                                <li class="dropdown-item">
                                    <a class="btn btn-primary w-100" href="{{ route('produitAdmin.edit', $produit) }}"
                                        title="Modifer">
                                        <i class="nav-icon fa-solid fa-pen"></i>
                                        Modifer
                                    </a>
                                </li>
                                <form action="{{ route('produitAdmin.destroy', $produit) }}" method="post"
                                    class="form-action dropdown-item" title="Supprimer">
                                    @csrf
                                    @method('delete')
                                    <button type="button" data-target="#modal-destroy" data-toggle="modal"
                                        class="btn btn-danger w-100">
                                        <i class="nav-icon fa-solid fa-trash action-btn"></i>
                                        Supprimer
                                    </button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
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

    <div class="modal fade" id="motif-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Motif de refus</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @forelse ($notifications as $notification)
                        @if (isset($notification->data['motif']))
                            <div>
                                <span>{{ $produit->getActionDate() }}</span>
                                <p class="lead">{{ $notification->data['motif'] }}</p>
                            </div>
                            <hr>
                        @endif
                    @empty
                        <p>Votre produit n'a jamais été décliné</p>
                    @endforelse
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                </div>
            </div>
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

                $('#confirmRelaunch').on('click', function() {
                    // Soumettre le formulaire
                    form.submit();
                });
            });

            $('#modal-declined').on('show.bs.modal', function(event) {

                $('#confirmRefus').on('click', function() {
                    let motif = $('#motifModal').val();

                    $('#motifHidden').val(motif);

                    $('#declinedForm').submit();
                });
            });

            @if ($errors->has('motif'))
                $('#modal-declined').modal('show')
            @endif
        });
    </script>
@endsection
