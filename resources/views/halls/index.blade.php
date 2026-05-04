@extends('layout.template')

@section('title', 'Halls')

@section('page_title', 'Halls')

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
                <div class="fw-semibold">Halls</div>
            </div>
            <a href="{{ route('halls.create') }}" class="btn btn-primary btn-sm rounded-3">
                <i class="bi bi-plus-lg me-1"></i> Add Hall
            </a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="bg-body-tertiary">
                    <tr>
                        <th class="text-uppercase small text-body-secondary fw-semibold" style="width: 90px;">ID</th>
                        <th class="text-uppercase small text-body-secondary fw-semibold">Name</th>
                        <th class="text-uppercase small text-body-secondary fw-semibold">Place</th>
                        <th class="text-uppercase small text-body-secondary fw-semibold text-end" style="width: 260px;">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($halls as $hall)
                        <tr>
                            <td>{{ $hall->id }}</td>
                            <td class="fw-medium">{{ $hall->lecture_hall_name }}</td>
                            <td>{{ $hall->lecture_hall_place }}</td>
                            <td class="text-end">
                                <a href="{{ route('halls.show', $hall->id) }}" class="btn btn-outline-secondary btn-sm rounded-3">
                                    <i class="bi bi-eye me-1"></i> View
                                </a>
                                <a href="{{ route('halls.edit', $hall->id) }}" class="btn btn-outline-primary btn-sm rounded-3">
                                    <i class="bi bi-pencil-square me-1"></i> Edit
                                </a>
                                <form action="{{ route('halls.destroy', $hall->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm rounded-3" onclick="return confirm('Delete this hall?')">
                                        <i class="bi bi-trash me-1"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">No halls found.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection