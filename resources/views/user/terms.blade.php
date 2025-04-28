@extends('layouts.base_user')

@section('content')
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Terms and Conditions - FloraTrade</title>
    <link rel="stylesheet" href="{{ asset('css/terms.css') }}">
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
      rel="stylesheet"
    />
  </head>
  <body>
    <!-- Updated Header -->

    <main class="terms-container">
      <section class="hero-section">
        <img src="https://cdn.builder.io/api/v1/image/assets/282631be213f4cdc9e5c0d357acf295c/c3e5c5498d672cb672fbcf378f295792e4fc8d58?placeholderIfAbsent=true" class="hero-image" alt="Terms and Conditions Banner" />
        <div class="hero-overlay">
          <div class="hero-content">
            <h1 class="hero-title">Know the Rules, Enjoy the Benefits!</h1>
            <p class="hero-description">
              Understanding our Terms and Conditions ensures a smooth and secure
              shopping experience.
            </p>
          </div>
        </div>
      </section>

      <section class="terms-content">
        <h2 class="terms-title">Terms and Condition</h2>

        <h3 class="terms-section-title">1. Penggunaan Layanan</h3>
        <p class="terms-text">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do
          eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
          minim veniam, quis nostrud exercitation ullamco laboris nisi ut
          aliquip ex ea commodo consequat. Duis aute irure dolor in
          reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
          pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
          culpa qui officia deserunt mollit anim id est laborum.
        </p>

        <h3 class="terms-section-title">2. Hak dan Kewajiban Pengguna</h3>
        <p class="terms-text">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do
          eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
          minim veniam, quis nostrud exercitation ullamco laboris nisi ut
          aliquip ex ea commodo consequat. Duis aute irure dolor in
          reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
          pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
          culpa qui officia deserunt mollit anim id est laborum.
        </p>

        <h3 class="terms-section-title">3. Kebijakan Privasi</h3>
        <p class="terms-text">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do
          eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
          minim veniam, quis nostrud exercitation ullamco laboris nisi ut
          aliquip ex ea commodo consequat. Duis aute irure dolor in
          reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
          pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
          culpa qui officia deserunt mollit anim id est laborum.
        </p>
      </section>

      <!-- Updated Footer -->
      <footer class="footer">
        <div class="footer__container">
          <div class="footer__content">
            <div class="footer__brand">
              <h1 class="footer__logo">FloraTrade</h1>
              <p class="footer__tagline">
                Bringing Nature Closer to You with the Best Plants, the Best
                Prices, and the Best Care.
                <br />
                Your satisfaction and comfort is our priority.
              </p>
            </div>
      
            <nav class="footer__links">
              <a href="#" class="footer__link">Home</a>
              <a href="#" class="footer__link">About FloraTrade</a>
              <a href="#" class="footer__link">Explore Plants</a>
              <a href="#" class="footer__link">Price List</a>
              <a href="#" class="footer__link">FAQ</a>
              <a href="#" class="footer__link">Terms &amp; Condition</a>
            </nav>
      
            <div class="footer__contact">
              <h3 class="footer__contact-title">Contact Us</h3>
              
              <div class="footer__contact-item">
                <img src="img/phone-icon.png" alt="Phone" class="footer__contact-icon">
                <span class="footer__contact-text">+6280123719310</span>
              </div>
      
              <div class="footer__contact-item">
                <img src="img/email-icon.png" alt="Email" class="footer__contact-icon">
                <span class="footer__contact-text">floratrade9@gmail.com</span>
              </div>
      
              <div class="footer__contact-item">
                <img src="img/location-icon.png" alt="Location" class="footer__contact-icon">
                <span class="footer__contact-text">Curug Mekar - Bogor Barat, Bogor, Jawa Barat</span>
              </div>
            </div>
          </div>
        </div>
      </footer>
    </main>

    <script src="script.js"></script>
  </body>
@endsection

@section('js')

<script src="{{ url('assets/vendor/jquery/jquery.min.js') }}"></script>
@endsection
