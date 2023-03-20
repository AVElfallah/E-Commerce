@include('dashboard.header')

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->


            @include('dashboard.sidebar')
            @include('dashboard.navbar')

            @yield('content')

            @include('dashboard.footer')
</body>
