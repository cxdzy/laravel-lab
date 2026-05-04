@extends('layout.template')

@section('title', 'Dashboard')

@section('page_title', 'Dashboard')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body">
                    <h3 class="mb-1">Welcome, {{ auth()->user()->name }}</h3>
                    <p class="text-muted mb-0">What would you like to manage today?</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 col-sm-6 col-12">
            <a class="text-decoration-none" href="{{ route('timetables.index') }}">
                <div class="card border-0 shadow-sm rounded-3 h-100">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="rounded-3 bg-primary-subtle text-primary d-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                            <i class="bi bi-table"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="fw-semibold">Timetables</div>
                            <div class="text-body-secondary small">Manage schedules</div>
                        </div>
                        <i class="bi bi-chevron-right text-body-secondary"></i>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4 col-sm-6 col-12">
            <a class="text-decoration-none" href="{{ route('students.index') }}">
                <div class="card border-0 shadow-sm rounded-3 h-100">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="rounded-3 bg-info-subtle text-info d-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                            <i class="bi bi-people"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="fw-semibold">Students</div>
                            <div class="text-body-secondary small">Manage records</div>
                        </div>
                        <i class="bi bi-chevron-right text-body-secondary"></i>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4 col-sm-6 col-12">
            <a class="text-decoration-none" href="{{ route('subjects.index') }}">
                <div class="card border-0 shadow-sm rounded-3 h-100">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="rounded-3 bg-success-subtle text-success d-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                            <i class="bi bi-book"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="fw-semibold">Subjects</div>
                            <div class="text-body-secondary small">Manage courses</div>
                        </div>
                        <i class="bi bi-chevron-right text-body-secondary"></i>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4 col-sm-6 col-12">
            <a class="text-decoration-none" href="{{ route('halls.index') }}">
                <div class="card border-0 shadow-sm rounded-3 h-100">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="rounded-3 bg-warning-subtle text-warning d-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                            <i class="bi bi-building"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="fw-semibold">Halls</div>
                            <div class="text-body-secondary small">Manage venues</div>
                        </div>
                        <i class="bi bi-chevron-right text-body-secondary"></i>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4 col-sm-6 col-12">
            <a class="text-decoration-none" href="{{ route('days.index') }}">
                <div class="card border-0 shadow-sm rounded-3 h-100">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="rounded-3 bg-secondary-subtle text-secondary d-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                            <i class="bi bi-calendar"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="fw-semibold">Days</div>
                            <div class="text-body-secondary small">Manage calendar</div>
                        </div>
                        <i class="bi bi-chevron-right text-body-secondary"></i>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4 col-sm-6 col-12">
            <a class="text-decoration-none" href="{{ route('lecturer-groups.index') }}">
                <div class="card border-0 shadow-sm rounded-3 h-100">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="rounded-3 bg-danger-subtle text-danger d-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                            <i class="bi bi-person-badge"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="fw-semibold">Lecturer Groups</div>
                            <div class="text-body-secondary small">Manage groups</div>
                        </div>
                        <i class="bi bi-chevron-right text-body-secondary"></i>
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection