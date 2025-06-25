@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Item: {{ $item->name }}</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('items.update', $item) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Item Name *</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $item->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description *</label>
            <textarea name="description" class="form-control" id="description" rows="4" required>{{ old('description', $item->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="location" class="form-label">Location (Optional)</label>
            <input type="text" name="location" class="form-control" id="location" value="{{ old('location', $item->location) }}">
        </div>

        <div class="mb-3">
            <label for="contact" class="form-label">Contact Info (Optional)</label>
            <input type="text" name="contact" class="form-control" id="contact" value="{{ old('contact', $item->contact) }}">
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status *</label>
            <select name="status" id="status" class="form-select" required>
                <option value="lost" {{ old('status', $item->status) == 'lost' ? 'selected' : '' }}>Lost</option>
                <option value="found" {{ old('status', $item->status) == 'found' ? 'selected' : '' }}>Found</option>
                <option value="claimed" {{ old('status', $item->status) == 'claimed' ? 'selected' : '' }}>Claimed</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Upload New Image (Optional)</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*">
            @if($item->image)
                <small class="form-text text-muted mt-2">Current Image:</small>
                <img src="{{ asset('storage/' . $item->image) }}" alt="Current Image" class="img-thumbnail mt-1" style="max-width: 200px;">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update Item</button>
        <a href="{{ route('items.show', $item) }}" class="btn btn-secondary ms-2">Cancel</a>
    </form>
</div>
@endsection
