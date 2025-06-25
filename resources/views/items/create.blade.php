@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Report Lost or Found Item</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="mb-3">
            <label for="name" class="form-label">Item Name *</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description *</label>
            <textarea name="description" class="form-control" id="description" rows="4" required>{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="location" class="form-label">Location (Optional)</label>
            <input type="text" name="location" class="form-control" id="location" value="{{ old('location') }}">
        </div>

        <div class="mb-3">
            <label for="contact" class="form-label">Contact Info (Optional)</label>
            <input type="text" name="contact" class="form-control" id="contact" value="{{ old('contact') }}">
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status *</label>
            <select name="status" id="status" class="form-select" required>
                <option value="" disabled selected>Select status</option>
                <option value="lost" {{ old('status') == 'lost' ? 'selected' : '' }}>Lost</option>
                <option value="found" {{ old('status') == 'found' ? 'selected' : '' }}>Found</option>
                <option value="claimed" {{ old('status') == 'claimed' ? 'selected' : '' }}>Claimed</option>
            </select>
        </div>

        {{-- 🗓️ Date and Time Lost --}}
        <div class="mb-3">
            <label for="time_lost" class="form-label">Date and Time Lost (Optional)</label>
            <input type="datetime-local" name="time_lost" id="time_lost" class="form-control" value="{{ old('time_lost') }}">
        </div>

        {{-- 🗓️ Date and Time Found --}}
        <div class="mb-3">
            <label for="time_found" class="form-label">Date and Time Found (Optional)</label>
            <input type="datetime-local" name="time_found" id="time_found" class="form-control" value="{{ old('time_found') }}">
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Upload Image (Optional)</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">Report Item</button>
        <a href="{{ route('items.index') }}" class="btn btn-secondary ms-2">Cancel</a>
    </form>
</div>
@endsection
