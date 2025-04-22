{{-- <x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout> --}}


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Marketplace</title>

    <!--Bootstrap Css-->
    <link rel="stylesheet" href="{{ url('assets_user/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets_user/vendor/bootstrap/icons-1.7.2/font/bootstrap-icons.css') }}">

    <!--Slick CSS-->
    <link rel="stylesheet" href="{{ url('assets_user/vendor/slick/slick.css') }}">

    <!--Auth CSS-->
    <link rel="stylesheet" href="{{ url('assets_user/css/auth.css') }}">
</head>

<body>


    <div id="auth">
        <div class="wrapper">
            <div class="authForm">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="headForm">
                        <h1>Create Account</h1>
                        <p>Sign Up account to continue</p>
                    </div>
                    <div class="bodyForm">
                        <div class="mb-3 inputForm">
                            <div class="icon">
                                <label for="username">
                                    <img src="{{ url('assets_user/img/iconUser.svg') }}" alt="">
                                </label>
                            </div>
                            <input type="text" class="form-control" name="name" id="name" placeholder="name">
                        </div>

                        <div class="mb-3 inputForm">
                            <div class="icon">
                                <label for="email">
                                    <img src="{{ url('assets_user/img/email 1.svg') }}" alt="">
                                </label>
                            </div>
                            <input type="email" class="form-control" name="email" id="email" placeholder="email">
                        </div>

                        <div class="mb-3 inputForm">
                            <div class="icon">
                                <label for="phone">
                                    <img src="{{ url('assets_user/img/telephone 1.svg') }}" alt="">
                                </label>
                            </div>
                            <input type="number" class="form-control" name="phone" id="phone" placeholder="phone">
                        </div>

                        <div class="mb-3 inputForm">
                            <div class="icon">
                                <label for="address">
                                    <img src="{{ url('assets_user/img/location 4.svg') }}" alt="">
                                </label>
                            </div>
                            <textarea name="address" id="address" cols="30" rows="1" class="form-control" placeholder="Address"></textarea>
                        </div>


                        <div class="mb-3 inputForm passwordForm">
                            <div class="icon">
                                <label for="password">
                                    <img src="{{ url('assets_user/img/iconLock.svg') }}" alt="">
                                </label>
                            </div>
                            <div class="wrapperToggle">
                                <i class="bi bi-eye-fill" id="togglePassword"></i>
                            </div>
                            <input type="password" name="password" class="form-control" id="password"
                                placeholder="Password">
                        </div>

                        <div class="mb-3 inputForm passwordForm">
                            <div class="icon">
                                <label for="password_confirmation">
                                    <img src="{{ url('assets_user/img/iconLock.svg') }}" alt="">
                                </label>
                            </div>
                            <div class="wrapperToggle">
                                <i class="bi bi-eye-fill" id="togglePassword"></i>
                            </div>
                            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation"
                                placeholder="Password">
                        </div>


                        <div class="wrapperButton mb-4">
                            <button class="button">Register</button>
                        </div>
                        <p class="toSignUppage">Have an account ? <a href="{{ route('login') }}">Log In!</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <!--Vendor-->
    <!--Jquery-->
    <script src="{{ url('assets_user/vendor/jquery/jquery.min.js') }}"></script>
    <!--Bootstrap-->
    <script src="{{ url('assets_user/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!--Auth Script-->
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function(e) {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);

            this.classList.toggle('bi-eye-slash-fill');
        });
    </script>

@if (!is_null(Session::get('message')))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    Swal.fire({
        position: 'center',
        icon: @json(Session::get('status')),
        title: @json(Session::get('status')),
        html: @json(Session::get('message')),
        showConfirmButton: false,
        timer: 4000
    })
</script>
@endif


@if (!is_null(Session::get('errors')))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    var err = @json(Session::get('errors'));
    console.log(err);
    var txt = '';
    Object.keys(err).forEach(element => {
        txt += err[element].message + '<br>';
    });
    Swal.fire({
        position: 'center',
        icon: 'error',
        title: 'Error',
        html: @json(session()->get('errors')->first()),
        showConfirmButton: false,
        timer: 4000
    })
</script>
@endif
</body>

</html>
