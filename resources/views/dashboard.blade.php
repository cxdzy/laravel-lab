<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Inter', sans-serif; 
            background-color: #f8fafc;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            text-align: center;
            background: white;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            border: 1px solid #eef2f7;
            max-width: 400px;
            width: 90%;
        }

        h2 { color: #1e293b; margin-bottom: 10px; }
        p { color: #64748b; margin-bottom: 30px; }

        button { 
            background: #f1f5f9;
            color: #475569;
            border: none;
            padding: 10px 24px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }

        button:hover {
            background: #e2e8f0;
            color: #d9534f;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Dashboard</h2>
    <p>You are now logged into your account. 🎉</p>

    <form method="POST" action="/logout">
        @csrf
        <button type="submit">Logout</button>
    </form>
</div>

</body>
</html>