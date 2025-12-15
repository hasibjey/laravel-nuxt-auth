<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/zarfcart_logo.png') }}">
    
    <title>{{ $title ?? '' }}</title>

    <!-- Style section -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome/css/all.min.css') }}">
    
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body>
    <!-- Start -->
    <section class="wrapper fixes top-0 left-0 w-screen h-screen">
        <div class="flex justify-center items-center h-full bg-gray-200">
            {{ $slot }}
        </div>
    </section>
    <!-- End -->
</body>

</html>
