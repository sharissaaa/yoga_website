<!-- ============================================================
     Needs Cormorant Garamond, Cinzel and Inter loaded on the page,
     plus css/home-page-css/home-about.css linked in <head>.
     ============================================================ -->

@if(!empty($about['title']) || !empty($about['paragraph1']))
<section class="origins-section">
  <div class="os-wrap">

    @if(!empty($about['title']) || !empty($about['subtitle']))
    <div class="os-header">
      @if(!empty($about['title']))
      <h2 class="os-title">{{ $about['title'] }}</h2>
      @endif
      @if(!empty($about['subtitle']))
      <p class="os-subtitle">{{ $about['subtitle'] }}</p>
      @endif
    </div>
    @endif

    @if(!empty($about['paragraph1']) || !empty($about['paragraph2']))
    <div class="os-body-group">
      @if(!empty($about['paragraph1']))
      <p class="os-body">{{ $about['paragraph1'] }}</p>
      @endif
      @if(!empty($about['paragraph2']))
      <p class="os-body">{{ $about['paragraph2'] }}</p>
      @endif
    </div>
    @endif

    @if(!empty($about['linkText']))
    <div class="os-more-wrap">
      <a href="{{ $about['linkUrl'] ?: '#' }}" class="os-more">{{ $about['linkText'] }}</a>
    </div>
    @endif

  </div>
</section>
@endif
