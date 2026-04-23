<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account | Modern UI</title>
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
            padding: 20px;
        }

        .register-card { 
            width: 100%;
            max-width: 450px; 
            padding: 40px; 
            background: rgba(255, 255, 255, 0.95); 
            border-radius: 20px; 
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        h2 { 
            margin: 0 0 10px 0; 
            color: #333; 
            font-weight: 600;
            font-size: 1.8rem;
        }

        p {
            color: #777;
            font-size: 0.95rem;
            margin-bottom: 30px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .input-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        input { 
            width: 100%; 
            padding: 12px 16px; 
            border: 1px solid #e1e1e1; 
            border-radius: 10px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            outline: none;
            background: #fdfdfd;
        }

        input:focus {
            border-color: #764ba2;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(118, 75, 162, 0.1);
        }

        button { 
            width: 100%; 
            padding: 14px; 
            margin-top: 10px;
            background: linear-gradient(to right, #667eea, #764ba2); 
            color: white; 
            border: none; 
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        button:hover { 
            transform: translateY(-1px);
            box-shadow: 0 5px 15px rgba(118, 75, 162, 0.3);
        }

        button:active {
            transform: translateY(0);
        }

        .footer-links {
            margin-top: 25px;
            font-size: 0.9rem;
            color: #666;
        }

        .footer-links a {
            color: #764ba2;
            text-decoration: none;
            font-weight: 600;
        }

        .footer-links a:hover {
            text-decoration: underline;
        }

        /* Mobile adjustment for the grid */
        @media (max-width: 480px) {
            .input-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

<div class="register-card">
    <h2>Join Us</h2>
    <p>Create your account in just a few seconds.</p>

    <form method="POST" action="/register">
        @csrf

        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email Address" required>

        <div class="input-row">
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="password_confirmation" placeholder="Confirm" required>
        </div>

        <div class="input-row">
            <input type="text" name="phone_number" placeholder="Phone Number">
            <input type="text" name="address" placeholder="Address">
        </div>

        <button type="submit">Create Account</button>
    </form>

    <div class="footer-links">
        Already have an account? <a href="/">Sign In</a>
    </div>
</div>

</body>
</html>