@extends('layouts.app')

@section('title', 'Residential and Online Practices and Courses – Bhumi Mantra')

@push('styles')
  <link rel="stylesheet" href="css/course.css" />
  <!-- Shared across every page: same nav + footer design, color set per page below -->
  <link rel="stylesheet" href="css/header-footer.css" />

  <link
    href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Inter:wght@300;400;500;600&display=swap"
    rel="stylesheet" />
@endpush

@section('content')

  <!-- ================= /HEADER ================= -->

  <!-- ===== HERO ===== -->
  <section class="hero">
    <!-- Replace hero-bg.jpg with your actual temple/meditation photo -->
    <img src="assets/gallery/home-image/pexels-tima-miroshnichenko-5928626.jpg" alt="" class="hero__bg" aria-hidden="true" />
    <div class="hero__overlay" aria-hidden="true"></div>
    <div class="hero__content">
      <h1 class="hero__heading">
        <span class="hero__heading-accent">Residential and Online practices and courses</span>
      </h1>
      <p class="hero__sub">
        Deepen your practice and define your daily Sadhana.
      </p>
    </div>
  </section>

  <!-- ===== COURSE HIGHLIGHTS ===== -->
  <section class="highlights">

    <!-- Header -->
    <div class="highlights__header">
      <h2 class="highlights__title">
        More Than a Place,<br />
        It's a <em>Way of Being.</em>
      </h2>

      <p class="highlights__desc">
        At Bhumi Mantra, we believe transformation happens when you feel
        safe, seen and supported. Our teachings and retreats are designed
        to awaken your inner light and help you create a life you truly love.
      </p>
    </div>

    <!-- Carousel -->
    <div class="highlights__carousel">

      <button class="highlights__arrow highlights__arrow--prev" aria-label="Previous">
        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M15 6l-6 6 6 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
            stroke-linejoin="round" />
        </svg>
      </button>

      <div class="highlights__track">

        <article class="hl-card">
          <div class="hl-card__media">
            <img src="assets/gallery/home-image/pexels-balljinder-singh-666149-18364977.jpg" alt="Sadhana Immersion" />
            <span class="hl-card__badge">Residential in India</span>
          </div>
          <h4 class="hl-card__title">Sadhana Immersion</h4>
          <p class="hl-card__meta">With Jeo Varghese and Nidish Nidhiri and Alice Avaldi</p>
          <p class="hl-card__desc">Immerse yourself in an authentic residential Sadhana experience set in the serene
            landscapes of India. Wake with the sun for guided meditation, deepen your asana practice, and let ancient
            rituals and community living restore your inner balance.</p>
          <button type="button" class="hl-card__toggle" aria-expanded="false">Read more</button>
        </article>

        <article class="hl-card">
          <div class="hl-card__media">
            <img src="assets/gallery/home-image/pexels-kundalini-yoga-ashram-324305954-14533456.jpg" alt="Yoga TTC" />
            <span class="hl-card__badge">Online</span>
          </div>
          <h4 class="hl-card__title">Yoga TTC</h4>
          <p class="hl-card__meta">With Jeo Varghese and Nidish Nidhiri</p>
          <p class="hl-card__desc">Deepen your practice and become a certified yoga teacher through this comprehensive
            online training. Learn traditional asana, pranayama, and philosophy from experienced teachers, with the
            flexibility to study at your own pace from anywhere in the world.</p>
          <button type="button" class="hl-card__toggle" aria-expanded="false">Read more</button>
        </article>

        <article class="hl-card">
          <div class="hl-card__media">
            <img src="assets/gallery/home-image/travel.png" alt="Prana Vidya Courses" />
            <span class="hl-card__badge">Residential and online</span>
          </div>
          <h4 class="hl-card__title">Prana Vidya Courses</h4>
          <p class="hl-card__meta">With Jeo Varghese</p>
          <p class="hl-card__desc">Discover the subtle science of Prana Vidya, an energy-healing practice rooted in
            yogic tradition. This course guides you through breath-based techniques to clear blockages, restore
            vitality, and support holistic wellbeing in daily life.</p>
          <button type="button" class="hl-card__toggle" aria-expanded="false">Read more</button>
        </article>

        <article class="hl-card">
          <div class="hl-card__media">
            <img src="assets/gallery/home-image/medation2.png.jpg" alt="Regular guided practice and Meditation" />
            <span class="hl-card__badge">Online</span>
          </div>
          <h4 class="hl-card__title">Regular guided practice and Meditation</h4>
          <p class="hl-card__meta">With Jeo Varghese and Alice Avaldi</p>
          <p class="hl-card__desc">Build a sustainable meditation habit with regular live-guided sessions designed for
            practitioners at every level. Cultivate stillness, presence, and emotional balance through consistent
            practice, wherever you are in the world.</p>
          <button type="button" class="hl-card__toggle" aria-expanded="false">Read more</button>
        </article>

      </div>

      <button class="highlights__arrow highlights__arrow--next" aria-label="Next">
        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M9 6l6 6-6 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
            stroke-linejoin="round" />
        </svg>
      </button>
    </div>

  </section>


  <!-- ===== WHAT YOU'LL LEARN ===== -->
  <section class="learn">

    <!-- BG image + overlay -->
    <div class="learn__bg" aria-hidden="true">
      <img src="assets/gallery/home-image/pexels-ian-panelo-11873771.jpg" alt="" class="learn__bg-img" />
      <div class="learn__bg-overlay"></div>
    </div>

    <div class="learn__inner">

      <!-- Left — skill list -->
      <div class="learn__left">
        <ul class="learn-list">

          <li class="learn-list__item">
            <div>
              <h4>Asana</h4>
              <p>Learn how to meditate in each of your body parts.</p>
            </div>
          </li>

          <li class="learn-list__sep" aria-hidden="true">
            <span></span>
          </li>

          <li class="learn-list__item">
             <div>
              <h4>Pranayama</h4>
              <p>Expand your awareness trough breathing techniques.</p>
            </div>
          </li>

          <li class="learn-list__sep" aria-hidden="true">
            <span></span>
          </li>

          <li class="learn-list__item">
            <div>
              <h4>Prana Vidya</h4>
              <p>Energy Healing to overcome habitual patterns and common sufferings.</p>
            </div>
          </li>

          <li class="learn-list__sep" aria-hidden="true">
            <span></span>
          </li>

          <li class="learn-list__item">
            <div>
              <h4>Meditation</h4>
              <p>From sitting Meditation to Mindful living.</p>
            </div>
          </li>

          <li class="learn-list__sep" aria-hidden="true">
            <span></span>
          </li>

          <li class="learn-list__item">
           <div>
              <h4>Yoga Philosophy</h4>
              <p>Understand ancient teachings and apply in daily life.</p>
            </div>
          </li>

        </ul>
      </div>

      <!-- Center — eyebrow + arch image -->
      <div class="learn__center">
        <p class="learn__eyebrow">— What You'll Learn —</p>
        <div class="learn__img-wrap">
          <img src="assets/gallery/home-image/livepose.jpg" alt="" class="learn__img" />
          <div class="learn__img-gradient" aria-hidden="true"></div>
          <div class="learn__img-frame" aria-hidden="true"></div>
        </div>
      </div>

      <!-- Right — quote -->
      <div class="learn__right">
        <span class="learn__quote-mark">&ldquo;</span>
        <p class="learn__quote-text">The body is your temple. Keep it pure and clean for the soul to reside in.</p>
        <p class="learn__quote-author">— B.K.S. Iyengar</p>
      </div>

    </div>
  </section>

  <!-- ===== COMPARE COURSES ===== -->
  <!-- Deliberately NOT another round of per-course cards/panels — the
       Highlights carousel above already tells each course's story.
       This is a plain, scannable reference table instead. -->
  <section class="course-compare">
    <div class="cc-inner">

      <div class="cc-media">
        <img src="assets/gallery/home-image/courselast.jpg" alt="Candlelit temple pathway at sunset" />
      </div>

      <div class="cc-content">
        

        <h2 class="cc-title">Which Path Calls You?</h2>

        <!-- Year-round availability + contact -->
        <div class="course-details__note">
          <svg viewBox="0 0 24 24" width="26" height="26" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
            <rect x="3" y="4" width="18" height="17" rx="2"></rect>
            <path d="M3 9h18"></path>
            <path d="M8 2v4M16 2v4"></path>
          </svg>
          <p>
            Our courses run throughout the year, across various dates &mdash; please
            <a href="contact.html">contact us</a> to get more information
            and find a schedule that works for you.
          </p>
        </div>
      </div>

    </div>
  </section>

  <!-- ===== CLOSING BANNER ===== -->
  <section class="closing">
    <img src="assets/gallery/home-image/logo.png" alt="Mandala" class="closing__emblem" />
    <p class="closing__sanskrit">तदा द्रष्टुः स्वरूपेऽवस्थानम्</p>
    <p class="closing__translit">Tadā draṣṭuḥ svarūpe 'vasthānam</p>
    <p class="closing__text">Then pure awareness is established in itself.</p>
  </section>
@endsection

@push('scripts')
  <script src="js/course-page-js/course.js"></script>
  <script src="js/nav-dropdown.js"></script>
@endpush
