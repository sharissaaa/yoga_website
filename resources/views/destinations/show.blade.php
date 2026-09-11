@extends('layouts.app')

@section('title', $data['title'].' – Bhumi Mantra')

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
      <img src="{{ $data['image'] }}" alt="{{ $data['imageAlt'] }}" class="dest-hero__bg" id="destHeroImg" aria-hidden="true" />
      <div class="dest-hero__overlay" aria-hidden="true"></div>
      <div class="dest-hero__content">
        <a href="travel.html" class="dest-hero__back">&larr; All Destinations</a>
        <h1 class="dest-hero__heading" id="destTitle">{{ $data['title'] }}</h1>
        <p class="dest-hero__location" id="destLocation">{{ $data['destination'] }}</p>
        <a href="{{ $reserveUrl }}" id="destHeroReserve" class="btn dest-hero__cta">Reserve Your Spot</a>
      </div>
    </section>

    <!-- ===== QUICK FACTS ===== -->
    <section class="dest-facts" id="destFacts" aria-label="Trip quick facts">
      <div class="dest-facts__item">
        <span class="dest-facts__label">Duration</span>
        <span class="dest-facts__value" id="destDuration">{{ $data['duration'] }}</span>
      </div>
      <div class="dest-facts__divider"></div>
      <div class="dest-facts__item">
        <span class="dest-facts__label">Experience Level</span>
        <span class="dest-facts__value" id="destLevel">{{ $data['level'] }}</span>
      </div>
      <div class="dest-facts__divider"></div>
      <div class="dest-facts__break" aria-hidden="true"></div>
      <div class="dest-facts__item">
        <span class="dest-facts__label">Next Departure</span>
        <span class="dest-facts__value" id="destDates">{{ $data['dates'] }}</span>
      </div>
    </section>

    <!-- ===== NEXT DEPARTURES ===== -->
    <section class="dest-departures">
      <p class="eyebrow eyebrow--center">· Next Departures ·</p>
      <div class="dest-departures__list" id="destDeparturesList">
        @foreach ($data['departures'] as $dep)
        <div class="dest-departures__card">
          <p class="dest-departures__range">{{ $dep['range'] }}</p>
          <p class="dest-departures__meta">With Bhumi Mantra guides · {{ $dep['spots'] }} spots left</p>
          <a class="dest-departures__link" href="{{ $reserveUrl }}">Reserve this date &rarr;</a>
        </div>
        @endforeach
      </div>
    </section>

    <!-- ===== PHOTO GALLERY ===== -->
    @if (count($galleryPhotos) > 1)
    <section class="dest-gallery" id="destGallerySection">
      <p class="eyebrow eyebrow--center">· A Glimpse of the Journey ·</p>
      <div class="dest-gallery__grid {{ $hasFeaturedGallery ? 'has-featured' : '' }}" id="destGalleryGrid">
        @foreach ($galleryPhotos as $i => $photo)
        <div class="dest-gallery__tile {{ $i === 0 && $hasFeaturedGallery ? 'is-featured' : '' }}">
          <img src="{{ $photo['src'] }}" alt="{{ $photo['alt'] }}" loading="lazy" />
        </div>
        @endforeach
      </div>
    </section>
    @endif

    <!-- ===== ABOUT + RESERVE ===== -->
    <section class="dest-about">
      <div class="dest-about__grid">
        <div class="dest-about__media">
          <img src="{{ $aboutPhoto['src'] }}" alt="{{ $aboutPhoto['alt'] }}" id="destAboutImg" />
        </div>
        <div class="dest-about__body">
          <p class="eyebrow">· About This Journey ·</p>
          <p class="dest-about__desc" id="destDescription">{{ $data['whyText'] ?? $data['description'] }}</p>
          <ul class="dest-about__highlights" id="destHighlights">
            @foreach ($data['highlights'] as $highlight)
            <li>{{ $highlight }}</li>
            @endforeach
          </ul>
        </div>
      </div>
    </section>

    <!-- ===== PROGRAM ===== -->
    @if (! empty($data['itinerary']))
    <section class="dest-program">
      <img src="{{ $programPhoto['src'] }}" alt="{{ $programPhoto['alt'] }}" class="dest-program__bg" id="destProgramImg" aria-hidden="true" />
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
          <span class="dest-program__day-num">Day {{ $i + 1 }}</span>
          <p class="dest-program__day-point">{{ $day['text'] }}</p>
        </div>
        @endforeach
      </div>
    </section>
    @endif

    <!-- ===== WHAT TO EXPECT ===== -->
    <section class="dest-expect">
      <p class="eyebrow eyebrow--center">· What To Expect ·</p>
      <div class="dest-expect__grid">
        <div class="dest-expect__item">
          <h3 class="dest-expect__heading">Pace &amp; Practice</h3>
          <p class="dest-expect__text">
            Each day is built around guided yoga and meditation sessions, with
            unhurried time between them this is a retreat to sink into, not
            a checklist of sights.
          </p>
        </div>
        <div class="dest-expect__item">
          <h3 class="dest-expect__heading">Meals</h3>
          <p class="dest-expect__text">
            Wholesome, mostly vegetarian meals suited to a retreat setting,
            with attention to dietary needs when we know about them in
            advance.
          </p>
        </div>
        <div class="dest-expect__item">
          <h3 class="dest-expect__heading">Travel &amp; Transfers</h3>
          <p class="dest-expect__text">
            Airport transfers and travel between stops are arranged for the
            group, so you can settle in rather than manage logistics.
          </p>
        </div>
        <div class="dest-expect__item">
          <h3 class="dest-expect__heading">Accommodation</h3>
          <p class="dest-expect__text">
            Comfortable, simple stays chosen for their setting and calm as
            much as their comfort details are shared once your spot is
            confirmed.
          </p>
        </div>
      </div>
    </section>

    <!-- ===== GOOD TO KNOW + YOUR GUIDES ===== -->
    <section class="dest-pricing">
      <div class="dest-info-card">
        <p class="eyebrow eyebrow--center">· Good To Know &amp; Who Travels With You ·</p>
        <div class="dest-info-grid">
          <div class="dest-info-col dest-info-col--media">
            <div class="dest-pricing__media">
              <img src="assets/gallery/home-image/travel.png" alt="Rolled yoga mat resting in a quiet garden" />
            </div>
            <p class="dest-pricing__cta">
              Pricing is confirmed when you enquire
              <a href="{{ $reserveUrl }}" id="destPricingLink" class="dest-pricing__link">write to us for a quote</a>.
            </p>
          </div>

          <div class="dest-info-col">
            <h3 class="dest-pricing__heading">Included</h3>
            <ul>
              <li>All accommodation for the retreat</li>
              <li>Daily yoga &amp; meditation sessions</li>
              <li>Meals as outlined for the retreat</li>
              <li>Airport transfers on arrival &amp; departure</li>
              <li>Guided excursions named in the itinerary</li>
            </ul>
          </div>

          <div class="dest-info-col">
            <h3 class="dest-pricing__heading">Not Included</h3>
            <ul>
              <li>Flights to and from your home country</li>
              <li>Visa fees, where applicable</li>
              <li>Travel insurance</li>
              <li>Personal expenses &amp; optional extras</li>
            </ul>
          </div>

          <div class="dest-info-col">
            <h3 class="dest-pricing__heading">Your Retreat Guides</h3>
            <ul class="dest-guides-compact">
              <li class="dest-guides-compact__item">
                <img src="assets/gallery/home-image/pexels-balljinder-singh-666149-18364977.jpg" alt="Jeo Varghese guiding a meditation session at a mountain retreat" class="dest-guides-compact__avatar" />
                <div>
                  <strong>Jeo Varghese</strong>
                  <span>Yoga Teacher &nbsp;|&nbsp; Researcher &nbsp;|&nbsp; Guide</span>
                </div>
              </li>
              <li class="dest-guides-compact__item">
                <img src="assets/gallery/home-image/pexels-yogavidyamandiram-31743034.jpg" alt="Alice Avaldi guiding students through a standing pose" class="dest-guides-compact__avatar" />
                <div>
                  <strong>Alice Avaldi</strong>
                  <span>Yoga Educator &nbsp;|&nbsp; Holistic Guide</span>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <!-- ===== FAQ ===== -->
    <section class="dest-faq">
      <p class="eyebrow eyebrow--center">· Frequently Asked ·</p>
      <h2 class="dest-faq__heading">Questions Before You Book</h2>
      <div class="dest-faq__list">
        <details class="dest-faq__item">
          <summary>How physically demanding is this retreat?</summary>
          <p>It depends on the destination and experience level shown above write to us and we'll be upfront about what to expect.</p>
        </details>
        <details class="dest-faq__item">
          <summary>What should I pack?</summary>
          <p>We send a full packing guide once you've reserved your spot, tailored to the season and destination.</p>
        </details>
        <details class="dest-faq__item">
          <summary>Do I need a visa?</summary>
          <p>Requirements vary by nationality and destination we're happy to point you in the right direction when you enquire.</p>
        </details>
        <details class="dest-faq__item">
          <summary>Can I join if I'm travelling alone?</summary>
          <p>Yes most of our travelers join solo and meet the rest of the group on arrival.</p>
        </details>
        <details class="dest-faq__item">
          <summary>What's your cancellation policy?</summary>
          <p>Terms depend on how far out you cancel we'll share the full policy when you reserve.</p>
        </details>
      </div>
    </section>

    <!-- ===== RESERVE CTA ===== -->
    <section class="dest-custom">
      <div class="dest-custom__content">
        <h2 class="dest-custom__heading">Ready to Reserve Your Spot?</h2>
        <p class="dest-custom__text">
          Let us know you're interested and our team will help you plan
          every detail of the journey.
        </p>
        <a href="{{ $reserveUrl }}" class="btn dest-custom__link"
          >Reserve Your Spot &rarr;</a
        >
      </div>
    </section>

    <!-- ===== TAGLINE BANNER ===== -->
    <section class="tagline-banner">
      <img
        src="assets/gallery/home-image/contact.png"
        alt=""
        class="tagline-banner__bg"
        aria-hidden="true"
      />
      <div class="tagline-banner__overlay" aria-hidden="true"></div>
      <div class="tagline-banner__content">
        <img src="assets/gallery/home-image/logo.png" alt="" class="tagline-banner__mandala" aria-hidden="true">
        <p class="tagline-banner__sanskrit">तदा द्रष्टुः स्वरूपेऽवस्थानम्</p>
        <p class="tagline-banner__translit">Tadā draṣṭuḥ svarūpe 'vasthānam</p>
        <p class="tagline-banner__text"><em>Then pure awareness is established in itself.</em></p>
      </div>
    </section>

@endsection

@push('scripts')
  <script src="js/travel-page-js/destination-detail.js"></script>
  <script src="js/nav-dropdown.js"></script>
@endpush
