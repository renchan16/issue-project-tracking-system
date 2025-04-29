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
    <div class="hero-section animate__animated animate__fadeIn">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="hero-title">Streamline your issue tracking with track.r</h1>
                    <p class="hero-subtitle mb-4">A modern, intuitive platform for teams to manage projects and track issues efficiently</p>
                    <div class="hero-actions">
                        <a href="{{ route('signup') }}" class="btn hero-btn btn-primary btn-lg me-3 d-inline-flex align-items-center">
                            <span>Get Started</span>
                            <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                        <a href="{{ route('login') }}" class="btn hero-btn btn-glass btn-lg d-inline-flex align-items-center">
                            <i class="fas fa-sign-in-alt me-2"></i>
                            <span>Log In</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <img src="{{ asset('images/hero-illustration.svg') }}" alt="track.r dashboard illustration" class="img-fluid animate__animated animate__fadeInRight">
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5 pt-5">
        <div class="row text-center mb-5">
            <div class="col-md-8 mx-auto">
                <h2 class="section-title">Designed for modern teams</h2>
                <p class="section-subtitle">Track issues, manage projects, and collaborate seamlessly with your team</p>
            </div>
        </div>
        
        <div class="row mb-5">
            <div class="col-md-4">
                <div class="card feature-card animate-on-scroll h-100">
                    <div class="feature-icon">
                        <i class="fas fa-tasks text-primary"></i>
                    </div>
                    <h3>Issue Tracking</h3>
                    <p>Create, assign, and track issues through their complete lifecycle with powerful workflow tools</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card feature-card animate-on-scroll h-100">
                    <div class="feature-icon">
                        <i class="fas fa-project-diagram text-primary"></i>
                    </div>
                    <h3>Project Management</h3>
                    <p>Organize issues into projects, set priorities, and monitor progress with intuitive dashboards</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card feature-card animate-on-scroll h-100">
                    <div class="feature-icon">
                        <i class="fas fa-users text-primary"></i>
                    </div>
                    <h3>Team Collaboration</h3>
                    <p>Work together effectively with real-time updates, comments, and role-based permissions</p>
                </div>
            </div>
        </div>
        
        <div class="row mt-5 pt-3 mb-5">
            <div class="col-lg-6 d-flex align-items-center">
                <div class="cta-content pe-lg-5">
                    <h2 class="mb-4">Ready to get started?</h2>
                    <p class="mb-4">Join thousands of teams already using track.r to streamline their workflows and boost productivity.</p>
                    <a href="{{ route('signup') }}" class="btn btn-primary btn-lg">Sign Up Now</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card testimonial-card animate-on-scroll">
                    <div class="card-body">
                        <div class="testimonial-quote">
                            <i class="fas fa-quote-left text-primary opacity-25 fa-2x mb-3"></i>
                            <p class="testimonial-text">track.r has transformed how our team manages projects. The intuitive interface and powerful features have significantly improved our productivity.</p>
                            <div class="testimonial-author">
                                <div class="testimonial-name">Sarah Johnson</div>
                                <div class="testimonial-title text-muted">Product Manager</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endauth
@endsection

<style>
.hero-section {
    padding: 6rem 0 4rem;
    background: linear-gradient(135deg, var(--primary-color) 0%, #2563eb 100%);
    color: white;
    margin-top: -2rem;
}

.hero-title {
    font-size: 2.8rem;
    font-weight: 700;
    margin-bottom: 1.5rem;
    line-height: 1.2;
}

.hero-subtitle {
    font-size: 1.2rem;
    opacity: 0.9;
    margin-bottom: 2rem;
}

.hero-btn {
    padding: 0.8rem 1.8rem;
    font-weight: 600;
    border-radius: 12px;
    transition: all 0.3s ease;
    letter-spacing: 0.02em;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.hero-btn.btn-primary {
    background-color: white;
    border-color: white;
    color: #3A86FF;
}

.hero-btn.btn-primary:hover {
    background-color:rgb(241, 241, 241);
    transform: translateY(-3px);
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.15);
}

.hero-btn.btn-primary:hover span{
    color: #3A86FF;
}

.hero-btn.btn-glass {
    background-color: rgba(255, 255, 255, 0.12);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: white;
}

.hero-btn.btn-glass:hover {
    background-color: rgba(255, 255, 255, 0.25);
    transform: translateY(-3px);
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
}

.section-title {
    font-size: 2.2rem;
    font-weight: 700;
    margin-bottom: 1rem;
}

.section-subtitle {
    font-size: 1.1rem;
    color: var(--dark-gray);
    margin-bottom: 3rem;
}

.feature-card {
    padding: 2rem;
    border-radius: 12px;
    border: none;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
    text-align: center;
}

.feature-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.1);
}

.feature-icon {
    font-size: 2.5rem;
    margin-bottom: 1.5rem;
    display: inline-block;
}

.feature-icon i {
    padding: 1rem;
    border-radius: 50%;
    background-color: rgba(59, 130, 246, 0.1);
}

.testimonial-card {
    border-radius: 12px;
    border: none;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    background-color: white;
}

.testimonial-text {
    font-size: 1.1rem;
    font-style: italic;
    margin-bottom: 1.5rem;
}

.testimonial-name {
    font-weight: 600;
    font-size: 1.1rem;
}

.cta-content {
    padding: 2rem 0;
}

@media (max-width: 991.98px) {
    .hero-section {
        padding: 4rem 0 3rem;
        text-align: center;
    }
    
    .hero-actions {
        justify-content: center;
    }
    
    .cta-content {
        text-align: center;
        margin-bottom: 3rem;
    }
}
</style>
