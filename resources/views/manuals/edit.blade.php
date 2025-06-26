@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h1 class="card-title mb-4 display-4">Edit Manual</h1>

            <form action="{{ route('manuals.update', $manual->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Machine Name:</label>
                    <input type="text" name="machine_name" value="{{ $manual->machine_name }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description:</label>
                    <textarea name="description" class="form-control" rows="3">{{ $manual->description }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Current PDF:</label><br>
                    <a href="{{ asset('storage/' . $manual->pdf_path) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                        View PDF
                    </a>
                </div>

                <div class="mb-3">
                    <label class="form-label">Upload New PDF (optional):</label>
                    <input type="file" name="pdf_file" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Update Manual</button>
                <a href="{{ route('manuals.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
