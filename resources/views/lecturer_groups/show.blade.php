@extends('layout.template')

@section('title', 'Lecturer Group Details')

@section('page_title', 'Lecturer Group Details')

@section('content')
    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-header bg-transparent border-0 d-flex justify-content-end align-items-center gap-2 py-3">
            <a href="{{ route('lecturer-groups.edit', $lecturer_group->id) }}" class="btn btn-outline-primary btn-sm rounded-3">
                <i class="bi bi-pencil-square me-1"></i> Edit
            </a>
            <a href="{{ route('lecturer-groups.index') }}" class="btn btn-outline-secondary btn-sm rounded-3">
                <i class="bi bi-arrow-left me-1"></i> Back
            </a>
        </div>
        <div class="card-body">
            <dl class="row mb-0">
                <dt class="col-sm-3 text-uppercase small text-body-secondary fw-semibold">ID</dt>
                <dd class="col-sm-9 fw-medium">{{ $lecturer_group->id }}</dd>
                <dt class="col-sm-3 text-uppercase small text-body-secondary fw-semibold">Name</dt>
                <dd class="col-sm-9 fw-medium">{{ $lecturer_group->name }}</dd>
                <dt class="col-sm-3 text-uppercase small text-body-secondary fw-semibold">Part</dt>
                <dd class="col-sm-9 fw-medium">{{ $lecturer_group->part }}</dd>
            </dl>
        </div>
    </div>
@endsection