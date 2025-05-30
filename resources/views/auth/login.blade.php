<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Marketplace</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

    <style>
        * {
          margin: 0;
          padding: 0;
          box-sizing: border-box;
          font-family: "Poppins", sans-serif;
        }

        body {
          background-image: url("{{ asset('assets/img/shahadat-rahman-KAnRMYTmnbw-unsplash.jpg') }}");
          background-size: cover;
          background-position: center;
          height: 100vh;
          display: flex;
          align-items: center;
          justify-content: center;
          color: #000;
        }

        .login-container {
          display: flex;
          width: 90%;
          max-width: 901px;
          background-color: #fff;
          border-radius: 12px;
          overflow: hidden;
          box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
          z-index: 1;
          height: 450px;
          position: relative;
        }

        .form-container{
           margin-top: 30px;
        }

        .login-form {
          background-color: #fff;
          padding: 40px;
          flex: 2;
          display: flex;
          flex-direction: column;
          justify-content: flex-start;
          position: relative;
        }

        .login-form h2,
        .login-form p {
          text-align: center;
          width: 100%;
          margin-bottom: 10px;
        }

        .login-form h2 {
          color: #2CA670;
          font-weight: 600;
          font-size: 24px;
        }

        .login-form p {
          font-size: 14px;
          color: #aaa;
        }

        .input-group {
          display: flex;
          align-items: center;
          width: 100%;
          height: 44px;
          border: 1px solid #dbe2de;
          border-radius: 8px;
          padding: 10px 16px;
          box-sizing: border-box;
          margin-bottom: 20px;
          position: relative;
        }

        .input-icon {
          margin-right: 10px;
          display: flex;
          align-items: center;
          color: #2CA670;
        }

        .input-field {
          font-family: "Poppins", sans-serif;
          font-weight: 400;
          font-size: 16px;
          color: #494c4b;
          flex: 1;
          border: none;
          outline: none;
          background: transparent;
          width: 100%;
        }

        .input-field::placeholder {
          color: #dedee0;
        }

        .password-toggle {
          position: absolute;
          right: 10px;
          top: 50%;
          transform: translateY(-50%);
          cursor: pointer;
          z-index: 2;
          color: #494c4b;
        }

        .forgot-password {
          display: block;
          margin: 10px 0 20px;
          text-align: right;
          color: #88e0aa;
          text-decoration: none;
          font-size: 14px;
        }

        .login-btn {
            width: 100%; /* fleksibel */
            max-width: 300px; /* batas maksimal */
            padding: 12px;
            margin: 20px auto 0; /* tengah horizontal */
            display: block;
            border: none;
            border-radius: 24px;
            cursor: pointer;
            background-color: #2CA670;
            color: #fff;
            font-weight: bold;
            font-size: 16px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* opsional: efek bayangan */
            transition: background-color 0.3s ease;
        }

        .visual-section {
          flex: 3;
          background-color: #fff;
          display: flex;
          flex-direction: column;
          justify-content: flex-end;
          align-items: center;
          position: relative;
          overflow: hidden;
        }

        .visual-section img.plant-cropped {
          width: 60%;
          border-radius: 12px;
          object-fit: cover;
          margin-bottom: 20px;
          transform: translate(50px, 30px);
          display: block;
          margin-left: auto;
          margin-right: auto;
          height: 400px;
          position: relative;
          z-index: 1;
        }

        /* Leaf icon on top-left of plant image */
        .leaf-on-plant {
          position: absolute;
          top: 15px;
          left: 15px;
          width: 150px;
          z-index: 2;
          transform: translate(30%, -20%);
          rotate: 20deg;
        }

        .leaf-on-plant-down {
          position: absolute;
          top: 15px;
          left: 15px;
          width: 150px;
          z-index: 2;
          transform: translate(20%, 10%);
          rotate: -5deg;
        }

        .leaf-middle-right {
          position: absolute;
          top: 50%;
          right: 10px;
          transform: translate(5%, 30%);
          width: 120px;
          z-index: 2;
        }

        .leaf-middle-right-up {
          position: absolute;
          top: 50%;
          right: 10px;
          transform: translateX(-10%);
          width: 120px;
          z-index: 2;
          rotate: -30deg;
        }

        .signup-link {
          /* position: absolute;
          bottom: 50px;
          left: 40%;
          transform: translateX(-50%);
          color: #88e0aa;
          text-decoration: none;
          font-size: 14px;
          display: block;
          margin-top: 30px; */
        text-align: center;
        display: block;
        margin-top: 20px;
        color: #88e0aa;
        text-decoration: none;
        font-size: 14px;
        }

        .bottom-plant {
          position: absolute;
          bottom: 10px;
          left: 46%;
          transform: translate(-50%, 3%);
          width: 220px;
          z-index: 1;
        }
    </style>
</head>

