<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://kit.fontawesome.com/9154a70912.js" crossorigin="anonymous"></script>
    <title>@yield('title')</title>
</head>

<body>
    <!-- SIDE BAR  -->
    <main>
        <div class="sidebar">
            <div class="d-flex flex-column flex-shrink-0 p-3 bg-body-tertiary min-vh-100">
                <a class="logo" href="/">
                    <img src="{{ asset('images/logo.png') }}" alt="system-logo">
                    <span class="fs-4">NSystem</span>
                </a>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
                    <li>
                        <a href=" {{ url('/') }} " class="nav-link link-body-emphasis">
                            <i class="fa-solid fa-book-open"></i>
                            My Courses
                        </a>
                    </li>
                    <li>
                        <a href=" {{ url('/top-reviewers') }} " class="nav-link link-body-emphasis">
                            <i class="fa-brands fa-web-awesome"></i>
                            Top Reviewers
                        </a>
                    </li>
                    <li>
                        <a href=" {{ url('/') }} " class="nav-link link-body-emphasis">
                            <i class="fa-solid fa-gear"></i>
                            Settings
                        </a>
                    </li>
                </ul>
                <hr>
                <div class="dropdown">
                    <form action="{{ url('logout') }}" method="POST">
                        @csrf
                        <button type="submit">
                            <i class="fa-solid fa-right-from-bracket"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="right-container">
            <nav class="navbar bg-body-tertiary justify-content-end" style="height: 75px;">
                <ul class="nav">
                    <li class="nav-item">
                        <span class="badge text-bg-primary">{{ session('role') }}</span>
                    </li>
                    <li class="nav-item">
                        <i class="fa-regular fa-user"></i> {{ session('name') }}
                    </li>
                </ul>
            </nav>

            @yield('content')

            {{-- Notification modal --}}
            <div class="modal fade" id="notificationModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Notification</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
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

        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <script>
        @if (session('message'))
            var notificationModal = new bootstrap.Modal(document.getElementById('notificationModal'));
            notificationModal.show();
        @endif
    </script>

    @yield('script')
</body>

</html>
