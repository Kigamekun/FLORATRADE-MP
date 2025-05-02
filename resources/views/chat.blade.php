@extends('layouts.base_user')

@section('css')
    <link rel="stylesheet" href="{{ url('assets_user/css/chat.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
@endsection

@section('content')
    <div id="mainContent">
        <div class="container">
            <div class="first-line">
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
                                <a href="{{ route('logoutUser') }}" class="menu logout">
                                    <ion-icon name="log-out"></ion-icon>
                                    Logout
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-8 col-xl-9">
                        <div class="chat-container">
                            <div class="header-chat">
                                <img src="{{ url('assets_user/img/plantsasriLogo.png') }}" alt="">
                                <div class="profile-chat">
                                    <h6>Plantsasri Admin</h6>
                                    <p class="active-status">Online</p>
                                </div>
                            </div>
                            <div class="body-chat">
                                {{-- <div class="date-message">
                                    <p>10 April 2022</p>
                                </div> --}}

                                <div id="chatContainer">


                                </div>

                                <div class="message-control-container">
                                    <form id="addUser" action="" method="GET"
                                        onkeydown="return event.key != 'Enter';">
                                        <div class="wrapper-message-control">
                                            <input type="hidden" name="for" value="{{ $for }}">
                                            <input type="hidden" name="from" value="{{ $user_id }}">
                                            <div class="type-message">
                                                <label class="insert-file-upload">
                                                    <img src="{{ url('assets_user/img/icon/insert-picture-icon.svg') }}"
                                                        alt="">
                                                    <input type="file" />
                                                </label>
                                                <input type="text" name="chat" id="chat"
                                                    placeholder="Write a message ..." required>
                                                <button id="submitUser" type="button" class="send-message">
                                                    <img src="{{ url('assets_user/img/icon/send-message-icon.svg') }}"
                                                        alt="">
                                                </button>
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

    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-app.js"></script>
    <!-- TODO: Add SDKs for Firebase products that you want to use https://firebase.google.com/docs/web/setup#available-libraries -->
    <script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-analytics.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-database.js"></script>
    <script>
        // Initialize Firebase

        var config = {
            apiKey: "AIzaSyAqYF1H3e24IVRP2tYHP2g_KUzzATLyA7E",
            authDomain: "chat-plantsasri.firebaseapp.com",
            databaseURL: "https://chat-plantsasri-default-rtdb.asia-southeast1.firebasedatabase.app",
            projectId: "chat-plantsasri",
            storageBucket: "chat-plantsasri.appspot.com",
            messagingSenderId: "308704456390",
            appId: "1:308704456390:web:63968018ff5671353b71c7",
            measurementId: "G-HD29M2F4MV"
        };
        firebase.initializeApp(config);
        firebase.analytics();
        var database = firebase.database();
        var lastIndex = 0;


        firebase.database().ref('chat/').on('value', function(snapshot) {
            var value = snapshot.val();

            var htmls = [];
            $.each(value, function(index, value) {
                try {
                    if (value && value.from == @json($user_id) && value.for ==
                        @json($for)) {

                        var cht = `<div class="line-chat message">
                                    <div class="profile-message">
                                        <img src="${@json(
    DB::table('users')
        ->where('id', Auth::id())
        ->first()->role == 0
        ? url('assets_user/img/plantsasriLogo.png')
        : DB::table('users')
            ->where('id', $user_id)
            ->first()->thumb,
)}" alt="">

                                    </div>
                                    <div class="message-text">
                                        <p>${value.chat}</p>
                                    </div>
                                </div>`;

                        htmls.push(cht);
                    } else if (value && value.for == @json($user_id) && value.from ==
                        @json($for)) {
                        console.log('ada di else if');
                        console.log(value);
                        var cht = `<div class="line-chat my-message">
                                    <div class="profile-message">
                                        <img src="${@json(
    DB::table('users')
        ->where('id', $for)
        ->first()->role == 0
        ? url('assets_user/img/plantsasriLogo.png')
        : DB::table('users')
            ->where('id', $for)
            ->first()->thumb,
)}" alt="">

                                    </div>
                                    <div class="message-text">
                                        <p>${value.chat}</p>
                                    </div>
                                </div>`;

                        htmls.push(cht);
                    }
                    lastIndex = index;
                } catch (error) {

                }
            });

            // var element = document.getElementById("chatContainer");
            // element.before(htmls, element.firstChild);
            console.log(htmls);
            $('#chatContainer').html(htmls);

        });

        function deleteUser(params) {
            var id = params.dataset.id;
            firebase.database().ref('chat/' + id).remove();
        }

        // Add Data
        $('#submitUser').on('click', function() {
            var values = $("#addUser").serializeArray();
            var for_who = values[0].value;
            var from_who = values[1].value;
            var chat = values[2].value;
            var userID = lastIndex + 1;

            firebase.database().ref('chat/' + userID).set({
                for: for_who,
                from: from_who,
                chat: chat
            });
            // Reassign lastID value
            lastIndex = userID;
            $('#chat').val('');
        });
    </script>

    <script>
        $(document).keyup(function(event) {
            if (event.which === 13) {
                event.preventDefault();
                $('#submitUser').click();
                return false;
            }
        });
    </script>
@endsection
