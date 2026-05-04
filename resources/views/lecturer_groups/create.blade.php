@extends('layout.template')

@section('title', 'Create Lecturer Group')

@section('page_title', 'Create Lecturer Group')

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
        <form action="{{ route('lecturer-groups.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-8">
                        <label for="name" class="form-label text-uppercase small text-body-secondary fw-semibold">Group Name</label>
                        <input type="text" name="name" id="name" class="form-control rounded-3 mm-input" required autofocus value="{{ old('name') }}" placeholder="e.g., Group A">
                    </div>
                    <div class="col-md-4">
                        <label for="part" class="form-label text-uppercase small text-body-secondary fw-semibold">Part / Division</label>
                        <input type="text" name="part" id="part" class="form-control rounded-3 mm-input" required value="{{ old('part') }}" placeholder="e.g., 1">
                    </div>
                </div>
            </div>
            <div class="card-footer bg-transparent border-0 d-flex justify-content-end gap-2">
                <a href="{{ route('lecturer-groups.index') }}" class="btn btn-outline-secondary rounded-3">Cancel</a>
                <button type="submit" class="btn btn-primary rounded-3">
                    <i class="bi bi-check2 me-1"></i> Save
                </button>
            </div>
        </form>
    </div>
@endsection