@php
  $isNavLinkActive = function (string $url) {
    if ($url === 'index.html') {
      return request()->is('/') || request()->is('index.html');
    }
    if ($url === 'travel.html') {
      return request()->is('travel.html') || request()->is('destination-detail.html');
    }
    return request()->is($url);
  };
@endphp
<!-- ================= HEADER (shared) ================= -->
<nav class="site-nav" id="siteNav">
  <a href="index.html" class="site-nav__logo">
    @if(!empty($siteHeader['logo']))
    <img src="{{ $siteHeader['logo'] }}" alt="" class="site-nav__logo-icon" />
    @endif
    @if(!empty($siteHeader['logoText']))
    <span class="site-nav__logo-text">
      {{ $siteHeader['logoText'] }}
      @if(!empty($siteHeader['logoTagline']))
      <small>{{ $siteHeader['logoTagline'] }}</small>
      @endif
    </span>
    @endif
  </a>

  <div class="site-nav__panel" id="navLinks">
    @if(!empty($siteHeader['navLinks']))
    <ul class="site-nav__links">
      @foreach($siteHeader['navLinks'] as $link)
      <li><a href="{{ $link['url'] }}" class="{{ $isNavLinkActive($link['url']) ? 'active' : '' }}">{{ $link['label'] }}</a></li>
      @endforeach
    </ul>
    @endif

    @if(!empty($siteHeader['contactHeading']) || !empty($siteHeader['phone']) || !empty($siteHeader['email']))
    <div class="site-nav__panel-section">
      @if(!empty($siteHeader['contactHeading']))
      <h4 class="site-nav__panel-heading">{{ $siteHeader['contactHeading'] }}</h4>
      @endif
      @if(!empty($siteHeader['phone']))
      <a href="tel:{{ preg_replace('/\s+/', '', $siteHeader['phone']) }}" class="site-nav__panel-line">{{ $siteHeader['phone'] }}</a>
      @endif
      @if(!empty($siteHeader['email']))
      <a href="mailto:{{ $siteHeader['email'] }}" class="site-nav__panel-line">{{ $siteHeader['email'] }}</a>
      @endif
      @if(!empty($siteHeader['locationNote']))
      <span class="site-nav__panel-line">{{ $siteHeader['locationNote'] }}</span>
      @endif
    </div>
    @endif

    @if(!empty($social['whatsapp']) || !empty($social['instagram']) || !empty($social['youtube']))
    <div class="site-nav__panel-section">
      <h4 class="site-nav__panel-heading">Follow Us</h4>
      <div class="site-footer-social">
        @include('partials.social-icons')
      </div>
    </div>
    @endif
  </div>

  @if(!empty($social['whatsapp']) || !empty($social['instagram']) || !empty($social['youtube']))
  <div class="site-nav__social">
    @include('partials.social-icons')
  </div>
  @endif

  <button type="button" class="site-nav__burger" id="navBurger" aria-label="Toggle menu" aria-expanded="false"
    aria-controls="navLinks">
    <span></span><span></span><span></span>
  </button>
</nav>
<!-- ================= /HEADER ================= -->
