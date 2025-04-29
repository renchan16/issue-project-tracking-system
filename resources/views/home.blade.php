@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Welcome, {{ Auth::user()->name }}!</div>
            <div class="card-body">
                <h5 class="card-title">You are now logged in</h5>
                <p class="card-text">This is your landing page after successful login.</p>
                <p class="card-text">Your email: {{ Auth::user()->email }}</p>
            </div>
        </div>
    </div>
</div>
@endsection 