@extends('layouts.app')

@section('content')
@auth
    <div class="welcome-back-section animate__animated animate__fadeIn">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="card welcome-card animate-on-scroll">
                        <div class="card-body text-center">
                            <div class="welcome-avatar mb-4">
                                <div class="avatar-circle">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                            </div>
                            <h2 class="welcome-title mb-3">Welcome back, {{ Auth::user()->name }}!</h2>
                            <p class="welcome-message mb-4">You are logged in. Here's your dashboard.</p>
                            <div class="welcome-stats mb-4">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stat-item">
                                            <i class="fas fa-user-circle"></i>
                                            <h4>Profile</h4>
                                            <p>View your profile</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="stat-item">
                                            <i class="fas fa-cog"></i>
                                            <h4>Settings</h4>
                                            <p>Manage your account</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="stat-item">
                                            <i class="fas fa-chart-line"></i>
                                            <h4>Analytics</h4>
                                            <p>View your stats</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="welcome-actions">
                                <a href="{{ route('home') }}" class="btn btn-primary btn-lg">Go to Dashboard</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="welcome-section animate__animated animate__fadeIn">
        <div class="container text-center">
            <h1 class="display-4 mb-4">Welcome to Our Platform</h1>
            <p class="lead mb-4">A secure and user-friendly authentication system</p>
            <div class="mt-4">
                <a href="{{ route('login') }}" class="btn btn-light btn-lg me-3">Login</a>
                <a href="{{ route('signup') }}" class="btn btn-outline-light btn-lg">Sign Up</a>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row mb-5">
            <div class="col-md-4">
                <div class="card feature-card animate-on-scroll h-100">
                    <div class="feature-icon">🔒</div>
                    <h3>Secure Authentication</h3>
                    <p>Advanced security features to protect your account</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card feature-card animate-on-scroll h-100">
                    <div class="feature-icon">⚡</div>
                    <h3>Fast & Responsive</h3>
                    <p>Lightning-fast performance across all devices</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card feature-card animate-on-scroll h-100">
                    <div class="feature-icon">🎨</div>
                    <h3>Modern Design</h3>
                    <p>Clean and intuitive user interface</p>
                </div>
            </div>
        </div>
    </div>
@endauth
@endsection
