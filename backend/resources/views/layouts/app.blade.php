<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('images/zarfcart_logo.png') }}">
    
    <title>{{ trim(($title ?? '') . ' | ') }}</title>

    <!-- Styles / Scripts -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome/css/all.min.css') }}">

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <!-- Style section -->
    {{ $css ?? '' }}
</head>

<body>
    <!-- Start -->
    <section class="wrapper fixes top-0 left-0 w-screen h-screen">
        <!-- Layout start -->
        <section class="flex flex-row items-center">
            <!-- Main side section start -->
            <div class="aside-blank w-0 xl:w-62.5"></div>
            <x-aside-layout/>
            <!-- Main side section end -->

            <!-- Main container section start -->
            <section class="bg-white bg-opacity-30 flex-1 h-screen overflow-hidden">
                <!-- Header -->
                <x-header-layout />
                <!-- Content section -->
                {{ $slot }}
                <!-- Footer -->
                <footer class="p-2.5 border-t border-side-secondary mt-1">
                    <small>Copyright &copy; 2025-{{ Date('Y') }} xavitech.com. All rights reserved</small>
                </footer>
            </section>
            <!-- Main container section end -->
        </section>
        <!-- Layout end -->
    </section>
    <!-- End -->


    <!-- JavaScript section -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Custom js -->
    <script src="{{ asset('js/x-texteditor.js') }}"></script>
    <script src="{{ asset('js/x_multi_selector.js') }}"></script>
    <script src="{{ asset('js/destroy.js') }}"></script>
    {{ $js ?? '' }}
</body>

</html>
