<div class="stories-premium">

  <div class="hero-stories-wrapper">

    <!-- ─────────── HERO QUOTE ─────────── -->
    @if(!empty($stories['quotes']))
    <section class="quote-section">
      <div class="ember ember-1"></div>
      <div class="ember ember-2"></div>
      <div class="ember ember-3"></div>

      <!-- Main quote — auto-cycling carousel, sideways slide -->
      <div class="wrapper quote-inner">

        <div class="quote-carousel">
          @foreach($stories['quotes'] as $quote)
          <div class="quote-slide">
            @if(!empty($quote['sanskrit']))
            <p class="quote-sanskrit">{{ $quote['sanskrit'] }}</p>
            @endif
            @if(!empty($quote['transliteration']))
            <p class="quote-translit">{{ $quote['transliteration'] }}</p>
            @endif
            @if(!empty($quote['translation']))
            <p class="quote-text">{{ $quote['translation'] }}</p>
            @endif
          </div>
          @endforeach
        </div>
      </div>
    </section>
    @endif

    <div class="rule"></div>

    @if(!empty($stories['eyebrow']) || !empty($stories['items']))
    <section class="stories-section">
      <div class="container">
        <div class="stories-top">
          <div>
            @if(!empty($stories['eyebrow']))
            <span class="eyebrow">{{ $stories['eyebrow'] }}</span>
            @endif
          </div>
          @if(!empty($stories['items']))
          <div class="story-nav">
            <button class="story-arrow" aria-label="Previous story">
              <i class="fas fa-arrow-left"></i>
            </button>
            <button class="story-arrow active" aria-label="Next story">
              <i class="fas fa-arrow-right"></i>
            </button>
          </div>
          @endif
        </div>
        @if(!empty($stories['items']))
        <div class="story-grid">
          @foreach($stories['items'] as $story)
          <div class="story-card-col">
            <div class="story-card @if(!empty($story['isPlaceholder'])) story-card--placeholder @endif">
              <span class="card-quote-glyph">&rdquo;</span>
              @if(!empty($story['name']))
              <p class="story-name">{{ $story['name'] }}</p>
              @endif
              @if(!empty($story['meta']))
              <p class="story-meta">{{ $story['meta'] }}</p>
              @endif
              @if(!empty($story['isPlaceholder']))
              <p class="story-placeholder-text">{{ $story['quote'] }}</p>
              @else
              @if(!empty($story['quote']))
              <p class="story-quote">{{ $story['quote'] }}</p>
              @endif
              <button type="button" class="story-read">Read more</button>
              @endif
            </div>
          </div>
          @endforeach
        </div>
        @endif
      </div>
    </section>
    @endif

    <img src="assets/gallery/home-image/budha.png" alt="Buddha statue" class="buddha-image" />
  </div>

  <!-- ─────────── NEWSLETTER ─────────── -->
  @if(!empty($newsletter['heading']))
  <section class="newsletter-section">
    <div class="nl-inner">
      <h2 class="nl-title">{{ $newsletter['heading'] }}</h2>
      <div class="nl-form">
        <input class="nl-input" type="email" placeholder="Your email address" aria-label="Email address" />
        <button class="nl-btn">Subscribe</button>
      </div>
    </div>
  </section>
  @endif
</div>
