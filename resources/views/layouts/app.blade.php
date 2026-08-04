<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Hamza Enterprises')</title>
  <meta name="description" content="@yield('meta_description', 'Hamza Enterprises connects global buyers with certified, inspected used vehicles from South Korea.')">
  <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/favicon-32.png') }}">
  <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/img/favicon-192.png') }}">
  <link rel="apple-touch-icon" href="{{ asset('assets/img/apple-touch-icon.png') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
  @stack('styles')
</head>

<body>

@include('partials.icons')

@include('partials.topbar')

@include('partials.header')

@yield('content')

@include('partials.footer')

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('assets/js/currency.js') }}"></script>
<script src="{{ asset('assets/js/currency-select.js') }}"></script>
<script src="{{ asset('assets/js/nav-toggle.js') }}"></script>
<script src="{{ asset('assets/js/newsletter.js') }}"></script>

@stack('scripts')

</body>

</html>
