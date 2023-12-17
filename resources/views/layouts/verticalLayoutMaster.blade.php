<body class="">
    {{-- @include('panels/loading') --}}
    <!-- BEGIN: Header-->
    <!-- END: Header-->
    <!-- BEGIN: Main Menu-->
    @if (Auth::check())
        @if (auth()->user()->role == 1)
            @include('panels.admin_sidebar')
        @endif
        @if (auth()->user()->role == 2)
            @include('panels.restaurant_sidebar')
        @endif
        {{-- @if (auth()->user()->role == 0)
            @include('panels.sidebar')
        @endif --}}

    @endif






    <main class="main-content">
        <div class="position-relative">

            @if (Auth::check())
                @if (auth()->user()->role == 0)
                    @include('panels.user-navbar')
                @else
                    @include('panels.navbar')
                @endif
            @else
                @include('panels.user-navbar')

            @endif

        </div>
        <div style="min-height: 85vh">
            @yield('content')
        </div>
        @include('panels/footer')
    </main>

    <script src="https://kit.fontawesome.com/40ab2e945c.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script src="http://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    @include('panels/scripts')

    <script type="text/javascript">
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>
</body>

</html>
