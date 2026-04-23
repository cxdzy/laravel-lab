<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Modern UI</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; }
        
        body { 
            font-family: 'Inter', sans-serif; 
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .login-card { 
            width: 100%;
            max-width: 400px; 
            padding: 40px; 
            background: rgba(255, 255, 255, 0.95); 
            border-radius: 16px; 
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        h2 { 
            margin-bottom: 8px; 
            color: #333; 
            font-weight: 600;
        }

        p {
            color: #777;
            font-size: 0.9rem;
            margin-bottom: 24px;
        }

        .error { 
            background: #ffe5e5;
            color: #d9534f; 
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
            font-size: 0.85rem;
            border: 1px solid #f5c6cb;
        }

        .input-group {
            text-align: left;
            margin-bottom: 15px;
        }

        input { 
            width: 100%; 
            padding: 12px 16px; 
            margin-top: 5px;
            border: 1px solid #ddd; 
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
            outline: none;
        }

        input:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        button { 
            width: 100%; 
            padding: 12px; 
            margin-top: 10px;
            background: #667eea; 
            color: white; 
            border: none; 
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover { 
            background: #5a67d8; 
        }

        .footer-links {
            margin-top: 20px;
            font-size: 0.85rem;
            color: #666;
        }

        .footer-links a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }

        .footer-links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="login-card">
    <h2>Welcome Back</h2>
    <p>Please enter your details to sign in.</p>

    @if(session('error'))
        <div class="error">{{ session('error') }}</div>
    @endif

    <form method="POST" action="/login">
        @csrf

        <div class="input-group">
            <input type="email" name="email" placeholder="Email Address" required>
        </div>

        <div class="input-group">
            <input type="password" name="password" placeholder="Password" required>
        </div>

        <button type="submit">Sign In</button>
    </form>

    <div class="footer-links">
        Don't have an account? <a href="/register">Create one</a>
    </div>
</div>

</body>
</html>