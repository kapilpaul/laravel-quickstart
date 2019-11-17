@stack('footer_top_js')

<script src="{{ mix('js/app.js') }}"></script>

<!-- build:js({.tmp,app}) scripts/app.min.js -->
<script src="{{ asset('assets/scripts/helpers/modernizr.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery/dist/jquery.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/vendor/fastclick/lib/fastclick.js') }}"></script>
<script src="{{ asset('assets/vendor/perfect-scrollbar/js/perfect-scrollbar.jquery.js') }}"></script>
<script src="{{ asset('assets/scripts/helpers/smartresize.js') }}"></script>
<script src="{{ asset('assets/scripts/constants.js') }}"></script>
<script src="{{ asset('assets/scripts/main.js') }}"></script>

@stack('footer_js')

<!-- endbuild -->
<!-- page scripts -->
{{--<script src="{{ asset('assets/vendor/flot/jquery.flot.js') }}"></script>--}}
{{--<script src="{{ asset('assets/vendor/flot/jquery.flot.resize.js') }}"></script>--}}
{{--<script src="{{ asset('assets/vendor/flot/jquery.flot.categories.js') }}"></script>--}}
{{--<script src="{{ asset('assets/vendor/flot/jquery.flot.stack.js') }}"></script>--}}
{{--<script src="{{ asset('assets/vendor/flot/jquery.flot.time.js') }}"></script>--}}
{{--<script src="{{ asset('assets/vendor/flot/jquery.flot.pie.js') }}"></script>--}}
{{--<script src="{{ asset('assets/vendor/flot-spline/js/jquery.flot.spline.js') }}"></script>--}}
{{--<script src="{{ asset('assets/vendor/flot.orderbars/js/jquery.flot.orderBars.js') }}"></script>--}}
{{--<!-- end page scripts -->--}}
{{--<!-- initialize page scripts -->--}}
{{--<script src="{{ asset('assets/scripts/helpers/sameheight.js') }}"></script>--}}
{{--<script src="{{ asset('assets/scripts/ui/dashboard.js') }}"></script>--}}
<!-- end initialize page scripts -->


@stack('footer_bottom_js')

@if(session('access_token'))
    <script>
        localStorage.setItem('token', '{{ session('access_token') }}');
        localStorage.setItem('expiration', '{{ session('expiration') }}' + Date.now());
    </script>
@endif

</body>
</html>
