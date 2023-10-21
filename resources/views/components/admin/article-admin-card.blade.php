<div class="card article-card">
    @if ($article->image)
        <img src="{{ $article->image }}" class="card-img-top" alt="Image">
    @else
        <img src="{{ asset('admin/dist/img/user1-128x128.jpg') }}" class="card-img-top" alt="Image">
    @endif
    <div class="card-body">
        <h6 class="card-subtitle font-weight-bold" style="font-size: 13.5px">
            {{ $article->titre }}.
        </h6>
        <small>{{ $article->getActionDate() }}</small><br>
        <small><Span class="badge badge-info">Staut</Span> : {{ $article->getStatus() }}</small>
        <p class="card-text mt-2" style="font-size: 13px">
            {{ $article->description }}
        </p>
    </div>
    @if (auth()->user()->isAdmin())
        <ul class="list-group list-group-flush article-author">
            <li class="list-group-item border-top px-3 py-1">
                <div class="d-flex">
                    <div class="mr-3 pt-1">
                        <img class="rounded-circle"
                            src="{{ 'https://eu.ui-avatars.com/api/?name=' . $article->author->nom . '+' . $article->author->prenom . '&background=random&size=40' }}">
                    </div>
                    <div class="">
                        <small class="d-block">Publier par </small>
                        <small class="d-block">{{ $article->author->nom . ' ' . $article->author->prenom }}</small>
                    </div>
                </div>
            </li>
            @if ($article->approuvedBy)
                <li class="list-group-item px-3 py-1">
                    <div class="d-flex justify-content-end">
                        <div class="">
                            <small class="d-block">Aprouvé par</small>
                            <small>{{ $article->approuvedBy->nom . ' ' . $article->approuvedBy->prenom }}</small>
                        </div>
                        <div class="pt-1 ml-3">
                            <img class="rounded-circle"
                                src="{{ 'https://eu.ui-avatars.com/api/?name=' . $article->approuvedBy->nom . '+' . $article->approuvedBy->prenom . '&background=random&size=40' }}">
                        </div>
                    </div>
                </li>
            @elseif ($article->declinedBy)
                <li class="list-group-item px-3 py-1">
                    <div class="d-flex justify-content-end">
                        <div class="">
                            <small class="d-block">Décliné par</small>
                            <small>{{ $article->declinedBy->nom . ' ' . $article->declinedBy->prenom }}</small>
                        </div>
                        <div class="pt-1 ml-3">
                            <img class="rounded-circle"
                                src="{{ 'https://eu.ui-avatars.com/api/?name=' . $article->declinedBy->nom . '+' . $article->declinedBy->prenom . '&background=random&size=40' }}">
                        </div>
                    </div>
                </li>
            @endif
        </ul>

    @endif

    <div class="card-footer d-flex justify-content-center">

        <div class="btn-group">
            <button type="button" class="btn btn-info text-light fw-bold">Actions</button>
            <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown">
                <span class="sr-only">Toggle Dropdown</span>
            </button>
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

                @if (($article->isStandby()) and auth()->user()->isAdmin())
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

                <ul class="nav nav-fill">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('articleAdmin.edit', $article) }}" title="Modifer">
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
                            <i class="nav-icon fa-solid fa-trash action-btn" style="color: red"
                                data-target="#modal-destroy" data-toggle="modal"></i>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
