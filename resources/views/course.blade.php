@extends('layouts.app')

@push('styles')
  <link rel="stylesheet" href="css/course.css" />
  <!-- Shared across every page: same nav + footer design, color set per page below -->
  <link rel="stylesheet" href="css/header-footer.css" />

  <link
    href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Inter:wght@300;400;500;600&display=swap"
    rel="stylesheet" />
@endpush

@section('content')

  <!-- ===== HERO ===== -->
  @if(!empty($hero['heading']) || !empty($hero['subText']))
  <section class="hero">
    @if(!empty($hero['backgroundImage']))
    <img src="{{ $hero['backgroundImage'] }}" alt="" class="hero__bg" aria-hidden="true" />
    @endif
    <div class="hero__overlay" aria-hidden="true"></div>
    <div class="hero__content">
      @if(!empty($hero['heading']))
      <h1 class="hero__heading">
        <span class="hero__heading-accent">{{ $hero['heading'] }}</span>
      </h1>
      @endif
      @if(!empty($hero['subText']))
      <p class="hero__sub">{{ $hero['subText'] }}</p>
      @endif
    </div>
  </section>
  @endif

  <!-- ===== COURSE HIGHLIGHTS ===== -->
  @if(!empty($highlights['heading']) || !empty($highlights['cards']))
  <section class="highlights">

    @if(!empty($highlights['heading']) || !empty($highlights['description']))
    <div class="highlights__header">
      @if(!empty($highlights['heading']))
      <h2 class="highlights__title">
        {{ $highlights['heading'] }}<br />
        @if(!empty($highlights['headingHighlight']))
        <em>{{ $highlights['headingHighlight'] }}</em>
        @endif
      </h2>
      @endif
      @if(!empty($highlights['description']))
      <p class="highlights__desc">{{ $highlights['description'] }}</p>
      @endif
    </div>
    @endif

    @if(!empty($highlights['cards']))
    <div class="highlights__carousel">

      <button class="highlights__arrow highlights__arrow--prev" aria-label="Previous">
        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M15 6l-6 6 6 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
      </button>

      <div class="highlights__track">
        @foreach($highlights['cards'] as $card)
        <article class="hl-card">
          @if(!empty($card['image']))
          <div class="hl-card__media">
            <img src="{{ $card['image'] }}" alt="{{ $card['title'] }}" />
            @if(!empty($card['badge']))
            <span class="hl-card__badge">{{ $card['badge'] }}</span>
            @endif
          </div>
          @endif
          @if(!empty($card['title']))
          <h4 class="hl-card__title">{{ $card['title'] }}</h4>
          @endif
          @if(!empty($card['meta']))
          <p class="hl-card__meta">{{ $card['meta'] }}</p>
          @endif
          @if(!empty($card['description']))
          <p class="hl-card__desc">{{ $card['description'] }}</p>
          <button type="button" class="hl-card__toggle" aria-expanded="false">Read more</button>
          @endif
        </article>
        @endforeach
      </div>

      <button class="highlights__arrow highlights__arrow--next" aria-label="Next">
        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M9 6l6 6-6 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
      </button>
    </div>
    @endif

  </section>
  @endif

  <!-- ===== WHAT YOU'LL LEARN ===== -->
  @if(!empty($learn['items']) || !empty($learn['quoteText']))
  <section class="learn">

    <div class="learn__bg" aria-hidden="true">
      @if(!empty($learn['backgroundImage']))
      <img src="{{ $learn['backgroundImage'] }}" alt="" class="learn__bg-img" />
      @endif
      <div class="learn__bg-overlay"></div>
    </div>

    <div class="learn__inner">

      @if(!empty($learn['items']))
      <div class="learn__left">
        <ul class="learn-list">
          @foreach($learn['items'] as $i => $item)
          <li class="learn-list__item">
            <div>
              @if(!empty($item['title']))
              <h4>{{ $item['title'] }}</h4>
              @endif
              @if(!empty($item['description']))
              <p>{{ $item['description'] }}</p>
              @endif
            </div>
          </li>
          @if(!$loop->last)
          <li class="learn-list__sep" aria-hidden="true"><span></span></li>
          @endif
          @endforeach
        </ul>
      </div>
      @endif

      <div class="learn__center">
        @if(!empty($learn['eyebrow']))
        <p class="learn__eyebrow">{{ $learn['eyebrow'] }}</p>
        @endif
        @if(!empty($learn['image']))
        <div class="learn__img-wrap">
          <img src="{{ $learn['image'] }}" alt="" class="learn__img" />
          <div class="learn__img-gradient" aria-hidden="true"></div>
          <div class="learn__img-frame" aria-hidden="true"></div>
        </div>
        @endif
      </div>

      @if(!empty($learn['quoteText']))
      <div class="learn__right">
        <span class="learn__quote-mark">&ldquo;</span>
        <p class="learn__quote-text">{{ $learn['quoteText'] }}</p>
        @if(!empty($learn['quoteAuthor']))
        <p class="learn__quote-author">— {{ $learn['quoteAuthor'] }}</p>
        @endif
      </div>
      @endif

    </div>
  </section>
  @endif

  <!-- ===== COMPARE COURSES ===== -->
  @if(!empty($compare['heading']) || !empty($compare['noteText']))
  <section class="course-compare">
    <div class="cc-inner">

      @if(!empty($compare['image']))
      <div class="cc-media">
        <img src="{{ $compare['image'] }}" alt="" />
      </div>
      @endif

      <div class="cc-content">
        @if(!empty($compare['heading']))
        <h2 class="cc-title">{{ $compare['heading'] }}</h2>
        @endif

        @if(!empty($compare['noteText']))
        <div class="course-details__note">
          <svg viewBox="0 0 24 24" width="26" height="26" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
            <rect x="3" y="4" width="18" height="17" rx="2"></rect>
            <path d="M3 9h18"></path>
            <path d="M8 2v4M16 2v4"></path>
          </svg>
          <p>{!! $compare['noteText'] !!}</p>
        </div>
        @endif
      </div>

    </div>
  </section>
  @endif

  <!-- ===== CLOSING BANNER ===== -->
  @if(!empty($tagline['sanskrit']) || !empty($tagline['translation']))
  <section class="closing">
    <img src="assets/gallery/home-image/logo.png" alt="Mandala" class="closing__emblem" />
    @if(!empty($tagline['sanskrit']))
    <p class="closing__sanskrit">{{ $tagline['sanskrit'] }}</p>
    @endif
    @if(!empty($tagline['transliteration']))
    <p class="closing__translit">{{ $tagline['transliteration'] }}</p>
    @endif
    @if(!empty($tagline['translation']))
    <p class="closing__text">{{ $tagline['translation'] }}</p>
    @endif
  </section>
  @endif
@endsection

@push('scripts')
  <script src="js/course-page-js/course.js"></script>
  <script src="js/nav-dropdown.js"></script>
@endpush
