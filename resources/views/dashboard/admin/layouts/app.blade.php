<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('custom_meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('page_title') | Guide to NJ State Tourism & Things to do in the Garden State | Admin Panel</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    @include('dashboard.admin.styles.css')
    @yield('css')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('dashboard/images/logo_funnj_64.png') }}"
                alt="FunNewJerseyLoader" height="60" width="60">
        </div>

        <!-- Navbar Start-->
        @include('dashboard.admin.includes.header')
        <!-- Navbar End-->
        <!-- Main Sidebar Container -->
        @include('dashboard.admin.includes.sidebar')
        <!-- Content Start-->
        @yield('admin-content')
        <!-- Content End-->
        <!-- Footer Start -->
        @include('dashboard.admin.includes.footer')
        <!-- Footer End -->
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    @include('dashboard.admin.styles.js')
    @yield('js')
</body>

</html>
