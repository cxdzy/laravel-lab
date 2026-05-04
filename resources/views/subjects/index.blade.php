@extends('layout.template')

@section('title', 'Subjects')

@section('page_title', 'Subjects')

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

    <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
        <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center py-3">
            <div>
                <div class="text-uppercase small text-body-secondary fw-semibold">Manage</div>
                <div class="fw-semibold">Subjects</div>
            </div>
            <a href="{{ route('subjects.create') }}" class="btn btn-primary btn-sm rounded-3">
                <i class="bi bi-plus-lg me-1"></i> Add Subject
            </a>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="bg-body-tertiary">
                    <tr>
                        <th class="text-uppercase small text-body-secondary fw-semibold" style="width: 90px;">ID</th>
                        <th class="text-uppercase small text-body-secondary fw-semibold" style="width: 140px;">Code</th>
                        <th class="text-uppercase small text-body-secondary fw-semibold">Subject</th>
                        <th class="text-uppercase small text-body-secondary fw-semibold">Lecturer</th>
                        <th class="text-uppercase small text-body-secondary fw-semibold text-end" style="width: 260px;">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($subjects as $subject)
                        <tr>
                            <td>{{ $subject->id }}</td>
                            <td class="fw-medium">{{ $subject->subject_code }}</td>
                            <td class="fw-medium">{{ $subject->subject_name }}</td>
                            <td>{{ $subject->lecturer_name }}</td>
                            <td class="text-end">
                                <a href="{{ route('subjects.show', $subject->id) }}" class="btn btn-outline-secondary btn-sm rounded-3">
                                    <i class="bi bi-eye me-1"></i> View
                                </a>
                                <a href="{{ route('subjects.edit', $subject->id) }}" class="btn btn-outline-primary btn-sm rounded-3">
                                    <i class="bi bi-pencil-square me-1"></i> Edit
                                </a>
                                <form action="{{ route('subjects.destroy', $subject->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm rounded-3" onclick="return confirm('Delete this subject?')">
                                        <i class="bi bi-trash me-1"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">No subjects found.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection