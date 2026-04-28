<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<div class="container mt-4">
    <h2>Edit Student</h2>

    <form action="{{ route('students.update', $student->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control"
                   id="name" name="name"
                   value="{{ $student->name }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control"
                   id="email" name="email"
                   value="{{ $student->email }}" required>
        </div>

        <div class="form-group">
            <label for="phone_number">Phone Number</label>
            <input type="text" class="form-control"
                   id="phone_number" name="phone_number"
                   value="{{ $student->phone_number }}">
        </div>

        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control"
                   id="address" name="address"
                   value="{{ $student->address }}">
        </div>

        <button type="submit" class="btn btn-primary">
            Update
        </button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>