@extends('admin.layout')

@section('titre', 'Modifer un article')

@section('css')
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/summernote/summernote-bs4.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('content')
    {{ $article->imgInit() }}
    <div class="container">
        <div class="card p-5">
            <form action="{{ route('articleAdmin.featured_image', $article) }}" method="post" id="featuredForm"
                enctype="multipart/form-data">
                @csrf
                <div class="row row-cols-1">
                    <div class="col">
                        <div class="form-group">
                            <label for="image">Image mise en avant</label>
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
                        <img src="{{ $article->image }}" class="img-thumbnail" alt="..."
                            style="width: 250px; height: 250px">
                    </div>
                </div>
            </form>

            <form action="{{ route('articleAdmin.update', $article) }}" method="post" enctype="multipart/form-data"
                accept-charset="UTF-8">
                @csrf
                @method('put')
                <div class="row row-cols-1">
                    <div class="col mb-3">
                        <div class="form-group">
                            <label for="titre">Titre</label>
                            <input type="text" class="form-control @error('titre') is-invalid @enderror" id="titre"
                                name="titre" required value="{{ old('titre', $article->titre) }}">
                            @error('titre')
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
                                rows="1" required>{{ old('description', $article->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col mb-3">
                        <div class="form-group">
                            <label>Categorie</label>
                            <select class="select2 @error('categorie') is-invalid @enderror" multiple
                                data-placeholder="Select a State" style="width: 100%;" name="categorie[]" id="categorie"
                                value="{{ old('categorie') }}">
                                @foreach ($categories as $categorie)
                                    <option value="{{ $categorie->id }}" @if ($article->categories->contains($categorie->id)) selected @endif>
                                        {{ Str::ucfirst($categorie->nom) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('categorie')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col mb-3">
                        <div class="form-group">
                            <label for="contenu">Corps de l'article</label>
                            <textarea class="form-control @error('contenu') is-invalid @enderror" id="contenu" name="contenu" rows="5"
                                required>
                                {{ old('contenu', $article->contenu) }}
                            </textarea>
                            @error('contenu')
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
                        <p>Voullez vous modifié cette article ?</p>
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
    <!-- Select2 -->
    <script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/summernote/lang/summernote-fr-FR.min.js') }}"></script>
    <script>
        $(function() {
            // Summernote
            $('#contenu').summernote({
                placeholder: 'contentu...',
                tabsize: 2,
                height: 300,
                lang: 'fr-FR',
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript',
                        'subscript', 'clear'
                    ]],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video', 'hr']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });

            $('#image').on('change', function() {
                $('#featuredForm').submit();
            });

            $('#confirmUpdate').on('click', function() {
                // Soumettre le formulaire
                $('form').submit();
            });

            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        })
    </script>
@endsection
