<!DOCTYPE html>
<html lang="en">

@include('frontend.layouts.head')

<body>

    @include('frontend.layouts.header')

    <main id="main">
        @yield('content')
    </main>

    @include('frontend.layouts.footer')

    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{('frontend/assets/vendor/aos/aos.js')}}"></script>
    <script src="{{('frontend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{('frontend/assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
    <script src="{{('frontend/assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
    <script src="{{('frontend/assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
    <script src="{{('frontend/assets/vendor/php-email-form/validate.js')}}"></script>

    <!-- Template Main JS File -->
    <script src="{{('frontend/assets/js/main.js')}}"></script>
    @yield('scripts')

</body>

</html>
