@extends('layouts.base_user')

@section('css')
    <!--CSS Profile-->
    <link rel="stylesheet" href="{{ url('assets_user/css/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    {{-- <link rel="stylesheet" href=""> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css"
        integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
    <style>
        .dropify-wrapper .dropify-message p {
            font-size: 14px;
        }

    </style>

    <div id="mainContent">
        <div class="container">
            <div class="profileContainer first-line">
                <div class="row">
                    <div class="col-12 col-lg-4 col-xl-3 mb-4 mb-lg-0">
                        <div class="card card-user-menu">
                            <div class="user-detail">
                                <img src="{{ Auth::user()->thumb }}" alt="">
                                <p class="name-user">{{ Auth::user()->name }}</p>
                            </div>
                            <div class="menu-profile">
                                <a href="{{ route('profile') }}" class="menu">
                                    <ion-icon name="person"></ion-icon>
                                    Account
                                </a>
                                <a href="{{ route('chat', ['for' => 1]) }}" class="menu">
                                    <ion-icon name="chatbox-ellipses"></ion-icon>
                                    Chat
                                </a>
                                <a href="{{ route('history-transaction') }}" class="menu">
                                    <ion-icon name="cart"></ion-icon>
                                    History Transaction
                                </a>
                                {{-- <form action="{{ route('logout') }}" method="post">
                                    @csrf --}}
                                <a href="{{ route('logoutUser') }}" class="menu logout">
                                    <ion-icon name="log-out"></ion-icon>
                                    Logout
                                </a>
                                {{-- </form> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-8 col-xl-9">
                        <div class="card profile-data">
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="nav-profileData-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-profileData" type="button" role="tab"
                                    aria-controls="nav-profileData" aria-selected="true">Profile Setting</button>
                                <button class="nav-link" id="nav-securitySetting-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-securitySetting" type="button" role="tab"
                                    aria-controls="nav-securitySetting" aria-selected="false">Security</button>
                            </div>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-profileData" role="tabpanel"
                                    aria-labelledby="nav-profileData-tab">
                                    <div class="row">
                                        <div class="col-12 col-lg-4 mb-5 mb-lg-0">
                                            <div class="profile-images-wrapper">
                                                <div class="profile-image">
                                                    <img src="{{ Auth::user()->thumb }}" alt="">
                                                </div>
                                                <div class="button-change-image">


                                                    <button type="button" class="button button-outline-primary w-100"
                                                        data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                                        Change Profile
                                                    </button>

                                                </div>
                                                <p class="info">Large file: maximum 4,000,000 bytes (4 MB).
                                                    allowed
                                                    files: .extensionJPG .JPEG .PNG</p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-8">
                                            <div class="biodata-user">
                                                <h5 class="title-data-user">Your Profile Data</h5>
                                                <div class="table-data-user">
                                                    <table>
                                                        <tbody>
                                                            <tr>
                                                                <td class="label">Name</td>
                                                                <td class="value">{{ Auth::user()->name }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="label">Phone Number</td>
                                                                <td class="value">{{ Auth::user()->phone }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="label">Email</td>
                                                                <td class="value">{{ Auth::user()->email }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="address-user">
                                                <h5 class="title-data-user">Your Address</h5>
                                                <p>{{ Auth::user()->address }}</p>
                                            </div>
                                            <div class="edit-data-modal py-2 pt-3 d-flex justify-content-end">
                                                <button type="button" class="button button-text" data-bs-toggle="modal"
                                                    data-bs-target="#changeDataProfileUser">
                                                    Change Your Profile Data
                                                </button>

                                                <div class="modal fade" id="changeDataProfileUser"
                                                    data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                    aria-labelledby="changeDataProfileUserLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="changeDataProfileUserLabel">
                                                                    Edit Profile
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('edit-user') }}" method="POST">
                                                                    @csrf
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <div class="form-input">
                                                                                <label for="username"
                                                                                    class="form-label">Username</label>
                                                                                <input type="text" name="name"
                                                                                    value="{{ Auth::user()->name }}"
                                                                                    class="form-control" id="username">
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-12">
                                                                            <div class="form-input">
                                                                                <label for="phoneNumber"
                                                                                    class="form-label">Phone
                                                                                    Number</label>
                                                                                <input type="number" name="phone"
                                                                                    value="{{ Auth::user()->phone }}"
                                                                                    class="form-control" id="phoneNumber">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <div class="form-input">
                                                                                <label for="email"
                                                                                    class="form-label">Email</label>
                                                                                <input type="email" name="email"
                                                                                    value="{{ Auth::user()->email }}"
                                                                                    class="form-control" id="email">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <div class="form-input">
                                                                                <label for="address"
                                                                                    class="form-label">Address</label>
                                                                                <textarea name="address" id="address" cols="30" rows="5"
                                                                                    class="form-control">{{ Auth::user()->address }}</textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row pt-3">
                                                                        <div class="col-12 d-flex justify-content-end">
                                                                            <button
                                                                                class="button button-outline-primary">Save
                                                                                Data</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <button type="button" class="button button-outline-primary"
                                                    data-bs-toggle="modal" data-bs-target="#addAddress">
                                                    Add Address
                                                </button>


                                                <div class="modal fade" id="addAddress" data-bs-backdrop="static"
                                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="addAddressLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="addAddressLabel">
                                                                    Edit Profile
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card" style="width: 18rem;">
                                                                    <div class="card-header">
                                                                        Your Address
                                                                    </div>


                                                                    <ul class="list-group" style="width:100%;">

                                                                        @foreach (DB::table('address_users')->where('user_id', Auth::id())->get()
        as $item)
                                                                            <li class="list-group-item">
                                                                                {{ $item->address }}</li>
                                                                        @endforeach
                                                                    </ul>

                                                                </div>
                                                                <br>
                                                                <form action="{{ route('add-address') }}" method="POST">
                                                                    @csrf
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <div class="form-input">
                                                                                <label for="username"
                                                                                    class="form-label">Address</label>
                                                                                <input type="text" name="address" value=""
                                                                                    class="form-control" id="username">
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                    <div class="row pt-3">
                                                                        <div class="col-12 d-flex justify-content-end">
                                                                            <button
                                                                                class="button button-outline-primary">Save
                                                                                Data</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-securitySetting" role="tabpanel"
                                    aria-labelledby="nav-securitySetting-tab">
                                    <div class="row change-password">
                                        <div class="col-12 col-md-4 mb-4 mb-md-0">
                                            <div class="greetings">
                                                <p>Hi, <span class="name">{{ Auth::user()->name }}</span></p>
                                                <p>set your <span class="text-dark">account security</span> here.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-8">
                                            <h5 class="title-data-user">Change Password</h5>
                                            <form action="{{ route('change-password') }}" method="POST">
                                                @csrf
                                                <div class="form-input">
                                                    <label for="currentPassword" class="form-label">Current
                                                        Password</label>
                                                    <div class="password-eye">
                                                        <input type="password" class="form-control" name="old_password"
                                                            id="currentPassword">
                                                        <div class="togglePassword">
                                                            <i class="bi bi-eye-fill"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-input">
                                                    <label for="newPassword" class="form-label">New Password</label>
                                                    <div class="password-eye">
                                                        <input type="password" name="new_password" class="form-control"
                                                            id="newPassword">
                                                        <div class="togglePassword">
                                                            <i class="bi bi-eye-fill"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-input">
                                                    <label for="confirmPassword" class="form-label">Confirm
                                                        Password</label>
                                                    <div class="password-eye">
                                                        <input type="password" name="new_password_confirmation"
                                                            class="form-control" id="confirmPassword">
                                                        <div class="togglePassword">
                                                            <i class="bi bi-eye-fill"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-end pt-3">
                                                    <button type="submit" class="button button-outline-primary">Change
                                                        Password</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



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
                        <button type="submit" class="btn btn-primary">Understood</button>
                    </div>

                </form>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"
        integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(".togglePassword").click(function() {
            $(this).children().toggleClass("bi-eye-slash-fill");
            input = $(this).parent().find("input");
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    </script>

    <script>
        $('.dropify').dropify();
    </script>
@endsection
