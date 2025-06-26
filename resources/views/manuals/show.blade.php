@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h1 class="card-title">{{ $manual->machine_name }}</h1>
            <p class="card-text">{{ $manual->description }}</p>

            <a href="{{ asset('storage/' . $manual->pdf_path) }}" target="_blank" class="btn btn-success">
                View PDF
            </a>
            <a href="{{ route('manuals.index') }}" class="btn btn-secondary">
                Back to List
            </a>
        </div>
    </div>
</div>
@endsection
