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
                <button type="button" class="btn btn-info  rounded-circle text-light fw-bold "
                    data-toggle="dropdown">Actions</button>
                <div class="dropdown-menu" role="menu">
                    <form action="" method="post" class="form-action dropdown-item">
                        @csrf
                        @method('delete')
                        <button type="button" class="btn btn-danger action-btn w-100" data-toggle="modal"
                            data-target="#modal-delete">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                    @if (true)
                        <form action="" method="post" class="form-action dropdown-item">
                            @csrf
                            <button type="button" class="btn btn-warning action-btn w-100" data-toggle="modal"
                                data-target="#modal-warning">
                                Caché
                            </button>
                        </form>
                    @endif
                    <a class="dropdown-item" href="">
                        <button class="btn btn-primary w-100"><i class="fa fa-pencil"></i></button>
                    </a>
                    @if (true)
                        <form action="" method="post" class="form-action dropdown-item">
                            @csrf
                            <button type="button" class="btn btn-success action-btn w-100" data-toggle="modal"
                                data-target="#modal-publish">
                                Publié
                            </button>
                        </form>
                    @endif
                </div>
            </div>
            <article class="article">
                <h1 class="article-titre text-center fw-bold ">{{ $article->titre }}</h1>

                @if ($article->approuvedBy)
                    <p class="article-date text-center">publié le : {{ $article->approuved_at }}</p>
                @else
                    <p class="lead text-center">Article non publié</p>
                @endif

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

    <div class="modal fade" id="modal-publish">
        <div class="modal-dialog">
            <div class="modal-content bg-success">
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
                    <button type="button" class="btn btn-outline-light" id="confirmPublish">Oui</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-delete">
        <div class="modal-dialog">
            <div class="modal-content bg-success">
                <div class="modal-header">
                    <h4 class="modal-title">Confirmation</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Voullez vous Supprimé cette article ?</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-outline-light" id="confirmDestroy">Oui</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')

@endsection
