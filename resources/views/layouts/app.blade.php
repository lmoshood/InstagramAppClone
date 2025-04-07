<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Instagram Clone') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom CSS -->
    <style>
        /* Instagram-like styling */
        body {
            background-color: #fafafa;
            font-family: 'Roboto', sans-serif;
            padding-bottom: 60px; /* For mobile bottom nav */
        }

        .navbar {
            background-color: white !important;
            border-bottom: 1px solid #dbdbdb;
        }

        .navbar-brand {
            font-family: 'Brush Script MT', cursive;
            font-size: 28px;
            font-weight: 600;
        }

        .nav-link {
            padding: 0.5rem 0.8rem;
            color: #262626 !important;
        }

        /* Fixed bottom navbar for mobile */
        @media (max-width: 767.98px) {
            .fixed-bottom {
                box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
                background-color: white;
                border-top: 1px solid #dbdbdb;
            }
            .bottom-nav-icon {
                font-size: 1.5rem;
                padding: 0.5rem;
            }
        }

        /* Instagram-like buttons */
        .btn-primary {
            background-color: #0095f6;
            border-color: #0095f6;
            font-weight: 500;
        }

        .btn-primary:hover {
            background-color: #0080e0;
            border-color: #0080e0;
        }

        .btn-outline-primary {
            color: #0095f6;
            border-color: #0095f6;
        }

        /* Instagram-like card styling */
        .card {
            border: 1px solid #dbdbdb;
            margin-bottom: 30px;
            border-radius: 8px;
        }

        .card-header {
            background-color: white;
            padding: 14px 16px;
            border-bottom: 1px solid #dbdbdb;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card-footer {
            background-color: white;
            padding: 14px 16px;
            border-top: 1px solid #dbdbdb;
        }

        /* Instagram-like form controls */
        .form-control {
            border-radius: 3px;
        }

        .form-control:focus {
            border-color: #b2b2b2;
            box-shadow: none;
        }

        /* Profile grid styling */
        .square-image-container {
            position: relative;
            width: 100%;
            padding-bottom: 100%; /* 1:1 Aspect Ratio */
            overflow: hidden;
        }

        .square-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .square-image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.3);
            opacity: 0;
            transition: opacity 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .square-image-container:hover .square-image-overlay {
            opacity: 1;
        }

        /* Like button styling */
        .like-btn {
            background: none;
            border: none;
            padding: 0;
            cursor: pointer;
        }

        .like-btn:focus {
            outline: none;
        }

        /* Comment section styling */
        .comment-box {
            border-top: 1px solid #efefef;
            padding-top: 12px;
        }

        /* Search box styling */
        .search-box {
            background-color: #efefef;
            border-radius: 8px;
            padding: 5px 10px;
        }

        /* Auth page styling */
        .auth-card {
            max-width: 400px;
            margin: 0 auto;
        }

        .auth-logo {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Instagram
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <div class="me-auto"></div>

                    <!-- Center Search Bar -->
                    <form class="d-none d-md-flex mx-md-4 search-box">
                        <input class="form-control form-control-sm me-2 border-0 bg-transparent"
                               type="search"
                               placeholder="Search"
                               aria-label="Search">
                    </form>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item d-none d-md-block">
                                <a class="nav-link" href="{{ route('posts.index') }}">
                                    <i class="fas fa-home fa-lg"></i>
                                </a>
                            </li>
                            <li class="nav-item d-none d-md-block">
                                <a class="nav-link" href="#">
                                    <i class="far fa-paper-plane fa-lg"></i>
                                </a>
                            </li>
                            <li class="nav-item d-none d-md-block">
                                <a class="nav-link" href="{{ route('posts.create') }}">
                                    <i class="far fa-plus-square fa-lg"></i>
                                </a>
                            </li>
                            <li class="nav-item d-none d-md-block">
                                <a class="nav-link" href="#">
                                    <i class="far fa-compass fa-lg"></i>
                                </a>
                            </li>
                            <li class="nav-item d-none d-md-block">
                                <a class="nav-link" href="#">
                                    <i class="far fa-heart fa-lg"></i>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                    @if(Auth::user()->profile_photo_path)
                                        <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" class="rounded-circle" width="24" height="24">
                                    @else
                                        <i class="fas fa-user-circle fa-lg"></i>
                                    @endif
                                </a>

                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="{{ route('profile.current') }}">
                                        <i class="fas fa-user me-2"></i> Profile
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-cog me-2"></i> Settings
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt me-2"></i> {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

        @auth
        <!-- Mobile Bottom Navigation -->
        <nav class="navbar fixed-bottom navbar-light d-md-none">
            <div class="container-fluid">
                <div class="d-flex justify-content-around w-100">
                    <a class="nav-link bottom-nav-icon" href="{{ route('posts.index') }}">
                        <i class="fas fa-home"></i>
                    </a>
                    <a class="nav-link bottom-nav-icon" href="#">
                        <i class="far fa-compass"></i>
                    </a>
                    <a class="nav-link bottom-nav-icon" href="{{ route('posts.create') }}">
                        <i class="far fa-plus-square"></i>
                    </a>
                    <a class="nav-link bottom-nav-icon" href="#">
                        <i class="far fa-heart"></i>
                    </a>
                    <a class="nav-link" href="{{ route('profile.current') }}">
                        @if(Auth::user()->profile_photo_path)
                            <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" class="rounded-circle" width="24" height="24">
                        @else
                            <i class="fas fa-user-circle fa-lg"></i>
                        @endif
                    </a>
                </div>
            </div>
        </nav>
        @endauth
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JavaScript -->
    <script>
        // Simple like button functionality
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.like-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const icon = this.querySelector('i');
                    if (icon.classList.contains('far')) {
                        icon.classList.remove('far');
                        icon.classList.add('fas', 'text-danger');
                    } else {
                        icon.classList.remove('fas', 'text-danger');
                        icon.classList.add('far');
                    }
                });
            });
        });
    </script>

    @stack('scripts')
</body>
</html>
