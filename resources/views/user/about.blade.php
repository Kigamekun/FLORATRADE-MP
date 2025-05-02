@extends('layouts.base_user')

@section('content')
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>About FloraTrade</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/about.css') }}">
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
      rel="stylesheet"
    />
  </head>
  <body>
    <section class="about-page">
      <!-- Updated Header -->


      <img src="https://cdn.builder.io/api/v1/image/assets/282631be213f4cdc9e5c0d357acf295c/0386b1cf6c1495cdb8526a3a4c300e47b94c8461?placeholderIfAbsent=true" alt="FloraTrade Banner" class="hero-image" />

      <main class="about-section" data-el="div-1">
        <div class="about-container">
          <div class="about-columns">
            <div class="image-column">
              <img src="https://cdn.builder.io/api/v1/image/assets/282631be213f4cdc9e5c0d357acf295c/22ef7e57322870ae52dec495cf35f84b406e0a32?placeholderIfAbsent=true" alt="Klorofil Farm" class="farm-image" />
            </div>
            <div class="content-column">
              <div class="content-wrapper">
                <h1 class="about-title">About Klorofil Farm</h1>
                <p class="about-description">
                  FloraTrade Indonesia is one of the exporters of agricultural
                  products, especially ornamental plants in Indonesia.
                  FloraTrade Indonesia also cares about all Indonesian farmers.
                  Through this website development program, we provide access to
                  farmers to be able to reach global markets and expand their
                  business reach. FloraTrade Indonesia also has an ornamental
                  plant marketplace that can be used to send and buy ornamental
                  plants and send them wherever they want.
                </p>
                <div class="stats-container">
                  <div class="stat-item">
                    <h2 class="stat-number">230+</h2>
                    <p class="stat-label">Country Destination</p>
                  </div>
                  <div class="stat-item">
                    <h2 class="stat-number">50+</h2>
                    <p class="stat-label">Plant Entrepreneur</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>

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
    </section>
    @endsection

    <script src="(104) script.ts"></script>
  </body>
</html>