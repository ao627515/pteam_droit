@extends('admin.layout')



@section('titre', 'article')


@section('css')
    <style>
        .notification {
            height: 10px;
            width: 10px;
            opacity: 1;
            position: relative;
            left: 55px;
            padding: 5px;
            background-color: red;
            border: red solid 5px;
            border-radius: 100%;
            z-index: 2;
            bottom: 10px
        }

        #btn-card {
            height: 75px;
            width: 75px;
            top: 80vh;
            left: 70vw;
        }

        #btn-action {
            opacity: 0.3;
        }

        #btn-action:hover {
            opacity: 1;

        }

        /* // Small devices (landscape phones, 576px and up) */
        @media (min-width: 576px) {
            #btn-card {
                left: 85vw;
            }
        }

        /* Extra large devices (large desktops, 1200px and up) */
        @media (min-width: 1200px) {
            #btn-card {
                left: 90vw;
            }
        }

        // Large devices (desktops, less than 1200px)
        @media (max-width: 1199.98px) {
            #btn-card {
                left: 95vw;
            }
        }
    </style>
@endsection

{{ $article->imgInit() }}

@section('content')
    <div class="container">
        <div class="py-3">

            <div class="btn-group fixed-top" id="btn-card" style="">
                @if ($article->isDeclined())
                    <span class="notification"></span>
                @endif
                <button type="button" class="btn btn-info  rounded-circle text-light fw-bold" data-toggle="dropdown"
                    id="btn-action">Actions</button>
                <div class="dropdown-menu" role="menu">
                    <div class="dropdown-item">
                        <button class="btn btn-primary w-100 action-btn" data-toggle="modal" data-target="#motif-modal">
                            Motif(s)
                            <span class="badge badge-danger">{{ $notifications->count() }}</span>
                        </button>
                    </div>
                    @if ($article->isDeclined())
                        <form action="{{ route('articleAdmin.relaunch', $article) }}" method="post"
                            class="form-action dropdown-item">
                            @csrf
                            <button type="button" class="btn btn-success w-100 action-btn" data-toggle="modal"
                                data-target="#modal-relaunch">
                                <i class="fas fa-check-circle"></i> Relancé
                            </button>
                        </form>
                    @endif
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
                        <button type="button" data-target="#modal-destroy" data-toggle="modal"
                            class="btn btn-danger w-100">
                            <i class="nav-icon fa-solid fa-trash action-btn"></i>
                            Supprimer
                        </button>
                    </form>
                </div>
            </div>
            <article class="article">
                <h1 class="article-titre text-center fw-bold ">{{ $article->titre }}</h1>

                <p class="lead text-center"> <span>Statut</span> : {{ $article->getArticleStatus() }}</p>
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
                                <span>{{ $article->getActionDate() }}</span>
                                <p class="lead">{{ $notification->data['motif'] }}</p>
                            </div>
                            <hr>
                        @endif
                    @empty
                        <p>Votre article n'a jamais été décliné</p>
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
    <script src="{{ asset('admin/dist/js/modalScript.js') }}"></script>

    <script>
        $(function() {
            @if ($errors->has('motif'))
                $('#modal-declined').modal('show')
            @endif
        });
    </script>
@endsection
