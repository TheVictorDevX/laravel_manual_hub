@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4 display-4">Machine Manuals</h1>

    <!-- Upload Button -->
    <a href="{{ route('manuals.create') }}" class="btn btn-success mb-3">Upload New Manual</a>

    <!-- Search Form -->
    <form action="{{ route('manuals.index') }}" method="GET" class="d-flex mb-3">
        <input type="text" name="query" value="{{ request('query') }}" class="form-control me-2" placeholder="Search manuals">
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    @if ($manuals->count() > 0)
        <div class="list-group">
            @foreach ($manuals as $manual)
                <div class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <a href="{{ route('manuals.show', $manual->id) }}" class="text-decoration-none">
                            <strong>{{ $manual->machine_name }}</strong>
                        </a>
                    </div>
                    <div>
                        <a href="{{ route('manuals.edit', $manual->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('manuals.destroy', $manual->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-muted">No manuals available.</p>
    @endif
</div>
@endsection
