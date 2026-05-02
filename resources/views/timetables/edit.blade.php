<!DOCTYPE html>
<html>
<head>
	<title>Edit Timetable</title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
	<h2>Edit Timetable</h2>

	@if ($errors->any())
		<div class="alert alert-danger">
			<ul class="mb-0">
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif

	<form action="{{ route('timetables.update', $timetable->id) }}" method="POST">
		@csrf
		@method('PUT')

		<div class="form-group">
			<label for="user_id">User</label>
			<select name="user_id" id="user_id" class="form-control" required>
				<option value="" disabled>Select user</option>
				@foreach($users as $user)
					<option value="{{ $user->id }}" @selected(old('user_id', $timetable->user_id) == $user->id)>{{ $user->name }}</option>
				@endforeach
			</select>
		</div>

		<div class="form-group">
			<label for="subject_id">Subject</label>
			<select name="subject_id" id="subject_id" class="form-control" required>
				<option value="" disabled>Select subject</option>
				@foreach($subjects as $subject)
					<option value="{{ $subject->id }}" @selected(old('subject_id', $timetable->subject_id) == $subject->id)>{{ $subject->subject_name }}</option>
				@endforeach
			</select>
		</div>

		<div class="form-group">
			<label for="day_id">Day</label>
			<select name="day_id" id="day_id" class="form-control" required>
				<option value="" disabled>Select day</option>
				@foreach($days as $day)
					<option value="{{ $day->id }}" @selected(old('day_id', $timetable->day_id) == $day->id)>{{ $day->day_name }}</option>
				@endforeach
			</select>
		</div>

		<div class="form-group">
			<label for="hall_id">Hall</label>
			<select name="hall_id" id="hall_id" class="form-control" required>
				<option value="" disabled>Select hall</option>
				@foreach($halls as $hall)
					<option value="{{ $hall->id }}" @selected(old('hall_id', $timetable->hall_id) == $hall->id)>{{ $hall->lecture_hall_name }}</option>
				@endforeach
			</select>
		</div>

		<div class="form-group">
			<label for="lecturer_group_id">Group</label>
			<select name="lecturer_group_id" id="lecturer_group_id" class="form-control" required>
				<option value="" disabled>Select group</option>
				@foreach($groups as $group)
					<option value="{{ $group->id }}" @selected(old('lecturer_group_id', $timetable->lecturer_group_id) == $group->id)>{{ $group->name }}</option>
				@endforeach
			</select>
		</div>

		<div class="form-row">
			<div class="form-group col-md-6">
				<label for="time_from">Start time</label>
				<input type="time" name="time_from" id="time_from" class="form-control" value="{{ old('time_from', $timetable->time_from) }}">
			</div>
			<div class="form-group col-md-6">
				<label for="time_to">End time</label>
				<input type="time" name="time_to" id="time_to" class="form-control" value="{{ old('time_to', $timetable->time_to) }}">
			</div>
		</div>

		<button class="btn btn-primary">Update</button>
		<a href="{{ route('timetables.index') }}" class="btn btn-secondary">Cancel</a>
	</form>
</div>

</body>
</html>
