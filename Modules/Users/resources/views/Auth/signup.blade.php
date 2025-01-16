<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Optional for styling -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
            background-image: url('https://via.placeholder.com/1920');
            background-size: cover;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        h1 {
            text-align: center;
            color: #4c5baf;
            margin-bottom: 20px;
        }

        .alert {
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 5px;
            font-size: 16px;
        }

        .alert ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .alert-success {
            background-color: #e3f2fd;
    border-color: #b3e5fc;
    color: #004d40;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-size: 14px;
            color: #333;
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        input[type="email"],
        input[type="password"],
        input[type="text"],
        input[type="phone"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
        }

        input[type="email"]:focus,
        input[type="password"]:focus,
        input[type="text"]:focus,
        input[type="phone"]:focus {
            border-color: #4CAF50;
            outline: none;
        }

        button {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            background-color: #2196F3;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #1e88e5;
        }

        .name-group {
            display: flex;
            gap: 10px;
        }

        .name-group .form-group {
            flex: 1;
        }

        .links {
            text-align: center;
            margin-top: 20px;
        }

        .links a {
            color: #2196F3;
            text-decoration: none;
            font-size: 14px;
        }

        .links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Sign Up</h1>
        @if (session('error'))
            <div class="alert alert-danger">
                <ul>
                    <li>{{ session('error') }}</li>
                </ul>
            </div>
        @endif

        <!-- Display success message -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Display validation errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('auth.signup.submit') }}" method="POST">
            @csrf

            <!-- Name fields side by side -->
            <div class="name-group">
                <div class="form-group">
                    <label for="fName">First Name:</label>
                    <input type="text" id="fName" name="fName" required>
                </div>
                <div class="form-group">
                    <label for="lName">Last Name:</label>
                    <input type="text" id="lName" name="lName" required>
                </div>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="country">Country:</label>
                <input type="text" id="country" name="country" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="phone" id="phone" name="phone" required>
            </div>

            <button type="submit">Sign Up</button>

            <div class="links">
                <p>Already have an account? <a href="{{ route('auth.login.form') }}">Login</a></p>
            </div>
        </form>
    </div>
</body>
</html>