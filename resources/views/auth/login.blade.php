{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Registration</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#153563',
                        'light-primary': '#1535631a',
                        secondary: '#0c9cd7',
                        text: '#666666',
                        google: {
                            'text-gray': '#3c4043',
                            'button-blue': '#1a73e8',
                            'button-blue-hover': '#5195ee',
                            'button-dark': '#202124',
                            'button-dark-hover': '#555658',
                            'button-border-light': '#dadce0',
                            'logo-blue': '#4285f4',
                            'logo-green': '#34a853',
                            'logo-yellow': '#fbbc05',
                            'logo-red': '#ea4335',
                        },
                    },
                    fontFamily: {
                        poppins: ['Poppins', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        /* Custom styles can be added here */
    </style>
</head>

<body class="font-poppins bg-gray-50 min-h-screen flex items-center justify-center py-8">
    <div class="container max-w-6xl mx-auto px-4">

        <!-- Login Form -->
        <div id="loginForm" class="bg-white rounded-xl shadow-lg overflow-hidden flex flex-col md:flex-row">
            <div class="md:w-1/2 p-8 md:p-12">
                <h2 class="text-3xl font-bold text-primary mb-2">Welcome Back</h2>
                <p class="text-text mb-6">Sign in to access your account</p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="login-email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" id="login-email" name="email" value="{{ old('email') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent"
                            placeholder="Enter your email">
                        @error('email')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label for="login-password"
                            class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input type="password" id="login-password" name="password"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent"
                            placeholder="Enter your password">
                        @error('password')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror

                        <div class="text-right mt-2">
                            <a href="#" class="text-sm text-secondary hover:underline">Forgot password?</a>
                        </div>
                    </div>
                    <button type="submit"
                        class="w-full bg-primary text-white py-2 px-4 rounded-md hover:bg-opacity-90 transition duration-300 font-medium">Sign
                        In</button>
                </form>

                <div class="relative flex items-center my-6">
                    <div class="flex-grow border-t border-gray-300"></div>
                    <span class="flex-shrink mx-4 text-text">Or continue with</span>
                    <div class="flex-grow border-t border-gray-300"></div>
                </div>

                <!-- Google Sign-In Button -->
                <a href="{{route('google_redirect')}}" aria-label="Sign in with Google"
                    class="flex items-center justify-center gap-3 bg-white border border-google-button-border-light rounded-md p-2 w-full transition-colors duration-300 hover:bg-gray-50">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5">
                        <title>Sign in with Google</title>
                        <desc>Google G Logo</desc>
                        <path
                            d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"
                            fill="#4285F4"></path>
                        <path
                            d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
                            fill="#34A853"></path>
                        <path
                            d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"
                            fill="#FBBC05"></path>
                        <path
                            d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"
                            fill="#EA4335"></path>
                    </svg>
                    <span class="text-sm text-google-text-gray tracking-wider">Sign in with Google</span>
                </a>

                <p class="text-center text-text mt-6">
                    Don't have an account? <a href="{{ route('register') }}"
                        class="text-secondary font-medium hover:underline">Sign up</a>
                </p>
            </div>
            <div class="hidden md:block md:w-1/2 bg-light-primary relative">
                <div class="absolute inset-0 flex items-center justify-center p-12">
                    <div class="text-center">
                        <div class="w-24 h-24 bg-primary rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-primary">Secure Login</h3>
                        <p class="text-text mt-2">Your security is our priority</p>
                    </div>
                </div>
            </div>
        </div>


    </div>
</body>

</html>
