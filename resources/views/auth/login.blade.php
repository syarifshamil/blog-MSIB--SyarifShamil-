@extends('layout-before-login')

@section('content')
    <div class="bg-light text-dark rounded-lg shadow-lg p-4">
        <h2 class="text-center mb-4">Login</h2>

        <!-- Form -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input id="email" type="email" class="form-control" name="email" required autofocus>
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input id="password" type="password" class="form-control" name="password" required>
                @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-between">
                <div>
                    <a href="{{ route('password.request') }}">Forgot your password?</a>
                </div>
                <button type="submit" class="btn btn-primary">Log in</button>
            </div>
        </form>
    </div>
@endsection
