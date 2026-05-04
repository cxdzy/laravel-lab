@extends('layout.template')

@section('title', 'Subject Details')

@section('page_title', 'Subject Details')

@section('content')
    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-header bg-transparent border-0 d-flex justify-content-end align-items-center gap-2 py-3">
            <a href="{{ route('subjects.edit', $subject->id) }}" class="btn btn-outline-primary btn-sm rounded-3">
                <i class="bi bi-pencil-square me-1"></i> Edit
            </a>
            <a href="{{ route('subjects.index') }}" class="btn btn-outline-secondary btn-sm rounded-3">
                <i class="bi bi-arrow-left me-1"></i> Back
            </a>
        </div>
        <div class="card-body">
            <dl class="row mb-0">
                <dt class="col-sm-3 text-uppercase small text-body-secondary fw-semibold">ID</dt>
                <dd class="col-sm-9 fw-medium">{{ $subject->id }}</dd>
                <dt class="col-sm-3 text-uppercase small text-body-secondary fw-semibold">Code</dt>
                <dd class="col-sm-9 fw-medium">{{ $subject->subject_code }}</dd>
                <dt class="col-sm-3 text-uppercase small text-body-secondary fw-semibold">Name</dt>
                <dd class="col-sm-9 fw-medium">{{ $subject->subject_name }}</dd>
                <dt class="col-sm-3 text-uppercase small text-body-secondary fw-semibold">Lecturer</dt>
                <dd class="col-sm-9 fw-medium">{{ $subject->lecturer_name }}</dd>
            </dl>
        </div>
    </div>
@endsection