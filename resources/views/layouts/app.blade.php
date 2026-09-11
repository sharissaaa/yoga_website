<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <title>@yield('title', 'Bhumi Mantra')</title>
  @hasSection('meta-description')
  <meta name="description" content="@yield('meta-description')" />
  @endif

  @stack('styles')
</head>

<body class="{{ $bodyClass ?? 'theme-gold' }}">
  @include('partials.nav')

  @yield('content')

  @include('partials.footer')

  @stack('scripts')
</body>
</html>
