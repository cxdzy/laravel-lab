<!DOCTYPE html>
<html>
<head>
    <title>Subjects</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h2>Subjects</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('subjects.create') }}" class="btn btn-success mb-3">Add Subject</a>

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Code</th>
            <th>Name</th>
            <th>Lecturer</th>
            <th>Action</th>
        </tr>

        @foreach($subjects as $subject)
        <tr>
            <td>{{ $subject->id }}</td>
            <td>{{ $subject->subject_code }}</td>
            <td>{{ $subject->subject_name }}</td>
            <td>{{ $subject->lecturer_name }}</td>
            <td>
                <a href="{{ route('subjects.show', $subject->id) }}" class="btn btn-info btn-sm">View</a>
                <a href="{{ route('subjects.edit', $subject->id) }}" class="btn btn-primary btn-sm">Edit</a>

                <form action="{{ route('subjects.destroy', $subject->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach

    </table>
</div>

</body>
</html>