<div class="card article-card">
    @if ($article->image)
        <img src="{{ $article->image }}" class="card-img-top" alt="Image">
    @else
        <img src="{{ asset('admin/dist/img/user1-128x128.jpg') }}" class="card-img-top" alt="Image">
    @endif
    <div class="card-body">
        <h6 class="card-subtitle font-weight-bold" style="font-size: 13.5px">{{ $article->titre }}.
        </h6>
        <p class="card-text mt-2" style="font-size: 13px">
            {{ $article->description }}
        </p>
    </div>
    @if (auth()->user()->role === 'administrateur')
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
            @endif
        </ul>
        @if (!$article->approuvedBy)
            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                <form action="" method="get" class="form-action w-50">
                    @csrf
                    <button type="button" class="btn btn-danger w-100 action-btn">Décliné</button>
                </form>
                <form action="{{ route('articleAdmin.approuved', $article) }}" method="get" class="form-action w-50">
                    @csrf
                    <button type="button" class="btn btn-success w-100 action-btn" data-toggle="modal"
                        data-target="#modal-approuve">
                        Approuvé
                    </button>
                </form>
            </div>
        @endif
    @endif
    <div class="card-footer">
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
                    <i class="nav-icon fa-solid fa-trash action-btn" style="color: red" data-target="#modal-destroy"
                        data-toggle="modal"></i>
                </form>
            </li>
        </ul>
    </div>
</div>
