@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="css/travel-page-css/travel.css" />
    <link rel="stylesheet" href="css/header-footer.css" />
    <link rel="stylesheet" href="css/travel-page-css/destination-detail.css" />

    <link
      href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Inter:wght@300;400;500;600&family=Noto+Serif+Devanagari:wght@400;500;600&display=swap"
      rel="stylesheet"
    />
@endpush

@section('content')

    <!-- ===== DESTINATION HERO ===== -->
    <section class="dest-hero">
      @if(!empty($data['image']))
      <img src="{{ $data['image'] }}" alt="{{ $data['title'] }}" class="dest-hero__bg" aria-hidden="true" />
      @endif
      <div class="dest-hero__overlay" aria-hidden="true"></div>
      <div class="dest-hero__content">
        <a href="travel.html" class="dest-hero__back">&larr; All Destinations</a>
        @if(!empty($data['title']))
        <h1 class="dest-hero__heading">{{ $data['title'] }}</h1>
        @endif
        @if(!empty($data['destinationCountry']))
        <p class="dest-hero__location">{{ $data['destinationCountry'] }}</p>
        @endif
        <a href="{{ $reserveUrl }}" class="btn dest-hero__cta">Reserve Your Spot</a>
      </div>
    </section>

    <!-- ===== QUICK FACTS ===== -->
    @if(!empty($data['duration']) || !empty($data['level']) || !empty($data['dates']))
    <section class="dest-facts" aria-label="Trip quick facts">
      @if(!empty($data['duration']))
      <div class="dest-facts__item">
        <span class="dest-facts__label">Duration</span>
        <span class="dest-facts__value">{{ $data['duration'] }}</span>
      </div>
      <div class="dest-facts__divider"></div>
      @endif
      @if(!empty($data['level']))
      <div class="dest-facts__item">
        <span class="dest-facts__label">Experience Level</span>
        <span class="dest-facts__value">{{ $data['level'] }}</span>
      </div>
      <div class="dest-facts__divider"></div>
      <div class="dest-facts__break" aria-hidden="true"></div>
      @endif
      @if(!empty($data['dates']))
      <div class="dest-facts__item">
        <span class="dest-facts__label">Next Departure</span>
        <span class="dest-facts__value">{{ $data['dates'] }}</span>
      </div>
      @endif
    </section>
    @endif

    <!-- ===== NEXT DEPARTURES ===== -->
    @if(!empty($data['departures']))
    <section class="dest-departures">
      <p class="eyebrow eyebrow--center">· Next Departures ·</p>
      <div class="dest-departures__list">
        @foreach ($data['departures'] as $dep)
        <div class="dest-departures__card">
          @if(!empty($dep['range']))
          <p class="dest-departures__range">{{ $dep['range'] }}</p>
          @endif
          <p class="dest-departures__meta">With Bhumi Mantra guides · {{ $dep['spots'] }} spots left</p>
          <a class="dest-departures__link" href="{{ $reserveUrl }}">Reserve this date &rarr;</a>
        </div>
        @endforeach
      </div>
    </section>
    @endif

    <!-- ===== PHOTO GALLERY ===== -->
    @if (count($galleryPhotos) > 1)
    <section class="dest-gallery">
      <p class="eyebrow eyebrow--center">· A Glimpse of the Journey ·</p>
      <div class="dest-gallery__grid {{ $hasFeaturedGallery ? 'has-featured' : '' }}">
        @foreach ($galleryPhotos as $i => $photo)
        <div class="dest-gallery__tile {{ $i === 0 && $hasFeaturedGallery ? 'is-featured' : '' }}">
          <img src="{{ $photo }}" alt="{{ $data['title'] }}" loading="lazy" />
        </div>
        @endforeach
      </div>
    </section>
    @endif

    <!-- ===== ABOUT + RESERVE ===== -->
    @if(!empty($data['whyText']) || !empty($data['description']) || !empty($data['highlights']))
    <section class="dest-about">
      <div class="dest-about__grid">
        @if(!empty($aboutPhoto))
        <div class="dest-about__media">
          <img src="{{ $aboutPhoto }}" alt="{{ $data['title'] }}" />
        </div>
        @endif
        <div class="dest-about__body">
          <p class="eyebrow">· About This Journey ·</p>
          @if(!empty($data['whyText']) || !empty($data['description']))
          <p class="dest-about__desc">{{ $data['whyText'] ?: $data['description'] }}</p>
          @endif
          @if(!empty($data['highlights']))
          <ul class="dest-about__highlights">
            @foreach ($data['highlights'] as $highlight)
            <li>{{ $highlight }}</li>
            @endforeach
          </ul>
          @endif
        </div>
      </div>
    </section>
    @endif

    <!-- ===== PROGRAM ===== -->
    @if (!empty($data['itinerary']))
    <section class="dest-program">
      @if(!empty($programPhoto))
      <img src="{{ $programPhoto }}" alt="{{ $data['title'] }}" class="dest-program__bg" aria-hidden="true" />
      @endif
      <div class="dest-program__overlay" aria-hidden="true"></div>
      <div class="dest-program__content">
        <p class="eyebrow eyebrow--center">· The Program ·</p>
        <h2 class="dest-program__heading">Day By Day</h2>
        <button type="button" class="dest-program__toggle" id="destProgramToggle" aria-expanded="false" aria-controls="destProgramList">
          <span>View the Full Itinerary</span>
          <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <polyline points="6 9 12 15 18 9"></polyline>
          </svg>
        </button>
      </div>
      <div class="dest-program__list" id="destProgramList" hidden>
        @foreach ($data['itinerary'] as $i => $day)
        <div class="dest-program__day">
          <span class="dest-program__day-num">Day {{ $i + 1 }}@if(!empty($day['title'])): {{ $day['title'] }}@endif</span>
          @if(!empty($day['text']))
          <p class="dest-program__day-point">{{ $day['text'] }}</p>
          @endif
        </div>
        @endforeach
      </div>
    </section>
    @endif

    <!-- ===== WHAT TO EXPECT ===== -->
    @if(!empty($whatToExpect['items']))
    <section class="dest-expect">
      <p class="eyebrow eyebrow--center">· What To Expect ·</p>
      <div class="dest-expect__grid">
        @foreach($whatToExpect['items'] as $item)
        <div class="dest-expect__item">
          @if(!empty($item['heading']))
          <h3 class="dest-expect__heading">{{ $item['heading'] }}</h3>
          @endif
          @if(!empty($item['text']))
          <p class="dest-expect__text">{{ $item['text'] }}</p>
          @endif
        </div>
        @endforeach
      </div>
    </section>
    @endif

    <!-- ===== GOOD TO KNOW + YOUR GUIDES ===== -->
    @if(!empty($goodToKnow['pricingText']) || !empty($goodToKnow['includedItems']) || !empty($goodToKnow['guides']))
    <section class="dest-pricing">
      <div class="dest-info-card">
        <p class="eyebrow eyebrow--center">· Good To Know &amp; Who Travels With You ·</p>
        <div class="dest-info-grid">
          <div class="dest-info-col dest-info-col--media">
            <div class="dest-pricing__media">
              <img src="assets/gallery/home-image/travel.png" alt="Rolled yoga mat resting in a quiet garden" />
            </div>
            @if(!empty($goodToKnow['pricingText']))
            <p class="dest-pricing__cta">
              {{ $goodToKnow['pricingText'] }}
              <a href="{{ $reserveUrl }}" class="dest-pricing__link">write to us for a quote</a>.
            </p>
            @endif
          </div>

          @if(!empty($goodToKnow['includedItems']))
          <div class="dest-info-col">
            <h3 class="dest-pricing__heading">Included</h3>
            <ul>
              @foreach($goodToKnow['includedItems'] as $item)
              <li>{{ $item }}</li>
              @endforeach
            </ul>
          </div>
          @endif

          @if(!empty($goodToKnow['notIncludedItems']))
          <div class="dest-info-col">
            <h3 class="dest-pricing__heading">Not Included</h3>
            <ul>
              @foreach($goodToKnow['notIncludedItems'] as $item)
              <li>{{ $item }}</li>
              @endforeach
            </ul>
          </div>
          @endif

          @if(!empty($goodToKnow['guides']))
          <div class="dest-info-col">
            <h3 class="dest-pricing__heading">Your Retreat Guides</h3>
            <ul class="dest-guides-compact">
              @foreach($goodToKnow['guides'] as $guide)
              <li class="dest-guides-compact__item">
                @if(!empty($guide['image']))
                <img src="{{ $guide['image'] }}" alt="{{ $guide['name'] }}" class="dest-guides-compact__avatar" />
                @endif
                <div>
                  @if(!empty($guide['name']))
                  <strong>{{ $guide['name'] }}</strong>
                  @endif
                  @if(!empty($guide['meta']))
                  <span>{{ $guide['meta'] }}</span>
                  @endif
                </div>
              </li>
              @endforeach
            </ul>
          </div>
          @endif
        </div>
      </div>
    </section>
    @endif

    <!-- ===== FAQ ===== -->
    @if(!empty($faq['items']))
    <section class="dest-faq">
      <p class="eyebrow eyebrow--center">· Frequently Asked ·</p>
      @if(!empty($faq['heading']))
      <h2 class="dest-faq__heading">{{ $faq['heading'] }}</h2>
      @endif
      <div class="dest-faq__list">
        @foreach($faq['items'] as $item)
        <details class="dest-faq__item">
          <summary>{{ $item['question'] }}</summary>
          <p>{{ $item['answer'] }}</p>
        </details>
        @endforeach
      </div>
    </section>
    @endif

    <!-- ===== RESERVE CTA ===== -->
    @if(!empty($reserveCta['heading']))
    <section class="dest-custom">
      <div class="dest-custom__content">
        <h2 class="dest-custom__heading">{{ $reserveCta['heading'] }}</h2>
        @if(!empty($reserveCta['text']))
        <p class="dest-custom__text">{{ $reserveCta['text'] }}</p>
        @endif
        <a href="{{ $reserveUrl }}" class="btn dest-custom__link">{{ $reserveCta['buttonText'] ?: 'Reserve Your Spot' }} &rarr;</a>
      </div>
    </section>
    @endif

    @include('partials.tagline-banner')

@endsection

@push('scripts')
  <script src="js/travel-page-js/destination-detail.js"></script>
  <script src="js/nav-dropdown.js"></script>
@endpush
