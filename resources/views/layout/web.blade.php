<!doctype html>
<html data-layout="vertical" data-topbar="light" data-sidebar="dark"
    data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="default"
    data-theme-colors="default">
<head>
    <meta charset="utf-8" />
    <title>@yield('title') | Khata App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('assets/images/favicon.ico') }}">
    @include('partials.head-css')
</head>

<body>
    <!-- Begin page -->
    <div id="layout-wrapper">
        @include('partials.topbar')
        @include('partials.sidebar')
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
            @include('partials.footer')
        </div>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->

    <!-- JAVASCRIPT -->
    @include('partials.scripts')
    <script>
        @if(session('success'))
            toastr.success("{{ session('success') }}");
        @endif

        @if(session('error'))
            toastr.error("{{ session('error') }}");
        @endif

        @if(session('info'))
            toastr.info("{{ session('info') }}");
        @endif

        @if(session('warning'))
            toastr.warning("{{ session('warning') }}");
        @endif
    </script>
</body>

</html>
