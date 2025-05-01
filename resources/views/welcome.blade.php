@extends('layouts.base_user')

@section('content')
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FloraTrade - Find Your Dream Plants</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  </head>
  <body>
    <section class="hero">
      <div class="container">
        <div class="hero__content">
          <div class="hero__text">
            <h1 class="hero__title">Find your Dream<br />Plants Here</h1>
            <p class="hero__description">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do
              eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
              enim ad minim veniam, quis nostrud exercitation ullamco laboris
              nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
              reprehenderit in voluptate velit esse cillum dolore eu fugiat
              nulla pariatur. Excepteur sint occaecat cupidatat non proident,
              sunt in culpa qui officia deserunt mollit anim id est laborum.
            </p>
            <div class="search-bar">
              <input
                type="text"
                placeholder="Search"
                class="search-bar__input"
              />
              <img src="https://cdn.builder.io/api/v1/image/assets/282631be213f4cdc9e5c0d357acf295c/400273b5e43afcb2d7f46724c298077477423c7b?placeholderIfAbsent=true" alt="Search" class="search-bar__icon" />
            </div>
            <div class="hero__cta">
              <button class="btn btn--text">Explore More</button>
              <img src="https://cdn.builder.io/api/v1/image/assets/282631be213f4cdc9e5c0d357acf295c/8519a136b218fd83e8a234c27fbbd37cc10b92c2?placeholderIfAbsent=true" alt="Arrow" class="hero__cta-icon" />
            </div>
          </div>
          <div class="hero__image">
            <img src="https://cdn.builder.io/api/v1/image/assets/282631be213f4cdc9e5c0d357acf295c/aa96e36c75e5017050c5b7f73817562d78d3fbb4?placeholderIfAbsent=true" alt="Plant" class="hero__img" />
          </div>
        </div>
      </div>
    </section>

    <section class="products">
      <div class="container">
        <div class="products__layout">
          <aside class="filter-panel">
            <div class="filter-panel__header">
              <img src="https://cdn.builder.io/api/v1/image/assets/282631be213f4cdc9e5c0d357acf295c/d05381a30c07000c2579d0865c43b11d8f686b4a?placeholderIfAbsent=true" alt="Filter" class="filter-panel__icon" />
              <h2 class="filter-panel__title">Filters</h2>
            </div>
            <h3 class="filter-panel__subtitle">Prices</h3>
            <img src="https://cdn.builder.io/api/v1/image/assets/282631be213f4cdc9e5c0d357acf295c/44b50f73c4fb9dad14d05aa2876843fa3137dd81?placeholderIfAbsent=true" alt="Price Range" class="filter-panel__range" />
            <div class="filter-panel__price-range">
              <span class="filter-panel__price">$2</span>
              <span class="filter-panel__price">$5</span>
            </div>
            <h3 class="filter-panel__subtitle">Varietas</h3>
            <label class="filter-option">
              <span class="filter-option__checkbox"></span>
              <span class="filter-option__label">Philodendron</span>
            </label>
            <label class="filter-option">
              <span class="filter-option__checkbox"></span>
              <span class="filter-option__label">Anthurium</span>
            </label>
            <label class="filter-option">
              <span class="filter-option__checkbox"></span>
              <span class="filter-option__label">Aglaonema</span>
            </label>
            <div class="filter-panel__actions">
              <button class="filter-panel__btn filter-panel__btn--reset">
                Reset
              </button>
              <button class="filter-panel__btn filter-panel__btn--apply">
                Apply
              </button>
            </div>
          </aside>
          <main class="product-grid">
            <div class="product-grid__header">
              <img src="https://cdn.builder.io/api/v1/image/assets/282631be213f4cdc9e5c0d357acf295c/bae6c7296546594691d429556149426dd736ff2d?placeholderIfAbsent=true" alt="Best Offer" class="product-grid__icon" />
              <h2 class="product-grid__title">Best Offer From Us</h2>
            </div>
            <div class="product-grid__row">
              <article class="product-card">
                <img
                  src="https://cdn.builder.io/api/v1/image/assets/282631be213f4cdc9e5c0d357acf295c/f728f3503707ca082e6065a3f8f2982688450321?placeholderIfAbsent=true"
                  alt="Plant Anggrek"
                  class="product-card__image"
                />
                <div class="product-card__content">
                  <div class="product-card__info">
                    <h3 class="product-card__name">Plant Anggrek</h3>
                    <span class="product-card__price">$5</span>
                  </div>
                  <div class="product-card__stats">
                    <span class="product-card__rating">4.9</span>
                    <span class="product-card__sold">100 sold</span>
                  </div>
                </div>
              </article>
              <article class="product-card">
                <img
                  src="https://cdn.builder.io/api/v1/image/assets/282631be213f4cdc9e5c0d357acf295c/f728f3503707ca082e6065a3f8f2982688450321?placeholderIfAbsent=true"
                  alt="Plant Anggrek"
                  class="product-card__image"
                />
                <div class="product-card__content">
                  <div class="product-card__info">
                    <h3 class="product-card__name">Plant Anggrek</h3>
                    <span class="product-card__price">$5</span>
                  </div>
                  <div class="product-card__stats">
                    <span class="product-card__rating">4.9</span>
                    <span class="product-card__sold">100 sold</span>
                  </div>
                </div>
              </article>

            </div>
          </main>
        </div>
      </div>
    </section>

    <section class="request">
      <div class="container">
        <h2 class="request__title">
          Request the Plant You've Been Looking For
        </h2>
        <p class="request__description">
          Can't find the plant you're looking for? Request It, and we'll bring
          it to you!
        </p>
        <div class="request__content">
          <form class="request__form">
            <input
              type="text"
              placeholder="Varietes Name"
              class="request__input"
            />
            <input
              type="text"
              placeholder="Plants Name"
              class="request__input"
            />
            <button type="submit" class="btn btn--light">Send Request</button>
          </form>
          <div class="request__image">
            <img src="https://cdn.builder.io/api/v1/image/assets/282631be213f4cdc9e5c0d357acf295c/9acea3c4d57c72542e777bc2209d9932a7669a7e?placeholderIfAbsent=true" alt="Plant Request" class="request__img" />
          </div>
        </div>
      </div>
    </section>

    <section class="how-we-work">
      <div class="container">
        <div class="how-we-work__header">
          <h2 class="how-we-work__title">How We Work ?</h2>
          <p class="how-we-work__description">
            Make space in your home for plants. you will feel better for it.
            <br />
            Not only are they beautiful, but caring for them helps us.
          </p>
        </div>
        <div class="how-we-work__features">
          <article class="feature">
            <div class="feature__icon-container">
              <img src= "{{ asset('assets/img/Group 69.png') }}">
                <circle cx="25" cy="25" r="25" fill="white" />
                <path
                  d="M46.487 41.142L41.812 33.388C41.47 32.824 40.989 32.358 40.415 32.034C39.842 31.71 39.194 31.538 38.535 31.536H34.865V30.991C34.865 30.204 34.71 29.424 34.408 28.698C34.106 27.971 33.663 27.311 33.105 26.756C31.978 25.632 30.451 25.001 28.859 25H7.008C5.819 24.992 4.655 25.339 3.664 25.997C2.673 26.655 1.901 27.594 1.447 28.693C1.146 29.421 0.994 30.203 1 30.991V50.598C1.001 51.519 1.336 52.408 1.943 53.101C2.549 53.794 3.386 54.244 4.299 54.367C4.288 54.564 4.288 54.76 4.299 54.956C4.291 55.884 4.471 56.804 4.827 57.662C5.184 58.519 5.71 59.295 6.374 59.944C7.025 60.622 7.805 61.164 8.668 61.538C9.53 61.911 10.459 62.11 11.399 62.122C13.276 62.105 15.071 61.354 16.4 60.029C17.729 58.707 18.484 56.915 18.502 55.041C18.513 54.86 18.513 54.679 18.502 54.498H30.56C30.548 54.679 30.548 54.86 30.56 55.041C30.551 55.97 30.731 56.891 31.088 57.748C31.444 58.606 31.97 59.382 32.635 60.031C33.286 60.71 34.067 61.252 34.931 61.626C35.794 62 36.723 62.198 37.664 62.209C39.541 62.192 41.336 61.441 42.666 60.117C43.993 58.794 44.747 57.002 44.765 55.129C44.776 54.947 44.776 54.765 44.765 54.584H46.419C46.851 54.577 47.264 54.404 47.57 54.099C47.875 53.794 48.051 53.382 48.059 52.951V46.656C48.059 44.708 47.514 42.799 46.487 41.142ZM15.201 54.954C15.202 55.454 15.101 55.949 14.906 56.41C14.711 56.871 14.425 57.287 14.065 57.635C13.337 58.327 12.371 58.712 11.366 58.712C10.362 58.712 9.396 58.327 8.667 57.635C8.313 57.281 8.031 56.859 7.841 56.396C7.65 55.932 7.553 55.435 7.556 54.934C7.545 54.416 7.65 53.903 7.862 53.43C8.151 52.745 8.648 52.167 9.28 51.773C9.927 51.346 10.689 51.126 11.465 51.143C12.205 51.143 12.927 51.362 13.54 51.773C14.168 52.174 14.662 52.749 14.962 53.43C15.177 53.901 15.291 54.415 15.288 54.934L15.201 54.954ZM22.301 44.062H11.379C10.801 44.062 10.247 43.832 9.837 43.424C9.427 43.016 9.196 42.463 9.193 41.884C9.192 41.598 9.248 41.313 9.358 41.048C9.468 40.783 9.629 40.543 9.832 40.34C10.035 40.137 10.276 39.977 10.541 39.868C10.806 39.759 11.09 39.703 11.377 39.704H22.301C22.88 39.705 23.434 39.935 23.843 40.344C24.252 40.752 24.483 41.306 24.486 41.884C24.486 42.171 24.43 42.455 24.32 42.72C24.21 42.984 24.049 43.225 23.846 43.427C23.643 43.63 23.402 43.79 23.137 43.899C22.872 44.008 22.588 44.063 22.301 44.062ZM22.301 36.568H11.379C10.801 36.567 10.247 36.338 9.837 35.93C9.427 35.522 9.196 34.968 9.193 34.39C9.192 34.103 9.249 33.819 9.359 33.555C9.468 33.29 9.629 33.049 9.832 32.847C10.035 32.645 10.276 32.484 10.541 32.375C10.806 32.266 11.091 32.211 11.377 32.212H22.301C22.879 32.213 23.433 32.443 23.842 32.851C24.252 33.259 24.483 33.812 24.486 34.39C24.486 34.677 24.43 34.96 24.32 35.225C24.21 35.49 24.049 35.731 23.846 35.933C23.643 36.135 23.402 36.296 23.137 36.405C22.872 36.513 22.588 36.569 22.301 36.568ZM41.418 54.954C41.418 55.454 41.318 55.949 41.122 56.41C40.927 56.871 40.64 57.287 40.28 57.635C39.552 58.326 38.586 58.711 37.582 58.711C36.578 58.711 35.613 58.326 34.885 57.635C34.529 57.281 34.248 56.86 34.057 56.396C33.865 55.932 33.768 55.435 33.771 54.934C33.761 54.14 34.015 53.366 34.493 52.732C35.031 52.016 35.804 51.506 36.677 51.294H37.224C37.324 51.27 37.429 51.27 37.529 51.294H37.966C38.63 51.37 39.262 51.618 39.801 52.014C40.341 52.41 40.764 52.944 41.024 53.561C41.241 54.032 41.352 54.546 41.352 55.063L41.418 54.954Z"
                  fill="#33B87D"
                />
              </svg>
            </div>
            <h3 class="feature__title">Free delivery worldwide</h3>
            <p class="feature__description">
              We offer free shipping for purchases over certain amount.
            </p>
          </article>
          <article class="feature">
            <div class="feature__icon-container">
                <img src= "{{ asset('assets/img/Group 68.png') }}">

                <circle cx="25" cy="25" r="25" fill="white" />
                <path
                  d="M26.015 13.875H26.126C28.676 13.875 30.752 11.8 30.752 9.25V4.625C30.752 2.075 28.676 0 26.126 0H16.876C14.326 0 12.251 2.075 12.251 4.625V9.25C12.251 11.8 14.326 13.875 16.876 13.875H17.188L20.015 16.368C20.462 16.763 21.022 16.96 21.582 16.96C22.133 16.96 22.685 16.766 23.12 16.381L26.015 13.877V13.875ZM11.48 27.751C14.456 27.751 16.876 25.33 16.876 22.355C16.876 19.379 14.456 16.959 11.48 16.959C8.505 16.959 6.084 19.379 6.084 22.355C6.084 25.33 8.505 27.751 11.48 27.751ZM26.126 22.355C26.126 25.33 28.547 27.751 31.522 27.751C34.498 27.751 36.918 25.33 36.918 22.355C36.918 19.379 34.498 16.959 31.522 16.959C28.547 16.959 26.126 19.379 26.126 22.355ZM11.48 29.293C7.728 29.293 4.361 31.553 3.098 34.918C2.921 35.392 2.987 35.922 3.274 36.338C3.564 36.754 4.035 37.001 4.541 37.001H18.416C18.922 37.001 19.395 36.753 19.684 36.338C19.972 35.922 20.037 35.392 19.859 34.918C18.598 31.553 15.23 29.293 11.477 29.293H11.48ZM39.905 34.918C38.644 31.553 35.275 29.293 31.522 29.293C27.77 29.293 24.403 31.553 23.14 34.918C22.963 35.392 23.029 35.922 23.316 36.338C23.606 36.754 24.078 37.001 24.583 37.001H38.459C38.964 37.001 39.438 36.753 39.726 36.338C40.014 35.922 40.079 35.392 39.902 34.918H39.905Z"
                  fill="#33B87D"
                />
              </svg>
            </div>
            <h3 class="feature__title">Top-notch support</h3>
            <p class="feature__description">
              Any question? There is a Chat Feature to communicate directly with
              us.
            </p>
          </article>
          <article class="feature">
            <div class="feature__icon-container">
                <img src= "{{ asset('assets/img/Group 67.png') }}">
                <circle cx="25" cy="25" r="25" fill="white" />
                <path
                  d="M31.48 25.023C25.69 25.023 20.99 29.721 20.99 35.517C20.99 41.312 25.69 46.011 31.48 46.011C37.28 46.011 41.98 41.312 41.98 35.517C41.98 29.721 37.28 25.023 31.48 25.023ZM37.65 34.652L32.57 39.739C31.9 40.401 31.03 40.763 30.09 40.763H30.09C29.15 40.763 28.28 40.397 27.62 39.737L25.33 37.455C24.65 36.772 24.65 35.664 25.33 34.981C26.02 34.298 27.12 34.298 27.81 34.981L30.09 37.265L35.18 32.179C35.86 31.496 36.97 31.496 37.65 32.179C38.33 32.861 38.33 33.969 37.65 34.652ZM34.98 4H6.99C3.13 4 0 7.132 0 10.997V12.745H41.98V10.997C41.98 7.133 38.85 4 34.98 4ZM31.35 21.524C35.53 21.524 39.41 23.37 41.98 26.283V16.244H0V28.487C0 32.35 3.13 35.484 7 35.484L17.36 35.517C17.36 27.789 23.62 21.524 31.35 21.524H31.35ZM9.62 28.487C8.17 28.487 6.99 27.312 6.99 25.863C6.99 24.414 8.17 23.239 9.62 23.239C11.07 23.239 12.24 24.414 12.24 25.863C12.24 27.312 11.07 28.487 9.62 28.487Z"
                  fill="#33B87D"
                />
              </svg>
            </div>
            <h3 class="feature__title">Secure payments</h3>
            <p class="feature__description">
              Your payment information is processed securely by us.
            </p>
          </article>
        </div>
      </div>
    </section>

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
        <div class="wrapperService line">
            <div class="container d-flex">
                <div class="image">
                    <img src="{{ url('assets_user/img/service.png') }}" alt="">
                </div>
                <div class="desc">
                    <h2>How We Work ?</h2>
                    <p class="mt-1" style="font-weight:300">Make space in your home for plants. you will feel better for it. not only are they beautiful, but caring for them helps us.</p>
                    <div class="items d-flex align-items-center">
                        <div class="image">
                            <img src="{{ url('assets_user/img/icon/delivery.png') }}" alt="">
                        </div>
                        <div class="text">
                            <h4 class="mb-1" style="font-size: 20px;">Free delivery worldwide</h4>
                            <p style="font-weight:300; font-size : 14px;">We offer free shipping for purchases over certain amount.</p>
                        </div>
                    </div>
                    <div class="items d-flex align-items-center">
                        <div class="image">
                            <img src="{{ url('assets_user/img/icon/secure.png') }}" alt="">
                        </div>
                        <div class="text">
                            <h4 class="mb-1" style="font-size: 20px;">Secure payments</h4>
                            <p style="font-weight:300; font-size : 14px;">Your payment information is processed securely by us.</p>
                        </div>
                    </div>
                    <div class="items d-flex align-items-center">
                        <div class="image">
                            <img src="{{ url('assets_user/img/icon/support.png') }}" alt="">
                        </div>
                        <div class="text">
                            <h4 class="mb-1" style="font-size: 20px;">Top-notch support</h4>
                            <p style="font-weight:300; font-size : 14px;">Any question? There is a Chat Feature to communicate directly with us.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="requestPlant line">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-12 col-lg-6 mb-4 mb-lg-0">
                        <div class="requestWrapper">
                            <h1>You Can,</h1>
                            <h1>Request New Plant.</h1>
                            <form action="">
                                <input type="text" class="form-control" placeholder="Name Plant">
                                <input type="text" class="form-control" placeholder="Variates Name">
                                <button class="button button-primary w-100 md-button">Submit Request</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="imagesContent">
                            <img src="{{ url('assets_user/img/content-images-request.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="wrapperFooter container">
            <div class="about">
                {{-- <img src="{{ url('KlorofilFarm.png') }}" alt=""> --}}
                <p>Find the various types of plants you want with Plantsasri. Your satisfaction and comfort is our priority.
                </p>
            </div>
            <div class="links">
                <a href="">Home</a>
                <a href="">About Plantsasri</a>
                <a href="{{ route('more') }}">Explore Plants</a>
                <a href="{{ route('catalog') }}">List Price</a>
                <a href="{{ route('faq') }}">Faq</a>
                <a href="{{ route('terms') }}">Terms & Condition</a>
            </div>
            <div class="contact">
                <p>Contact Us</p>
                <a class="item email" href="">
                    <img src="{{ url('assets_user/img/icon/email 2.png') }}" alt="">
                    <p>dadaiafh@gmail.com</p>
                </a>
                <a class="item call" href="">
                    <img src="{{ url('assets_user/img/icon/telephone-handle-silhouette 1.png') }}" alt="">
                    <p>+6286473563</p>
                </a>
                <a class="item address" href="">
                    <img src="{{ url('assets_user/img/icon/pin (1).png') }}" alt="">
                    <p>GARDEN, No.13 Jalan Cijahe, Curug Mekar - Bogor Barat, Bogor, Jawa Barat</p>
                </a>
            </div>
        </div>
        <div class="wrapperCopy container">
            <p>© 2022 Plantsasri, Design By Startcode</p>
            <p><b>English</b></p>
        </div>
    </footer>

    <script src="(101) script.js"></script>
  </body>
  @endsection
