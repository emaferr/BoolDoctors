@include('layouts/partials/head')

@include('layouts/partials/guest_header')

<main class="pb-5">
    @yield('content')
</main>

@include('layouts/partials/footer')

<script>
    $(function() {
        // bind change event to select
        $('#dynamic_select').on('change', function() {
            var url = 'specialization/';
            var urlCom = $(this).val(); // get selected value
            if (url) { // require a URL
                window.location = url + urlCom; // redirect
            }
            return false;
        });
    });
</script>

<script>
    $(document).ready(function(){ 
        $(window).scroll(function(){ 
            if ($(this).scrollTop() > 100) { 
                $('#scroll').fadeIn(); 
            } else { 
                $('#scroll').fadeOut(); 
            } 
        }); 
        $('#scroll').click(function(){ 
            $("html, body").animate({ scrollTop: 0 }, 600); 
            return false; 
        }); 
    });
    
    </script>

</body>

</html>