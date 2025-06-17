<x-guest-layout>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background: url('{{ asset('images/bg.png') }}') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .login-card {
            width: 100%;
            max-width: 500px;
            background-color: rgba(0, 0, 0, 0.85);
            padding: 30px;
            border-radius: 12px;
            color: #fff;
            box-shadow: 0 0 25px rgba(183, 28, 28, 0.5);
        }

        .login-title {
            text-align: center;
            font-size: 2rem;
            color: #e53935;
            font-weight: bold;
            margin-bottom: 20px;
            letter-spacing: 1px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            color: #e57373;
            font-size: 0.9rem;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            background-color: rgb(148, 127, 127);
            border: 1px solid #e53935;
            color: white;
        }

        input::placeholder {
            color: #aaa;
        }

        .login-button {
            background-color: #b71c1c;
            border: none;
        }

        .login-button:hover {
            background-color: #d32f2f;
        }

     .logo img {
    max-width: 350px; /* Sesuaikan ukuran logo */
    margin-bottom: 10px;
    display: block;  /* Membuat gambar menjadi block-level element */
    margin-left: auto;  /* Menyelaraskan gambar ke kiri secara otomatis */
    margin-right: auto;  /* Menyelaraskan gambar ke kanan secara otomatis */
}

        .forgot-link {
            color: #f44336;
            text-decoration: none;
            font-size: 0.85rem;
        }

        .forgot-link:hover {
            color: #ff7961;
        }
    </style>

    <div class="login-card">
          <div class="logo">
        <<img src="vendor/adminlte/dist/img/isolutions.png" alt="Logo" />
    </div>
                <div class="login-title">Register</div>


        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="form-group">
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full"
                              type="text" name="name"
                              :value="old('name')"
                              required autofocus autocomplete="name"
                              placeholder="Nama lengkap" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="form-group">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full"
                              type="email" name="email"
                              :value="old('email')"
                              required autocomplete="username"
                              placeholder="email@example.com" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="form-group">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full"
                              type="password" name="password"
                              required autocomplete="new-password"
                              placeholder="********" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                              type="password" name="password_confirmation"
                              required autocomplete="new-password"
                              placeholder="********" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-between mt-4">
                <a class="forgot-link" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="login-button">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
