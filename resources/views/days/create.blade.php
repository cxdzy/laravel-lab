@extends('layout.template')

@section('title', 'Create Day')

@section('page_title', 'Create Day')

@push('styles')
    <style>
        .mm-input:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 0.2rem rgba(99, 102, 241, 0.25);
        }
    </style>
@endpush

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger border-0 rounded-3 shadow-sm">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-3">
        <form action="{{ route('days.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="day_name" class="form-label text-uppercase small text-body-secondary fw-semibold">Day Name</label>
                        <input type="text" name="day_name" id="day_name" class="form-control rounded-3 mm-input" required autofocus value="{{ old('day_name') }}" placeholder="e.g., Monday">
                    </div>
                </div>
            </div>
            <div class="card-footer bg-transparent border-0 d-flex justify-content-end gap-2">
                <a href="{{ route('days.index') }}" class="btn btn-outline-secondary rounded-3">
                    Cancel
                </a>
                <button type="submit" class="btn btn-primary rounded-3">
                    <i class="bi bi-check2 me-1"></i> Save
                </button>
            </div>
        </form>
    </div>
@endsection