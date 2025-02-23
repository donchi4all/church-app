<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="{{ asset('favicon.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600&family=Inter&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('fonts/icomoon/style.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/flaticon/font/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tiny-slider.css') }}">
    <link rel="stylesheet" href="{{ asset('css/glightbox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>{{ $seo_title ?? $__env->yieldContent('title', 'TheChurch') }}</title>
    <meta name="description" content="{{ $seo_description ?? 'Default description for the site' }}">
    <meta name="keywords" content="{{ $seo_keywords ?? 'church, sermons, Bible, faith' }}">
    <meta name="author" content="Grace Operated Life International Ministry">
    <meta name="robots" content="index, follow">

    <!-- Open Graph (Facebook & LinkedIn) -->
    <meta property="og:title" content="{{ $seo_title ?? 'Default Site Title' }}">
    <meta property="og:description" content="{{ $seo_description ?? 'Default description for the site' }}">
    <meta property="og:image" content="{{ $seo_image ?? asset('default-image.jpg') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $seo_title ?? 'Default Site Title' }}">
    <meta name="twitter:description" content="{{ $seo_description ?? 'Default description for the site' }}">
    <meta name="twitter:image" content="{{ $seo_image ?? asset('default-image.jpg') }}">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}">
</head>

<body>
    @include('frontend.partials.header')

    <main>
        @yield('content')
    </main>

    @include('frontend.partials.footer')

    {{-- <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/tiny-slider.js') }}"></script>
    <script src="{{ asset('js/glightbox.min.js') }}"></script>
    <script src="{{ asset('js/aos.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script> --}}

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/tiny-slider.js') }}"></script>
    <script src="{{ asset('js/glightbox.min.js') }}"></script>
    <script src="{{ asset('js/aos.js') }}"></script>
    <script src="{{ asset('js/navbar.js') }}"></script>
    <script src="{{ asset('js/counter.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>

</body>

</html>
