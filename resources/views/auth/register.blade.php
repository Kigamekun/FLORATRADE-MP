<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Marketplace</title>
    
    <!-- Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ url('assets_user/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets_user/vendor/bootstrap/icons-1.7.2/font/bootstrap-icons.css') }}">

    <style>
        * {
          margin: 0;
          padding: 0;
          box-sizing: border-box;
        }

        body {
          font-family: "Poppins", -apple-system, Roboto, Helvetica, sans-serif;
          font-size: 16px;
          color: #dedee0;
          font-weight: 400;
          background-color: #f5f5f5;
          display: flex;
          justify-content: center;
          align-items: center;
          min-height: 100vh;
        }

        .registration-container {
          background-color: rgba(245, 245, 245, 1);
          display: flex;
          padding: 128px 80px 311px;
          flex-direction: column;
          overflow: hidden;
          align-items: center;
          width: 100%;
        }

        .registration-form {
          border-radius: 16px;
          box-shadow: 0px 1px 2px 0px rgba(0, 0, 0, 0.3), 0px 2px 6px 2px rgba(0, 0, 0, 0.15);
          background-color: #fff;
          display: flex;
          width: 510px;
          max-width: 100%;
          padding: 38px 40px;
          flex-direction: column;
          overflow: hidden;
          align-items: stretch;
        }

        .form-header {
          text-align: center;
          margin-bottom: 34px;
        }

        .form-title {
          color: rgba(44, 166, 112, 1);
          font-size: 31px;
          font-weight: 600;
          margin-bottom: 5px;
        }

        .form-subtitle {
          color: #494c4b;
          font-size: 13px;
        }

        .form-fields {
          display: flex;
          flex-direction: column;
          gap: 21px;
        }

        .input-group {
          display: flex;
          align-items: center;
          border-radius: 8px;
          min-height: 44px;
          padding: 10px 16px;
          gap: 10px;
          border: 1px solid #dedee0;
          position: relative;
        }

        .input-icon {
          width: 18px;
          height: 18px;
          flex-shrink: 0;
        }

        .form-input {
          border: none;
          outline: none;
          width: 100%;
          font-family: "Poppins", -apple-system, Roboto, Helvetica, sans-serif;
          font-size: 16px;
          color: #494c4b;
          flex: 1;
          padding: 0;
          background: transparent;
        }

        .form-input::placeholder {
          color: #dedee0;
        }

        .password-input-container {
          display: flex;
          align-items: center;
          border-radius: 8px;
          min-height: 44px;
          padding: 10px 16px;
          border: 1px solid #dedee0;
          position: relative;
        }

        .password-toggle {
          cursor: pointer;
          color: #494c4b;
          position: absolute;
          right: 16px;
          top: 50%;
          transform: translateY(-50%);
        }

        .password-input-container {
        padding-right: 40px; /* Increased right padding to prevent text under icon */
        }

        /* To add space between the lock icon and the input */
        .input-icon {
        margin-right: 12px; /* Adds space between icon and input */
        }

        .register-button {
          align-self: center;
          border-radius: 24px;
          background-color: rgba(44, 166, 112, 1);
          margin-top: 48px;
          min-height: 48px;
          width: 228px;
          max-width: 100%;
          padding: 12px 32px;
          border: none;
          color: #fff;
          font-weight: 700;
          font-family: "Poppins", -apple-system, Roboto, Helvetica, sans-serif;
          font-size: 16px;
          cursor: pointer;
          text-align: center;
        }

        .register-button:hover {
          background-color: #259a64;
        }

        .login-link {
          color: #494c4b;
          text-align: center;
          font-size: 10px;
          font-weight: 300;
          margin-top: 21px;
        }

        /* Focus styles */
        .input-group.focused,
        .password-input-container.focused {
          border-color: #2ca670;
          box-shadow: 0 0 0 2px rgba(44, 166, 112, 0.2);
        }

        /* Error styles */
        .input-error {
          border-color: #e53e3e;
        }

        .error-message {
          color: #e53e3e;
          font-size: 12px;
          margin-top: 4px;
        }

        /* Textarea styles */
        textarea.form-input {
          resize: none;
          height: auto;
          min-height: 44px;
          line-height: 1.5;
        }

        /* Media Queries */
        @media (max-width: 991px) {
          .registration-container {
            padding: 100px 20px;
          }

          .registration-form {
            padding: 38px 20px;
          }

          .register-button {
            padding: 12px 20px;
            margin-top: 40px;
          }
        }

        @media (max-width: 640px) {
          .registration-container {
            padding: 60px 20px;
          }
          
          .form-title {
            font-size: 24px;
          }
          
          .form-subtitle {
            font-size: 12px;
          }
        }
    </style>
</head>

