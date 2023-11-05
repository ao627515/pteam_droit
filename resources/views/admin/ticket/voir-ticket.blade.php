@extends('admin.layout')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profile</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                utilisateur
                            </div>

                            <h3 class="profile-username text-center">{{ $ticket->user->nom . ' ' . $ticket->user->prenom }}
                            </h3>

                            <p class="text-muted text-center">ticket {{ $ticket->id }}</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>telephone</b> <a class="float-right">{{ $ticket->user->phone }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>email</b> <a>{{ $ticket->user->email }}</a>
                                </li>

                            </ul>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <h2 class="text-center">COMMENTAIRE</h2>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="activity">

                                    <!-- Post -->
                                    <div class="post clearfix">
                                        <div class="user-block">
                                            <img class="img-circle img-bordered-sm"
                                                src="{{ asset('admin/dist/img/user7-128x128.jpg') }}" alt="User Image">
                                            <span class="username">
                                                <a href="#" class="float-right btn-tool"><i
                                                        class="fas fa-times"></i></a>
                                            </span>
                                            <span class="description">envoyé le {{ $ticket->created_at }}</span>
                                        </div>
                                        <!-- /.user-block -->

                                        <p>
                                            {{ $ticket->message }}
                                        </p>
                                        @foreach ($commentaires as $commentaire)
                                            <div class="post clearfix">
                                                <div class="user-block">
                                                    <img class="img-circle img-bordered-sm"
                                                        src="{{ asset('admin/dist/img/user7-128x128.jpg') }}"
                                                        alt="User Image">
                                                    <span class="username">
                                                        <a href="#" class="float-right btn-tool"><i
                                                                class="fas fa-times"></i></a>
                                                    </span>
                                                    <span class="description">envoyé le
                                                        {{ $commentaire->created_at }}</span>
                                                </div>
                                                <p> {{ $commentaire->contenu }}</p>
                                        @endforeach


                                        <form class="form-horizontal" method="post"
                                            action="{{ route('commentaire.store') }}">
                                            @csrf
                                            <div class="input-group input-group-sm mb-0">
                                                <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                                                <textarea name="contenu" id="contenu" cols="60" rows="5" class="form-control"></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-danger">envoyer</button>
                                        </form>

                                    </div>
                                </div>
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <form action="{{ route('ticket.changer') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $ticket->id }}">
                        {{-- <button type="submit" name="status" value="1">Annuler</button> --}}
                        <button type="submit" name="status" value="3">Terminer</button>
                    </form>

                    {{-- <form action="{{ route('ticket.changer') }}" method="post">
            @csrf
            @foreach ($tickets as $ticket)
            <div class="ticket">
                <span>{{ $ticket->objet }}</span>
                <span>Statut actuel : {{ $ticket->status }}</span>
                <button type="submit" name="ticket_id" value="{{ $ticket->id }}" data-status="1">Annuler</button>
                <button type="submit" name="ticket_id" value="{{ $ticket->id }}" data-status="3">Terminer</button>
            </div>
            @endforeach
        </form> --}}


                </div>

                <!-- /.row -->
            </div><!-- /.container-fluid -->


    </section>
    <!-- Post -->
@endsection


{{-- <script>
    function changeStatut(nouveauStatut) {
        // Envoyez une requête Ajax pour mettre à jour le statut du ticket
        $.ajax({
            type: 'POST',
            url: "{{ route('update-statut', $ticket) }}",
            data: {
                '_token': "{{ csrf_token() }}",
                'nouveauStatut': nouveauStatut
            },
            success: function (data) {
                // Rafraîchissez la page ou effectuez d'autres actions nécessaires
                window.location.reload();
            }
        });
    }
</script>

@endsection --}}
