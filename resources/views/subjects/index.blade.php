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
                            <td class="fw-medium">
                                {{ $subject->subject_name }}
                                @if ($subject->timetables_count > 0)
                                    <span class="badge text-bg-warning ms-2">{{ $subject->timetables_count }} timetable</span>
                                @endif
                            </td>
                            <td>{{ $subject->lecturer_name }}</td>
                            <td class="text-end">
                                <a href="{{ route('subjects.show', $subject->id) }}" class="btn btn-outline-secondary btn-sm rounded-3">
                                    <i class="bi bi-eye me-1"></i> View
                                </a>
                                <a href="{{ route('subjects.edit', $subject->id) }}" class="btn btn-outline-primary btn-sm rounded-3">
                                    <i class="bi bi-pencil-square me-1"></i> Edit
                                </a>
                                <form action="{{ route('subjects.destroy', $subject->id) }}" method="POST" class="d-inline" id="delete-subject-{{ $subject->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="button"
                                        class="btn btn-outline-danger btn-sm rounded-3"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteSubjectModal"
                                        data-subject-name="{{ $subject->subject_name }}"
                                        data-subject-code="{{ $subject->subject_code }}"
                                        data-timetable-count="{{ $subject->timetables_count }}"
                                        data-form-id="delete-subject-{{ $subject->id }}"
                                    >
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

    <div class="modal fade" id="deleteSubjectModal" tabindex="-1" aria-labelledby="deleteSubjectModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteSubjectModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="fw-semibold" id="deleteSubjectName">This subject</div>
                    <div class="text-body-secondary" id="deleteSubjectImpact">Deleting this subject will affect related timetables.</div>
                    <div class="mt-3">
                        <label for="deleteSubjectConfirm" class="form-label">Type the subject code to confirm</label>
                        <input type="text" class="form-control" id="deleteSubjectConfirm" placeholder="e.g., TMC501">
                        <div class="form-text">This action cannot be undone.</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary rounded-3" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger rounded-3" id="confirmDeleteSubject" disabled>
                        <i class="bi bi-trash me-1"></i> Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        (() => {
            const modal = document.getElementById('deleteSubjectModal');
            const nameEl = document.getElementById('deleteSubjectName');
            const impactEl = document.getElementById('deleteSubjectImpact');
            const confirmBtn = document.getElementById('confirmDeleteSubject');
            const confirmInput = document.getElementById('deleteSubjectConfirm');

            if (!modal || !confirmBtn || !confirmInput) return;

            modal.addEventListener('show.bs.modal', (event) => {
                const trigger = event.relatedTarget;
                if (!trigger) return;

                const subjectName = trigger.getAttribute('data-subject-name') || 'this subject';
                const subjectCode = trigger.getAttribute('data-subject-code') || '';
                const count = Number(trigger.getAttribute('data-timetable-count') || 0);
                const formId = trigger.getAttribute('data-form-id');

                nameEl.textContent = subjectName;
                impactEl.textContent = count > 0
                    ? `Deleting this subject will affect ${count} timetable ${count === 1 ? 'entry' : 'entries'}.`
                    : 'Deleting this subject will not affect any timetables.';

                confirmInput.value = '';
                confirmInput.placeholder = subjectCode ? `e.g., ${subjectCode}` : 'Subject code';
                confirmBtn.disabled = true;

                const enableIfMatch = () => {
                    confirmBtn.disabled = confirmInput.value.trim().toLowerCase() !== subjectCode.toLowerCase();
                };

                confirmInput.oninput = enableIfMatch;
                enableIfMatch();

                confirmBtn.onclick = () => {
                    const form = document.getElementById(formId);
                    if (form) form.submit();
                };
            });
        })();
    </script>
@endpush