<body>
    <main class="registration-container">
        <form class="registration-form" method="POST" action="{{ route('register') }}">
            @csrf
            <header class="form-header">
                <h1 class="form-title">Create a New Account</h1>
                <p class="form-subtitle">Join us and start your experience today!</p>
            </header>

            <section class="form-fields">
                <div class="input-group">
                    <img src="{{ url('assets_user/img/iconUser.svg') }}" class="input-icon" alt="Name icon" />
                    <input type="text" name="name" id="name" class="form-input" placeholder="Name" value="{{ old('name') }}" required autofocus />
                </div>

                <div class="input-group">
                    <img src="{{ url('assets_user/img/email 1.svg') }}" class="input-icon" alt="Email icon" />
                    <input type="email" name="email" id="email" class="form-input" placeholder="Email" value="{{ old('email') }}" required />
                </div>

                <div class="input-group">
                    <img src="{{ url('assets_user/img/telephone 1.svg') }}" class="input-icon" alt="Phone icon" />
                    <input type="tel" name="phone" id="phone" class="form-input" placeholder="Phone" value="{{ old('phone') }}" required />
                </div>

                <div class="input-group">
                    <img src="{{ url('assets_user/img/location 4.svg') }}" class="input-icon" alt="Address icon" />
                    <textarea name="address" id="address" class="form-input" placeholder="Address" required>{{ old('address') }}</textarea>
                </div>

                <div class="password-input-container">
                    <img src="{{ url('assets_user/img/iconLock.svg') }}" class="input-icon" alt="Password icon" />
                    <input type="password" name="password" id="password" class="form-input" placeholder="Password" required autocomplete="new-password" />
                    <i class="bi bi-eye-fill password-toggle" id="togglePassword1"></i>
                </div>

                <div class="password-input-container">
                    <img src="{{ url('assets_user/img/iconLock.svg') }}" class="input-icon" alt="Confirm Password icon" />
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-input" placeholder="Confirm Password" required />
                    <i class="bi bi-eye-fill password-toggle" id="togglePassword2"></i>
                </div>
            </section>

            <button type="submit" class="register-button">Register</button>

            <p class="login-link">
                Already have an account?
            </p>
        </form>
    </main>

    <!-- jQuery -->
    <script src="{{ url('assets_user/vendor/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap JS -->
    <script src="{{ url('assets_user/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script>
        // Password toggle functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle for first password field
            const togglePassword1 = document.querySelector('#togglePassword1');
            const password1 = document.querySelector('#password');
            
            // Toggle for confirm password field
            const togglePassword2 = document.querySelector('#togglePassword2');
            const password2 = document.querySelector('#password_confirmation');

            togglePassword1.addEventListener('click', function(e) {
                const type = password1.getAttribute('type') === 'password' ? 'text' : 'password';
                password1.setAttribute('type', type);
                this.classList.toggle('bi-eye-slash-fill');
            });

            togglePassword2.addEventListener('click', function(e) {
                const type = password2.getAttribute('type') === 'password' ? 'text' : 'password';
                password2.setAttribute('type', type);
                this.classList.toggle('bi-eye-slash-fill');
            });

            // Form validation
            const form = document.querySelector('.registration-form');
            const inputs = form.querySelectorAll('.form-input');

            inputs.forEach(input => {
                // Add focus/blur event listeners for styling
                input.addEventListener('focus', () => {
                    const parent = input.closest('.input-group') || input.closest('.password-input-container');
                    parent?.classList.add('focused');
                });
                
                input.addEventListener('blur', () => {
                    const parent = input.closest('.input-group') || input.closest('.password-input-container');
                    if (!input.value) {
                        parent?.classList.remove('focused');
                    }
                });
            });

            // Form submission validation
            form.addEventListener('submit', function(event) {
                let isValid = true;
                const name = document.getElementById('name').value;
                const email = document.getElementById('email').value;
                const phone = document.getElementById('phone').value;
                const address = document.getElementById('address').value;
                const password = document.getElementById('password').value;
                const confirmPassword = document.getElementById('password_confirmation').value;
                
                // Name validation
                if (name.trim().length < 2) {
                    showError('name', 'Name must be at least 2 characters');
                    isValid = false;
                }
                
                // Email validation
                if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                    showError('email', 'Please enter a valid email address');
                    isValid = false;
                }
                
                // Phone validation
                if (!/^\+?[0-9]{10,15}$/.test(phone.replace(/\s/g, ''))) {
                    showError('phone', 'Please enter a valid phone number');
                    isValid = false;
                }
                
                // Address validation
                if (address.trim().length === 0) {
                    showError('address', 'Address is required');
                    isValid = false;
                }
                
                // Password validation
                if (password.length < 8) {
                    showError('password', 'Password must be at least 8 characters');
                    isValid = false;
                } else if (!/(?=.*[A-Za-z])(?=.*\d)/.test(password)) {
                    showError('password', 'Password must contain letters and numbers');
                    isValid = false;
                }
                
                // Confirm password validation
                if (password !== confirmPassword) {
                    showError('password_confirmation', 'Passwords do not match');
                    isValid = false;
                }
                
                if (!isValid) {
                    event.preventDefault();
                }
            });

            function showError(fieldId, message) {
                // Remove any existing error
                removeError(fieldId);
                
                const field = document.getElementById(fieldId);
                const parent = field.closest('.input-group') || field.closest('.password-input-container');
                
                // Add error class
                parent.classList.add('input-error');
                
                // Create error message element
                const errorElement = document.createElement('p');
                errorElement.className = 'error-message';
                errorElement.textContent = message;
                
                parent.appendChild(errorElement);
            }
            
            function removeError(fieldId) {
                const field = document.getElementById(fieldId);
                const parent = field.closest('.input-group') || field.closest('.password-input-container');
                const errorMessage = parent?.querySelector('.error-message');
                
                if (errorMessage) {
                    parent.removeChild(errorMessage);
                }
                
                parent.classList.remove('input-error');
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