@extends('admin.layout')



@section('titre', 'article')


@section('css')
    <style>
        #btn-action {
            height: 75px;
            width: 75px;
            top: 80vh;
            left: 70vw;
            opacity: 0.3;
        }

        #btn-action:hover {
            opacity: 1;
        }

        /* // Small devices (landscape phones, 576px and up) */
        @media (min-width: 576px) {
            #btn-action {
                left: 85vw;
            }
        }

        /* Extra large devices (large desktops, 1200px and up) */
        @media (min-width: 1200px) {
            #btn-action {
                left: 90vw;
            }
        }

        // Large devices (desktops, less than 1200px)
        @media (max-width: 1199.98px) {
            #btn-action {
                left: 95vw;
            }
        }
    </style>
@endsection

{{ $article->imgInit() }}

@section('content')
    <div class="container">
        <div class="py-3">

            <div class="btn-group fixed-top" id="btn-action" style="">
                <button type="button" class="btn btn-info  rounded-circle text-light fw-bold"
                    data-toggle="dropdown">Actions</button>
                <div class="dropdown-menu" role="menu">
                    @if ($article->isDraft())
                        <form action="{{ route('articleAdmin.publish', $article) }}" method="post"
                            class="form-action dropdown-item">
                            @csrf
                            <button type="button" class="btn btn-success w-100 action-btn" data-toggle="modal"
                                data-target="#modal-approuved">
                                <i class="fas fa-check-circle"></i> Publier
                            </button>
                        </form>
                    @endif

                    @if (
                        $article->isStandby() and
                            auth()->user()->isAdmin())
                        <form action="{{ route('articleAdmin.declined', $article) }}" method="post"
                            class="form-action dropdown-item" id="declinedForm">
                            @csrf
                            <input type="hidden" name="motif" id="motifHidden">
                            <button type="button" class="btn btn-danger w-100 action-btn" data-toggle="modal"
                                data-target="#modal-declined">
                                <i class="fas fa-times-circle"></i> Refuser
                            </button>
                        </form>

                        <form action="{{ route('articleAdmin.approuved', $article) }}" method="post"
                            class="form-action dropdown-item">
                            @csrf
                            <button type="button" class="btn btn-primary w-100 action-btn" data-toggle="modal"
                                data-target="#modal-approuved">
                                <i class="fas fa-check-circle"></i> Approuver
                            </button>
                        </form>
                    @endif

                    <li class="dropdown-item">
                        <a class="btn btn-primary w-100" href="{{ route('articleAdmin.edit', $article) }}" title="Modifer">
                            <i class="nav-icon fa-solid fa-pen"></i>
                            Modifer
                        </a>
                    </li>
                    <form action="{{ route('articleAdmin.destroy', $article) }}" method="post"
                        class="form-action dropdown-item" title="Supprimer">
                        @csrf
                        @method('delete')
                        <button type="button" data-target="#modal-destroy" data-toggle="modal" class="btn btn-danger w-100">
                            <i class="nav-icon fa-solid fa-trash action-btn"></i>
                            Supprimer
                        </button>
                    </form>
                </div>
            </div>
            <article class="article">
                <h1 class="article-titre text-center fw-bold ">{{ $article->titre }}</h1>

                <p class="lead text-center"> <span>Statut</span> : {{ $article->getStatus() }}</p>
                <p class="article-date text-center">{{ $article->getActionDate() }}</p>

                <div class="article-image mb-3 d-flex justify-content-center">
                    <img src="{{ $article->image }}" alt="{{ $article->titre }}" class="img-fluid" style="height: 300px">
                </div>
                <div class="article-content">
                    @if ($article->isFActory())
                        {{ $article->contenu }} <!-- Affiche le contenu Summernote sans échappement -->
                    @else
                        {!! $article->contenu !!}
                    @endif
                </div>
            </article>

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
