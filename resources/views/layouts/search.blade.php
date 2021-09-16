@include('layouts/partials/head')

<header>
    <nav class="navbar navbar-expand-md navbar-light">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img width="222" class="img-fluid" src="{{ asset('img/logo_white_large.png') }}" alt="" />
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <div></div>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav shadow p-2">
                <!-- Authentication Links -->
                @guest @if (Route::has('register'))
                <li class="nav-item mr-3">
                    <a id="test-hover" class="nav-link sei rounded text-white font-weight-bold px-2" href="{{ route('register') }}">Sei un dottore? Iscriviti</a>
                </li>
                @endif
                <li class="nav-item font-weight-bold">
                    <a id="test-hover-2" class="nav-link text-up" href="{{ route('login') }}">{{ __('Accedi') }}
                        <i class="far fa-user-circle h5 text-up"></i>
                    </a>
                </li>

                @else
                <li class="nav-item dropdown font-weight-bold">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-up" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('dashboard') }}">
                            {{ __('DashBoard') }}
                        </a>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </nav>
</header>

<body class="bg-white">





    <main class="pb-5">

        @yield('content')
    </main>

    <!-- Optional JavaScript -->
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <script>
        $(document).ready(function() {
            $(window).scroll(function() {
                if ($(this).scrollTop() > 100) {
                    $('#scroll').fadeIn();
                } else {
                    $('#scroll').fadeOut();
                }
            });
            $('#scroll').click(function() {
                $("html, body").animate({
                    scrollTop: 0
                }, 600);
                return false;
            });
        });

        $('#test-hover').hover(
            function() {
                $(this).addClass('test-hv')
            },
            function() {
                $(this).removeClass('test-hv')
            }
        )

        $('#test-hover-2').hover(
            function() {
                $(this).addClass('test-hv-2')
            },
            function() {
                $(this).removeClass('test-hv-2')
            }
        )
    </script>
</body>

</html>