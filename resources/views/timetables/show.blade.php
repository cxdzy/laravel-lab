<!DOCTYPE html>
<html>
<head>
	<title>Timetable Details</title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
	<h2>Timetable Details</h2>

	<table class="table table-bordered">
		<tr>
			<th>User</th>
			<td>{{ optional($timetable->user)->name }}</td>
		</tr>
		<tr>
			<th>Subject</th>
			<td>{{ optional($timetable->subject)->subject_name }}</td>
		</tr>
		<tr>
			<th>Day</th>
			<td>{{ optional($timetable->day)->day_name }}</td>
		</tr>
		<tr>
			<th>Hall</th>
			<td>{{ optional($timetable->hall)->lecture_hall_name }}</td>
		</tr>
		<tr>
			<th>Group</th>
			<td>{{ optional($timetable->lecturerGroup)->name }}</td>
		</tr>
		<tr>
			<th>Time From</th>
			<td>{{ $timetable->time_from }}</td>
		</tr>
		<tr>
			<th>Time To</th>
			<td>{{ $timetable->time_to }}</td>
		</tr>
	</table>

	<a href="{{ route('timetables.edit', $timetable->id) }}" class="btn btn-primary">Edit</a>
	<a href="{{ route('timetables.index') }}" class="btn btn-secondary">Back</a>
</div>

</body>
</html>
