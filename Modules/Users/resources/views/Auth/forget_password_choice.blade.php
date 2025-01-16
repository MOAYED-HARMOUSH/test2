<!-- resources/views/auth/forget_password_choice.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        h1 {
            text-align: center;
            color: #2196F3; /* Blue color */
            margin-bottom: 20px;
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
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
        }

        input[type="email"]:focus,
        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #2196F3; /* Blue color */
            outline: none;
        }

        button {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            background-color: #2196F3; /* Blue color */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #1e88e5; /* Darker blue on hover */
        }

        .links {
            text-align: center;
            margin-top: 20px;
        }

        .links a {
            color: #2196F3; /* Blue color */
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
        <h1>Forgot Password</h1>
        @if (session('error'))
            <div style="background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('password.email') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>
                    <input type="radio" name="reset_method" value="email" checked>
                    Reset via Email
                </label>
            </div>
            <div class="form-group">
                <label>
                    <input type="radio" name="reset_method" value="mobile">
                    Reset via Mobile
                </label>
            </div>
            <div id="inputField" class="form-group">
                @if (old('reset_method') == 'mobile')
                    <input type="text" name="mobile" placeholder="Mobile Number">
                @else
                    <input type="email" name="email" placeholder="Email">
                @endif
            </div>
            <button type="submit">Proceed</button>
        </form>

        <div class="links">
            <p>Back to Login? <a href="{{ route('auth.login.form') }}">Login</a></p>
        </div>
    </div>

    <script>
        document.querySelectorAll('input[type="radio"]').forEach(radio => {
            radio.addEventListener('change', function() {
                const method = this.value;
                const inputField = document.getElementById('inputField');
                inputField.innerHTML = method === 'mobile' 
                    ? '<input type="text" name="mobile" placeholder="Mobile Number" class="form-control">'
                    : '<input type="email" name="email" placeholder="Email" class="form-control">';
            });
        });
    </script>
</body>
</html>