@extends('layout.template')

@section('title', 'Timetable Details')

@section('page_title', 'Timetable Details')

@section('content')
    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-header bg-transparent border-0 d-flex justify-content-end align-items-center gap-2 py-3">
            <a href="{{ route('timetables.edit', $timetable->id) }}" class="btn btn-outline-primary btn-sm rounded-3">
                <i class="bi bi-pencil-square me-1"></i> Edit
            </a>
            <a href="{{ route('timetables.index') }}" class="btn btn-outline-secondary btn-sm rounded-3">
                <i class="bi bi-arrow-left me-1"></i> Back
            </a>
        </div>
        <div class="card-body">
            <dl class="row mb-0">
                <dt class="col-sm-3 text-uppercase small text-body-secondary fw-semibold">ID</dt>
                <dd class="col-sm-9 fw-medium">{{ $timetable->id }}</dd>

                <dt class="col-sm-3 text-uppercase small text-body-secondary fw-semibold">User</dt>
                <dd class="col-sm-9 fw-medium">{{ optional($timetable->user)->name }}</dd>

                <dt class="col-sm-3 text-uppercase small text-body-secondary fw-semibold">Subject</dt>
                <dd class="col-sm-9">
                    <div class="fw-medium">{{ optional($timetable->subject)->subject_name }}</div>
                    <div class="text-muted small">{{ optional($timetable->subject)->subject_code }}</div>
                </dd>

                <dt class="col-sm-3 text-uppercase small text-body-secondary fw-semibold">Lecturer</dt>
                <dd class="col-sm-9 fw-medium">{{ optional($timetable->subject)->lecturer_name }}</dd>

                <dt class="col-sm-3 text-uppercase small text-body-secondary fw-semibold">Day</dt>
                <dd class="col-sm-9 fw-medium">{{ optional($timetable->day)->day_name }}</dd>

                <dt class="col-sm-3 text-uppercase small text-body-secondary fw-semibold">Time</dt>
                <dd class="col-sm-9 fw-medium">{{ $timetable->time_from }} — {{ $timetable->time_to }}</dd>

                <dt class="col-sm-3 text-uppercase small text-body-secondary fw-semibold">Hall</dt>
                <dd class="col-sm-9 fw-medium">{{ optional($timetable->hall)->lecture_hall_name }}</dd>

                <dt class="col-sm-3 text-uppercase small text-body-secondary fw-semibold">Group</dt>
                <dd class="col-sm-9 fw-medium">{{ optional($timetable->lecturerGroup)->name }}</dd>
            </dl>
        </div>
    </div>
@endsection