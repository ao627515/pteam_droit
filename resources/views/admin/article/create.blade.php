@extends('admin.layout')

@section('title', 'Créer un article')

@section('css')
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/summernote/summernote-bs4.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('content')
    <div class="container ">
        <div class="card">
            <div class="card-header">
                <h1 class="text-center w-100">Créer un article</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('articleAdmin.store') }}" method="post" enctype="multipart/form-data"
                    id="formCreate">
                    @csrf
                    <input type="hidden" name="status">
                    <div class="row row-cols-1">
                        <div class="col mb-3">
                            <div class="form-group">
                                <label for="titre">Titre</label>
                                <input type="text" class="form-control @error('titre') is-invalid @enderror"
                                    id="titre" name="titre" required value="{{ old('titre') }}">
                                @error('titre')
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
                                <label for="description">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                    rows="4" required>{{ old('description') }}</textarea>
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
                                        <option value="{{ $categorie->id }}"
                                            @if (in_array($categorie->id, old('categorie', []))) selected @endif>
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
                                <textarea class="form-control @error('contenu') is-invalid @enderror" id="contenu" name="contenu" required>{{ old('contenu') }}</textarea>
                                @error('contenu')
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
    <!-- Select2 -->
    <script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/summernote/lang/summernote-fr-FR.min.js') }}"></script>
    <script>
        $(document).ready(function() {
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

            $('#confirmDraft').on('click', function() {
                $('input[name="status"]').val(5)

                $('form').submit();
            });

            $('#confirmPublish').on('click', function() {
                $('input[name="status"]').val(1)
                $('form').submit();
            });

            //Initialize Select2 Elements
            $('.select2').select2()

        });
    </script>
@endsection
