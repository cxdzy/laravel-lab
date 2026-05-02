<!DOCTYPE html>
<html>
<head>
    <title>Create Subject</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h2>Create Subject</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('subjects.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Subject Code</label>
            <input type="text" name="subject_code" class="form-control">
        </div>

        <div class="form-group">
            <label>Subject Name</label>
            <input type="text" name="subject_name" class="form-control">
        </div>

        <div class="form-group">
            <label>Lecturer Name</label>
            <input type="text" name="lecturer_name" class="form-control">
        </div>

        <button class="btn btn-success">Save</button>
    </form>
</div>

</body>
</html>