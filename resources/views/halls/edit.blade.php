<!DOCTYPE html>
<html>
<head>
    <title>Edit Hall</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h2>Edit Hall</h2>

    <form action="{{ route('halls.update', $hall->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Hall Name</label>
            <input type="text" name="lecture_hall_name" class="form-control" value="{{ $hall->lecture_hall_name }}">
        </div>

        <div class="form-group">
            <label>Hall Place</label>
            <input type="text" name="lecture_hall_place" class="form-control" value="{{ $hall->lecture_hall_place }}">
        </div>

        <button class="btn btn-primary">Update</button>
    </form>
</div>

</body>
</html>