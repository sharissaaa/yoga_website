@extends('layouts.app')

@section('title', 'Personalized Travel Packages – Bhumi Mantra')

@push('styles')
  <link rel="stylesheet" href="css/travel-page-css/travel.css" />
  <link rel="stylesheet" href="css/header-footer.css" />
  <link rel="stylesheet" href="css/travel-page-css/personalized-package.css" />

  <link
    href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Inter:wght@300;400;500;600&family=Noto+Serif+Devanagari:wght@400;500;600&display=swap"
    rel="stylesheet" />
@endpush

@section('content')

  <!-- ================= /HEADER ================= -->

  <!-- ===== HERO ===== -->
  <section class="pp-hero">
    <img src="assets/gallery/home-image/varnasi.jpg" alt="Evening ceremony on the ghats of the Ganges"
      class="pp-hero__bg" aria-hidden="true" />
    <div class="pp-hero__overlay" aria-hidden="true"></div>
    <div class="pp-hero__content">
      <h1 class="pp-hero__heading">
        Personalized <em>Travel Packages</em>
      </h1>
      <a href="mailto:travel@innerjourney.com?subject=Personalized Travel Package Enquiry" class="pp-hero__sub">
        Bring your own group friends, colleagues, or a community you
        already practice with and we'll design a journey built entirely
        around your dates, pace and interests.
      </a>
    </div>
  </section>

  <!-- ===== HOW IT WORKS ===== -->
  <section class="pp-steps">
    <p class="eyebrow eyebrow--center">· How It Works ·</p>
    <div class="pp-steps__grid">
      <div class="pp-steps__item">
        <span class="pp-steps__num">01</span>
        <h3>Tell Us About Your Group</h3>
        <p>Group size, rough dates, and the kind of experience you're after relaxed, active, devotional, or a mix.</p>
      </div>
      <div class="pp-steps__item">
        <span class="pp-steps__num">02</span>
        <h3>We Design Your Itinerary</h3>
        <p>Our guides shape a route, pace and set of practices around what you've told us, drawing on the destinations
          we already know well.</p>
      </div>
      <div class="pp-steps__item">
        <span class="pp-steps__num">03</span>
        <h3>You Travel, We Hold The Space</h3>
        <p>The same teachers who lead our group retreats accompany your journey from arrival to departure.</p>
      </div>
    </div>
  </section>

  <!-- ===== IMMERSIVE BREAK ===== -->
  <section class="pp-break">
    <img src="assets/gallery/home-image/medation2.png.jpg" alt="Buddha statue in a quiet forest setting"
      class="pp-break__bg" aria-hidden="true" />
    <div class="pp-break__overlay" aria-hidden="true"></div>
    <p class="pp-break__quote">
      <em>Every group is different your itinerary should be too.</em>
    </p>
  </section>

  <!-- ===== PACKAGE IDEAS ===== -->
  <section class="pp-ideas">
    <p class="eyebrow eyebrow--center">· A Few Starting Points ·</p>
    <h2 class="pp-ideas__heading">Ways Groups Travel With Us</h2>
    <p class="pp-ideas__sub">
      These are starting points, not fixed packages every one of them is
      reshaped around your group before we call it an itinerary.
    </p>

    <div class="pp-ideas__grid">
      <article class="pp-idea">
        <div class="pp-idea__media">
          <img src="assets/gallery/home-image/livepose.jpg"
            alt="Yoga teacher assisting a student at a studio in Rishikesh" />
        </div>
        <h3>Private Group Retreats</h3>
        <p>A retreat built just for your circle of friends, family or colleagues same practice, same care, entirely your
          own dates.</p>
      </article>

      <article class="pp-idea">
        <div class="pp-idea__media">
          <img src="assets/gallery/home-image/yogavidyamandiram.jpg"
            alt="Group meditation by the river with the Himalayan foothills behind" />
        </div>
        <h3>Yoga Teacher Training Immersions</h3>
        <p>Extended, practice heavy itineraries for teacher trainees who need depth, repetition and time with
          experienced guides.</p>
      </article>

      <article class="pp-idea">
        <div class="pp-idea__media">
          <img src="assets/gallery/home-image/varnasi.jpg"
            alt="Candlelit temple pathway lined with statues and flowers" />
        </div>
        <h3>Cultural &amp; Pilgrimage Journeys</h3>
        <p>Slower, devotional itineraries built around temples, ritual and ceremony rather than sightseeing stops.</p>
      </article>


      <div class="pp-idea pp-idea--note">
        <div class="pp-idea--note__inner">
          <h3>Don't See Your Style Here?</h3>
          <p>
            These six are just where most conversations start. If what
            you have in mind doesn't fit neatly into any of them,
            <a href="custom-itinerary.html" class="pp-idea--note__link">tell us anyway</a>
            &mdash; that's exactly what "personalized" is for.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- ===== FINAL CTA ===== -->
  <section class="pp-cta">
    <div class="pp-cta__content">
      <p class="eyebrow eyebrow--center">· Ready When You Are ·</p>
      <h2 class="pp-cta__heading">Let's Build Your Itinerary</h2>
      <p class="pp-cta__text">
        Write to us with your group size and rough dates, and we'll get
        back to you with a starting shape for the journey.
      </p>
      <a href="custom-itinerary.html" class="pp-cta__link">Write to us &rarr;</a>
    </div>
  </section>

  <!-- ===== TAGLINE BANNER ===== -->
  <section class="tagline-banner">
    <img src="assets/gallery/home-image/contact.png" alt="" class="tagline-banner__bg" aria-hidden="true" />
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
  <script src="js/travel-page-js/personalized-package.js"></script>
  <script src="js/nav-dropdown.js"></script>
@endpush
