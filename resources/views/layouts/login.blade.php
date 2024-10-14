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
            margin: 100px auto;
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

        .btn {
            background-color: steelblue;
            width: 100px;
            color: white;
            margin-left: 35%;
            margin-top: 15px
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
        <h2 class="login-title">Login</h2>
        <form action="{{ url('/login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="sNumber">sNumber</label>
                <input type="text" class="form-control" id="sNumber" name="sNumber">
                @if ($errors->has('sNumber'))
                    <div class="error">
                        <p>{{ $errors->first('sNumber') }}</p>
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
            @if (session('error'))
                <p class="error">{{ session('error') }}</p>
            @endif
            <button type="submit" class="btn btn-block">Login</button>
        </form>
        <div class="text-center mt-3">
            <a href="#">Forgot Password?</a>
            <a href="/register">Sign Up</a>
        </div>
    </div>

    {{-- Notification modal --}}
    <div class="modal fade" id="notificationModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Notification</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>{{ session('message') }}</p>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
        @if (session('message'))
            var notificationModal = new bootstrap.Modal(document.getElementById('notificationModal'));
            notificationModal.show();
        @endif
    </script>

</body>

</html>
