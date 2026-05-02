<!DOCTYPE html>
<html>
<head>
    <title>Halls</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h2>Halls</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('halls.create') }}" class="btn btn-success mb-3">Add Hall</a>

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Place</th>
            <th>Action</th>
        </tr>

        @foreach($halls as $hall)
        <tr>
            <td>{{ $hall->id }}</td>
            <td>{{ $hall->lecture_hall_name }}</td>
            <td>{{ $hall->lecture_hall_place }}</td>
            <td>
                <a href="{{ route('halls.show', $hall->id) }}" class="btn btn-info btn-sm">View</a>
                <a href="{{ route('halls.edit', $hall->id) }}" class="btn btn-primary btn-sm">Edit</a>

                <form action="{{ route('halls.destroy', $hall->id) }}" method="POST" style="display:inline;">
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