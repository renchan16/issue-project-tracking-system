@extends('layouts.app')

@section('content')
<div class="auth-container">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7 col-sm-9">
            <div class="auth-card card animate__animated animate__fadeIn">
                <div class="card-body p-4 p-md-5">
                    <div class="text-center mb-4">
                        <h2 class="auth-title">Create Account</h2>
                        <p class="auth-subtitle">Join track.r to start managing your projects</p>
                    </div>
                    
                    <form method="POST" action="{{ route('signup') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="form-label">Full Name</label>
                            <div class="form-floating">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                    id="name" name="name" value="{{ old('name') }}" 
                                     autofocus placeholder="John Doe">
                                <label for="name">John Doe</label>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label">Email address</label>
                            <div class="form-floating">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                    id="email" name="email" value="{{ old('email') }}" 
                                    required placeholder="name@example.com">
                                <label for="email">name@example.com</label>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <div class="form-floating">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                    id="password" name="password" required placeholder="Create a password">
                                <label for="password">Create a password</label>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="password-strength-meter mt-1">
                                <small class="text-muted">Password should be at least 8 characters</small>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <div class="form-floating">
                                <input type="password" class="form-control" 
                                    id="password_confirmation" name="password_confirmation" 
                                     placeholder="Confirm your password">
                                <label for="password_confirmation">Confirm your password</label>
                            </div>
                        </div>

                        <div class="mb-4 form-check">
                            <input type="checkbox" class="form-check-input" id="terms" name="terms" required>
                            <label class="form-check-label" for="terms">
                                I agree to the <a href="#" class="text-decoration-none">Terms of Service</a> and <a href="#" class="text-decoration-none">Privacy Policy</a>
                            </label>
                        </div>

                        <div class="d-grid mb-4">
                            <button type="submit" class="btn btn-primary btn-lg auth-btn">Create Account</button>
                        </div>
                        
                        <div class="text-center">
                            <p class="mb-0">Already have an account? 
                                <a href="{{ route('login') }}" class="text-decoration-none fw-medium">Log in</a>
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

.password-strength-meter {
    height: 4px;
    background-color: var(--light-gray);
    border-radius: 2px;
    margin-top: 0.5rem;
}
</style>
@endsection 