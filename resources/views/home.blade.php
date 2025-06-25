@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold">Lost and Found Portal</h1>
        <p class="text-secondary">Helping you recover what matters most.</p>

        <div class="row justify-content-center mt-4">
            <div class="col-md-3 mb-2">
                <a href="{{ route('items.create') }}" class="btn btn-primary w-100">Report Lost Item</a>
            </div>
            <div class="col-md-3 mb-2">
                <a href="{{ route('items.index') }}" class="btn btn-outline-primary w-100">Browse Items</a>
            </div>
            <div class="col-md-3 mb-2">
                <a href="{{ route('contacts.create') }}" class="btn btn-outline-secondary w-100">Contact Us</a>
            </div>

            @auth
                @if(auth()->user()->is_admin)
                <div class="col-md-3 mb-2">
                    <a href="{{ route('admin.messages.index') }}" class="btn btn-outline-dark w-100">View Messages</a>
                </div>
                @endif
            @endauth
        </div>
    </div>

    @if($recentItems->count())
    <h4 class="mb-3">Recently Reported Items</h4>
    <div class="row">
        @foreach($recentItems as $item)
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                @if($item->image)
                <img src="{{ asset('storage/' . $item->image) }}" class="card-img-top" alt="{{ $item->name }}" style="object-fit: cover; height: 200px;">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $item->name }}</h5>
                    <p class="card-text">{{ Str::limit($item->description, 80) }}</p>
                    <p class="mb-1 text-muted"><small>Status: {{ ucfirst($item->status) }}</small></p>
                    <p class="text-muted"><small>Location: {{ $item->location }}</small></p>
                    <a href="{{ route('items.show', $item) }}" class="btn btn-sm btn-outline-primary">View Details</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="alert alert-info text-center">
        No items have been reported recently.
    </div>
    @endif
</div>
@endsection
