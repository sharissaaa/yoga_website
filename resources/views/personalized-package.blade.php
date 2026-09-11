@extends('layouts.app')

@push('styles')
  <link rel="stylesheet" href="css/travel-page-css/travel.css" />
  <link rel="stylesheet" href="css/header-footer.css" />
  <link rel="stylesheet" href="css/travel-page-css/personalized-package.css" />

  <link
    href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Inter:wght@300;400;500;600&family=Noto+Serif+Devanagari:wght@400;500;600&display=swap"
    rel="stylesheet" />
@endpush

@section('content')

  <!-- ===== HERO ===== -->
  @if(!empty($hero['heading']) || !empty($hero['subText']))
  <section class="pp-hero">
    @if(!empty($hero['backgroundImage']))
    <img src="{{ $hero['backgroundImage'] }}" alt="" class="pp-hero__bg" aria-hidden="true" />
    @endif
    <div class="pp-hero__overlay" aria-hidden="true"></div>
    <div class="pp-hero__content">
      @if(!empty($hero['heading']) || !empty($hero['headingHighlight']))
      <h1 class="pp-hero__heading">
        {{ $hero['heading'] ?? '' }}
        @if(!empty($hero['headingHighlight']))
        <em>{{ $hero['headingHighlight'] }}</em>
        @endif
      </h1>
      @endif
      @if(!empty($hero['subText']))
        @if(!empty($hero['subLinkUrl']))
        <a href="{{ $hero['subLinkUrl'] }}" class="pp-hero__sub">{{ $hero['subText'] }}</a>
        @else
        <p class="pp-hero__sub">{{ $hero['subText'] }}</p>
        @endif
      @endif
    </div>
  </section>
  @endif

  <!-- ===== HOW IT WORKS ===== -->
  @if(!empty($steps['items']))
  <section class="pp-steps">
    @if(!empty($steps['eyebrow']))
    <p class="eyebrow eyebrow--center">{{ $steps['eyebrow'] }}</p>
    @endif
    <div class="pp-steps__grid">
      @foreach($steps['items'] as $step)
      <div class="pp-steps__item">
        @if(!empty($step['number']))
        <span class="pp-steps__num">{{ $step['number'] }}</span>
        @endif
        @if(!empty($step['heading']))
        <h3>{{ $step['heading'] }}</h3>
        @endif
        @if(!empty($step['text']))
        <p>{{ $step['text'] }}</p>
        @endif
      </div>
      @endforeach
    </div>
  </section>
  @endif

  <!-- ===== IMMERSIVE BREAK ===== -->
  @if(!empty($breakSection['quote']))
  <section class="pp-break">
    @if(!empty($breakSection['backgroundImage']))
    <img src="{{ $breakSection['backgroundImage'] }}" alt="" class="pp-break__bg" aria-hidden="true" />
    @endif
    <div class="pp-break__overlay" aria-hidden="true"></div>
    <p class="pp-break__quote"><em>{{ $breakSection['quote'] }}</em></p>
  </section>
  @endif

  <!-- ===== PACKAGE IDEAS ===== -->
  @if(!empty($ideas['heading']) || !empty($ideas['items']))
  <section class="pp-ideas">
    @if(!empty($ideas['eyebrow']))
    <p class="eyebrow eyebrow--center">{{ $ideas['eyebrow'] }}</p>
    @endif
    @if(!empty($ideas['heading']))
    <h2 class="pp-ideas__heading">{{ $ideas['heading'] }}</h2>
    @endif
    @if(!empty($ideas['subText']))
    <p class="pp-ideas__sub">{{ $ideas['subText'] }}</p>
    @endif

    <div class="pp-ideas__grid">
      @foreach($ideas['items'] as $idea)
      <article class="pp-idea">
        @if(!empty($idea['image']))
        <div class="pp-idea__media">
          <img src="{{ $idea['image'] }}" alt="{{ $idea['heading'] }}" />
        </div>
        @endif
        @if(!empty($idea['heading']))
        <h3>{{ $idea['heading'] }}</h3>
        @endif
        @if(!empty($idea['text']))
        <p>{{ $idea['text'] }}</p>
        @endif
      </article>
      @endforeach

      @if(!empty($ideas['noteHeading']) || !empty($ideas['noteText']))
      <div class="pp-idea pp-idea--note">
        <div class="pp-idea--note__inner">
          @if(!empty($ideas['noteHeading']))
          <h3>{{ $ideas['noteHeading'] }}</h3>
          @endif
          @if(!empty($ideas['noteText']))
          <p>{!! $ideas['noteText'] !!}</p>
          @endif
        </div>
      </div>
      @endif
    </div>
  </section>
  @endif

  <!-- ===== FINAL CTA ===== -->
  @if(!empty($cta['heading']))
  <section class="pp-cta">
    <div class="pp-cta__content">
      @if(!empty($cta['eyebrow']))
      <p class="eyebrow eyebrow--center">{{ $cta['eyebrow'] }}</p>
      @endif
      <h2 class="pp-cta__heading">{{ $cta['heading'] }}</h2>
      @if(!empty($cta['text']))
      <p class="pp-cta__text">{{ $cta['text'] }}</p>
      @endif
      @if(!empty($cta['linkText']))
      <a href="{{ $cta['linkUrl'] ?: '#' }}" class="pp-cta__link">{{ $cta['linkText'] }} &rarr;</a>
      @endif
    </div>
  </section>
  @endif

  @include('partials.tagline-banner')
@endsection

@push('scripts')
  <script src="js/travel-page-js/personalized-package.js"></script>
  <script src="js/nav-dropdown.js"></script>
@endpush
