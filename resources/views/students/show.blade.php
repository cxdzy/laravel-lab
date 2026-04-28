<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<div class="container mt-4">
    <h2>Student Details</h2>

    <table class="table">
        <tr>
            <th>Name</th>
            <td>{{ $student->name }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $student->email }}</td>
        </tr>
        <tr>
            <th>Phone Number</th>
            <td>{{ $student->phone_number }}</td>
        </tr>
        <tr>
            <th>Address</th>
            <td>{{ $student->address }}</td>
        </tr>
    </table>

    <a href="{{ route('students.edit', $student->id) }}" class="btn btn-primary">
        Edit
    </a>

    <a href="{{ route('students.index') }}" class="btn btn-secondary">
        Back to List
    </a>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>