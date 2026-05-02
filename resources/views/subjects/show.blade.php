<!DOCTYPE html>
<html>
<head>
    <title>Subject Details</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h2>Subject Details</h2>

    <table class="table">
        <tr><th>Code</th><td>{{ $subject->subject_code }}</td></tr>
        <tr><th>Name</th><td>{{ $subject->subject_name }}</td></tr>
        <tr><th>Lecturer</th><td>{{ $subject->lecturer_name }}</td></tr>
    </table>

    <a href="{{ route('subjects.index') }}" class="btn btn-secondary">Back</a>
</div>

</body>
</html>