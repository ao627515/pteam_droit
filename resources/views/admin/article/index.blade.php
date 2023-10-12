@extends('admin.layout')

@section('title', 'LIste des articles')

@section('content')
    <style>
        .article-card .article-author {
            display: none;
            transition: display 1s ease;
        }

        .article-card.active:hover .article-author {
            display: block;
            transition: display 1s ease;
        }
    </style>

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
            <div class="row row-cols-1 row-cols-sm-2  row-cols-md-2 row-cols-lg-2  row-cols-xl-4 row-cols-xll-6">
                @foreach ($articles as $article)
                    <div class="col">
                        <x-admin.article-admin-card :article="$article" />
                    </div>
                @endforeach
            </div>
        </div>
        <div class="card-footer px-3 py-0">
            {{ $articles->links() }}
        </div>

        <div class="modal fade" id="modal-destroy">
            <div class="modal-dialog">
                <div class="modal-content bg-danger">
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
                        <button type="button" class="btn btn-outline-light" id="confirmDestroy">Oui</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        <div class="modal fade" id="modal-approuve">
            <div class="modal-dialog">
                <div class="modal-content bg-success">
                    <div class="modal-header">
                        <h4 class="modal-title">Success Modal</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Voullez vous Publier cette article ?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Annuler</button>
                        <button type="button" class="btn btn-outline-light" id="confirmApprouvation">Oui</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <div class="modal fade" id="modal-decline">
            <div class="modal-dialog">
                <div class="modal-content bg-warning">
                    <div class="modal-header">
                        <h4 class="modal-title">Success Modal</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Ete vous surs de vouloir refusé cette article ?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Annuler</button>
                        <button type="button" class="btn btn-outline-light" id="confirmApprouvation">Oui</button>
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
            $('.action-btn').on('click', function() {
                var form = $(this).closest('.form-action');

                $('#confirmDestroy').on('click', function() {
                    // Soumettre le formulaire
                    form.submit();
                });

                $('#confirmApprouvation').on('click', function() {
                    // Soumettre le formulaire
                    form.submit();
                });
            });
        });
    </script>
    {{-- <script>
        document.addEventListener('DOMContentLoaded', () => {
            let activeCard = null;
            const cards = document.querySelectorAll('.article-card');
            cards.forEach(card => {

                card.addEventListener('mouseenter', () => {
                    console.log(card);
                    if(activeCard){
                    activeCard.classList.remove('active');
                }
                    card.classList.add('active');

                    activeCard = card;
                });
            });
        })
    </script> --}}
        <script>
        document.addEventListener('DOMContentLoaded', () => {
            const cards = document.querySelectorAll('.article-card');
            cards.forEach(card => {
                card.addEventListener('mouseenter', () => {
                    card.classList.add('active');
                });

                card.addEventListener('mouseleave', () => {
                    card.classList.remove('active');
                });
            });
        })
    </script>
    {{-- <script src="{{ asset('admin/dist/js/adminArticle.js') }}"></script> --}}
@endsection
