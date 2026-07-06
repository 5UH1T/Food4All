<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | Food For All</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', system-ui, sans-serif;
        }

        :root {
            --primary-color: #ff4757; /* Food Red */
            --secondary-color: #ffa502; /* Golden Orange */
            --dark-color: #2f3542;
            --light-bg: #f1f2f6;
        }

        body {
            background: linear-gradient(135deg, #f1f2f6 0%, #dfe4ea 100%);
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
            box-shadow: 0 15px 35px rgba(0,0,0,0.08);
            border-top: 6px solid var(--secondary-color);
        }

        .brand {
            text-align: center;
            font-size: 26px;
            font-weight: 800;
            color: var(--primary-color);
            margin-bottom: 5px;
        }

        .brand span {
            color: var(--secondary-color);
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
            border-color: var(--secondary-color);
        }

        .btn-submit {
            width: 100%;
            padding: 14px;
            background-color: var(--secondary-color);
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: opacity 0.2s;
            margin-top: 10px;
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
        <div class="brand">Food<span>ForAll</span></div>
        <div class="tagline">Join our Restaurant.</div>

        <h2>Create Account</h2>
        
        <form onsubmit="event.preventDefault(); alert('Account registered successfully!');">
            <div class="form-group">
                <label for="fullname">Full Name</label>
                <input type="text" id="fullname" placeholder="Your Name" required>
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" placeholder="you@mail.com" required>
            </div>

            <div class="form-group">
                <label for="password">Create Password</label>
                <input type="password" id="password" placeholder="Minimum 8 characters" minlength="8" required>
            </div>

            
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" id="password_confirmation" placeholder="Repeat your password" minlength="8" required>
            </div>

            <button type="submit" class="btn-submit">Register Now</button>

            <div class="switch-prompt">
                Already have an account? <a href="login.html">Log In here</a>
            </div>
        </form>
    </div>

</body>
</html>
