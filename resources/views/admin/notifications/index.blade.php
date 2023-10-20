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
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{ $notifications->markAsRead() }}
                    @foreach ($notifications as $notification)
                        <tr>
                            <td>{{ $notification->data['type'] }}</td>
                            <td>{{ $notification->data['message'] }}</td>
                            <td>
                                <a href="{{ $notification->data['object_show'] }}" class="btn">
                                    <i class="nav-icon fa-solid fa-eye" title="Voir" style="color: blue"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $notifications->links() }}
        </div>
    </div>
@endsection
