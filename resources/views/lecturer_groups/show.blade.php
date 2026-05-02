<!DOCTYPE html>
<html>
<head>
    <title>Group Details</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h2>Lecturer Group Details</h2>

    <table class="table">
        <tr><th>Name</th><td>{{ $lecturer_group->name }}</td></tr>
        <tr><th>Part</th><td>{{ $lecturer_group->part }}</td></tr>
    </table>

    <a href="{{ route('lecturer-groups.index') }}" class="btn btn-secondary">Back</a>
</div>

</body>
</html>