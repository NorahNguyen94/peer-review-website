<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Login</title>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .login-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .login-title {
            margin-bottom: 20px;
            text-align: center;
            font-size: 30px
        }

        .form-group {
            padding-bottom: 10px
        }

        label {
            padding-bottom: 5px;
            font-weight: 500;
        }

        .button {
            display: flex;
            justify-content: center;
        }

        .btn {
            width: 100px;
            color: white;
            margin-top: 15px;
            margin-right: 15px;
        }

        .login-button {
            background-color: steelblue;
        }

        .error {
            color: red;
            font-weight: 700;
            font-style: italic;
        }
    </style>
</head>

<body>

    <div class="login-container">
        <h2 class="login-title">Sign Up</h2>
        <form action="{{ url('/register') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="sNumber">sNumber (s-6 digits)</label>
                <input type="text" class="form-control" id="sNumber" name="sNumber">
                @if ($errors->has('sNumber'))
                    <div class="error">
                        <p>{{ $errors->first('sNumber') }}</p>
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name">
                @if ($errors->has('name'))
                    <div class="error">
                        <p>{{ $errors->first('name') }}</p>
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="sNumber">Email</label>
                <input type="email" class="form-control" id="email" name="email">
                @if ($errors->has('email'))
                    <div class="error">
                        <p>{{ $errors->first('email') }}</p>
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password">
                @if ($errors->has('password'))
                    <div class="error">
                        <p>{{ $errors->first('password') }}</p>
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                @if ($errors->has('password_confirmation'))
                    <div class="error">
                        <p>{{ $errors->first('password_confirmation') }}</p>
                    </div>
                @endif
            </div>

            <div class="button">
                <button type="submit" class="btn login-button btn-block">Sign Up</button>
                <a href="/login" class="btn btn-secondary btn-block">Cancel</a>
            </div>
        </form>
    </div>
</body>

</html>
