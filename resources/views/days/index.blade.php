<!DOCTYPE html>
<html>
<head>
    <title>Days</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h2>Days</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('days.create') }}" class="btn btn-success mb-3">Add Day</a>

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Day Name</th>
            <th>Action</th>
        </tr>

        @foreach($days as $day)
        <tr>
            <td>{{ $day->id }}</td>
            <td>{{ $day->day_name }}</td>
            <td>
                <a href="{{ route('days.show', $day->id) }}" class="btn btn-info btn-sm">View</a>
                <a href="{{ route('days.edit', $day->id) }}" class="btn btn-primary btn-sm">Edit</a>

                <form action="{{ route('days.destroy', $day->id) }}" method="POST" style="display:inline;">
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