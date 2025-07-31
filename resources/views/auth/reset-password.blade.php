
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

        .reset-card {
            width: 100%;
            max-width: 420px;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 25px rgba(183, 28, 28, 0.5);
        }

        .reset-title {
            text-align: center;
            font-size: 14px;
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

        input[type="email"],
        input[type="password"] {
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

        .reset-button:hover {
            background-color: #d32f2f;
            color: white;
        }

        .forgot-link {
            color: #b71c1c;
            text-decoration: none;
            font-size: 0.85rem;
        }

        .forgot-link:hover {
            color: #ff7961;
        }
    </style>

    <div class="reset-card">
        <div class="logo">
            <img src="{{ asset('vendor/adminlte/dist/img/isolutions.png') }}" alt="Logo" />
        </div>

        <div class="reset-title">Input Your New Password</div>

        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <!-- Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email -->
            <div class="form-group">
                <label for="email">Email</label>
                <x-text-input id="email" class="block mt-1 w-full"
                              type="email"
                              name="email"
                              :value="old('email', $request->email)"
                              required autofocus
                              placeholder="email@example.com"
                              autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password">Password</label>
                <x-text-input id="password" class="block mt-1 w-full"
                              type="password"
                              name="password"
                              required
                              placeholder="******"
                              autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                              type="password"
                              name="password_confirmation"
                              required
                              placeholder="******"
                              autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Submit -->
            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="reset-button">
                    {{ __('Reset Password') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>




{{-- <x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
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
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
