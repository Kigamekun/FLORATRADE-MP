<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Marketplace</title>
    
    <!-- Font -->
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
    max-width: 900px;
    background-color: #fff;
    border-radius: 20px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    z-index: 1;
    height: 650px;
    position: relative;
    overflow: hidden; /* Ensure content respects the border-radius */
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

        /* Updated Input Group Styles */
        .input-group {
          display: flex;
          align-items: center;
          border-radius: 8px;
          min-height: 44px;
          padding: 10px 16px;
          gap: 10px;
          border: 1px solid #dedee0;
          position: relative;
          margin-bottom: 20px;
        }

        .input-group.focused {
          border-color: #2ca670;
          box-shadow: 0 0 0 2px rgba(44, 166, 112, 0.2);
        }

        .input-icon {
          width: 18px;
          height: 18px;
          flex-shrink: 0;
          color: #2CA670;
        }

        .input-field {
          font-family: "Poppins", sans-serif;
          font-size: 16px;
          color: #494c4b;
          flex: 1;
          border: none;
          outline: none;
          background: transparent;
          width: 100%;
          padding: 0;
        }

        .input-field::placeholder {
          color: #dedee0;
        }

        /* Password Input Container */
        .password-input-container {
          display: flex;
          align-items: center;
          border-radius: 8px;
          min-height: 44px;
          padding: 10px 16px;
          border: 1px solid #dedee0;
          position: relative;
          margin-bottom: 20px;
        }

        .password-toggle {
          cursor: pointer;
          color: #494c4b;
          position: absolute;
          right: 16px;
          top: 50%;
          transform: translateY(-50%);
        }

        .login-btn {
          width: calc(100% / 3);
          padding: 10px;
          border: none;
          border-radius: 24px;
          cursor: pointer;
          background-color: #2CA670;
          color: #fff;
          float: right;
          clear: both;
          font-weight: bold;
          font-size: 16px;
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
          width: 350px;
          height: 350px;
          border-radius: 50%;
          object-fit: cover;
          position: absolute;
          top: 50%;
          left: 50%;
          transform: translate(-50%, -65%);
          margin: 0;
          z-index: 1;
        }

        .plant-circle-top {
          width: 180px;
          height: 180px;
          border-radius: 50%;
          object-fit: cover;
          position: absolute;
          top: 20%;
          left: 30%;
          z-index: 1;
          opacity: 1;
          transform: translate(-70%, -15%);
        }

        .leaf-on-plant {
          position: absolute;
          top: 50%;
          left: 10%;
          transform: translate(-35%, -75%) rotate(20deg);
          width: 120px;
          z-index: 4;
        }

        .leaf-on-plant-down {
          position: absolute;
          top: 50%;
          left: 5%;
          transform: translate(-20%, -55%) rotate(-5deg);
          width: 120px;
          z-index: 4;
        }

        .leaf-middle-right {
          position: absolute;
          top: 40%;
          right: 15%;
          transform: translate(70%, -135%) rotate(15deg);
          width: 100px;
          z-index: 2;
        }

        .leaf-middle-right-up {
          position: absolute;
          top: 30%;
          right: 10%;
          transform: translate(0%, -105%) rotate(-15deg);
          width: 100px;
          z-index: 2;
        }

        .signup-link {
          position: absolute;
          bottom: 30px;
          left: 50%;
          transform: translateX(-50%);
          color: #88e0aa;
          text-decoration: none;
          font-size: 14px;
          display: block;
          margin-top: 30px;
        }

        .bottom-plant {
          position: absolute;
          bottom: 10px;
          left: 50%;
          transform: translate(-70%, 3%);
          width: 200px;
          z-index: -1;
        }

        .bottom-right-plant {
          position: absolute;
          bottom: 10px;
          right: 10px;
          width: 350px;
          z-index: 1;
          transform: translate(-13%, 0%) rotate(20deg);
        }

        /* Error styles */
        .input-error {
          border-color: #e53e3e;
        }

        .error-message {
          color: #e53e3e;
          font-size: 12px;
          margin-top: 4px;
          position: absolute;
          bottom: -18px;
          left: 16px;
        }
    </style>
</head>

