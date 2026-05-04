@extends('layout.template')

@section('title', 'Create Subject')

@section('page_title', 'Create Subject')

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
        <form action="{{ route('subjects.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="subject_code" class="form-label text-uppercase small text-body-secondary fw-semibold">Subject Code</label>
                        <input type="text" name="subject_code" id="subject_code" class="form-control rounded-3 mm-input" required autofocus value="{{ old('subject_code') }}" placeholder="e.g., CS101">
                    </div>
                    <div class="col-md-8">
                        <label for="subject_name" class="form-label text-uppercase small text-body-secondary fw-semibold">Subject Name</label>
                        <input type="text" name="subject_name" id="subject_name" class="form-control rounded-3 mm-input" required value="{{ old('subject_name') }}" placeholder="e.g., Data Structures">
                    </div>
                    <div class="col-12">
                        <label for="lecturer_name" class="form-label text-uppercase small text-body-secondary fw-semibold">Lecturer Name (optional)</label>
                        <input type="text" name="lecturer_name" id="lecturer_name" class="form-control rounded-3 mm-input" value="{{ old('lecturer_name') }}" placeholder="Optional">
                    </div>
                </div>
            </div>
            <div class="card-footer bg-transparent border-0 d-flex justify-content-end gap-2">
                <a href="{{ route('subjects.index') }}" class="btn btn-outline-secondary rounded-3">Cancel</a>
                <button type="submit" class="btn btn-primary rounded-3">
                    <i class="bi bi-check2 me-1"></i> Save
                </button>
            </div>
        </form>
    </div>
@endsection