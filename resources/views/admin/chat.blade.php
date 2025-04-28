@extends('layouts.base')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css"
        integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
@endsection



@section('menu')
    <div class="sidebar-menu-wrapper">
        <li class="listMenuName">
            <p>Admin Menu</p>
        </li>
        <li class="list-menu ">
            <div class="icon">
                <ion-icon name="grid"></ion-icon>
            </div>
            <a href="/admin" class="sidebar-menu">Dashboard Admin</a>
        </li>
        <li class="list-menu ">
            <div class="icon">
                <ion-icon name="folder-open"></ion-icon>
            </div>
            <a href="{{ route('admin.plants.index') }}" class="sidebar-menu">Manage Marga (Plants)</a>
        </li>

        <li class="list-menu ">
            <div class="icon">
                <ion-icon name="leaf"></ion-icon>
            </div>
            <a href="{{ route('admin.plant.index') }}" class="sidebar-menu">Manage Plant</a>
        </li>

        <li class="list-menu ">
            <div class="icon">
                <ion-icon name="card"></ion-icon>
            </div>
            <a href="{{ route('admin.voucher.index') }}" class="sidebar-menu">Manage Voucher</a>
        </li>

        <li class="list-menu">
            <div class="icon">
                <ion-icon name="airplane"></ion-icon>
            </div>
            <a href="{{ route('admin.shipping.index') }}" class="sidebar-menu">Manage Shipping</a>
        </li>

        <li class="list-menu ">
            <div class="icon">
                <ion-icon name="cart"></ion-icon>
            </div>
            <a href="{{ route('admin.order.index') }}" class="sidebar-menu">Manage Transaction</a>
        </li>

        <li class="list-menu">
            <div class="icon">
                <ion-icon name="cash"></ion-icon>
            </div>
            <a href="{{ route('admin.pricing.index') }}" class="sidebar-menu">Manage Pricing</a>
        </li>
        <li class="list-menu active">
            <div class="icon">
                <ion-icon name="easel"></ion-icon>
            </div>
            <a href="{{ route('admin.banner.index') }}" class="sidebar-menu">Manage Banner</a>
        </li>
        <li class="list-menu">
            <div class="icon">
                <ion-icon name="reader"></ion-icon>
            </div>
            <a href="{{ route('admin.terms.index') }}" class="sidebar-menu">Manage Terms</a>
        </li>
        <li class="list-menu">
            <div class="icon">
                <ion-icon name="person"></ion-icon>
            </div>
            <a href="{{ route('admin.user.index') }}" class="sidebar-menu">Manage User</a>
        </li>
        <li class="list-menu">
            <div class="icon">
                <ion-icon name="receipt"></ion-icon>
            </div>
            <a href="{{ route('admin.invoice.index') }}" class="sidebar-menu">Manage Invoice</a>
        </li>
        <li class="list-menu">
            <div class="icon">
                <ion-icon name="receipt"></ion-icon>
            </div>
            <a href="{{ route('admin.faq.index') }}" class="sidebar-menu">Manage Faq</a>
        </li>
    </div>
@endsection

@section('content')
    <style>
        .dropify-wrapper .dropify-message p {
            font-size: 14px;
        }
    </style>
    <div class="contentMain">
        <h2 class="pageNameContent">Manage Chat</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active">Manage Chat</li>
        </ol>

        <div class="card">
            <div class="row mb-5">
                <div class="col-md">
                  <div class="card mb-3">
                    <div class="row g-0">
                      <div class="col-md-4">
                        <img class="card-img card-img-left" src="../assets/img/elements/12.jpg" alt="Card image">
                      </div>
                      <div class="col-md-8">
                        <div class="card-body">
                          <h5 class="card-title">Card title</h5>
                          <p class="card-text">
                            This is a wider card with supporting text below as a natural lead-in to additional content.
                            This content is a little bit longer.
                          </p>
                          <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md">
                  <div class="card mb-3">
                    <div class="row g-0">
                      <div class="col-md-8">
                        <div class="card-body">
                          <h5 class="card-title">Card title</h5>
                          <p class="card-text">
                            This is a wider card with supporting text below as a natural lead-in to additional content.
                            This content is a little bit longer.
                          </p>
                          <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <img class="card-img card-img-right" src="../assets/img/elements/17.jpg" alt="Card image">
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            <ul class="list-group list-group-flush" id="list-chat">

            </ul>
        </div>
    </div>
@endsection




@section('js')
    <!--Ion Icon-->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-app.js"></script>
    <!-- TODO: Add SDKs for Firebase products that you want to use
                    https://firebase.google.com/docs/web/setup#available-libraries -->
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
            var senders = [];
            console.log('ini value di serialize' + value);
            console.log(htmls);
            $.each(value, function(index, value) {
                try {
                    if (!senders.includes(value.from)) {
                        senders.push(value.from);
                        $.ajax({
                            url: "{{ route('admin.getSenders') }}",
                            method: "GET",
                            data: {
                                id: value.from,
                            },
                            success: function(data) {
                                $('#list-chat').append(`<li class="list-group-item"><a href="/admin/chat/${value.from}">${data}</a></li>`);
                            }
                        });
                    }
                } catch (error) {

                }
            });

            // var element = document.getElementById("chatContainer");
            // element.before(htmls, element.firstChild);


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
