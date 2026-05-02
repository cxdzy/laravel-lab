<!DOCTYPE html>
<html>
<head>
    <title>Day Details</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h2>Day Details</h2>

    <table class="table">
        <tr>
            <th>Day Name</th>
            <td>{{ $day->day_name }}</td>
        </tr>
    </table>

    <a href="{{ route('days.index') }}" class="btn btn-secondary">Back</a>
</div>

</body>
</html>