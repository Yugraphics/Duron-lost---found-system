@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Messages</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Status</th>
                <th>Sent At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($messages as $msg)
            <tr>
                <td>{{ $msg->name }}</td>
                <td>{{ $msg->email }}</td>
                <td>{{ $msg->status }}</td>
                <td>{{ $msg->created_at->format('Y-m-d H:i') }}</td>
                <td><a href="{{ route('admin.messages.show', $msg->id) }}" class="btn btn-primary btn-sm">View</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $messages->links() }}
</div>
@endsection
