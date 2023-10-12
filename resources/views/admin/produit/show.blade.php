@extends('admin.layout')

@section('titre', 'produit')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <div class="col-12">
                        <div class="card">
                            {{-- <img src="{{ asset('assets/img/produit.jpg') }}" alt="logo" width="50%" class="card-img-top"> --}}
                            <img src="{{ asset('admin/dist/img/default-150x150.png') }}" class="card-img-top" alt="Image">
                            <h3 class="card-title text-center mt-3">{{ $produit->nom }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6">
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
                    @if (!$produit->approuvedBy)
                        <div class="btn-group mt-3 w-100" role="group" aria-label="Basic mixed styles example">
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
                    @endif
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
@endsection

@section('script')

@endsection
