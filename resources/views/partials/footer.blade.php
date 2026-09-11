<footer class="site-footer">
  <div class="site-footer__brand">
    @if(!empty($siteFooter['logo']))
    <img src="{{ $siteFooter['logo'] }}" alt="" class="site-footer__logo-icon" />
    @endif
    @if(!empty($siteFooter['brandTitle']))
    <h2 class="site-footer__brand-title">{{ $siteFooter['brandTitle'] }}</h2>
    @endif
    @if(!empty($siteFooter['brandSubtitle']))
    <p class="site-footer__brand-subtitle">{{ $siteFooter['brandSubtitle'] }}</p>
    @endif
    @if(!empty($siteFooter['tagline']))
    <p class="site-footer__tagline">{{ $siteFooter['tagline'] }}</p>
    @endif
  </div>

  @if(!empty($siteFooter['quickLinks']))
  <nav class="site-footer__col site-footer__col--collapsible" aria-label="Quick links">
    @if(!empty($siteFooter['quickLinksHeading']))
    <h3 class="site-footer__col-heading">{{ $siteFooter['quickLinksHeading'] }}</h3>
    @endif
    <ul>
      @foreach($siteFooter['quickLinks'] as $link)
      <li><a href="{{ $link['url'] }}">{{ $link['label'] }}</a></li>
      @endforeach
    </ul>
  </nav>
  @endif

  @if(!empty($siteFooter['offeringsLinks']))
  <nav class="site-footer__col site-footer__col--collapsible" aria-label="Our offerings">
    @if(!empty($siteFooter['offeringsHeading']))
    <h3 class="site-footer__col-heading">{{ $siteFooter['offeringsHeading'] }}</h3>
    @endif
    <ul>
      @foreach($siteFooter['offeringsLinks'] as $link)
      <li><a href="{{ $link['url'] }}">{{ $link['label'] }}</a></li>
      @endforeach
    </ul>
  </nav>
  @endif

  <div class="site-footer__col site-footer__col--newsletter">
    @if(!empty($siteFooter['newsletterHeading']))
    <h3 class="site-footer__col-heading">{{ $siteFooter['newsletterHeading'] }}</h3>
    @endif
    @if(!empty($siteFooter['newsletterText']))
    <p>{{ $siteFooter['newsletterText'] }}</p>
    @endif
    <form class="site-newsletter-form" onsubmit="return false;" autocomplete="off">
      <label for="newsletterEmail" class="sr-only">Your email address</label>
      <input id="newsletterEmail" name="newsletter_email_bhumi" type="email" placeholder="Your email address"
        autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
      <button type="submit" aria-label="Subscribe">→</button>
    </form>

    @if(!empty($social['whatsapp']) || !empty($social['instagram']) || !empty($social['youtube']))
    <div class="site-footer-social">
      @include('partials.social-icons')
    </div>
    @endif
  </div>

  <div class="site-footer__bottom">
    <span>© 2026 BHUMI MANTRA. All Rights Reserved.</span>
    <img src="assets/gallery/home-image/logo.png" alt="" class="site-footer__lotus" />
  </div>
</footer>
