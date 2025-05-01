<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Marketplace</title>
    
    <!-- Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap">
    
    <!-- Bootstrap CSS (needed for SweetAlert and any other Bootstrap-dependent components) -->
    <link rel="stylesheet" href="{{ url('assets_user/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets_user/vendor/bootstrap/icons-1.7.2/font/bootstrap-icons.css') }}">

    <style>
        * {
          margin: 0;
          padding: 0;
          box-sizing: border-box;
        }

        body {
          font-family: "Poppins", sans-serif;
          background-color: #f5f5f5;
          display: flex;
          justify-content: center;
          align-items: center;
          min-height: 100vh;
          width: 100%;
        }

        .login-container {
          display: flex;
          justify-content: center;
          align-items: center;
          width: 100vw;
          height: 100vh;
        }

        .login-form {
          width: 510px;
          height: 487px;
          border-radius: 16px;
          box-shadow:
            0px 1px 2px rgba(0, 0, 0, 0.3),
            0px 2px 6px 2px rgba(0, 0, 0, 0.15);
          padding: 67px 40px 0;
          box-sizing: border-box;
          background-color: #fff;
        }

        .login-title {
          font-weight: 600;
          font-size: 31px;
          color: #2ca670;
          margin-bottom: 54px;
          text-align: center;
        }

        .login-subtitle {
          font-weight: 400;
          font-size: 13px;
          color: #494c4b;
          margin-bottom: 52px;
          text-align: center;
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
        }

        .input-icon {
          margin-right: 10px;
          display: flex;
          align-items: center;
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

        .forgot-password-container {
          text-align: right;
          margin-bottom: 40px;
        }

        .forgot-password {
          font-weight: 400;
          font-size: 10px;
          color: #494c4b;
          text-decoration: none;
        }

        .login-button {
          display: block;
          width: 228px;
          height: 48px;
          color: #fff;
          font-family: "Poppins", sans-serif;
          font-weight: 700;
          font-size: 16px;
          border-radius: 24px;
          margin: 0 auto 67px;
          background-color: #2ca670;
          border: none;
          cursor: pointer;
          text-align: center;
          line-height: 48px;
        }

        .signup-text {
          font-weight: 300;
          font-size: 10px;
          color: #494c4b;
          text-align: center;
        }

        .signup-link {
          color: #2ca670;
          text-decoration: none;
          font-weight: 400;
        }

        /* Password toggle styles */
        .password-toggle {
          cursor: pointer;
          margin-left: 10px;
          color: #494c4b;
        }

        /* Focus styles */
        .input-group.focused {
          border-color: #2ca670;
          box-shadow: 0 0 0 2px rgba(44, 166, 112, 0.2);
        }

        .login-button:hover {
          background-color: #259a64;
        }

        .forgot-password:hover, .signup-link:hover {
          text-decoration: underline;
        }

        /* Media Queries */
        @media (max-width: 991px) {
          .login-form {
            width: 100%;
            max-width: 510px;
          }

          .login-button {
            width: 100%;
            max-width: 228px;
          }
        }

        @media (max-width: 640px) {
          .login-container {
            padding: 20px;
          }

          .login-form {
            padding: 40px 20px;
          }

          .login-title {
            font-size: 24px;
          }

          .login-subtitle {
            font-size: 12px;
          }

          .input-group {
            height: 40px;
          }

          .input-field {
            font-size: 14px;
          }

          .forgot-password {
            font-size: 9px;
          }

          .login-button {
            height: 44px;
            font-size: 14px;
            line-height: 44px;
          }

          .signup-text {
            font-size: 9px;
          }
        }
    </style>
</head>

<body>
    <main class="login-container">
        <form class="login-form" action="{{ route('login') }}" method="POST">
            @csrf
            <h1 class="login-title">Log in to Your Account</h1>
            <p class="login-subtitle">Sign in to continue your journey with us.</p>

            <div class="input-group">
                <div class="input-icon">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="icon-email">
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
                <input type="email" name="email" id="email" class="input-field" placeholder="Email" required>
            </div>

            <div class="input-group">
                <div class="input-icon">
                    <svg width="16" height="16" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg" class="icon-password">
                        <path d="M30.1666 19.02V17.8333C30.1666 14.6117 27.555 12 24.3333 12C21.1116 12 18.5 14.6117 18.5 17.8333V19.02C16.9834 19.6819 16.0022 21.1786 16 22.8333V27.8333C16.0027 30.1334 17.8666 31.9973 20.1666 32H28.5C30.8 31.9973 32.6639 30.1334 32.6666 27.8333V22.8333C32.6645 21.1786 31.6833 19.6819 30.1666 19.02ZM25.1666 26.1667C25.1666 26.6269 24.7936 27 24.3333 27C23.8731 27 23.5 26.6269 23.5 26.1667V24.5C23.5 24.0398 23.8731 23.6667 24.3333 23.6667C24.7936 23.6667 25.1666 24.0398 25.1666 24.5V26.1667ZM28.5 18.6667H20.1666V17.8334C20.1666 15.5322 22.0321 13.6667 24.3333 13.6667C26.6345 13.6667 28.5 15.5321 28.5 17.8334V18.6667Z" fill="#2CA670"></path>
                    </svg>
                </div>
                <input type="password" name="password" id="password" class="input-field" placeholder="Password" required>
                <i class="bi bi-eye-fill password-toggle" id="togglePassword"></i>
            </div>

            <div class="forgot-password-container">
                <a href="#" class="forgot-password">Forget your Password?</a>
            </div>

            <button type="submit" class="login-button">Login</button>

            <p class="signup-text">
                Don't have an Account? <a href="{{ route('register') }}" class="signup-link">Sign Up</a>
            </p>
        </form>
    </main>

    <!-- jQuery (needed for Bootstrap and SweetAlert) -->
    <script src="{{ url('assets_user/vendor/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap JS -->
    <script src="{{ url('assets_user/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script>
        // Password toggle functionality
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function(e) {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            
            // toggle the eye / eye slash icon
            this.classList.toggle('bi-eye-slash-fill');
        });

        // Form validation and focus styles
        document.addEventListener('DOMContentLoaded', function() {
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

            // Form validation
            form.addEventListener('submit', function(event) {
                const email = emailInput.value;
                const password = passwordInput.value;
                
                // Basic email validation
                if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                    event.preventDefault();
                    showError('Please enter a valid email address');
                    return;
                }
                
                // Basic password validation
                if (password.length < 6) {
                    event.preventDefault();
                    showError('Password must be at least 6 characters long');
                    return;
                }
            });

            function showError(message) {
                // This will use SweetAlert if available, otherwise fall back to alert()
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