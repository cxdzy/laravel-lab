<!DOCTYPE html>
<html>
<head>
    <title>Edit Group</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h2>Edit Lecturer Group</h2>

    <form action="{{ route('lecturer-groups.update', $lecturer_group->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Group Name</label>
            <input type="text" name="name" class="form-control" value="{{ $lecturer_group->name }}">
        </div>

        <div class="form-group">
            <label>Part</label>
            <input type="text" name="part" class="form-control" value="{{ $lecturer_group->part }}">
        </div>

        <button class="btn btn-primary">Update</button>
    </form>
</div>

</body>
</html>