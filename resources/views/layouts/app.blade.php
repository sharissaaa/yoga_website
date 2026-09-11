<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />

  @if(!empty($seo['pageTitle']))
  <title>{{ $seo['pageTitle'] }}</title>
  @else
  <title>@yield('title', 'Bhumi Mantra')</title>
  @endif

  @if(!empty($seo['searchDescription']))
  <meta name="description" content="{{ $seo['searchDescription'] }}" />
  @elseif(\Illuminate\Support\Facades\View::hasSection('meta-description'))
  <meta name="description" content="@yield('meta-description')" />
  @endif

  @if(!empty($seo['keywords']))
  <meta name="keywords" content="{{ $seo['keywords'] }}" />
  @endif
  @if(!empty($seo['canonicalUrl']))
  <link rel="canonical" href="{{ $seo['canonicalUrl'] }}" />
  @endif
  @if(isset($seo['allowSearchEngines']) && !$seo['allowSearchEngines'])
  <meta name="robots" content="noindex, nofollow" />
  @endif
  @if(!empty($seo['socialTitle']) || !empty($seo['socialDescription']) || !empty($seo['socialImage']))
  <meta property="og:type" content="website" />
  @if(!empty($seo['canonicalUrl']))
  <meta property="og:url" content="{{ $seo['canonicalUrl'] }}" />
  @endif
  @if(!empty($seo['socialTitle']))
  <meta property="og:title" content="{{ $seo['socialTitle'] }}" />
  @endif
  @if(!empty($seo['socialDescription']))
  <meta property="og:description" content="{{ $seo['socialDescription'] }}" />
  @endif
  @if(!empty($seo['socialImage']))
  <meta property="og:image" content="{{ $seo['socialImage'] }}" />
  @endif
  @endif
  @if(!empty($seo['twitterTitle']) || !empty($seo['twitterDescription']) || !empty($seo['twitterImage']))
  <meta name="twitter:card" content="summary_large_image" />
  @if(!empty($seo['twitterTitle']))
  <meta name="twitter:title" content="{{ $seo['twitterTitle'] }}" />
  @endif
  @if(!empty($seo['twitterDescription']))
  <meta name="twitter:description" content="{{ $seo['twitterDescription'] }}" />
  @endif
  @if(!empty($seo['twitterImage']))
  <meta name="twitter:image" content="{{ $seo['twitterImage'] }}" />
  @endif
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
