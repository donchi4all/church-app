@extends('backend.layouts.auth')

@section('title', 'Golim Admin Login')

@section('content')

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Login -->
                <div class="card px-sm-6 px-0">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a href="{{ route('home') }}" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">
                                    <svg width="25" viewBox="0 0 25 42" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <!-- SVG logo here -->
                                    </svg>
                                </span>
                                <span class="app-brand-text demo text-heading fw-bold">Golim</span>
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-1">Welcome to Golim Admin Portal! 🙏</h4>
                        <p class="mb-6">Please sign-in to access the church's admin panel</p>
                        @if ($errors->any())
                            <p class="mb-6">
                            <div style="color: red;">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            </p>
                        @endif
                        <form method="POST" id="formAuthentication" class="mb-6"
                            action="{{ route('admin.login.submit') }}">
                            @csrf
                            <div class="mb-6">
                                <label for="email" class="form-label">Email or Username</label>
                                <input type="text" class="form-control" id="email" name="email"
                                    placeholder="Enter your email or username" value="{{ old('email') }}" autofocus />
                            </div>
                            <div class="mb-6 form-password-toggle">
                                <label class="form-label" for="password">Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password" />
                                    <span class="input-group-text cursor-pointer" id="togglePassword">
                                        <i class="bx bx-hide"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="mb-8">
                                <div class="d-flex justify-content-between mt-8">
                                    <div class="form-check mb-0 ms-2">
                                        <input class="form-check-input" type="checkbox" id="remember-me" />
                                        <label class="form-check-label" for="remember-me" name="remember"
                                            {{ old('remember') ? 'checked' : '' }}> Remember Me </label>
                                    </div>
                                    {{-- <a href="auth-forgot-password-basic.html">
                                        <span>Forgot Password?</span>
                                    </a> --}}
                                </div>
                            </div>
                            <div class="mb-6">
                                <button class="btn btn-primary d-grid w-100" type="submit">Login</button>
                            </div>
                        </form>

                        <p class="text-center">
                            <span>New to Golim?</span>
                            <a href="{{ route('home') }}">
                                <span>Visit our site</span>
                            </a>
                        </p>
                    </div>
                </div>
                <!-- /Login -->
            </div>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const togglePassword = document.getElementById('togglePassword');

        // Ensure the element exists before adding the event listener
        if (togglePassword) {
            togglePassword.addEventListener('click', function() {
                const passwordField = document.getElementById('password');
                const icon = this.querySelector('i'); // Get the icon inside the span
                const isPassword = passwordField.getAttribute('type') === 'password';

                // Toggle password field type
                passwordField.setAttribute('type', isPassword ? 'text' : 'password');

                // Toggle icon class
                icon.classList.toggle('bx-hide', !isPassword);
                icon.classList.toggle('bx-show', isPassword);
            });
        }
    });
</script>
