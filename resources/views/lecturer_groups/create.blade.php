<!DOCTYPE html>
<html>
<head>
    <title>Create Group</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h2>Create Lecturer Group</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('lecturer-groups.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Group Name</label>
            <input type="text" name="name" class="form-control">
        </div>

        <div class="form-group">
            <label>Part</label>
            <input type="text" name="part" class="form-control">
        </div>

        <button class="btn btn-success">Save</button>
    </form>
</div>

</body>
</html>