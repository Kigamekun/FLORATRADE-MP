@extends('layouts.base_user')

@section('css')
    <!--CSS Profile-->
    <link rel="stylesheet" href="{{ url('assets_user/css/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css"
        integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
    <style>
        /* Add the new styles from the HTML file */
        .nav-icon {
            width: 19px;
            height: 19px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: inherit;
            margin-right: 15px;
        }

        .logout .nav-icon {
            color: #f00;
        }

        .account-page {
            padding: 20px 0;
            overflow: hidden;
        }

        @media (max-width: 991px) {
            .account-page {
                padding-bottom: 100px;
            }
        }

        .container {
            margin: 26px auto 0;
            width: 100%;
            max-width: 1158px;
            margin-top: 10px;
        }

        @media (max-width: 991px) {
            .container {
                max-width: 100%;
            }
        }

        .content-wrapper {
            display: flex;
            gap: 20px;
            margin-top: 100px;
        }

        @media (max-width: 991px) {
            .content-wrapper {
                flex-direction: column;
                align-items: stretch;
                gap: 0px;
            }
        }

        /* Sidebar styles */
        .sidebar {
            width: 22%;
        }

        @media (max-width: 991px) {
            .sidebar {
                width: 100%;
            }
        }

        .user-info {
            border-radius: 10px;
            background-color: #ffffff;
            padding: 19px 14px 46px;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        @media (max-width: 991px) {
            .user-info {
                margin-top: 30px;
            }
        }

        .avatar-name {
            display: flex;
            margin-left: 14px;
            align-items: center;
            gap: 17px;
        }

        @media (max-width: 991px) {
            .avatar-name {
                margin-left: 10px;
            }
        }

        .avatar-small {
            color: #6b6f6d;
            background-color: rgba(237, 237, 237, 1);
            border-radius: 50%;
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .username {
            color: #494c4b;
            font-size: 16px;
            font-weight: 400;
        }

        .divider {
            border: none;
            border-top: 1px solid rgba(182, 183, 187, 1);
            width: 100%;
            margin-top: 18px;
            background-color: #b6b7bb;
        }

        .sidebar-nav {
            display: flex;
            flex-direction: column;
            width: 100%;
            margin-top: 20px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 15px;
            font-size: 16px;
            color: #494c4b;
            text-decoration: none;
            margin-top: 10px;
            padding: 10px 0 10px 16px;
        }

        .nav-item.active {
            font-weight: 500;
        }

        .nav-text {
            color: #494c4b;
        }

        .logout {
            color: #f00;
        }

        .logout .nav-text {
            color: #f00;
        }

        /* Main content styles */
        .main-content {
            width: 78%;
        }

        @media (max-width: 991px) {
            .main-content {
                width: 100%;
                margin-top: 30px;
            }
        }

        /* NEW PROFILE HEADER STYLES */
        .profile-header-container {
            width: 100%;
            border-radius: 8px;
            overflow: hidden;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        
        .green-section {
            height: 160px;
            background-color: rgba(51, 184, 125, 1);
            position: relative;
        }
        
        .white-section {
            height: 40px;
            display: flex;
            align-items: center;
            padding-left: 180px;
            padding-bottom: 20px;
            padding-top: 35px;
        }
        
        .profile-pic {
            width: 120px;
            height: 120px;
            background-color: rgba(237, 237, 237, 1);
            border-radius: 50%;
            position: absolute;
            left: 30px;
            bottom: -40px;
            border: 4px solid white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
            color: #6b6f6d;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            background-size: cover;
            background-position: center;
        }
        
        .profile-tabs {
            display: flex;
            gap: 30px;
            margin-left: 20px;
        }
        
        .tab-button {
            font-family: 'Poppins', sans-serif;
            font-size: 16px;
            background: none;
            border: none;
            cursor: pointer;
            padding: 5px 0;
            color: #909097;
            position: relative;
            transform: translateY(-20%);
        }
        
        .tab-button.active {
            color: rgba(51, 184, 125, 1);
            font-weight: 500;
        }
        
        .tab-button.active::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 0;
            width: 100%;
            height: 5px;
            background-color: rgba(51, 184, 125, 1);
            transform: translateY(-70%);
        }
        
        .btn-outline {
            padding: 5px 15px;
            border: 1px solid rgba(51, 184, 125, 1);
            border-radius: 4px;
            background: white;
            color: rgba(51, 184, 125, 1);
            font-family: 'Poppins', sans-serif;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 20px;
            margin-bottom: 30px;
        }
        
        .change-pic-btn {
            margin-left: auto;
            margin-right: 20px;
            padding: 5px 15px;
            border: 1px solid rgba(51, 184, 125, 1);
            border-radius: 4px;
            background: white;
            color: rgba(51, 184, 125, 1);
            font-family: 'Poppins', sans-serif;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transform: translateY(-20%);
        }

        /* Profile details section */
        .profile-details {
            border-radius: 8px;
            background-color: #fff;
            padding: 33px 39px;
            margin-top: 22px;
            width: 100%;
        }

        @media (max-width: 991px) {
            .profile-details {
                padding: 33px 20px;
            }
        }

        .section-title {
            color: #494c4b;
            font-size: 25px;
            font-weight: 600;
        }

        .section-divider {
            border: none;
            border-top: 1px solid rgba(182, 183, 187, 1);
            width: 226px;
            margin-top: 12px;
            background-color: #b6b7bb;
        }

        .profile-info {
            display: flex;
            margin-top: 20px;
            width: 335px;
            max-width: 100%;
            gap: 20px;
            justify-content: space-between;
        }

        .info-labels {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .info-label {
            color: #6b6f6d;
            font-size: 16px;
            font-weight: 400;
            margin-bottom: 32px;
        }

        .info-label:last-child {
            margin-bottom: 0;
        }

        .info-values {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            margin-top: 8px;
        }

        .info-value {
            color: #8f9491;
            font-size: 16px;
            font-weight: 400;
            margin-bottom: 28px;
        }

        .info-value:last-child {
            margin-bottom: 0;
        }

        .address-section {
            margin-top: 19px;
        }

        .address-info {
            display: flex;
            width: 335px;
            max-width: 100%;
            gap: 20px;
            justify-content: space-between;
        }

        .address-header {
            margin-bottom: 32px;
        }

        /* Security section styles */
        .security-section {
            border-radius: 8px;
            background-color: #fff;
            padding: 33px 39px;
            margin-top: 22px;
            width: 100%;
            display: none;
        }

        .security-title {
            color: #494c4b;
            font-size: 25px;
            font-weight: 600;
        }

        .security-description {
            color: #6b6f6d;
            font-size: 16px;
            margin-bottom: 30px;
        }

        .password-form {
            display: flex;
            flex-direction: column;
            gap: 25px;
            width: 100%;
            max-width: 500px;
        }

        .password-field {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .password-label {
            color: #6b6f6d;
            font-size: 16px;
            font-weight: 400;
        }

        .password-input {
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
        }

        .password-actions {
            display: flex;
            justify-content: flex-end;
            margin-top: 20px;
        }

        /* Modal styles */
        .modal-body .dropify-wrapper .dropify-message p {
            font-size: 14px;
        }
    </style>
@endsection

@section('content')
    <main class="account-page">
        <div class="container">
            <div class="content-wrapper">
                <!-- Sidebar -->
                <aside class="sidebar">
                    <div class="user-info">
                        <div class="avatar-name">
                            <div class="avatar-small">
                                @if(Auth::user()->thumb)
                                    <img src="{{ Auth::user()->thumb }}" alt="" style="width:100%; height:100%; border-radius:50%; object-fit:cover;">
                                @else
                                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                                @endif
                            </div>
                            <h3 class="username">{{ Auth::user()->name }}</h3>
                        </div>
                        <hr class="divider">
                        <nav class="sidebar-nav">
                            <a href="{{ route('profile') }}" class="nav-item active">
                                <i class="fas fa-user nav-icon"></i>
                                <span class="nav-text">Account</span>
                            </a>
                            <a href="{{ route('chat', ['for' => 1]) }}" class="nav-item">
                                <i class="fas fa-comment-dots nav-icon"></i>
                                <span class="nav-text">Chat</span>
                            </a>
                            <a href="{{ route('history-transaction') }}" class="nav-item">
                                <i class="fas fa-shopping-cart nav-icon"></i>
                                <span class="nav-text">History Transaction</span>
                            </a>
                            <a href="{{ route('logoutUser') }}" class="nav-item logout">
                                <i class="fas fa-sign-out-alt nav-icon"></i>
                                <span class="nav-text">Logout</span>
                            </a>
                        </nav>
                    </div>
                </aside>

                <!-- Main Content -->
                <section class="main-content">
                    <!-- Profile Header -->
                    <div class="profile-header-container">
                        <div class="green-section">
                            <div class="profile-pic" style="background-image: url('{{ Auth::user()->thumb }}')">
                                @if(!Auth::user()->thumb)
                                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                                @endif
                            </div>
                        </div>
                        <div class="white-section">
                            <div class="profile-tabs">
                                <button class="tab-button active" data-tab="profile">Profile Setting</button>
                                <button class="tab-button" data-tab="security">Security</button>
                            </div>
                            <button type="button" class="change-pic-btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                Change Profile Picture
                            </button>
                        </div>
                    </div>

                    <!-- Profile Details Section -->
                    <section class="profile-details" id="profile-section">
                        <h2 class="section-title">Your Profile</h2>
                        <hr class="section-divider">

                        <div class="profile-info">
                            <div class="info-labels">
                                <p class="info-label">Name</p>
                                <p class="info-label">Phone Number</p>
                                <p class="info-label">Email</p>
                            </div>
                            <div class="info-values">
                                <p class="info-value">{{ Auth::user()->name }}</p>
                                <p class="info-value">{{ Auth::user()->phone }}</p>
                                <p class="info-value">{{ Auth::user()->email }}</p>
                            </div>
                        </div>

                        <button class="btn-outline" data-bs-toggle="modal" data-bs-target="#changeDataProfileUser">
                            Change Profile
                        </button>

                        <h2 class="section-title">Address</h2>
                        <hr class="section-divider">

                        <div class="address-section">
                            <div class="address-info">
                                <div class="info-labels">
                                    <p class="info-label">Full address</p>
                                </div>
                                <div class="info-values">
                                    <p class="info-value">{{ Auth::user()->address }}</p>
                                </div>
                            </div>
                            <button class="btn-outline" data-bs-toggle="modal" data-bs-target="#addAddress">
                                Add Address
                            </button>
                        </div>
                    </section>

                    <!-- Security Section -->
                    <section class="security-section" id="security-section">
                        <h2 class="security-title">Change Password</h2>
                        <p class="security-description">Hi <span class="name">{{ Auth::user()->name }}</span>, set your account security here</p>
                        
                        <form action="{{ route('change-password') }}" method="POST">
                            @csrf
                            <div class="password-form">
                                <div class="password-field">
                                    <label class="password-label">Current password:</label>
                                    <div class="password-eye">
                                        <input type="password" name="old_password" class="password-input" placeholder="Enter current password" id="currentPassword">
                                        <div class="togglePassword">
                                            <i class="bi bi-eye-fill"></i>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="password-field">
                                    <label class="password-label">New password:</label>
                                    <div class="password-eye">
                                        <input type="password" name="new_password" class="password-input" placeholder="Enter new password" id="newPassword">
                                        <div class="togglePassword">
                                            <i class="bi bi-eye-fill"></i>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="password-field">
                                    <label class="password-label">Confirm new password:</label>
                                    <div class="password-eye">
                                        <input type="password" name="new_password_confirmation" class="password-input" placeholder="Confirm new password" id="confirmPassword">
                                        <div class="togglePassword">
                                            <i class="bi bi-eye-fill"></i>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="password-actions">
                                    <button type="submit" class="btn-outline">Change Password</button>
                                </div>
                            </div>
                        </form>
                    </section>
                </section>
            </div>
        </div>
    </main>

    <!-- Change Profile Picture Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Change Profile Picture</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('change-thumb') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <label for="">Profile Picture</label>
                        <input type="file" name="thumb" class="dropify" />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Change Profile Data Modal -->
    <div class="modal fade" id="changeDataProfileUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="changeDataProfileUserLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changeDataProfileUserLabel">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('edit-user') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-input">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" name="name" value="{{ Auth::user()->name }}"
                                        class="form-control" id="username">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-input">
                                    <label for="phoneNumber" class="form-label">Phone Number</label>
                                    <input type="number" name="phone" value="{{ Auth::user()->phone }}"
                                        class="form-control" id="phoneNumber">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-input">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" value="{{ Auth::user()->email }}"
                                        class="form-control" id="email">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-input">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea name="address" id="address" cols="30" rows="5"
                                        class="form-control">{{ Auth::user()->address }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row pt-3">
                            <div class="col-12 d-flex justify-content-end">
                                <button class="btn-outline">Save Data</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Address Modal -->
    <div class="modal fade" id="addAddress" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" 
        aria-labelledby="addAddressLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAddressLabel">Add Address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card" style="width: 100%;">
                        <div class="card-header">
                            Your Addresses
                        </div>
                        <ul class="list-group" style="width:100%;">
                            @foreach (DB::table('address_users')->where('user_id', Auth::id())->get() as $item)
                                <li class="list-group-item">{{ $item->address }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <br>
                    <form action="{{ route('add-address') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-input">
                                    <label for="address" class="form-label">New Address</label>
                                    <input type="text" name="address" value="" class="form-control" id="address">
                                </div>
                            </div>
                        </div>
                        <div class="row pt-3">
                            <div class="col-12 d-flex justify-content-end">
                                <button class="btn-outline">Save Address</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer>
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
                <img src="{{ url('assets_user/img/icon/telephone-handle-silhouette 1.png') }}" alt="">
                <span class="footer__contact-text">+6280123719310</span>
              </div>
      
              <div class="footer__contact-item">
                <img src="{{ url('assets_user/img/icon/email 2.png') }}" alt="">
                <span class="footer__contact-text">floratrade9@gmail.com</span>
              </div>
      
              <div class="footer__contact-item">
                <img src="{{ url('assets_user/img/icon/pin (1).png') }}" alt="" >
                <span class="footer__contact-text">Curug Mekar - Bogor Barat, Bogor, Jawa Barat</span>
              </div>
            </div>
          </div>
        </div>
    </footer>
@endsection

@section('js')
    <!--Ion Icon-->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"
        integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        
    <script>
        // Initialize dropify
        $('.dropify').dropify();

        // Password toggle functionality
        $(".togglePassword").click(function() {
            $(this).children().toggleClass("bi-eye-slash-fill");
            input = $(this).parent().find("input");
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });

        // Tab switching functionality
        document.addEventListener('DOMContentLoaded', function() {
            const tabButtons = document.querySelectorAll('.tab-button');
            
            tabButtons.forEach(button => {
                button.addEventListener('click', (e) => {
                    const target = e.target;
                    const tabName = target.dataset.tab;
                    
                    // Remove active class from all tabs
                    tabButtons.forEach(tab => {
                        tab.classList.remove('active');
                    });
                    
                    // Add active class to clicked tab
                    target.classList.add('active');
                    
                    // Show the corresponding section
                    if (tabName === 'profile') {
                        document.getElementById('profile-section').style.display = 'block';
                        document.getElementById('security-section').style.display = 'none';
                    } else if (tabName === 'security') {
                        document.getElementById('profile-section').style.display = 'none';
                        document.getElementById('security-section').style.display = 'block';
                    }
                });
            });

            // Initialize the first tab as active
            document.querySelector('.tab-button[data-tab="profile"]').classList.add('active');
            document.getElementById('profile-section').style.display = 'block';
        });
    </script>
@endsection