@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card animate__animated animate__fadeIn">
            <div class="card-header">
                <h4 class="mb-0">Sign Up</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('signup') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="form-label">Name</label>
                        <div class="input-group">
                            <span class="input-group-text">👤</span>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                id="name" name="name" value="{{ old('name') }}" 
                                required autofocus placeholder="Enter your name">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="email" class="form-label">Email address</label>
                        <div class="input-group">
                            <span class="input-group-text">📧</span>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                id="email" name="email" value="{{ old('email') }}" 
                                required placeholder="Enter your email">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text">🔑</span>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                id="password" name="password" required placeholder="Enter your password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <div class="input-group">
                            <span class="input-group-text">🔒</span>
                            <input type="password" class="form-control" 
                                id="password_confirmation" name="password_confirmation" 
                                required placeholder="Confirm your password">
                        </div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">Sign Up</button>
                    </div>
                </form>

                <div class="mt-4 text-center">
                    <p class="mb-0">Already have an account? 
                        <a href="{{ route('login') }}" class="text-decoration-none">Login</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 