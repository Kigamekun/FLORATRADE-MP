<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Marketplace</title>

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
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="headForm">
                        <h1>Welcome</h1>
                        <p>Log in to your account to continue</p>
                    </div>
                    <div class="bodyForm">
                        <div class="mb-3 inputForm">
                            <div class="icon">
                                <label for="username">
                                    <img src="{{ url('assets_user/img/iconUser.svg') }}" alt="">
                                </label>
                            </div>
                            <input type="email" class="form-control" name="email" id="email" placeholder="email">
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
                        <div class="mb-5 link">
                            <a href="#">Forget Your Password ?</a>
                        </div>

                        <div class="wrapperButton mb-4">
                            <button class="button">Login</button>
                        </div>
                        <p class="toSignUppage">Don’t have an account ? <a href="{{ route('register') }}">Sign up!</a></p>
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
