<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <title>Sign In Page</title>
    <style>
        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
           position: relative;
            bottom: 20px;
           padding: 1px;
            border-radius: 50px;
        }
        .text-danger{
            color: red;
        }
        .links {
            text-align: center;
            margin-top: 20px;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUa1zuw3y1hVR0sA0F2iEc9LrBvBuQf0GIO6As6MAh5zo4v5zvg6uRRR1iBh" crossorigin="anonymous">

    <!-- Font Icon -->
    <link rel="stylesheet" href="{{asset('fonts/material-icon/css/material-design-iconic-font.min.css')}}">

    <!-- Main css -->
    <link rel="stylesheet" href="{{asset('css/auth.css')}}">


</head>
<body>

<div class="main">


    <!-- Sing in  Form -->
    <section class="sign-in">
        <div class="container">
            <div class="signin-content">
                <div >
                    <img src="{{asset('/images/authImages/sign-in.jpg')}}" alt="sing up image" style="height: 400px ; width: 800px ;position: relative ; left: 50px">
                    <a href="{{ route('auth.signup.form') }}" class="signup-image-link" style="position: relative; left: 50px">Create an account</a>
                    <div class="links">
                        <p>Forgot Password? <a href="{{ route('auth.password.request') }}">Reset Password</a></p>
    </div>

                </div>
                
                <div class="signin-form">

                    <h2 class="form-title" style="position: relative ; left: 60px">Sign In</h2>
                    <!-- General Error Alert -->
                    @if (session('error'))
                        <div class="alert alert-danger">
                            <ul>
                                <li>{{ session('error') }}</li>
                            </ul>
                        </div>
                    @endif
                                        <form method="POST" action="{{ route('auth.login.submit') }}" id="login-form">
                                            @csrf
                        <div class="form-group">
                            <label for="emailOrPhone"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="text" name="emailOrPhone" id="emailOrPhone"
                                   value="{{ old('emailOrPhone') }}"
                                   placeholder="Enter Your email or phone"/>
{{-- @error('email') --}}
                            {{-- <span class="text-danger">{{ $message }}</span>
@enderror --}}
                        </div>
                        <div class="form-group">
                            <label for="password"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="password" id="password" placeholder="Enter your password"/>
                            @error('password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <a href="{{ route('google.login') }}" class="btn btn-primary">Login with Google</a>

                        <div class="form-group">
                            <input type="checkbox" name="remember" id="remember-me" class="agree-term" />
                            <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember me</label>
                        </div>
                        <div class="form-group form-button">
                            <input type="submit" name="signin" id="signin" class="form-submit"
                                   style="position: relative; left: 75px"
                                   value="Log in"/>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </section>

</div>


<!-- JS -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="{{asset('js/layouts.js')}}"></script>


</body>
</html>
