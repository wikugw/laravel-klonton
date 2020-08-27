<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description"
        content="Sleek Dashboard - Free Bootstrap 4 Admin Dashboard Template and UI Kit. It is very powerful bootstrap admin dashboard, which allows you to build products like admin panels, content management systems and CRMs etc.">
    <title>Toko Sumbersekar</title>

    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500"
        rel="stylesheet" />
    <link href="https://cdn.materialdesignicons.com/3.0.39/css/materialdesignicons.min.css" rel="stylesheet" />
    <!-- PLUGINS CSS STYLE -->
    <link href="{{ URL::asset('admin/assets/plugins/nprogress/nprogress.css') }}" rel="stylesheet" />
    <!-- No Extra plugin used -->
    <link href="{{ URL::asset('admin/assets/plugins/jvectormap/jquery-jvectormap-2.0.3.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('admin/assets/plugins/daterangepicker/daterangepicker.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('admin/assets/plugins/toastr/toastr.min.css') }}" rel="stylesheet" />
    <!-- SLEEK CSS -->
    <link id="sleek-css" rel="stylesheet" href="{{ URL::asset('admin/assets/css/sleek.css') }}" />
    <!-- FAVICON -->
    <link href="{{ URL::asset('admin/assets/img/favicon.png') }}" rel="shortcut icon" />
    {{-- DATATABLES --}}
    <link href="{{ URL::asset('admin/assets/plugins/data-tables/datatables.bootstrap4.min.css" rel="stylesheet') }}">
    {{-- <link href="https://unpkg.com/sleek-dashboard/dist/assets/css/sleek.min.css"> --}}
    <!--
			HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries
		-->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
    <script src="{{ URL::asset('admin/assets/plugins/nprogress/nprogress.js') }}"></script>
</head>

<body class="header-fixed sidebar-fixed sidebar-dark header-light" id="body">

    <script>
        NProgress.configure({
            showSpinner: false
        });
        NProgress.start();

    </script>
    <div class="wrapper">

        @include('admin.partials.sidebar')

        <div class="page-wrapper">
            @include('admin.partials.header')
            <div class="content-wrapper">
                @yield('content')
            </div>
            @include('admin.partials.footer')
        </div>
    </div>

    <script src="{{ URL::asset('admin/assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('admin/assets/plugins/slimscrollbar/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ URL::asset('admin/assets/plugins/jekyll-search.min.js') }}"></script>
    <script src="{{ URL::asset('admin/assets/plugins/charts/Chart.min.js') }}"></script>
    <script src="{{ URL::asset('admin/assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js') }}"></script>
    <script src="{{ URL::asset('admin/assets/plugins/jvectormap/jquery-jvectormap-world-mill.js') }}"></script>
    <script src="{{ URL::asset('admin/assets/plugins/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ URL::asset('admin/assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ URL::asset('admin/assets/plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ URL::asset('admin/assets/js/sleek.bundle.js') }}"></script>
    <script src="{{ URL::asset('admin/assets/plugins/data-tables/jquery.datatables.min.js') }}"></script>
    <script src="{{ URL::asset('admin/assets/plugins/data-tables/datatables.bootstrap4.min.js') }}"></script>

    <script>
        jQuery(document).ready(function () {
            jQuery('#basic-data-table').DataTable({
                "dom": '<"row justify-content-between top-information"lf>rt<"row justify-content-between bottom-information "ip><"clear">'
            });
        });

    </script>

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

    </script>
</body>

</html>
