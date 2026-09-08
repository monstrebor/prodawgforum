@extends('layout.layout')

@section('title', 'Pro Dawg Forum')

@section('script')
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
@php
$showRegister = $errors->has('name') || old('auth_form') === 'register';
@endphp

<div id="auth-page" class="relative min-h-screen overflow-hidden text-white" style="--bg-color: #020617;">

    {{-- =========================================
    ANIMATED BACKGROUND
    ========================================== --}}
    <div id="animated-background" class="fixed inset-0 -z-30"></div>

    {{-- Dark overlay for readability --}}
    <div class="fixed inset-0 -z-20 bg-slate-950/30"></div>


    {{-- =========================================
    3D BACKGROUND BLOBS
    ========================================== --}}
    <div class="fixed inset-0 -z-10 overflow-hidden pointer-events-none">

        <div class="bg-blob blob-one"></div>
        <div class="bg-blob blob-two"></div>
        <div class="bg-blob blob-three"></div>

        {{-- Floating particles --}}
        <div id="particles"></div>

    </div>


    {{-- =========================================
    MAIN 3D CONTAINER
    ========================================== --}}
    <main id="parallax-container" class="relative z-10 mx-auto grid min-h-screen w-full max-w-[1600px]
               lg:grid-cols-[1.08fr_.92fr]">

        {{-- =====================================
        LEFT / HERO
        ====================================== --}}
        <section class="brand-panel flex min-h-[50vh] flex-col justify-center
                   px-6 py-12 sm:px-10 lg:min-h-screen lg:px-16 xl:px-20">

            <div class="hero-content max-w-3xl" style="transform: translateZ(70px);">

                <div class="inline-flex items-center gap-2 rounded-full
                           border border-white/20 bg-white/10 px-4 py-2
                           text-sm backdrop-blur-xl">
                    <span class="h-2 w-2 animate-pulse rounded-full bg-cyan-400"></span>

                    CONNECT WITH PEOPLE
                </div>


                <h1 class="mt-8 text-5xl font-black leading-[0.95]
                           tracking-tight sm:text-6xl md:text-7xl
                           lg:text-7xl xl:text-8xl">

                    <span class="block">
                        <i class="fas fa-comments text-cyan-300"></i>
                    </span>

                    Make People

                    <span class="block bg-gradient-to-r
                               from-cyan-300 via-blue-300 to-purple-300
                               bg-clip-text text-transparent">
                        Interact.
                    </span>

                </h1>


                <p class="mt-8 max-w-xl text-lg leading-relaxed
                           text-blue-100/80 sm:text-xl lg:text-2xl">
                    Connect, engage, and share meaningful conversations
                    in a place designed for real interaction.
                </p>


                {{-- Stats --}}
                <div class="mt-10 flex flex-wrap gap-4">

                    <div class="stat-card rounded-2xl border border-white/15
                               bg-white/10 px-5 py-4 backdrop-blur-xl" style="transform: translateZ(50px);">
                        <div class="text-xl font-bold">Connect</div>

                        <div class="mt-1 text-sm text-blue-200/70">
                            Meet people
                        </div>
                    </div>


                    <div class="stat-card rounded-2xl border border-white/15
                               bg-white/10 px-5 py-4 backdrop-blur-xl" style="transform: translateZ(80px);">
                        <div class="text-xl font-bold">Interact</div>

                        <div class="mt-1 text-sm text-blue-200/70">
                            Start conversations
                        </div>
                    </div>


                    <div class="stat-card rounded-2xl border border-white/15
                               bg-white/10 px-5 py-4 backdrop-blur-xl" style="transform: translateZ(60px);">
                        <div class="text-xl font-bold">Share</div>

                        <div class="mt-1 text-sm text-blue-200/70">
                            Express yourself
                        </div>
                    </div>

                </div>

            </div>

        </section>



        {{-- =====================================
        RIGHT / AUTH
        ====================================== --}}
        <section class="flex min-h-[50vh] items-center justify-center
                   border-t border-white/10 bg-slate-950/10
                   px-5 py-10 backdrop-blur-sm
                   sm:px-8
                   lg:min-h-screen lg:border-l lg:border-t-0 lg:px-12">

            <div class="w-full max-w-md">

                @include('layout.all_notif')


                {{-- 3D AUTH CARD --}}
                <div id="auth-card" class="relative mt-6 overflow-hidden rounded-3xl
                           border border-white/20 bg-white/10
                           p-6 shadow-2xl backdrop-blur-2xl
                           sm:p-10" style="transform: translateZ(100px);">

                    {{-- LOGIN --}}
                    <form id="login-form" class="relative z-10 w-full" action="{{ route('login.store') }}"
                        method="POST">

                        @csrf

                        <div class="mb-8 text-center">

                            <div class="mx-auto mb-5 flex h-26 w-26 items-center justify-center ">
                                <img src="{{ asset('storage/assets/logo.png') }}" alt="Logo"
                                    class="h-300 w-300 object-contain">
                            </div>


                            <h2 class="text-3xl font-bold">
                                Welcome Back
                            </h2>

                            <p class="mt-2 text-blue-100/70">
                                Sign in and continue the conversation.
                            </p>

                        </div>

                        {{-- Email --}}
                        <div class="mb-5">

                            <label class="mb-2 block text-sm text-blue-100">
                                Email Address
                            </label>

                            <input type="email" name="email" value="{{ old('email') }}" placeholder="you@example.com"
                                required class="w-full rounded-xl border border-white/20
                                       bg-white/10 px-4 py-4
                                       text-white outline-none
                                       placeholder:text-blue-200/40
                                       transition
                                       focus:border-cyan-400
                                       focus:ring-4
                                       focus:ring-cyan-400/10">

                            @error('email')
                            <span class="mt-2 block text-sm text-red-300">
                                {{ $message }}
                            </span>
                            @enderror

                        </div>


                        {{-- Password --}}
                        <div class="mb-6">
                            <label class="mb-2 block text-sm text-blue-100">
                                Password
                            </label>

                            <!-- 1. Wrapped in a relative container to position the button inside -->
                            <div class="relative">
                                <input id="password" type="password" name="password" placeholder="Enter your password"
                                    required class="w-full rounded-xl border border-white/20
                      bg-white/10 pl-4 pr-12 py-4
                      text-white outline-none
                      placeholder:text-blue-200/40
                      transition
                      focus:border-cyan-400
                      focus:ring-4
                      focus:ring-cyan-400/10">

                                <!-- 2. The Eye Toggle Button -->
                                <button type="button" onclick="togglePassword()"
                                    class="absolute inset-y-0 right-0 flex items-center pr-4 text-blue-200/60 hover:text-white transition">
                                    <!-- SVG Eye Icon -->
                                    <svg id="eyeIcon" xmlns="http://w3.org" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </button>
                            </div>

                            @error('password')
                            <span class="mt-2 block text-sm text-red-300">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>

                        <!-- 3. JavaScript Logic to toggle type and icon -->
                        <script>
                            function togglePassword() {
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        // Change SVG to "Eye Slash" icon when password is visible
        eyeIcon.innerHTML = `
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
        `;
    } else {
        passwordInput.type = 'password';
        // Change back to regular "Eye" icon
        eyeIcon.innerHTML = `
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
        `;
    }
}
                        </script>



                        <button type="submit" class="w-full rounded-xl
                                   bg-gradient-to-r
                                   from-cyan-500 via-blue-600 to-indigo-600
                                   py-4 font-bold text-white
                                   transition-all duration-300
                                   hover:scale-[1.02]
                                   hover:shadow-xl
                                   hover:shadow-cyan-500/20
                                   active:scale-[0.98]">

                            <i class="fas fa-sign-in-alt mr-2"></i>

                            Login

                        </button>


                        <p class="mt-7 text-center text-blue-100/70">

                            Don't have an account?

                            <button type="button" onclick="toggleForms()" class="ml-1 font-semibold text-cyan-300
                                       hover:text-cyan-100">
                                Create an account
                            </button>

                        </p>

                    </form>



                    {{-- REGISTER --}}
                    <form id="register-form" class="hidden" method="POST" action="{{ route('register.store') }}">

                        @csrf

                        <div class="mb-8 text-center">

                            <div class="mx-auto mb-5 flex h-26 w-26 items-center justify-center ">
                                <img src="{{ asset('storage/assets/logo.png') }}" alt="Logo"
                                    class="h-300 w-300 object-contain">
                            </div>

                            <h2 class="text-3xl font-bold">
                                Join the Community
                            </h2>

                        </div>


                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Anonymous name" required
                            class="mb-5 w-full rounded-xl
                                   border border-white/20 bg-white/10
                                   px-4 py-4 text-white
                                   placeholder:text-blue-200/40
                                   outline-none
                                   focus:border-purple-400">


                        <input type="email" name="email" value="{{ old('email') }}" placeholder="you@example.com"
                            required class="mb-6 w-full rounded-xl
                                   border border-white/20 bg-white/10
                                   px-4 py-4 text-white
                                   placeholder:text-blue-200/40
                                   outline-none
                                   focus:border-purple-400">


                        <button type="submit" class="w-full rounded-xl
                                   bg-gradient-to-r
                                   from-purple-500 via-pink-500 to-rose-500
                                   py-4 font-bold text-white
                                   transition-all duration-300
                                   hover:scale-[1.02]
                                   active:scale-[0.98]">
                            Create Account
                        </button>


                        <p class="mt-7 text-center text-blue-100/70">

                            Already have an account?

                            <button type="button" onclick="toggleForms()" class="ml-1 font-semibold text-purple-300">
                                Login
                            </button>

                        </p>

                    </form>

                </div>

            </div>

        </section>

    </main>

</div>
@endsection
