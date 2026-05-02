<!DOCTYPE html>
<html>
<head>
    <title>Create Day</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h2>Create Day</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('days.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Day Name</label>
            <input type="text" name="day_name" class="form-control">
        </div>

        <button class="btn btn-success">Save</button>
    </form>
</div>

</body>
</html>