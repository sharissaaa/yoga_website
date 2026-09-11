@extends('layouts.app')

@section('title', 'Travel – Bhumi Mantra')

@push('styles')
  <link rel="stylesheet" href="css/travel-page-css/travel.css" />
  <link rel="stylesheet" href="css/header-footer.css" />

  <link
    href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Inter:wght@300;400;500;600&family=Noto+Serif+Devanagari:wght@400;500;600&display=swap"
    rel="stylesheet" />
  <script src="js/travel-page-js/travel.js"></script>
@endpush

@section('content')

  <!-- ================= /HEADER ================= -->

  <!-- ===== HERO ===== -->
  <section class="hero">
    <!-- Replace hero-bg.jpg with your actual hero image -->
    <img src="assets/gallery/home-image/travel1.png" alt="" class="hero__bg" aria-hidden="true" />
    <div class="hero__overlay" aria-hidden="true"></div>
    <div class="hero__content">
      <h1 class="hero__heading">
        Journeys that<br />
        <em>Awaken the Soul.</em>
      </h1>
    </div>
  </section>

  <!-- ===== RETREATS ===== -->
  <section class="retreats" id="retreats">

    <!-- CARDS (all shown at once — no pagination) -->
    <div class="retreats-list" id="retreatsList">

      <!-- CARD 1 -->
      <article class="retreat-card" data-slug="bali" data-destination="Indonesia" data-duration="7"
        data-month="August" data-level="Beginner">
        <div class="retreat-card__badge">Popular</div>
        <!-- Replace bali.jpg with your actual retreat image -->
        <img src="assets/gallery/home-image/travel-bali.png" alt="Bali temple gardens" class="retreat-card__img" />
        <div class="retreat-card__body">
          <h2 class="retreat-card__title">Bali Healing Retreat</h2>
          <p class="retreat-card__meta">
            <span class="meta-loc">Indonesia</span>
            <span class="meta-dot">•</span>
            <span>7 Days</span>
            <span class="meta-dot">•</span>
            <span class="meta-tag">Beginner</span>
          </p>
          <p class="retreat-card__desc">
            Experience deep healing through yoga, meditation, sacred temple
            visits, sound baths, and mindful living in the heart of Bali.
          </p>


        </div>
        <div class="retreat-card__aside">
          <div class="aside-block">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="aside-block__icon"
              aria-hidden="true">
              <rect x="3" y="5" width="18" height="16" rx="2" />
              <path d="M3 9h18M8 3v4M16 3v4" />
            </svg>
            <div>
              <p class="aside-block__label">Dates</p>
              <p class="aside-block__value">15–21 Aug 2026</p>
            </div>
          </div>
          <div class="aside-divider"></div>
          <div class="aside-block">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="aside-block__icon"
              aria-hidden="true">
              <rect x="3" y="5" width="18" height="14" rx="2" />
              <path d="m4 7 8 6 8-6" />
            </svg>
            <div>
              <p class="aside-block__label">Email</p>
              <a href="mailto:travel@innerjourney.com"
                class="aside-block__value aside-block__link">travel@innerjourney<wbr>.com</a>
            </div>
          </div>
          <div class="aside-divider"></div>
          <a href="destination-detail.html?slug=bali" class="aside-invite-btn">View Full Details</a>
        </div>
      </article>

      <!-- CARD 2 -->
      <article class="retreat-card" data-slug="rishikesh" data-destination="India"
        data-duration="6" data-month="September" data-level="All Levels">
        <!-- Replace rishikesh.jpg with your actual retreat image -->
        <img src="assets/gallery/home-image/Rishikesh.jpg" alt="Rishikesh on the Ganges" class="retreat-card__img" />
        <div class="retreat-card__body">
          <h2 class="retreat-card__title">Rishikesh Yoga Retreat</h2>
          <p class="retreat-card__meta">
            <span class="meta-loc">India</span>
            <span class="meta-dot">•</span>
            <span>6 Days</span>
            <span class="meta-dot">•</span>
            <span class="meta-tag meta-tag--green">All Levels</span>
          </p>
          <p class="retreat-card__desc">
            Rejuvenate your body and mind with traditional yoga, meditation and
            Ayurvedic healing on the banks of the Ganges.
          </p>


        </div>
        <div class="retreat-card__aside">
          <div class="aside-block">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="aside-block__icon"
              aria-hidden="true">
              <rect x="3" y="5" width="18" height="16" rx="2" />
              <path d="M3 9h18M8 3v4M16 3v4" />
            </svg>
            <div>
              <p class="aside-block__label">Dates</p>
              <p class="aside-block__value">10–15 Sep 2026</p>
            </div>
          </div>
          <div class="aside-divider"></div>
          <div class="aside-block">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="aside-block__icon"
              aria-hidden="true">
              <rect x="3" y="5" width="18" height="14" rx="2" />
              <path d="m4 7 8 6 8-6" />
            </svg>
            <div>
              <p class="aside-block__label">Email</p>
              <a href="mailto:travel@innerjourney.com"
                class="aside-block__value aside-block__link">travel@innerjourney<wbr>.com</a>
            </div>
          </div>
          <div class="aside-divider"></div>
          <a href="destination-detail.html?slug=rishikesh" class="aside-invite-btn">View Full Details</a>
        </div>
      </article>

      <!-- CARD 3 -->
      <article class="retreat-card" data-slug="sri-lanka"
        data-destination="Sri Lanka" data-duration="8" data-month="October" data-level="Intermediate">
        <!-- Replace srilanka.jpg with your actual retreat image -->
        <img src="assets/gallery/home-image/sri lanka.png" alt="Sri Lanka rock fortress" class="retreat-card__img" />
        <div class="retreat-card__body">
          <h2 class="retreat-card__title">Sri Lanka Wellness Escape</h2>
          <p class="retreat-card__meta">
            <span class="meta-loc">Sri Lanka</span>
            <span class="meta-dot">•</span>
            <span>8 Days</span>
            <span class="meta-dot">•</span>
            <span class="meta-tag">Intermediate</span>
          </p>
          <p class="retreat-card__desc">
            A journey of wellness, nature and culture. Reconnect with yourself
            in serene beaches and lush tea country.
          </p>


        </div>
        <div class="retreat-card__aside">
          <div class="aside-block">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="aside-block__icon"
              aria-hidden="true">
              <rect x="3" y="5" width="18" height="16" rx="2" />
              <path d="M3 9h18M8 3v4M16 3v4" />
            </svg>
            <div>
              <p class="aside-block__label">Dates</p>
              <p class="aside-block__value">05–12 Oct 2026</p>
            </div>
          </div>
          <div class="aside-divider"></div>
          <div class="aside-block">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="aside-block__icon"
              aria-hidden="true">
              <rect x="3" y="5" width="18" height="14" rx="2" />
              <path d="m4 7 8 6 8-6" />
            </svg>
            <div>
              <p class="aside-block__label">Email</p>
              <a href="mailto:travel@innerjourney.com"
                class="aside-block__value aside-block__link">travel@innerjourney<wbr>.com</a>
            </div>
          </div>
          <div class="aside-divider"></div>
          <a href="destination-detail.html?slug=sri-lanka" class="aside-invite-btn">View Full Details</a>
        </div>
      </article>

      <!-- CARD 4 -->
      <article class="retreat-card" data-slug="ladakh" data-destination="India"
        data-duration="7" data-month="November" data-level="Intermediate">
        <!-- Replace ladakh.jpg with your actual retreat image -->
        <img src="assets/gallery/home-image/ladakh.jpg" alt="Ladakh mountain monastery" class="retreat-card__img" />
        <div class="retreat-card__body">
          <h2 class="retreat-card__title">Ladakh Himalayan Retreat</h2>
          <p class="retreat-card__meta">
            <span class="meta-loc">India</span>
            <span class="meta-dot">•</span>
            <span>7 Days</span>
            <span class="meta-dot">•</span>
            <span class="meta-tag">Intermediate</span>
          </p>
          <p class="retreat-card__desc">
            High-altitude stillness among ancient monasteries — a retreat of
            silence, breathwork and wide open skies.
          </p>


        </div>
        <div class="retreat-card__aside">
          <div class="aside-block">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="aside-block__icon"
              aria-hidden="true">
              <rect x="3" y="5" width="18" height="16" rx="2" />
              <path d="M3 9h18M8 3v4M16 3v4" />
            </svg>
            <div>
              <p class="aside-block__label">Dates</p>
              <p class="aside-block__value">02–09 Nov 2026</p>
            </div>
          </div>
          <div class="aside-divider"></div>
          <div class="aside-block">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="aside-block__icon"
              aria-hidden="true">
              <rect x="3" y="5" width="18" height="14" rx="2" />
              <path d="m4 7 8 6 8-6" />
            </svg>
            <div>
              <p class="aside-block__label">Email</p>
              <a href="mailto:travel@innerjourney.com"
                class="aside-block__value aside-block__link">travel@innerjourney<wbr>.com</a>
            </div>
          </div>
          <div class="aside-divider"></div>
          <a href="destination-detail.html?slug=ladakh" class="aside-invite-btn">View Full Details</a>
        </div>
      </article>

      <!-- CARD 5 -->
      <article class="retreat-card" data-slug="auroville" data-destination="India"
        data-duration="6" data-month="December" data-level="Beginner">
        <!-- Replace Auroville.jpg with your actual retreat image -->
        <img src="assets/gallery/home-image/Auroville.jpg" alt="Auroville township gardens" class="retreat-card__img" />
        <div class="retreat-card__body">
          <h2 class="retreat-card__title">Auroville Mindful Living</h2>
          <p class="retreat-card__meta">
            <span class="meta-loc">India</span>
            <span class="meta-dot">•</span>
            <span>6 Days</span>
            <span class="meta-dot">•</span>
            <span class="meta-tag">Beginner</span>
          </p>
          <p class="retreat-card__desc">
            A quiet immersion in Auroville's community gardens — mindful
            living, meditation and conscious community practice.
          </p>


        </div>
        <div class="retreat-card__aside">
          <div class="aside-block">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="aside-block__icon"
              aria-hidden="true">
              <rect x="3" y="5" width="18" height="16" rx="2" />
              <path d="M3 9h18M8 3v4M16 3v4" />
            </svg>
            <div>
              <p class="aside-block__label">Dates</p>
              <p class="aside-block__value">14–20 Dec 2026</p>
            </div>
          </div>
          <div class="aside-divider"></div>
          <div class="aside-block">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="aside-block__icon"
              aria-hidden="true">
              <rect x="3" y="5" width="18" height="14" rx="2" />
              <path d="m4 7 8 6 8-6" />
            </svg>
            <div>
              <p class="aside-block__label">Email</p>
              <a href="mailto:travel@innerjourney.com"
                class="aside-block__value aside-block__link">travel@innerjourney<wbr>.com</a>
            </div>
          </div>
          <div class="aside-divider"></div>
          <a href="destination-detail.html?slug=auroville" class="aside-invite-btn">View Full Details</a>
        </div>
      </article>

      <!-- CARD 6 -->
      <article class="retreat-card" data-slug="kerala" data-destination="India"
        data-duration="7" data-month="January" data-level="All Levels">
        <!-- Replace kerala.jpg with your actual retreat image -->
        <img src="assets/gallery/home-image/kerala.jpg" alt="Kerala backwaters" class="retreat-card__img" />
        <div class="retreat-card__body">
          <h2 class="retreat-card__title">Kerala Ayurveda Retreat</h2>
          <p class="retreat-card__meta">
            <span class="meta-loc">India</span>
            <span class="meta-dot">•</span>
            <span>7 Days</span>
            <span class="meta-dot">•</span>
            <span class="meta-tag meta-tag--green">All Levels</span>
          </p>
          <p class="retreat-card__desc">
            Traditional Ayurvedic healing, gentle yoga and calm backwater
            days — restore body and mind at their own pace.
          </p>


        </div>
        <div class="retreat-card__aside">
          <div class="aside-block">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="aside-block__icon"
              aria-hidden="true">
              <rect x="3" y="5" width="18" height="16" rx="2" />
              <path d="M3 9h18M8 3v4M16 3v4" />
            </svg>
            <div>
              <p class="aside-block__label">Dates</p>
              <p class="aside-block__value">10–17 Jan 2027</p>
            </div>
          </div>
          <div class="aside-divider"></div>
          <div class="aside-block">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="aside-block__icon"
              aria-hidden="true">
              <rect x="3" y="5" width="18" height="14" rx="2" />
              <path d="m4 7 8 6 8-6" />
            </svg>
            <div>
              <p class="aside-block__label">Email</p>
              <a href="mailto:travel@innerjourney.com"
                class="aside-block__value aside-block__link">travel@innerjourney<wbr>.com</a>
            </div>
          </div>
          <div class="aside-divider"></div>
          <a href="destination-detail.html?slug=kerala" class="aside-invite-btn">View Full Details</a>
        </div>
      </article>

      <!-- CARD 7 -->
      <article class="retreat-card" data-slug="gujarat" data-destination="India"
        data-duration="6" data-month="February" data-level="Intermediate">
        <!-- Replace Gujarat.png with your actual retreat image -->
        <img src="assets/gallery/home-image/Gujarat.png" alt="Gujarat heritage architecture"
          class="retreat-card__img" />
        <div class="retreat-card__body">
          <h2 class="retreat-card__title">Gujarat Heritage Journey</h2>
          <p class="retreat-card__meta">
            <span class="meta-loc">India</span>
            <span class="meta-dot">•</span>
            <span>6 Days</span>
            <span class="meta-dot">•</span>
            <span class="meta-tag">Intermediate</span>
          </p>
          <p class="retreat-card__desc">
            Sacred stepwells, temple towns and mindful practice woven
            through Gujarat's timeless heritage landscape.
          </p>


        </div>
        <div class="retreat-card__aside">
          <div class="aside-block">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="aside-block__icon"
              aria-hidden="true">
              <rect x="3" y="5" width="18" height="16" rx="2" />
              <path d="M3 9h18M8 3v4M16 3v4" />
            </svg>
            <div>
              <p class="aside-block__label">Dates</p>
              <p class="aside-block__value">08–14 Feb 2027</p>
            </div>
          </div>
          <div class="aside-divider"></div>
          <div class="aside-block">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="aside-block__icon"
              aria-hidden="true">
              <rect x="3" y="5" width="18" height="14" rx="2" />
              <path d="m4 7 8 6 8-6" />
            </svg>
            <div>
              <p class="aside-block__label">Email</p>
              <a href="mailto:travel@innerjourney.com"
                class="aside-block__value aside-block__link">travel@innerjourney<wbr>.com</a>
            </div>
          </div>
          <div class="aside-divider"></div>
          <a href="destination-detail.html?slug=gujarat" class="aside-invite-btn">View Full Details</a>
        </div>
      </article>

      <!-- CARD 8 -->
      <article class="retreat-card" data-slug="tamil-nadu"
        data-destination="India" data-duration="8" data-month="March" data-level="Beginner">
        <!-- Replace TN.jpg with your actual retreat image -->
        <img src="assets/gallery/home-image/TN.jpg" alt="Tamil Nadu temple" class="retreat-card__img" />
        <div class="retreat-card__body">
          <h2 class="retreat-card__title">Tamil Nadu Temple Trail</h2>
          <p class="retreat-card__meta">
            <span class="meta-loc">India</span>
            <span class="meta-dot">•</span>
            <span>8 Days</span>
            <span class="meta-dot">•</span>
            <span class="meta-tag">Beginner</span>
          </p>
          <p class="retreat-card__desc">
            Chant, ritual and stillness among South India's grand temple
            towns — a devotional path for body and spirit.
          </p>


        </div>
        <div class="retreat-card__aside">
          <div class="aside-block">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="aside-block__icon"
              aria-hidden="true">
              <rect x="3" y="5" width="18" height="16" rx="2" />
              <path d="M3 9h18M8 3v4M16 3v4" />
            </svg>
            <div>
              <p class="aside-block__label">Dates</p>
              <p class="aside-block__value">05–13 Mar 2027</p>
            </div>
          </div>
          <div class="aside-divider"></div>
          <div class="aside-block">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="aside-block__icon"
              aria-hidden="true">
              <rect x="3" y="5" width="18" height="14" rx="2" />
              <path d="m4 7 8 6 8-6" />
            </svg>
            <div>
              <p class="aside-block__label">Email</p>
              <a href="mailto:travel@innerjourney.com"
                class="aside-block__value aside-block__link">travel@innerjourney<wbr>.com</a>
            </div>
          </div>
          <div class="aside-divider"></div>
          <a href="destination-detail.html?slug=tamil-nadu" class="aside-invite-btn">View Full Details</a>
        </div>
      </article>

    </div>

    <!-- Shown by travel.js when the active filters match no cards -->
    <p class="retreats-empty" id="retreatsEmpty" hidden>
      No retreats match your filters. Try adjusting your selection.
    </p>

  </section>

  <!-- ===== PERSONALIZED TRAVEL PACKAGE ===== -->
  <section class="custom-package" id="custom-package">
    <div class="custom-package__content">
      <h2 class="custom-package__heading">Personalized Travel Package</h2>
      <p class="custom-package__text">
        Bring your own group and we'll design a custom journey around
        your dates, pace and interests.
      </p>
      <a href="personalized-package.html" class="btn custom-package__link">See how personalized packages work &rarr;</a>
    </div>
  </section>

  <!-- ===== TAGLINE BANNER ===== -->
  <section class="tagline-banner">
    <!-- Replace candles-bg.jpg with your actual candles/lotus image -->
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
  <script src="js/travel-page-js/travel-page.js"></script>
  <script src="js/nav-dropdown.js"></script>
@endpush
