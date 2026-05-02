<!DOCTYPE html>
<html>
<head>
    <title>Edit Day</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h2>Edit Day</h2>

    <form action="{{ route('days.update', $day->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Day Name</label>
            <input type="text" name="day_name" class="form-control" value="{{ $day->day_name }}">
        </div>

        <button class="btn btn-primary">Update</button>
    </form>
</div>

</body>
</html>