@extends('layout.template')

@section('title', 'Edit Timetable')

@section('page_title', 'Edit Timetable')

@push('styles')
    <style>
        .mm-input:focus {
            border-color: #6366f1;
            box-shadow: 0 0 0 0.2rem rgba(99, 102, 241, 0.25);
        }
    </style>
@endpush

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger border-0 rounded-3 shadow-sm">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-3">
        <form action="{{ route('timetables.update', $timetable->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-12">
                        <label for="user_id" class="form-label text-uppercase small text-body-secondary fw-semibold">User / Lecturer</label>
                        <select name="user_id" id="user_id" class="form-select rounded-3 mm-input" required>
                            <option value="" disabled>Select a user</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" @selected(old('user_id', $timetable->user_id) == $user->id)>{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="subject_id" class="form-label text-uppercase small text-body-secondary fw-semibold">Subject</label>
                        <select name="subject_id" id="subject_id" class="form-select rounded-3 mm-input" required>
                            <option value="" disabled>Select subject</option>
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}" @selected(old('subject_id', $timetable->subject_id) == $subject->id)>{{ $subject->subject_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="day_id" class="form-label text-uppercase small text-body-secondary fw-semibold">Day of Week</label>
                        <select name="day_id" id="day_id" class="form-select rounded-3 mm-input" required>
                            <option value="" disabled>Select day</option>
                            @foreach ($days as $day)
                                <option value="{{ $day->id }}" @selected(old('day_id', $timetable->day_id) == $day->id)>{{ $day->day_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="hall_id" class="form-label text-uppercase small text-body-secondary fw-semibold">Lecture Hall</label>
                        <select name="hall_id" id="hall_id" class="form-select rounded-3 mm-input" required>
                            <option value="" disabled>Select hall</option>
                            @foreach ($halls as $hall)
                                <option value="{{ $hall->id }}" @selected(old('hall_id', $timetable->hall_id) == $hall->id)>{{ $hall->lecture_hall_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="lecturer_group_id" class="form-label text-uppercase small text-body-secondary fw-semibold">Lecturer Group</label>
                        <select name="lecturer_group_id" id="lecturer_group_id" class="form-select rounded-3 mm-input" required>
                            <option value="" disabled>Select group</option>
                            @foreach ($groups as $group)
                                <option value="{{ $group->id }}" @selected(old('lecturer_group_id', $timetable->lecturer_group_id) == $group->id)>{{ $group->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="time_from" class="form-label text-uppercase small text-body-secondary fw-semibold">Start Time</label>
                        <input type="time" name="time_from" id="time_from" class="form-control rounded-3 mm-input" value="{{ old('time_from', $timetable->time_from) }}">
                    </div>
                    <div class="col-md-6">
                        <label for="time_to" class="form-label text-uppercase small text-body-secondary fw-semibold">End Time</label>
                        <input type="time" name="time_to" id="time_to" class="form-control rounded-3 mm-input" value="{{ old('time_to', $timetable->time_to) }}">
                    </div>
                </div>
            </div>
            <div class="card-footer bg-transparent border-0 d-flex justify-content-end gap-2">
                <a href="{{ route('timetables.index') }}" class="btn btn-outline-secondary rounded-3">Cancel</a>
                <button type="submit" class="btn btn-primary rounded-3">
                    <i class="bi bi-save2 me-1"></i> Update
                </button>
            </div>
        </form>
    </div>
@endsection