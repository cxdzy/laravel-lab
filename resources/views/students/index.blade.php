@extends('layout.template')

@section('title', 'Students')

@section('page_title', 'Students')

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
                <div class="fw-semibold">Students</div>
            </div>
            <a href="{{ route('students.create') }}" class="btn btn-primary btn-sm rounded-3">
                <i class="bi bi-plus-lg me-1"></i> Add Student
            </a>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="bg-body-tertiary">
                    <tr>
                        <th class="text-uppercase small text-body-secondary fw-semibold" style="width: 90px;">ID</th>
                        <th class="text-uppercase small text-body-secondary fw-semibold">Name</th>
                        <th class="text-uppercase small text-body-secondary fw-semibold">Email</th>
                        <th class="text-uppercase small text-body-secondary fw-semibold">Phone</th>
                        <th class="text-uppercase small text-body-secondary fw-semibold">Address</th>
                        <th class="text-uppercase small text-body-secondary fw-semibold text-end" style="width: 260px;">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($students as $student)
                        <tr>
                            <td>{{ $student->id }}</td>
                            <td class="fw-medium">{{ $student->name }}</td>
                            <td>{{ $student->email }}</td>
                            <td>{{ $student->phone_number ?? '—' }}</td>
                            <td>{{ $student->address ?? '—' }}</td>
                            <td class="text-end">
                                <a href="{{ route('students.show', $student->id) }}" class="btn btn-outline-secondary btn-sm rounded-3">
                                    <i class="bi bi-eye me-1"></i> View
                                </a>
                                <a href="{{ route('students.edit', $student->id) }}" class="btn btn-outline-primary btn-sm rounded-3">
                                    <i class="bi bi-pencil-square me-1"></i> Edit
                                </a>
                                <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm rounded-3" onclick="return confirm('Delete this student record?')">
                                        <i class="bi bi-trash me-1"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">No student records found.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection