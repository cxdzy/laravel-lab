<!DOCTYPE html>
<html>
<head>
    <title>Lecturer Groups</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h2>Lecturer Groups</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('lecturer-groups.create') }}" class="btn btn-success mb-3">Add Group</a>

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Part</th>
            <th>Action</th>
        </tr>

        @foreach($groups as $group)
        <tr>
            <td>{{ $group->id }}</td>
            <td>{{ $group->name }}</td>
            <td>{{ $group->part }}</td>
            <td>
                <a href="{{ route('lecturer-groups.show', $group->id) }}" class="btn btn-info btn-sm">View</a>
                <a href="{{ route('lecturer-groups.edit', $group->id) }}" class="btn btn-primary btn-sm">Edit</a>

                <form action="{{ route('lecturer-groups.destroy', $group->id) }}" method="POST" style="display:inline;">
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