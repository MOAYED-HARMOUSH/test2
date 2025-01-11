<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign In Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            display: flex;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            max-width: 800px;
        }

        .signin-content {
            display: flex;
            width: 100%;
        }

        .signin-content img {
            width: 50%;
            object-fit: cover;
        }

        .signin-form {
            width: 50%;
            padding: 30px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: inline-block;
            margin-bottom: 5px;
            color: #333;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-group input:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        .form-group .text-danger {
            color: red;
            font-size: 12px;
        }

        .form-button {
            margin-top: 20px;
        }

        .form-button input {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }

        .form-button input:hover {
            background-color: #0056b3;
        }

        .signup-image-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #007bff;
            text-decoration: none;
        }

        .signup-image-link:hover {
            text-decoration: underline;
        }

        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="signin-content">
            <img src="{{ asset('/images/authImages/sign-in.jpg') }}" alt="Sign in image">
            <div class="signin-form">
                <h2 class="form-title">Sign In</h2>

                <!-- General Error Alert -->
                @if (session('error'))
                    <div class="alert-danger">
                        <ul>
                            <li>{{ session('error') }}</li>
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('auth.login.submit') }}" id="login-form">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" value="{{ old('email') }}"
                            placeholder="Enter Your Email">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" placeholder="Enter Your Password">
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-button">
                        <input type="submit" name="signin" id="signin" value="Log in">
                    </div>
                </form>

            </div>
        </div>
    </div>

</body>

</html>
