{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
<!-- Register Form (Initially Hidden) -->


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
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

        <div id="registerForm" class="bg-white rounded-xl shadow-lg overflow-hidden flex flex-col md:flex-row">
            <div class="md:w-1/2 p-8 md:p-12">
                <h2 class="text-3xl font-bold text-primary mb-2">Create Account</h2>
                <p class="text-text mb-6">Join us to get started</p>

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="register-fname" class="block text-sm font-medium text-gray-700 mb-1">Full
                            Name</label>
                        <input type="text" id="register-fname" name="name" value="{{ old('name') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent"
                            placeholder="Full name">
                        @error('name')
                            <div class="text-sm text-[red]">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="register-email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" id="register-email" name="email" value="{{ old('email') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent"
                            placeholder="Enter your email">
                        @error('email')
                            <div class="text-sm text-[red]">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="register-password"
                            class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input type="password" id="register-password" name="password"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent"
                            placeholder="Create a password">
                        @error('password')
                            <div class="text-sm text-[red]">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-6">
                        <label for="register-confirm-password"
                            class="block text-sm font-medium text-gray-700 mb-1">Confirm
                            Password</label>
                        <input type="password" id="register-confirm-password" name="password_confirmation"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-secondary focus:border-transparent"
                            placeholder="Confirm your password">
                        @error('password_confirmation')
                            <div class="text-sm text-[red]">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-4 flex items-center">
                        <input type="checkbox" id="terms"
                            class="h-4 w-4 text-secondary focus:ring-secondary border-gray-300 rounded">
                        <label for="terms" class="ml-2 block text-sm text-text">
                            I agree to the <a href="#" class="text-secondary hover:underline">Terms of
                                Service</a> and <a href="#" class="text-secondary hover:underline">Privacy
                                Policy</a>
                        </label>
                    </div>
                    <button type="submit"
                        class="w-full bg-primary text-white py-2 px-4 rounded-md hover:bg-opacity-90 transition duration-300 font-medium">Create
                        Account</button>
                </form>

                <div class="relative flex items-center my-6">
                    <div class="flex-grow border-t border-gray-300"></div>
                    <span class="flex-shrink mx-4 text-text">Or sign up with</span>
                    <div class="flex-grow border-t border-gray-300"></div>
                </div>

                <!-- Google Sign-In Button -->
                <a href="{{ route('google_redirect') }}" aria-label="Sign up with Google"
                    class="flex items-center justify-center gap-3 bg-white border border-google-button-border-light rounded-md p-2 w-full transition-colors duration-300 hover:bg-gray-50">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5">
                        <title>Sign up with Google</title>
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
                    <span class="text-sm text-google-text-gray tracking-wider">Sign up with Google</span>
                </a>

                <p class="text-center text-text mt-6">
                    Already have an account? <a href="{{route('login')}}" id="switchToLogin"
                        class="text-secondary font-medium hover:underline">Sign in</a>
                </p>
            </div>
            <div class="hidden md:block md:w-1/2 bg-light-primary relative">
                <div class="absolute inset-0 flex items-center justify-center p-12">
                    <div class="text-center">
                        <div class="w-24 h-24 bg-secondary rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-primary">Join Our Community</h3>
                        <p class="text-text mt-2">Create an account to access exclusive features</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