<body>
  <!-- Standalone Middle Plant -->
  <

  <div class="login-container">
    
    <!-- Left Side: Register Form -->
    <div class="login-form">
      <form method="POST" action="{{ route('register') }}">
        @csrf
        <h2>Create a New Account</h2>
        <p>Join us and start your experience today.</p>

        <!-- Name Input -->
        <div class="input-group">
          <div class="input-icon">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M8 8C10.21 8 12 6.21 12 4C12 1.79 10.21 0 8 0C5.79 0 4 1.79 4 4C4 6.21 5.79 8 8 8ZM8 10C5.33 10 0 11.34 0 14V16H16V14C16 11.34 10.67 10 8 10Z" fill="currentColor"/>
            </svg>
          </div>
          <input type="text" id="name" name="name" class="input-field" placeholder="Name" value="{{ old('name') }}" required autofocus>
        </div>

        <!-- Email Input -->
        <div class="input-group">
          <div class="input-icon">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M15.9693 3.69458L10.3573 9.30658C9.73158 9.93075 8.88383 10.2813 8 10.2813C7.11617 10.2813 6.26842 9.93075 5.64267 9.30658L0.0306667 3.69458C0.0213333 3.79991 0 3.89525 0 3.99991V11.9999C0.001059 12.8836 0.352588 13.7309 0.97748 14.3558C1.60237 14.9807 2.4496 15.3322 3.33333 15.3332H12.6667C13.5504 15.3322 14.3976 14.9807 15.0225 14.3558C15.6474 13.7309 15.9989 12.8836 16 11.9999V3.99991C16 3.89525 15.9787 3.79991 15.9693 3.69458Z" fill="currentColor"></path>
              <path d="M9.41476 8.36408L15.5041 2.27408C15.2091 1.78496 14.7931 1.38011 14.2961 1.09857C13.7991 0.81703 13.2379 0.668308 12.6668 0.666748H3.33343C2.76224 0.668308 2.20109 0.81703 1.70411 1.09857C1.20713 1.38011 0.791079 1.78496 0.496094 2.27408L6.58543 8.36408C6.96114 8.73829 7.46982 8.94839 8.00009 8.94839C8.53037 8.94839 9.03905 8.73829 9.41476 8.36408Z" fill="currentColor"></path>
            </svg>
          </div>
          <input type="email" id="email" name="email" class="input-field" placeholder="Email Address" value="{{ old('email') }}" required>
        </div>

        <!-- Phone Input -->
        <div class="input-group">
          <div class="input-icon">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M14.6667 10.6667V13.3333C14.6667 14.0697 14.0697 14.6667 13.3333 14.6667H2.66667C1.93029 14.6667 1.33333 14.0697 1.33333 13.3333V2.66667C1.33333 1.93029 1.93029 1.33333 2.66667 1.33333H5.33333" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M14.6667 6.66667V1.33333H9.33333" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M9.33333 1.33333L14.6667 6.66667" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
          <input type="tel" id="phone" name="phone" class="input-field" placeholder="Phone Number" value="{{ old('phone') }}" required>
        </div>

        <!-- Address Textarea -->
        <div class="input-group">
          <div class="input-icon">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M8 8.83333C9.19608 8.83333 10.1667 7.86274 10.1667 6.66667C10.1667 5.47059 9.19608 4.5 8 4.5C6.80392 4.5 5.83333 5.47059 5.83333 6.66667C5.83333 7.86274 6.80392 8.83333 8 8.83333Z" stroke="currentColor" stroke-width="1.5"/>
              <path d="M13.8333 6.66667C13.8333 11.5 8 14.8333 8 14.8333C8 14.8333 2.16667 11.5 2.16667 6.66667C2.16667 5.28696 2.71488 3.96354 3.69373 2.98469C4.67257 2.00585 5.99599 1.45764 7.37567 1.45764C8.75534 1.45764 10.0788 2.00585 11.0576 2.98469C12.0365 3.96354 12.5847 5.28696 12.5847 6.66667H13.8333Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
          <textarea id="address" name="address" class="input-field" rows="2" placeholder="Address" required>{{ old('address') }}</textarea>
        </div>

        <!-- Password Input -->
        <div class="password-input-container">
          <div class="input-icon">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M12 5.33333H3.99999C2.52724 5.33333 1.33333 6.52724 1.33333 8V12C1.33333 13.4728 2.52724 14.6667 3.99999 14.6667H12C13.4728 14.6667 14.6667 13.4728 14.6667 12V8C14.6667 6.52724 13.4728 5.33333 12 5.33333Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M4.66667 5.33333V3.33333C4.66667 2.8029 4.87738 2.29419 5.25245 1.91912C5.62753 1.54405 6.13623 1.33333 6.66667 1.33333H9.33334C9.86377 1.33333 10.3725 1.54405 10.7475 1.91912C11.1226 2.29419 11.3333 2.8029 11.3333 3.33333V5.33333" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M8 10.6667C8.36819 10.6667 8.66667 10.3682 8.66667 10C8.66667 9.63181 8.36819 9.33333 8 9.33333C7.63181 9.33333 7.33333 9.63181 7.33333 10C7.33333 10.3682 7.63181 10.6667 8 10.6667Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
          <input type="password" id="password" name="password" class="input-field" placeholder="Password" required autocomplete="new-password">
          <i class="bi bi-eye-slash-fill password-toggle" id="togglePassword1"></i>
        </div>

        <!-- Confirm Password Input -->
        <div class="password-input-container">
          <div class="input-icon">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M12 5.33333H3.99999C2.52724 5.33333 1.33333 6.52724 1.33333 8V12C1.33333 13.4728 2.52724 14.6667 3.99999 14.6667H12C13.4728 14.6667 14.6667 13.4728 14.6667 12V8C14.6667 6.52724 13.4728 5.33333 12 5.33333Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M4.66667 5.33333V3.33333C4.66667 2.8029 4.87738 2.29419 5.25245 1.91912C5.62753 1.54405 6.13623 1.33333 6.66667 1.33333H9.33334C9.86377 1.33333 10.3725 1.54405 10.7475 1.91912C11.1226 2.29419 11.3333 2.8029 11.3333 3.33333V5.33333" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M8 10.6667C8.36819 10.6667 8.66667 10.3682 8.66667 10C8.66667 9.63181 8.36819 9.33333 8 9.33333C7.63181 9.33333 7.33333 9.63181 7.33333 10C7.33333 10.3682 7.63181 10.6667 8 10.6667Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
          <input type="password" id="password_confirmation" name="password_confirmation" class="input-field" placeholder="Confirm Password" required>
          <i class="bi bi-eye-slash-fill password-toggle" id="togglePassword2"></i>
        </div>

        <button type="submit" class="login-btn">Register</button>

        <!-- Already have an account? -->
        <a href="{{ route('login') }}" class="signup-link"> Already have an account?</a>
      </form>
    </div>

    <!-- Right Side: Visual Section -->
    <div class="visual-section">
        <img src="{{ asset('assets/img/melanie-magdalena-9CMeB8-olUA-unsplash.jpg') }}" alt="Cropped Plant" class="plant-cropped">
        <!-- Add this new circle -->
        <img src="{{ asset('assets/img/shelley-johnson-9E-byP974NQ-unsplash.jpg') }}" alt="Decorative Plant Circle" class="plant-circle-top">
        <!-- Keep all existing leaf elements below -->
        <img src="{{ asset('assets/img/leave 1.png') }}" alt="Leaf" class="leaf-on-plant">
        <img src="{{ asset('assets/img/leave 1.png') }}" alt="Leaf" class="leaf-on-plant-down">
        <!-- Rest of your existing elements... -->
    </div>

    <!-- Additional Leaf Icons -->
    <img src="{{ asset('assets/img/leave1 1.png') }}" alt="Leaf" class="leaf-middle-right">
    <img src="{{ asset('assets/img/leave1 1.png') }}" alt="Leaf" class="leaf-middle-right-up">
    <img src="assets/aaaa.png" alt="Plant in Pot" class="bottom-plant">

    <!-- Bottom right plant -->
    <img src="{{ asset('assets/img/Picture7.png') }}" 
    alt="Bottom Right Plant" 
    class="bottom-right-plant">
  </div>

  <!-- JavaScript for Toggle Password Visibility -->
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      // Focus effects for input fields
      const inputGroups = document.querySelectorAll('.input-group, .password-input-container');
      inputGroups.forEach(group => {
        const input = group.querySelector('.input-field');
        input.addEventListener('focus', () => {
          group.classList.add('focused');
        });
        input.addEventListener('blur', () => {
          if (!input.value) {
            group.classList.remove('focused');
          }
        });
      });

      // Password toggle functionality
      const togglePassword1 = document.querySelector('#togglePassword1');
      const password1 = document.querySelector('#password');

      const togglePassword2 = document.querySelector('#togglePassword2');
      const password2 = document.querySelector('#password_confirmation');

      if (togglePassword1 && password1) {
        togglePassword1.addEventListener('click', function (e) {
          const type = password1.getAttribute('type') === 'password' ? 'text' : 'password';
          password1.setAttribute('type', type);
          this.classList.toggle('bi-eye-slash-fill');
          this.classList.toggle('bi-eye-fill');
        });
      }

      if (togglePassword2 && password2) {
        togglePassword2.addEventListener('click', function (e) {
          const type = password2.getAttribute('type') === 'password' ? 'text' : 'password';
          password2.setAttribute('type', type);
          this.classList.toggle('bi-eye-slash-fill');
          this.classList.toggle('bi-eye-fill');
        });
      }

      // Form validation
      const form = document.querySelector('form');
      const inputs = form.querySelectorAll('.input-field');

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
        
        // Clear previous errors
        document.querySelectorAll('.error-message').forEach(el => el.remove());
        document.querySelectorAll('.input-error').forEach(el => el.classList.remove('input-error'));
        
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