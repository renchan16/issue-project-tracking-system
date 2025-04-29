<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trackr - Issue Tracking System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #3a86ff;
            --secondary-color: #2d3748;
            --accent-color: #ff6b6b;
            --background-color: #f9fafb;
            --text-color: #2d3748;
            --light-gray: #f1f5f9;
            --medium-gray: #cbd5e1;
            --dark-gray: #64748b;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --info-color: #3b82f6;
        }

        body {
            background-color: var(--background-color);
            color: var(--text-color);
            font-family: 'Poppins', sans-serif;
            padding-bottom: 2rem;
            min-height: 100vh;
            padding-top: 70px; /* Added to prevent content from hiding behind fixed navbar */
        }

        .navbar {
            background-color: white !important;
            box-shadow: 0 2px 10px rgba(0,0,0,0.06);
            padding: 0.8rem 0;
            position: fixed;
            top: 0;
            right: 0;
            left: 0;
            z-index: 1030;
        }

        .navbar-brand {
            color: var(--primary-color) !important;
            font-weight: 700;
            font-size: 1.6rem;
            letter-spacing: -0.5px;
            transition: transform 0.2s ease;
            font-family: 'Poppins', sans-serif;
        }
        
        .navbar-brand:hover {
            transform: scale(1.03);
        }
        
        .navbar-brand i {
            margin-right: 0.5rem;
            color: var(--primary-color);
        }

        .nav-link {
            color: var(--secondary-color) !important;
            transition: all 0.2s ease;
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            border-radius: 6px;
            margin: 0 0.15rem;
        }

        .nav-link:hover {
            color: var(--primary-color) !important;
            background-color: rgba(58, 134, 255, 0.05);
            transform: translateY(-1px);
        }
        
        .nav-link.active {
            color: var(--primary-color) !important;
            background-color: rgba(58, 134, 255, 0.1);
            font-weight: 600;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.04);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            margin-bottom: 1.5rem;
            overflow: hidden;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.08);
        }

        .card-header {
            background-color: white;
            border-bottom: 1px solid var(--light-gray);
            padding: 1.25rem 1.5rem;
            font-weight: 600;
            color: var(--secondary-color);
            border-radius: 12px 12px 0 0 !important;
        }

        .card-body {
            padding: 1.5rem;
        }

        .btn {
            padding: 0.6rem 1.2rem;
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.2s ease;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border: none;
        }

        .btn-primary:hover {
            background-color: #2b75e8;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(58, 134, 255, 0.2);
        }
        
        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(58, 134, 255, 0.2);
        }

        .btn-success {
            background-color: var(--success-color);
            border: none;
        }
        
        .btn-success:hover {
            background-color: #0ca678;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(16, 185, 129, 0.2);
        }
        
        .btn-danger {
            background-color: var(--danger-color);
            border: none;
        }
        
        .btn-danger:hover {
            background-color: #dc2626;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(239, 68, 68, 0.2);
        }

        .btn-warning, .btn-outline-warning {
            color: #212529;
        }
        
        .btn-sm {
            padding: 0.4rem 0.8rem;
            font-size: 0.875rem;
        }

        .form-control {
            border-radius: 8px;
            padding: 0.65rem 1rem;
            border: 1px solid var(--medium-gray);
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(58, 134, 255, 0.15);
        }

        .form-label {
            font-weight: 500;
            margin-bottom: 0.5rem;
            color: var(--secondary-color);
        }

        .alert {
            border-radius: 10px;
            padding: 1rem 1.25rem;
            margin-bottom: 1.5rem;
            border: none;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .list-group-item {
            padding: 1rem 1.25rem;
            border-color: var(--light-gray);
        }

        .table {
            background-color: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .table th {
            background-color: var(--light-gray);
            color: var(--secondary-color);
            font-weight: 600;
            border-top: none;
            padding: 1rem 1.25rem;
            white-space: nowrap;
        }

        .table td {
            padding: 1rem 1.25rem;
            vertical-align: middle;
        }
        
        .table tr:hover {
            background-color: rgba(58, 134, 255, 0.02);
        }

        .badge {
            padding: 0.55em 0.8em;
            font-weight: 500;
            font-size: 0.75rem;
            border-radius: 6px;
        }
        
        .bg-success {
            background-color: var(--success-color) !important;
        }
        
        .bg-danger {
            background-color: var(--danger-color) !important;
        }
        
        .bg-warning {
            background-color: var(--warning-color) !important;
        }
        
        .bg-info {
            background-color: var(--info-color) !important;
        }

        .pagination {
            margin-bottom: 0;
        }

        .page-link {
            padding: 0.5rem 0.75rem;
            color: var(--secondary-color);
            border-color: var(--light-gray);
            margin: 0 2px;
            border-radius: 6px;
        }

        .page-link:hover {
            color: var(--primary-color);
            background-color: var(--light-gray);
            transform: translateY(-1px);
        }

        .page-item.active .page-link {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            box-shadow: 0 2px 5px rgba(58, 134, 255, 0.2);
        }

        .animate-on-scroll {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s ease;
        }

        .animate-on-scroll.visible {
            opacity: 1;
            transform: translateY(0);
        }
        
        /* Dashboard stats and welcome section */
        .welcome-back-section {
            padding: 2.5rem 0 1.5rem;
        }

        .welcome-title {
            color: var(--secondary-color);
            font-weight: 700;
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .welcome-message {
            color: var(--dark-gray);
            font-size: 1.1rem;
        }

        .stat-item {
            padding: 1.5rem;
            text-align: center;
            transition: all 0.3s ease;
        }

        .stat-item:hover {
            transform: translateY(-5px);
        }

        .stat-item i {
            font-size: 2rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .stat-item h4 {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--secondary-color);
        }

        .stat-item .display-6 {
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--primary-color);
        }
        
        /* Dropdown styling */
        .dropdown-menu {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            padding: 0.5rem 0;
        }
        
        .dropdown-item {
            padding: 0.6rem 1.2rem;
            transition: all 0.2s ease;
        }
        
        .dropdown-item:hover {
            background-color: rgba(58, 134, 255, 0.05);
            color: var(--primary-color);
        }
        
        .dropdown-item i {
            width: 20px;
            text-align: center;
            margin-right: 8px;
        }
        
        /* Empty state styling */
        .empty-state {
            text-align: center;
            padding: 3rem 1.5rem;
        }
        
        .empty-state i {
            font-size: 3rem;
            color: var(--medium-gray);
            margin-bottom: 1.5rem;
        }
        
        .empty-state h4 {
            color: var(--secondary-color);
            font-weight: 600;
            margin-bottom: 0.75rem;
        }
        
        .empty-state p {
            color: var(--dark-gray);
            max-width: 400px;
            margin: 0 auto 1.5rem;
        }

        .btn i {
            vertical-align: -0.125em;
            font-size: 0.85em;
        }
        
        .btn-sm i {
            font-size: 0.8em;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Trackr Logo" height="35" class="me-1">
                track.r
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('signup') }}">Sign Up</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                                <i class="fas fa-home me-1"></i> Dashboard
                            </a>
                        </li>
                        @can('viewAny', App\Models\Project::class)
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('projects.*') ? 'active' : '' }}" href="{{ route('projects.index') }}">
                                    <i class="fas fa-project-diagram me-1"></i> Projects
                                </a>
                            </li>
                        @endcan
                        @can('viewAny', App\Models\Issue::class)
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('issues.*') ? 'active' : '' }}" href="{{ route('issues.index') }}">
                                    <i class="fas fa-tasks me-1"></i> Issues
                                </a>
                            </li>
                        @endcan
                        @can('viewAny', App\Models\User::class)
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                                    <i class="fas fa-users me-1"></i> Users
                                </a>
                            </li>
                        @endcan
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li>
                                    <span class="dropdown-item-text text-muted small">
                                        Role: {{ ucfirst(Auth::user()->role) }}
                                    </span>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}" 
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @if(session('success'))
            <div class="alert alert-success animate__animated animate__fadeIn">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger animate__animated animate__fadeIn">
                <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger animate__animated animate__shakeX">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Animation on scroll
        document.addEventListener('DOMContentLoaded', function() {
            const elements = document.querySelectorAll('.animate-on-scroll');
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            });

            elements.forEach(element => {
                observer.observe(element);
            });
        });
    </script>
</body>
</html> 