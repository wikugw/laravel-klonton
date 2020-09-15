<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sumbersekar-Mart</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">

    <link rel="stylesheet" href="{{ URL::asset('user/css/open-iconic-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('user/css/animate.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('user/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('user/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('user/css/magnific-popup.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('user/css/aos.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('user/css/ionicons.min.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('user/css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('user/css/jquery.timepicker.css') }}">


    <link rel="stylesheet" href="{{ URL::asset('user/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('user/css/icomoon.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('user/css/style.css') }}">
    <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>
</head>

<body class="goto-here">
    <div class="py-1 bg-black">
        <div class="container">
            <div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
                <div class="col-lg-12 d-block">
                    <div class="row d-flex">
                        <div class="col-md pr-4 d-flex topper align-items-center">
                            <div class="icon mr-2 d-flex justify-content-center align-items-center"><span
                                    class="icon-phone2"></span></div>
                            <span class="text">+ 1235 2355 98</span>
                        </div>
                        <div class="col-md pr-4 d-flex topper align-items-center">
                            <div class="icon mr-2 d-flex justify-content-center align-items-center"><span
                                    class="icon-paper-plane"></span></div>
                            <span class="text">youremail@email.com</span>
                        </div>
                        <div class="col-md-5 pr-4 d-flex topper align-items-center text-lg-right">
                            <span class="text">Menyediakan Kebutuhan sehari - hari </span>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">Sumbersekar-Mart</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>

            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    @if (auth()->user())
                    <li class="nav-item dropdown active">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false"><span
                            class="icon-bell"></span>{{ auth()->user()->unreadNotifications->where('data.for',  '!=',  'store')->count() }}</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown04">
                            @forelse (auth()->user()->unreadNotifications->where('data.for',  '!=',  'store') as $notification)
                            @if ($notification->data['for'] == 'admin')
                            @if (auth()->user()->role_id == '2' )
                            <a class="dropdown-item" style="color: red" href="{{ route('stores.products', auth()->user()->store_id) }}">{{ $notification->data['message'] }}</a>
                            @else
                            <a class="dropdown-item" style="color: red" href="{{ route('stores.index') }}">{{ $notification->data['message'] }}</a>
                            @endif
                            @else
                            <a class="dropdown-item" href="{{ route('home.transactions') }}">{{ $notification->data['message'] }}</a>
                            @endif
                            @empty
                            <a class="dropdown-item" href="#">Tidak ada notifikasi :(</a>
                            @endforelse
                            @if (!auth()->user()->unreadNotifications->where('data.for', '!=',  'store')->isEmpty())
<div align="center">
                    <a  class="dropdown-item" style="font-weight: bold" href="{{ route('markAsRead', 'store') }}"> Tandai semua telah terbaca </a>
                </div>
                  @endif
                        </div>
                    </li>
                    @endif
                    <li class="nav-item"><a href="{{ route('home') }}" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="{{ route('home.stores') }}" class="nav-link">Toko</a></li>
                    @if (Auth::user())
                    <li class="nav-item"><a href="{{ route('home.transactions') }}" class="nav-link">Transaksi</a></li>
                    <li class="nav-item dropdown active">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown04">
                            @if (Auth::user()->role_id == '1')
                            <a class="dropdown-item" href="{{ route('stores.index') }}">Menuju Halaman Admin</a>
                            @else
                            @if (Auth::user()->store_id == '')
                            <a class="dropdown-item" href="{{ route('stores.create') }}">Buat Toko</a>
                            @else
                            <a class="dropdown-item" href="{{ route('stores.show', Auth::user()->store_id) }}">Menuju
                                Toko</a>
                            @endif
                            @endif
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    <li class="nav-item cta cta-colored"><a href="{{ route('carts.index') }}" class="nav-link"><span
                        class="icon-shopping_cart"></span>{{ $cart_details->count() }}</a></li>
                    @else
                    <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Login</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <!-- END nav -->

    <section class="ftco-section bg-light pt-5">
        @yield('content')
    </section>

    <footer class="ftco-footer bg-light ftco-section">
        <div class="container">
            <div class="row">
                <div class="mouse">
                    <a href="#" class="mouse-icon">
                        <div class="mouse-wheel"><span class="ion-ios-arrow-up"></span></div>
                    </a>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Sumbersekar-Mart</h2>
                        <p> Bumdes Sekar Abadi Desa Sumbersekar</p>
                        <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                            <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                            <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                            <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4 ml-md-5">
                        <h2 class="ftco-heading-2">Menu</h2>
                        <ul class="list-unstyled">
                            <li><a href="#" class="py-2 d-block">Shop</a></li>
                            <li><a href="#" class="py-2 d-block">About</a></li>
                            <li><a href="#" class="py-2 d-block">Journal</a></li>
                            <li><a href="#" class="py-2 d-block">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Help</h2>
                        <div class="d-flex">
                            {{-- <ul class="list-unstyled mr-l-5 pr-l-3 mr-4"> --}}
                                {{-- <li><a href="#" class="py-2 d-block">Shipping Information</a></li>
                                <li><a href="#" class="py-2 d-block">Returns &amp; Exchange</a></li>
                                <li><a href="#" class="py-2 d-block">Terms &amp; Conditions</a></li>
                                <li><a href="#" class="py-2 d-block">Privacy Policy</a></li> --}}
                            {{-- </ul> --}}
                            <ul class="list-unstyled">
                                <li><a href="#" class="py-2 d-block">FAQs</a></li>
                                <li><a href="#" class="py-2 d-block">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Have a Questions?</h2>
                        <div class="block-23 mb-3">
                            <ul>
                                <li><span class="icon icon-map-marker"></span><span class="text">Sumbersekar, Kec. Dau, Malang, Jawa Timur</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">

                    <p>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright PPMFilkomUB &copy;<script>
                            document.write(new Date().getFullYear());

                        </script> All rights reserved | This template is made with <i class="icon-heart color-danger"
                            aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>
                </div>
            </div>
        </div>
    </footer>



    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
                stroke="#F96D00" /></svg></div>


    <script src="{{ URL::asset('user/js/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('user/js/jquery-migrate-3.0.1.min.js') }}"></script>
    <script src="{{ URL::asset('user/js/popper.min.js') }}"></script>
    <script src="{{ URL::asset('user/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('user/js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ URL::asset('user/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ URL::asset('user/js/jquery.stellar.min.js') }}"></script>
    <script src="{{ URL::asset('user/js/owl.carousel.min.js') }}"></script>
    <script src="{{ URL::asset('user/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ URL::asset('user/js/aos.js') }}"></script>
    <script src="{{ URL::asset('user/js/jquery.animateNumber.min.js') }}"></script>
    <script src="{{ URL::asset('user/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ URL::asset('user/js/scrollax.min.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false">
    </script>
    <script src="{{ URL::asset('user/js/google-map.js') }}"></script>
    <script src="{{ URL::asset('user/js/main.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('select[name="province_id"]').on('change', function () {
                var cityId = $(this).val();
                if (cityId) {
                    $.ajax({
                        url: 'http://127.0.0.1:8000/getCity/ajax/' + cityId,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="city_id"]').empty();
                            $.each(data, function (key, value) {
                                $('select[name="city_id"]').append(
                                    '<option value="' +
                                    key + '">' + value + '</option>');
                            });
                        }
                    });
                } else {
                    $('select[name="city_id"]').empty();
                }
            });
        });

        $('#exampleModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var service = button.data('service')
            var ongkir = button.data('ongkir')
            var recipient = button.data('whatever') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('.modal-body #service').val(service)
            modal.find('.modal-body #ongkir').val(ongkir)
            modal.find('.modal-title').text('Pilihan paket ' + service)
            modal.find('.modal-body #bayar').text('LAKUKAN TRANSFER SEJUMLAH RP.' + recipient +
                ' PADA SALAH 1 BANK DIBAWAH INI')
        })

    </script>

</body>

</html>
