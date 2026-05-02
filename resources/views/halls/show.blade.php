<!DOCTYPE html>
<html>
<head>
    <title>Hall Details</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h2>Hall Details</h2>

    <table class="table">
        <tr><th>Name</th><td>{{ $hall->lecture_hall_name }}</td></tr>
        <tr><th>Place</th><td>{{ $hall->lecture_hall_place }}</td></tr>
    </table>

    <a href="{{ route('halls.index') }}" class="btn btn-secondary">Back</a>
</div>

</body>
</html>