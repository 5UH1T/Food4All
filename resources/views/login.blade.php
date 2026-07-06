<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LogIn</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', system-ui, sans-serif;
        }

        :root {
            --primary-color: #ffa502;
            --secondary-color: #ffa502;
            --dark-color: #2f3542;
            --light-bg: #f1f2f6;
        }

        body {
            
            background-size: cover;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .auth-card {
            background-color: #ffffff;
            width: 100%;
            max-width: 400px;
            padding: 40px 30px;
            border-radius: 16px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.15);
            border-top: 6px solid var(--primary-color);
        }

        .brand {
            text-align: center;
            font-size: 26px;
            font-weight: 800;
            color: var(--primary-color);
            margin-bottom: 5px;
        }

        .tagline {
            text-align: center;
            font-size: 13px;
            color: #747d8c;
            margin-bottom: 30px;
        }

        h2 {
            font-size: 22px;
            color: var(--dark-color);
            margin-bottom: 20px;
            font-weight: 700;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #57606f;
            margin-bottom: 8px;
        }

        .form-group input {
            width: 100%;
            padding: 12px 16px;
            font-size: 15px;
            border: 2px solid #e4e7eb;
            border-radius: 8px;
            outline: none;
            transition: border-color 0.2s;
        }

        .form-group input:focus {
            border-color: var(--primary-color);
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            font-size: 13px;
            color: #747d8c;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
        }

        .forgot-link {
            color: #747d8c;
            text-decoration: none;
        }

        .forgot-link:hover {
            color: var(--primary-color);
        }

        .btn-submit {
            width: 100%;
            padding: 14px;
            background-color: var(--primary-color);
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: opacity 0.2s;
        }

        .btn-submit:hover {
            opacity: 0.9;
        }

        .switch-prompt {
            text-align: center;
            margin-top: 25px;
            font-size: 14px;
            color: #747d8c;
        }

        .switch-prompt a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 700;
        }

        .switch-prompt a:hover {
            text-decoration: underline;
        }
    </style>

</head>
<body>

    <div class="auth-card">
        <div class="brand">FoodForAll</div>
        <div class="tagline">Click to Share, serve to care.</div>
        
        <h2>Welcome Back</h2>
        
        <form onsubmit="event.preventDefault(); alert('Logged in successfully!');">
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" placeholder="you@mail.com" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" placeholder="" required>
            </div>

            <div class="form-options">
                <label class="remember-me">
                    <input type="checkbox" id="remember" name="remember">
                    Remember Me
                </label>
                <a href="#" class="forgot-link">Forgot Password?</a>
            </div>

            <button type="submit" class="btn-submit">Sign In</button>

            <div class="switch-prompt">
                Don't Have an Account? <a href="signup.html">Create an account</a>
            </div>
        </form>
    </div>

</body>
</html>