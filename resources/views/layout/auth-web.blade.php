<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-topbar="light" data-sidebar-image="none"
    data-theme="default" data-theme-colors="default">

<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('assets/images/favicon.ico') }}">
    @include('partials.head-css')
</head>

@yield('body')

@yield('content')

@include('partials.scripts')
<script>
    @if (session('success'))
        toastr.success("{{ session('success') }}");
    @endif

    @if (session('error'))
        toastr.error("{{ session('error') }}");
    @endif

    @if (session('info'))
        toastr.info("{{ session('info') }}");
    @endif

    @if (session('warning'))
        toastr.warning("{{ session('warning') }}");
    @endif
</script>
</body>

</html>
