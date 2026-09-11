@extends('layouts.app')

@section('title', 'Bhumi Mantra — Yoga · Travel · Mindfulness')
@section('meta-description', 'Curated yoga journeys across India\'s sacred landscapes. Reconnect. Rebalance. Return renewed.')

@push('styles')
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300&family=Inter:wght@300;400;500;600&display=swap"
      rel="stylesheet"
    />
    <!-- Extra weights + Manrope needed by the meditation-orb partial. -->
    <link
      href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,400&family=Cinzel:wght@400;500;600&family=Manrope:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />

    <link rel="stylesheet" href="css/main.css" />
    <!-- Shared header/footer design system — loaded right after main.css so its
         --nav-accent tokens can see --dark/--cream/--gold defined there -->
    <link rel="stylesheet" href="css/header-footer.css" />
    <link rel="stylesheet" href="css/home.css" />
    <link rel="stylesheet" href="css/home-page-css/home-about.css" />
    <link rel="stylesheet" href="css/home-page-css/home-experience.css" />
    <link rel="stylesheet" href="css/home-page-css/home-destination.css" />
    <link rel="stylesheet" href="css/home-page-css/home-meditation-orb.css" />
    <link rel="stylesheet" href="css/home-page-css/home-srories.css" />
@endpush

@section('content')

    <!-- ══════════════════════════════════════ -->
    <!-- SECTION: HERO                          -->
    <!-- ══════════════════════════════════════ -->
    <section class="hero-section">
      <div class="hero-bg"></div>

      <div class="container hero-content">
        <div class="row">
          <div class="col-lg-6 col-md-9">
            <h1 class="hero-h1">
              Explore
              <span class="hero-h1-gold">Transform. Transcend.</span>
            </h1>

            <div class="hero-rule"></div>

            <p class="hero-desc">
              Yoga courses and mindful experiences across<br />
              India's sacred landscapes. Reconnect. Rebalance.<br />
              Return renewed.
            </p>

            <div class="hero-btns">
              <a href="course.html" class="btn-primary-sy">Courses &nbsp;→</a>
              <a href="travel.html" class="btn-outline-sy"
                >Our Destinations &nbsp;→</a
              >
            </div>
          </div>
        </div>
      </div>
    </section>

    <div class="section-sep"></div>

    <!-- ══════════════════════════════════════ -->
    <!-- SECTION: EXPERIENCES                   -->
    <!-- ══════════════════════════════════════ -->
    @include('partials.home.experience')

    <!-- ══════════════════════════════════════ -->
    <!-- SECTION: DESTINATIONS                  -->
    <!-- ══════════════════════════════════════ -->
    @include('partials.home.destinations')

    <!-- ══════════════════════════════════════ -->
    <!-- SECTION: BREATHE (MEDITATION ORB)      -->
    <!-- ══════════════════════════════════════ -->
    @include('partials.home.meditation-orb')

    <!-- ══════════════════════════════════════ -->
    <!-- SECTION: ABOUT                         -->
    <!-- ══════════════════════════════════════ -->
    @include('partials.home.about')

    <!-- ══════════════════════════════════════ -->
    <!-- SECTION: STORIES                       -->
    <!-- ══════════════════════════════════════ -->
    @include('partials.home.stories')

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="js/home-page-js/home.js"></script>
    <script src="js/nav-dropdown.js"></script>
@endpush
