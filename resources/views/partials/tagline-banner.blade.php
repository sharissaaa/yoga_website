@if(!empty($tagline['sanskrit']) || !empty($tagline['translation']))
<section class="tagline-banner">
  <img src="assets/gallery/home-image/contact.png" alt="" class="tagline-banner__bg" aria-hidden="true" />
  <div class="tagline-banner__overlay" aria-hidden="true"></div>
  <div class="tagline-banner__content">
    <img src="assets/gallery/home-image/logo.png" alt="" class="tagline-banner__mandala" aria-hidden="true">
    @if(!empty($tagline['sanskrit']))
    <p class="tagline-banner__sanskrit">{{ $tagline['sanskrit'] }}</p>
    @endif
    @if(!empty($tagline['transliteration']))
    <p class="tagline-banner__translit">{{ $tagline['transliteration'] }}</p>
    @endif
    @if(!empty($tagline['translation']))
    <p class="tagline-banner__text"><em>{{ $tagline['translation'] }}</em></p>
    @endif
  </div>
</section>
@endif
