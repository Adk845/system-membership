<x-guest-layout>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background: url('{{ asset('images/background3.jpg') }}') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .form-card {
            width: 100%;
            max-width: 420px;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 25px rgba(183, 28, 28, 0.5);
        }

        .form-title {
            text-align: center;
            font-size: 1.4rem;
            font-weight: bold;
            color: #b71c1c;
            margin-bottom: 20px;
            letter-spacing: 1px;
        }

        .logo img {
            max-width: 300px;
            margin: 0 auto 20px;
            display: block;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            color: #b71c1c;
            font-size: 0.9rem;
        }

        input[type="email"] {
            background-color: #fff;
            border: 1px solid #e53935;
            color: #333;
        }

        input::placeholder {
            color: #aaa;
        }

        .form-button {
            background-color: #dad4d4;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            border: none;            
        }

        .form-button:hover {
            background-color: #d32f2f;
            color: white;
        }

        .info-text {
            font-size: 0.9rem;
            color: #555;
            margin-bottom: 20px;
        }
    </style>

    <div class="form-card">
        <div class="logo">
            <img src="{{ asset('vendor/adminlte/dist/img/isolutions.png') }}" alt="Logo" />
        </div>

        <div class="form-title">Forgot Password</div>

        <div class="info-text">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            {{-- {{ __('masukan email yang terdaftar') }} --}}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div class="form-group">
                <label for="email">Email</label>
                <x-text-input id="email" class="block mt-1 w-full"
                              type="email"
                              name="email"
                              :value="old('email')"
                              required
                              autofocus
                              placeholder="email@example.com" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="form-button">
                    {{ __('Send Link Reset Password') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>







{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
