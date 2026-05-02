<!DOCTYPE html>
<html>
<head>
    <title>Edit Subject</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h2>Edit Subject</h2>

    <form action="{{ route('subjects.update', $subject->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Subject Code</label>
            <input type="text" name="subject_code" class="form-control" value="{{ $subject->subject_code }}">
        </div>

        <div class="form-group">
            <label>Subject Name</label>
            <input type="text" name="subject_name" class="form-control" value="{{ $subject->subject_name }}">
        </div>

        <div class="form-group">
            <label>Lecturer Name</label>
            <input type="text" name="lecturer_name" class="form-control" value="{{ $subject->lecturer_name }}">
        </div>

        <button class="btn btn-primary">Update</button>
    </form>
</div>

</body>
</html>