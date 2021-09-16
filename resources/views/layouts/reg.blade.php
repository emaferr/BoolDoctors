@include('layouts/partials/head')

@include('layouts/partials/guest_header')

<main class="py-5">
    @yield('content')

</main>

</div>

<!-- Optional JavaScript -->
<script src="{{ asset('js/app.js') }}"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

<script>
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