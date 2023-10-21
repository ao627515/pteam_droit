@extends('admin.layout')

@section('title', 'Notifications')

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Message</th>
                        <th></th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if($notifications->count() > 0)
                        @foreach ($notifications as $notification)
                            <tr>
                                <td>{{ $notification->data['type'] }}</td>
                                <td>{{ $notification->data['message'] }}</td>
                                <td>
                                    @if (isset($notification->data['motif']))
                                        <button type="button" class="btn btn-primary motif-button"
                                            data-motif="{{ $notification->data['motif'] }}" data-toggle="modal"
                                            data-target="#motif-modal">
                                            Motif
                                        </button>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ $notification->data['object_show'] }}" class="btn">
                                        <i class="nav-icon fa-solid fa-eye" title="Voir" style="color: blue"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4">Aucune notification disponible.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $notifications->links() }}
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="motif-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Motif de refus</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="lead"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // Gérez le clic sur le bouton "Motif"
            $('.motif-button').click(function() {
                // Obtenez la valeur du motif à partir des données de la notification parente
                var motif = $(this).data('motif');

                // Mettez à jour le texte de la balise <p class="lead">
                $('.modal-body .lead').text(motif);
            });
        });
    </script>
@endsection
