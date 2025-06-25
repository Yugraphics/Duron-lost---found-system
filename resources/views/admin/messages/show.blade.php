@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Message from {{ $message->name }}</h3>
    <p><strong>Email:</strong> {{ $message->email }}</p>
    <p><strong>Sent:</strong> {{ $message->created_at->format('Y-m-d H:i') }}</p>
    <hr>
    <p>{{ $message->message }}</p>
    <a href="{{ route('admin.messages.index') }}" class="btn btn-secondary mt-3">Back to Messages</a>
</div>
@endsection
