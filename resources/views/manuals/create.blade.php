@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h1 class="card-title mb-4 display-4">Upload Manual</h1>

            <form action="{{ route('manuals.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Machine Name:</label>
                    <input type="text" name="machine_name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description:</label>
                    <textarea name="description" class="form-control" rows="3"></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Upload PDF:</label>
                    <input type="file" name="pdf_file" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Upload</button>
                <a href="{{ route('manuals.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
