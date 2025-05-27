@extends('layouts.app')

@section('content')
<div class="auth-container">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7 col-sm-9">
            <div class="auth-card card animate__animated animate__fadeIn">
                <div class="card-body p-4 p-md-5">
                    <div class="text-center mb-4">
                        <h2 class="auth-title">Welcome Back</h2>
                        <p class="auth-subtitle">Log in to your track.r account</p>
                    </div>
                    
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="email" class="form-label">Email address</label>
                            <div class="form-floating">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                    id="email" name="email" value="{{ old('email') }}" 
                                    autofocus placeholder="name@example.com">
                                <label for="email">name@example.com</label>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <label for="password" class="form-label">Password</label>
                                <a href="#" class="text-decoration-none small forgot-link">Forgot password?</a>
                            </div>
                            <div class="form-floating">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                    id="password" name="password" placeholder="Enter your password">
                                <label for="password">Enter your password</label>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">Remember me</label>
                        </div>

                        <div class="d-grid mb-4">
                            <button type="submit" class="btn btn-primary btn-lg auth-btn">Log In</button>
                        </div>
                        
                        <div class="text-center">
                            <p class="mb-0">Don't have an account? 
                                <a href="{{ route('signup') }}" class="text-decoration-none fw-medium">Sign up</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.auth-container {
    padding: 3rem 1rem;
}

.auth-card {
    border: none;
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
}

.auth-title {
    font-weight: 700;
    color: var(--secondary-color);
    margin-bottom: 0.5rem;
}

.auth-subtitle {
    color: var(--dark-gray);
    margin-bottom: 2rem;
}

.form-floating > .form-control {
    padding: 1rem 1rem;
    height: calc(3.5rem + 2px);
    line-height: 1.25;
    border-radius: 12px;
}

.form-floating > label {
    padding: 1rem 1rem;
}

.form-control:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 0.25rem rgba(58, 134, 255, 0.15);
}

.forgot-link {
    color: var(--primary-color);
    transition: all 0.2s ease;
}

.forgot-link:hover {
    color: var(--secondary-color);
    text-decoration: underline !important;
}

.form-check-input:checked {
    background-color: var(--primary-color);
    border-color: var(--primary-color);
}

.auth-btn {
    padding: 0.8rem 1.5rem;
    font-weight: 600;
    border-radius: 12px;
    background-color: var(--primary-color);
    border-color: var(--primary-color);
    transition: all 0.3s ease;
}

.auth-btn:hover {
    background-color: var(--secondary-color);
    border-color: var(--secondary-color);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}
</style>
@endsection 