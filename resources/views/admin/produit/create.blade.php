@extends('admin.layout')

@section('title', 'Créer un produit')

@section('content')
    <div class="container ">
        <div class="card">
            <div class="card-header bg-secondary">
                <h1 class="text-center w-100">Créer un produit</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('produitAdmin.store') }}" method="post" enctype="multipart/form-data" id="formCreate">
                    @csrf
                    <input type="hidden" name="status">
                    <div class="row row-cols-1">
                        <div class="col mb-3">
                            <div class="form-group">
                                <label for="nom">Nom du produit</label>
                                <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom"
                                    name="nom" required value="{{ old('nom') }}">
                                @error('nom')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col mb-3">
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" class="form-control-file @error('image') is-invalid @enderror"
                                    id="image" name="image" required>
                                @error('image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col mb-3">
                            <div class="form-group">
                                <label for="stock">Stock</label>
                                <input type="number" class="form-control @error('stock') is-invalid @enderror"
                                    id="stock" name="stock" value="{{ old('stock') }}" required>
                                @error('stock')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col mb-3">
                            <div class="form-group">
                                <label for="prix">Prix</label>
                                <input type="number" class="form-control @error('prix') is-invalid @enderror"
                                    id="prix" name="prix" value="{{ old('prix') }}" required>
                                @error('prix')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col mb-3">
                            <div class="form-group">
                                <label for="short_desc">Description Court</label>
                                <textarea class="form-control @error('short_desc') is-invalid @enderror" id="short_desc" name="short_desc"
                                    rows="4" required>{{ old('short_desc') }}</textarea>
                                @error('short_desc')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col mb-3">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                    rows="5" required>{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary w-100 " data-toggle="modal" data-target="#modal-default">
                        Créer
                    </button>
                </form>
            </div>
        </div>


        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content bg-default">
                    <div class="modal-header">
                        <h4 class="modal-title">Confimation</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Voullez vous créer cette article ?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Annuler</button>
                        <button type="button" class="btn btn-outline-primary" id="confirmDraft">Créer un brouillons</button>
                        <button type="button" class="btn btn-outline-primary" id="confirmPublish">Créer et Publier</button>
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
        $(document).ready(function() {

            $('#confirmDraft').on('click', function() {
                $('input[name="status"]').val(5)

                $('form').submit();
            });

            $('#confirmPublish').on('click', function() {
                $('input[name="status"]').val(1)
                $('form').submit();
            });
        });
    </script>
@endsection
