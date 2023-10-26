@extends('admin.layout')

@section('titre', 'Modifer un produit')

@section('content')
    <div class="container">
        <div class="card p-5">
            <form action="{{ route('produitAdmin.featured_image',$produit) }}" method="post" id="featuredForm" enctype="multipart/form-data">
                @csrf
                <div class="row row-cols-1">
                    <div class="col">
                        <div class="form-group" >
                            <label for="image">Image mise en avant</label>
                            <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image"
                                name="image" required>
                            @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col mb-3">
                        @if ($produit->image)
                        <img src="{{$produit->imageLink() }}" class="img-thumbnail" alt="..." style="width: 250px; height: 250px">
                            @else
                            <h4>Aucune image enregistré</h4>
                        @endif
                    </div>
                </div>
            </form>

            <form action="{{ route('produitAdmin.update',$produit) }}" method="post" enctype="multipart/form-data" accept-charset="UTF-8" id="form-update">
                @csrf
                @method('put')
                <div class="row row-cols-1">
                    <div class="col mb-3">
                        <div class="form-group">
                            <label for="nom">Nom du produit</label>
                            <input type="text" class="form-control @error('nom') is-invalid @enderror"
                                id="nom" name="nom" required value="{{ old('nom', $produit->nom) }}">
                            @error('nom')
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
                                id="stock" name="stock" value="{{ old('stock', $produit->stock) }}" required>
                            @error('stock')
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
                                rows="4" required>{{ old('short_desc', $produit->short_desc) }}</textarea>
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
                                rows="5" required>{{ old('description',$produit->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary w-100 " data-toggle="modal" data-target="#modal-default">
                    modifié
                </button>
            </form>
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
                        <p>Voullez vous modifié ce produit ?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Annuler</button>
                        <button type="button" class="btn btn-outline-primary" id="confirmUpdate">Oui</button>
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

            $('#image').on('change', function() {
                $('#featuredForm').submit();
            });

            $('#confirmUpdate').on('click', function() {
                // Soumettre le formulaire
                $('#form-update').submit();
            });
        })
    </script>
@endsection

