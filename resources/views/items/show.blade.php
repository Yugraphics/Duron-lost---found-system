<!-- resources/views/items/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
        @if($item->image)
            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="img-fluid mb-3 rounded">
        @endif

        <h3>{{ $item->name }}</h3>
        <p>{{ $item->description }}</p>
        <p><strong>Status:</strong> {{ ucfirst($item->status) }}</p>
        <p><strong>Location:</strong> {{ $item->location ?? 'N/A' }}</p>
        <p><strong>Contact:</strong> {{ $item->contact ?? 'N/A' }}</p>

        @if($item->time_lost)
            <p><strong>Date & Time Lost:</strong> {{ \Carbon\Carbon::parse($item->time_lost)->format('F j, Y \a\t g:i A') }}</p>
        @endif

        @if($item->time_found)
            <p><strong>Date & Time Found:</strong> {{ \Carbon\Carbon::parse($item->time_found)->format('F j, Y \a\t g:i A') }}</p>
        @endif

        <!-- Action Buttons -->
        <a href="{{ route('items.edit', $item) }}" class="btn btn-outline-primary me-2">Edit</a>

        <form action="{{ route('items.destroy', $item) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this item?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-outline-danger">Delete</button>
        </form>

        <a href="{{ route('items.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>
@endsection
