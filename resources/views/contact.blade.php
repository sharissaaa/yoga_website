@extends('layouts.app')

@section('title', 'Contact Us | Bhumi Mantra')

@push('styles')
  <meta name="description"
    content="Get in touch with Bhumi Mantra. Reach out about journeys, retreats, or private sessions — we typically respond within 24 hours.">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Inter:wght@300;400;500;600&family=Noto+Serif+Devanagari:wght@400;500;600&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="css/contact.css">
  <!-- Shared across every page: same nav + footer design, color set per page below -->
  <link rel="stylesheet" href="css/header-footer.css">
@endpush

@section('content')

  <!-- ================= /HEADER ================= -->

  <main id="main">

    <!-- ================= HERO ================= -->
    <section class="hero">
      <div class="hero-grid">

        <div class="hero-text">
          <p class="eyebrow">
            Connect With Us
            <!-- PLACEHOLDER: small lotus icon -->

          </p>

          <h1>We&rsquo;d Love To<br>Hear From <span class="accent">You</span></h1>

          <div class="divider-dots" aria-hidden="true">
          </div>

        </div>

        <div class="hero-image-full">
          <!-- PLACEHOLDER: replace with your temple/garden entrance image -->
          <img src="assets/gallery/home-image/contact.png" alt="Open temple doors leading to a sunlit garden path">
        </div>

      </div>
    </section>

    <!-- ================= CONTACT PANELS ================= -->
    <section class="contact-panels">
      <div class="container panels-wrap">

        <div class="panel-frame">

          <!-- LEFT: GET IN TOUCH -->
          <div class="panel panel-maroon">
            <h2>Get In Touch</h2>
            <div class="divider divider-center"></div>

            <ul class="contact-list">
              <li>
                <span class="icon-circle">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                    <circle cx="12" cy="8" r="4" />
                    <path d="M4 20c0-4.4 3.6-7 8-7s8 2.6 8 7" />
                  </svg>
                </span>
                <div class="contact-text">
                  <strong>Bhumi Mantra Team</strong>
                  <span>Guides &amp; Facilitators</span>
                </div>
              </li>


              <li>
                <span class="icon-circle">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                    <rect x="3" y="5" width="18" height="14" rx="2" />
                    <path d="m3 7 9 6 9-6" />
                  </svg>
                </span>
                <div class="contact-text">
                  <strong>Email</strong>
                  <span><a href="mailto:hello@bhumimantra.com">hello@bhumimantra.com</a></span>
                </div>
              </li>

              <li>
                <span class="icon-circle">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                    <path d="M12 21s7-7.2 7-12a7 7 0 1 0-14 0c0 4.8 7 12 7 12Z" />
                    <circle cx="12" cy="9" r="2.5" />
                  </svg>
                </span>
                <div class="contact-text">
                  <strong>Location</strong>
                  <span>Italy</span>
                  <span class="muted">Available for Online &amp; In-Person Sessions</span>
                </div>
              </li>

              <li class="no-border">
                
                <div class="contact-text">
                  <strong>Year-Round Courses</strong>
                  <span>Our courses run throughout the year. Get in touch with us to find the next available program
                    that best suits your schedule.</span>
                </div>
              </li>
            </ul>

            <!-- PLACEHOLDER: corner mandala decoration -->

          </div>

          <!-- RIGHT: SEND US A MESSAGE -->
          <div class="panel panel-green" id="send-message">
            <h2>Send Us A Message</h2>
            <div class="divider divider-center"></div>

            <form class="contact-form" action="#" method="POST" novalidate>
              <div class="field">
                <label for="name" class="sr-only">Your Name</label>
                <input id="name" type="text" name="name" placeholder="Your Name" autocomplete="name" required>
              </div>
              <div class="field">
                <label for="email" class="sr-only">Your Email</label>
                <input id="email" type="email" name="email" placeholder="Your Email" autocomplete="email" required>
              </div>
              <div class="field">
                <label for="subject" class="sr-only">Subject</label>
                <input id="subject" type="text" name="subject" placeholder="Subject" autocomplete="off">
              </div>
              <div class="field">
                <label for="message" class="sr-only">Your Message</label>
                <textarea id="message" name="message" placeholder="Your Message" rows="6" required></textarea>
              </div>

              <button type="submit" class="btn btn-primary btn-submit">
                Send Message <span class="arrow">→</span>
              </button>
            </form>

            <!-- PLACEHOLDER: corner mandala decoration -->

          </div>

        </div>
      </div>
    </section>

    <!-- ================= QUOTE BANNER ================= -->
    <section class="quote-banner">
      <!-- PLACEHOLDER: replace with temple silhouette background image -->
      <img src="assets/gallery/home-image/contact.png" alt="" class="quote-bg" aria-hidden="true">
      <div class="quote-overlay" aria-hidden="true"></div>

      <div class="container quote-content">
        <img src="assets/gallery/home-image/logo.png" alt="" class="quote-mandala" aria-hidden="true">
        <p class="quote-sanskrit">तदा द्रष्टुः स्वरूपेऽवस्थानम्</p>
        <p class="quote-translit">Tadā draṣṭuḥ svarūpe 'vasthānam</p>
        <p class="quote-text">Then pure awareness is established in itself.</p>
      </div>
    </section>

  </main>
@endsection

@push('scripts')
  <script src="js/contact-page-js/contact.js"></script>
  <script src="js/nav-dropdown.js"></script>
@endpush
