<!DOCTYPE html>
<html>
<head>
    <title>Create Hall</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h2>Create Hall</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('halls.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Hall Name</label>
            <input type="text" name="lecture_hall_name" class="form-control">
        </div>

        <div class="form-group">
            <label>Hall Place</label>
            <input type="text" name="lecture_hall_place" class="form-control">
        </div>

        <button class="btn btn-success">Save</button>
    </form>
</div>

</body>
</html>