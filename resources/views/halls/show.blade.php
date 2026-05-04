@extends('layout.template')

@section('title', 'Hall Details')

@section('page_title', 'Hall Details')

@section('content')
    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-header bg-transparent border-0 d-flex justify-content-end align-items-center gap-2 py-3">
            <a href="{{ route('halls.edit', $hall->id) }}" class="btn btn-outline-primary btn-sm rounded-3">
                <i class="bi bi-pencil-square me-1"></i> Edit
            </a>
            <a href="{{ route('halls.index') }}" class="btn btn-outline-secondary btn-sm rounded-3">
                <i class="bi bi-arrow-left me-1"></i> Back
            </a>
        </div>
        <div class="card-body">
            <dl class="row mb-0">
                <dt class="col-sm-3 text-uppercase small text-body-secondary fw-semibold">ID</dt>
                <dd class="col-sm-9 fw-medium">{{ $hall->id }}</dd>
                <dt class="col-sm-3 text-uppercase small text-body-secondary fw-semibold">Name</dt>
                <dd class="col-sm-9 fw-medium">{{ $hall->lecture_hall_name }}</dd>
                <dt class="col-sm-3 text-uppercase small text-body-secondary fw-semibold">Place</dt>
                <dd class="col-sm-9 fw-medium">{{ $hall->lecture_hall_place }}</dd>
            </dl>
        </div>
    </div>
@endsection