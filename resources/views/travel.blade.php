@extends('layouts.app')

@push('styles')
  <link rel="stylesheet" href="css/travel-page-css/travel.css" />
  <link rel="stylesheet" href="css/header-footer.css" />

  <link
    href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Inter:wght@300;400;500;600&family=Noto+Serif+Devanagari:wght@400;500;600&display=swap"
    rel="stylesheet" />
  <script src="js/travel-page-js/travel.js"></script>
@endpush

@section('content')

  <!-- ===== HERO ===== -->
  @if(!empty($hero['heading']) || !empty($hero['headingHighlight']))
  <section class="hero">
    @if(!empty($hero['backgroundImage']))
    <img src="{{ $hero['backgroundImage'] }}" alt="" class="hero__bg" aria-hidden="true" />
    @endif
    <div class="hero__overlay" aria-hidden="true"></div>
    <div class="hero__content">
      <h1 class="hero__heading">
        {{ $hero['heading'] ?? '' }}<br />
        @if(!empty($hero['headingHighlight']))
        <em>{{ $hero['headingHighlight'] }}</em>
        @endif
      </h1>
    </div>
  </section>
  @endif

  <!-- ===== RETREATS ===== -->
  @if(!empty($destinations))
  <section class="retreats" id="retreats">

    <!-- CARDS (all shown at once — no pagination) -->
    <div class="retreats-list" id="retreatsList">
      @foreach($destinations as $destination)
      <article class="retreat-card" data-slug="{{ $destination['slug'] }}">
        @if(!empty($destination['badge']))
        <div class="retreat-card__badge">{{ $destination['badge'] }}</div>
        @endif
        @if(!empty($destination['image']))
        <img src="{{ $destination['image'] }}" alt="{{ $destination['title'] }}" class="retreat-card__img" />
        @endif
        <div class="retreat-card__body">
          @if(!empty($destination['title']))
          <h2 class="retreat-card__title">{{ $destination['title'] }}</h2>
          @endif
          @if(!empty($destination['destinationCountry']) || !empty($destination['duration']) || !empty($destination['level']))
          <p class="retreat-card__meta">
            @if(!empty($destination['destinationCountry']))
            <span class="meta-loc">{{ $destination['destinationCountry'] }}</span>
            <span class="meta-dot">•</span>
            @endif
            @if(!empty($destination['duration']))
            <span>{{ $destination['duration'] }}</span>
            <span class="meta-dot">•</span>
            @endif
            @if(!empty($destination['level']))
            <span class="meta-tag {{ $destination['level'] === 'All Levels' ? 'meta-tag--green' : '' }}">{{ $destination['level'] }}</span>
            @endif
          </p>
          @endif
          @if(!empty($destination['description']))
          <p class="retreat-card__desc">{{ $destination['description'] }}</p>
          @endif
        </div>
        <div class="retreat-card__aside">
          @if(!empty($destination['dates']))
          <div class="aside-block">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="aside-block__icon" aria-hidden="true">
              <rect x="3" y="5" width="18" height="16" rx="2" />
              <path d="M3 9h18M8 3v4M16 3v4" />
            </svg>
            <div>
              <p class="aside-block__label">Dates</p>
              <p class="aside-block__value">{{ $destination['dates'] }}</p>
            </div>
          </div>
          <div class="aside-divider"></div>
          @endif
          <div class="aside-block">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="aside-block__icon" aria-hidden="true">
              <rect x="3" y="5" width="18" height="14" rx="2" />
              <path d="m4 7 8 6 8-6" />
            </svg>
            <div>
              <p class="aside-block__label">Email</p>
              <a href="mailto:travel@innerjourney.com" class="aside-block__value aside-block__link">travel@innerjourney<wbr>.com</a>
            </div>
          </div>
          <div class="aside-divider"></div>
          <a href="destination-detail.html?slug={{ $destination['slug'] }}" class="aside-invite-btn">View Full Details</a>
        </div>
      </article>
      @endforeach
    </div>

    <p class="retreats-empty" id="retreatsEmpty" hidden>
      No retreats match your filters. Try adjusting your selection.
    </p>

  </section>
  @endif

  <!-- ===== PERSONALIZED TRAVEL PACKAGE ===== -->
  @if(!empty($personalizedTeaser['heading']))
  <section class="custom-package" id="custom-package">
    <div class="custom-package__content">
      <h2 class="custom-package__heading">{{ $personalizedTeaser['heading'] }}</h2>
      @if(!empty($personalizedTeaser['text']))
      <p class="custom-package__text">{{ $personalizedTeaser['text'] }}</p>
      @endif
      @if(!empty($personalizedTeaser['linkText']))
      <a href="{{ $personalizedTeaser['linkUrl'] ?: '#' }}" class="btn custom-package__link">{{ $personalizedTeaser['linkText'] }} &rarr;</a>
      @endif
    </div>
  </section>
  @endif

  @include('partials.tagline-banner')
@endsection

@push('scripts')
  <script src="js/travel-page-js/travel-page.js"></script>
  <script src="js/nav-dropdown.js"></script>
@endpush
