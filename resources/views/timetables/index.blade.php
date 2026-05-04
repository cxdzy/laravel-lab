@extends('layout.template')

@section('title', 'Timetables')

@section('page_title', 'Timetables')

@push('styles')
    <style>
        .mm-input:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 0.2rem rgba(99, 102, 241, 0.25);
        }
    </style>
@endpush

@section('content')
    @if (session('success'))
        <div class="alert alert-success border-0 rounded-3 shadow-sm py-2 px-3 d-flex align-items-center justify-content-between" role="alert">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-check-circle"></i>
                <span>{{ session('success') }}</span>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger border-0 rounded-3 shadow-sm py-2 px-3 d-flex align-items-center justify-content-between" role="alert">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-exclamation-triangle"></i>
                <span>{{ session('error') }}</span>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
        <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center py-3">
            <div>
                <div class="text-uppercase small text-body-secondary fw-semibold">Manage</div>
                <div class="fw-semibold">Timetables</div>
            </div>
            <a href="{{ route('timetables.create') }}" class="btn btn-primary btn-sm rounded-3">
                <i class="bi bi-plus-lg me-1"></i> Create Timetable
            </a>
        </div>

        <div class="card-body pt-0">
            <form action="{{ route('timetables.index') }}" method="GET" class="mb-0">
                <div class="row g-3">
                    <div class="col-12 col-md">
                        <label for="user_name" class="form-label text-uppercase small text-body-secondary fw-semibold">User</label>
                        <input type="text" name="user_name" id="user_name" value="{{ request('user_name') }}" class="form-control rounded-3 mm-input" placeholder="User name">
                    </div>
                    <div class="col-12 col-md">
                        <label for="subject_name" class="form-label text-uppercase small text-body-secondary fw-semibold">Subject</label>
                        <input type="text" name="subject_name" id="subject_name" value="{{ request('subject_name') }}" class="form-control rounded-3 mm-input" placeholder="Subject">
                    </div>
                    <div class="col-12 col-md">
                        <label for="day_name" class="form-label text-uppercase small text-body-secondary fw-semibold">Day</label>
                        <input type="text" name="day_name" id="day_name" value="{{ request('day_name') }}" class="form-control rounded-3 mm-input" placeholder="Day">
                    </div>
                    <div class="col-12 col-md">
                        <label for="hall_name" class="form-label text-uppercase small text-body-secondary fw-semibold">Hall</label>
                        <input type="text" name="hall_name" id="hall_name" value="{{ request('hall_name') }}" class="form-control rounded-3 mm-input" placeholder="Hall">
                    </div>
                    <div class="col-12 col-md">
                        <label for="group_name" class="form-label text-uppercase small text-body-secondary fw-semibold">Group</label>
                        <input type="text" name="group_name" id="group_name" value="{{ request('group_name') }}" class="form-control rounded-3 mm-input" placeholder="Group">
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-3">
                    <a href="{{ route('timetables.index') }}" class="btn btn-outline-secondary btn-sm rounded-3">
                        <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                    </a>
                    <button type="submit" class="btn btn-primary btn-sm rounded-3">
                        <i class="bi bi-search me-1"></i> Search
                    </button>
                </div>
            </form>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="bg-body-tertiary">
                    <tr>
                        <th class="text-uppercase small text-body-secondary fw-semibold">User</th>
                        <th class="text-uppercase small text-body-secondary fw-semibold">Subject</th>
                        <th class="text-uppercase small text-body-secondary fw-semibold">Schedule</th>
                        <th class="text-uppercase small text-body-secondary fw-semibold">Hall & Group</th>
                        <th class="text-uppercase small text-body-secondary fw-semibold text-end" style="width: 260px;">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($timetables as $t)
                        <tr>
                            <td class="fw-medium">{{ optional($t->user)->name }}</td>
                            <td>
                                <div class="fw-semibold">{{ optional($t->subject)->subject_name }}</div>
                                <div class="text-muted small">{{ optional($t->subject)->subject_code }}</div>
                            </td>
                            <td>
                                <div class="fw-semibold">{{ optional($t->day)->day_name }}</div>
                                <div class="text-muted small">{{ $t->time_from }} — {{ $t->time_to }}</div>
                            </td>
                            <td>
                                <div class="fw-semibold">{{ optional($t->hall)->lecture_hall_name }}</div>
                                <div class="text-muted small">{{ optional($t->lecturerGroup)->name }}</div>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('timetables.show', $t->id) }}" class="btn btn-outline-secondary btn-sm rounded-3">
                                    <i class="bi bi-eye me-1"></i> View
                                </a>
                                <a href="{{ route('timetables.edit', $t->id) }}" class="btn btn-outline-primary btn-sm rounded-3">
                                    <i class="bi bi-pencil-square me-1"></i> Edit
                                </a>
                                <form action="{{ route('timetables.destroy', $t->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm rounded-3" onclick="return confirm('Delete this schedule?')">
                                        <i class="bi bi-trash me-1"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">No timetables found.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection