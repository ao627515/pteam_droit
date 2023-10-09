@extends('admin.layout')

@section('title', 'LIste des articles')

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="" method="post">
                <input type="search" name="search" id="search" placeholder="Recherche" class="form-control">
            </form>
        </div>
        <div class="card-header">
            Filtre
        </div>
        <div class="card-body">
            <div class="row row-cols-4">
=
                @foreach ($articles as $article)
                    <div class="col">
                        <div class="card">
                            @if ($article->image)
                                <img src="{{ $article->imageLink() }}" class="card-img-top" alt="Image">
                            @else
                                <img src="{{ asset('admin/dist/img/user1-128x128.jpg') }}" class="card-img-top"
                                    alt="Image">
                            @endif
                            <div class="card-body">
                                <h6 class="card-subtitle font-weight-bold" style="font-size: 13.5px">{{ $article->titre }}.
                                </h6>
                                <p class="card-text mt-2" style="font-size: 13px">
                                    {{ $article->description }}
                                </p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item border-top px-3 py-1">
                                    <div class="d-flex">
                                        <div class="mr-3 pt-1" >
                                            <img class="rounded-circle"
                                                src="https://eu.ui-avatars.com/api/?name=Ouédraogo+Abdoul+Aziz&background=random&size=40">
                                        </div>
                                        <div class="">
                                            <small>Publier par </small> <br>
                                            <small>Ouédraogo Abdoul Aziz</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item px-3 py-1">
                                    <div class="d-flex justify-content-end">
                                        <div class="mr-3">
                                            <small>Aprouvé par par </small><br>
                                            <small>Ouédraogo Ibrahim</small>
                                        </div>
                                        <div class="pt-1">
                                            <img class="rounded-circle"
                                                src="https://eu.ui-avatars.com/api/?name=Ouédraogo+Ibrahim&background=random&size=40">
                                        </div>
                                    </div>
                                </li>
                                @if ($article->approuvedBy)
                                <li class="list-group-item px-3 py-1">
                                    <div class="d-flex justify-content-end">
                                        <div class="mr-3">
                                            <small>Aprouvé par par </small><br>
                                            <small>Ouédraogo Ibrahim</small>
                                        </div>
                                        <div class="pt-1">
                                            <img class="rounded-circle"
                                                src="https://eu.ui-avatars.com/api/?name=Ouédraogo+Ibrahim&background=random&size=40">
                                        </div>
                                    </div>
                                </li>
                                @else
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <button type="button" class="btn btn-danger">Décliné</button>
                                        <button type="button" class="btn btn-success">Approuvé</button>
                                    </div>
                                @endif
                            </ul>
                            <div class="card-footer">
                                <ul class="nav nav-fill">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="{{ route('articleAdmin.edit', $article) }}"
                                            title="Modifer">
                                            <i class="nav-icon fa-solid fa-pen"></i>
                                            {{-- Modifer --}}
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('articleAdmin.show', $article) }}" title="Voir">
                                            <i class="nav-icon fa-solid fa-eye"></i>
                                            {{-- Voir --}}
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <form action="{{ route('articleAdmin.destroy', $article) }}" method="post"
                                            class="form-action nav-link" title="Supprimer">
                                            @csrf
                                            @method('delete')
                                            <i class="nav-icon fa-solid fa-trash action-btn" style="color: red" data-target="#modal-default" data-toggle="modal"></i>
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
             {{ $articles->links() }}
        </div>

        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content bg-default">
                    <div class="modal-header">
                        <h4 class="modal-title">Success Modal</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Voullez vous supprimé cette article ?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Annuler</button>
                        <button type="button" class="btn btn-outline-danger" id="confirmDestroy">Oui</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
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
            });
        });
    </script>
@endsection
