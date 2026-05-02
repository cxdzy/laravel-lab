<!DOCTYPE html>
<html>
<head>
    <title>Timetables</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h2>Timetables</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <a href="{{ route('timetables.create') }}" class="btn btn-success mb-3">Create Timetable</a>

    <table class="table table-bordered">
        <tr>
            <th>User</th>
            <th>Subject</th>
            <th>Day</th>
            <th>Hall</th>
            <th>Group</th>
            <th>Time From</th>
            <th>Time To</th>
            <th>Action</th>
        </tr>

        @forelse($timetables as $t)
        <tr>
            <td>{{ optional($t->user)->name }}</td>
            <td>{{ optional($t->subject)->subject_name }}</td>
            <td>{{ optional($t->day)->day_name }}</td>
            <td>{{ optional($t->hall)->lecture_hall_name }}</td>
            <td>{{ optional($t->lecturerGroup)->name }}</td>
            <td>{{ $t->time_from }}</td>
            <td>{{ $t->time_to }}</td>
            <td>
                <a href="{{ route('timetables.show', $t->id) }}" class="btn btn-info btn-sm">View</a>
                <a href="{{ route('timetables.edit', $t->id) }}" class="btn btn-primary btn-sm">Edit</a>
                <form action="{{ route('timetables.destroy', $t->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="8" class="text-center">No timetables found.</td>
        </tr>
        @endforelse
    </table>
</div>

</body>
</html>