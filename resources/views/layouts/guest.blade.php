<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 flex items-center justify-center w-screen min-h-screen bg-gray-100">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', system-ui, sans-serif;
        }

        :root {
            --primary-color: #ff4757;
            --secondary-color: #ffa502;
            --dark-color: #2f3542;
            --light-bg: #f1f2f6;
            --text-muted: #6b7280;
            --border-color: #e5e7eb;
            --danger: #dc2626;
        }

        .auth-card {
            width: 540px;
            background: #fff;
            padding: 40px 30px;
            border-radius: 16px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, .08);
            border-top: 6px solid var(--secondary-color);
        }

        @media (max-width: 540px) {
            .auth-card {
                width: 80vw;
            }
        }

        .brand {
            text-align: center;
            font-size: 28px;
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
            color: var(--text-muted);
            margin-bottom: 30px;
        }

        .title,
        h2 {
            font-size: 22px;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 22px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 600;
            color: #57606f;
        }

        .form-group input {
            width: 100%;
            padding: 12px 16px;
            font-size: 15px;
            border: 2px solid var(--border-color);
            border-radius: 8px;
            outline: none;
            transition: .3s;
        }

        .form-group input:focus {
            border-color: var(--secondary-color);
        }

        .options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 10px 0 25px;
            font-size: 14px;
        }

        .forgot {
            color: var(--text-muted);
            text-decoration: none;
        }

        .forgot:hover {
            color: var(--secondary-color);
        }

        .login-btn,
        .btn-submit {
            width: 100%;
            padding: 14px;
            background: var(--secondary-color);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: .3s;
        }

        .login-btn:hover,
        .btn-submit:hover {
            opacity: .9;
        }

        .register-text,
        .switch-prompt {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: var(--text-muted);
        }

        .register-text a,
        .switch-prompt a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 700;
        }

        .register-text a:hover,
        .switch-prompt a:hover {
            text-decoration: underline;
        }

        .text-red-500,
        .text-red-600 {
            color: var(--danger);
            font-size: 13px;
            margin-top: 6px;
        }
    </style>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 ">

        <div class="w-full mt-6 shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
