@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="my-4">Lost and Found Items</h2>
    
    <!-- Flash Message -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Search and Status Filter -->
    <form method="GET" action="{{ route('items.index') }}" class="d-flex mb-4">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search items..." class="form-control me-2">
        <select name="status" class="form-select me-2">
            <option value="" {{ request('status') == '' ? 'selected' : '' }}>All Statuses</option>
            <option value="lost" {{ request('status') == 'lost' ? 'selected' : '' }}>Lost</option>
            <option value="found" {{ request('status') == 'found' ? 'selected' : '' }}>Found</option>
            <option value="claimed" {{ request('status') == 'claimed' ? 'selected' : '' }}>Claimed</option>
        </select>
        <button type="submit" class="btn btn-primary">Filter</button>
    </form>

    <!-- Items List -->
    @if($items->count())
        <div class="row">
            @foreach($items as $item)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm h-100">
                        @if($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" class="card-img-top" alt="{{ $item->name }}">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->name }}</h5>

                            <!-- Status Badge -->
                            <span class="badge 
                                {{ $item->status == 'lost' ? 'bg-danger' : ($item->status == 'found' ? 'bg-warning' : 'bg-success') }}">
                                {{ ucfirst($item->status) }}
                            </span>

                            <p class="card-text">{{ Str::limit($item->description, 100) }}</p>

                            <!-- Date/Time Info -->
                            @if($item->time_lost)
                                <p class="mb-1"><small class="text-muted">Lost: {{ \Carbon\Carbon::parse($item->time_lost)->format('M d, Y g:i A') }}</small></p>
                            @endif
                            @if($item->time_found)
                                <p><small class="text-muted">Found: {{ \Carbon\Carbon::parse($item->time_found)->format('M d, Y g:i A') }}</small></p>
                            @endif

                            <!-- View Details Button -->
                            <a href="{{ route('items.show', $item) }}" class="btn btn-outline-primary btn-sm">View Details</a>

                            <!-- Delete Button -->
                            <form action="{{ route('items.destroy', $item) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $items->withQueryString()->links() }}
    @else
        <p>No items found.</p>
    @endif
</div>
@endsection
