@extends('layout.template')

@section('title', 'Student Details')

@section('page_title', 'Student Details')

@section('content')
    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-header bg-transparent border-0 d-flex justify-content-end align-items-center gap-2 py-3">
            <a href="{{ route('students.edit', $student->id) }}" class="btn btn-outline-primary btn-sm rounded-3">
                <i class="bi bi-pencil-square me-1"></i> Edit
            </a>
            <a href="{{ route('students.index') }}" class="btn btn-outline-secondary btn-sm rounded-3">
                <i class="bi bi-arrow-left me-1"></i> Back
            </a>
        </div>
        <div class="card-body">
            <dl class="row mb-0">
                <dt class="col-sm-3 text-uppercase small text-body-secondary fw-semibold">ID</dt>
                <dd class="col-sm-9 fw-medium">{{ $student->id }}</dd>

                <dt class="col-sm-3 text-uppercase small text-body-secondary fw-semibold">Name</dt>
                <dd class="col-sm-9 fw-medium">{{ $student->name }}</dd>

                <dt class="col-sm-3 text-uppercase small text-body-secondary fw-semibold">Email</dt>
                <dd class="col-sm-9 fw-medium">{{ $student->email }}</dd>

                <dt class="col-sm-3 text-uppercase small text-body-secondary fw-semibold">Phone</dt>
                <dd class="col-sm-9 fw-medium">{{ $student->phone_number ?? '—' }}</dd>

                <dt class="col-sm-3 text-uppercase small text-body-secondary fw-semibold">Address</dt>
                <dd class="col-sm-9 fw-medium">{{ $student->address ?? '—' }}</dd>
            </dl>
        </div>
    </div>
@endsection