<body>
    <!-- Standalone Middle Plant -->


    <div class="login-container">
        <!-- Left Side: Login Form -->
         <form class="login-form" action="{{ route('login') }}" method="POST">
                @csrf
                <h2>Log In</h2>
                <p>Welcome back! Please login to your account.</p>

                <div class="form-container">
                    <!-- Email Input -->
                    <div class="input-group">
                        <div class="input-icon">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_1_5605)">
                                    <path d="M15.9693 3.69458L10.3573 9.30658C9.73158 9.93075 8.88383 10.2813 8 10.2813C7.11617 10.2813 6.26842 9.93075 5.64267 9.30658L0.0306667 3.69458C0.0213333 3.79991 0 3.89525 0 3.99991V11.9999C0.00105857 12.8836 0.352588 13.7309 0.97748 14.3558C1.60237 14.9807 2.4496 15.3322 3.33333 15.3332H12.6667C13.5504 15.3322 14.3976 14.9807 15.0225 14.3558C15.6474 13.7309 15.9989 12.8836 16 11.9999V3.99991C16 3.89525 15.9787 3.79991 15.9693 3.69458Z" fill="#2CA670"></path>
                                    <path d="M9.41476 8.36408L15.5041 2.27408C15.2091 1.78496 14.7931 1.38011 14.2961 1.09857C13.7991 0.81703 13.2379 0.668308 12.6668 0.666748H3.33343C2.76224 0.668308 2.20109 0.81703 1.70411 1.09857C1.20713 1.38011 0.791079 1.78496 0.496094 2.27408L6.58543 8.36408C6.96114 8.73829 7.46982 8.94839 8.00009 8.94839C8.53037 8.94839 9.03905 8.73829 9.41476 8.36408Z" fill="#2CA670"></path>
                                </g>
                                <defs>
                                    <clipPath id="clip0_1_5605">
                                        <rect width="16" height="16" fill="white"></rect>
                                    </clipPath>
                                </defs>
                            </svg>
                        </div>
                        <input type="email" name="email" id="email" class="input-field" placeholder="Email Address" value="{{ old('email') }}" required>
                    </div>

                    <!-- Password Input -->
                    <div class="input-group">
                        <div class="input-icon">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 5.33333H3.99999C2.52724 5.33333 1.33333 6.52724 1.33333 8V12C1.33333 13.4728 2.52724 14.6667 3.99999 14.6667H12C13.4728 14.6667 14.6667 13.4728 14.6667 12V8C14.6667 6.52724 13.4728 5.33333 12 5.33333Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M4.66667 5.33333V3.33333C4.66667 2.8029 4.87738 2.29419 5.25245 1.91912C5.62753 1.54405 6.13623 1.33333 6.66667 1.33333H9.33334C9.86377 1.33333 10.3725 1.54405 10.7475 1.91912C11.1226 2.29419 11.3333 2.8029 11.3333 3.33333V5.33333" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M8 10.6667C8.36819 10.6667 8.66667 10.3682 8.66667 10C8.66667 9.63181 8.36819 9.33333 8 9.33333C7.63181 9.33333 7.33333 9.63181 7.33333 10C7.33333 10.3682 7.63181 10.6667 8 10.6667Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <input type="password" name="password" id="password" class="input-field" placeholder="Password" required>
                        <i class="bi bi-eye-slash-fill password-toggle" id="togglePassword"></i>
                    </div>

                    <a href="#" class="forgot-password">Forgot Password?</a>
                    <button type="submit" class="login-btn">Login</button>

                    <!-- Sign Up stays at bottom -->
                    <a href="{{ route('register') }}" class="signup-link">Don’t have an Account? Sign Up</a>
                </div>
            </form>



        <!-- Right Side: Visual Section -->
        <div class="visual-section">
                <img src="{{ asset('assets/img/bgnew.jpg') }}"
         alt="Plant"
         class="plant-cropped">
            <img src="{{ asset('assets/img/leave 1.png') }}" alt="Leaf" class="leaf-on-plant">
            <img src="{{ asset('assets/img/leave 1.png') }}" alt="Leaf" class="leaf-on-plant-down">
        </div>

        <!-- Additional Leaf Icons -->
        <img src="{{ asset('assets/img/leave1 1.png') }}" alt="Leaf" class="leaf-middle-right">
        <img src="{{ asset('assets/img/leave1 1.png') }}" alt="Leaf" class="leaf-middle-right-up">
        <!-- <img src="{{ asset('assets/img/aaaa.png') }}" alt="Plant in Pot" class="bottom-plant"> -->
    </div>

    <!-- jQuery (needed for Bootstrap and SweetAlert) -->
    <script src="{{ url('assets_user/vendor/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap JS -->
    <script src="{{ url('assets_user/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script>
        // Password toggle functionality
        document.addEventListener("DOMContentLoaded", function () {
            const togglePassword = document.querySelector('#togglePassword');
            const password = document.querySelector('#password');

            if (togglePassword && password) {
                togglePassword.addEventListener('click', function (e) {
                    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                    password.setAttribute('type', type);
                    this.classList.toggle('bi-eye-slash-fill');
                    this.classList.toggle('bi-eye-fill');
                });
            }

            // Form validation and focus styles
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const form = document.querySelector('.login-form');

            // Add focus/blur event listeners for styling
            emailInput.addEventListener('focus', () => {
                emailInput.closest('.input-group').classList.add('focused');
            });

            passwordInput.addEventListener('focus', () => {
                passwordInput.closest('.input-group').classList.add('focused');
            });

            emailInput.addEventListener('blur', () => {
                if (!emailInput.value) {
                    emailInput.closest('.input-group').classList.remove('focused');
                }
            });

            passwordInput.addEventListener('blur', () => {
                if (!passwordInput.value) {
                    passwordInput.closest('.input-group').classList.remove('focused');
                }
            });
        });

        function showError(message) {
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Error',
                    html: message,
                    showConfirmButton: false,
                    timer: 4000
                });
            } else {
                alert(message);
            }
        }
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
