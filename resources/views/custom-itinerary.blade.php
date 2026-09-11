@extends('layouts.app')

@section('title', 'Build Your Itinerary – Bhumi Mantra')

@push('styles')
  <link rel="stylesheet" href="css/travel-page-css/travel.css" />
  <link rel="stylesheet" href="css/header-footer.css" />
  <link rel="stylesheet" href="css/reserve.css" />

  <link
    href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Inter:wght@300;400;500;600&family=Noto+Serif+Devanagari:wght@400;500;600&display=swap"
    rel="stylesheet" />
@endpush

@section('content')

  <!-- ================= /HEADER ================= -->

  <!-- ===== BUILD YOUR ITINERARY FORM ===== -->
  <section class="reserve-section">
    <div class="reserve-card">
      <p class="eyebrow eyebrow--center">· Ready When You Are ·</p>
      <h1 class="reserve-heading">Let's Build Your Itinerary</h1>
      <p class="reserve-sub">
        Tell us your group size and rough dates, and we'll get back to you
        with a starting shape for the journey.
      </p>

      <form id="itineraryForm" class="reserve-form" novalidate>
        <div class="reserve-field">
          <label for="itName">Full Name</label>
          <input id="itName" name="name" type="text" placeholder="Your full name" autocomplete="name" required />
        </div>

        <div class="reserve-field">
          <label for="itEmail">Email</label>
          <input id="itEmail" name="email" type="email" placeholder="you@example.com" autocomplete="email" required />
        </div>

        <div class="reserve-field">
          <label for="itPhone">Phone <span class="optional">(optional)</span></label>
          <input id="itPhone" name="phone" type="tel" placeholder="+1 234 567 8900" autocomplete="tel" />
        </div>

        <div class="reserve-row">
          <div class="reserve-field">
            <label for="itGroupSize">Group Size</label>
            <input id="itGroupSize" name="groupSize" type="number" min="1" placeholder="e.g. 8" required />
          </div>

          <div class="reserve-field">
            <label for="itDates">Rough Dates <span class="optional">(optional)</span></label>
            <input id="itDates" name="dates" type="text" placeholder="e.g. Late Sept 2026" />
          </div>
        </div>

        <div class="reserve-field">
          <label for="itVision">What Do You Have In Mind? <span class="optional">(optional)</span></label>
          <textarea id="itVision" name="vision" rows="4" placeholder="Destinations, pace, style of practice — anything that helps us shape it."></textarea>
        </div>

        <button type="submit" class="reserve-submit">Submit</button>

        <p class="reserve-note" id="itineraryNote" hidden>
          Your email app should now be open with your request ready to send.
          If nothing opened, please email us directly at
          <a href="mailto:travel@innerjourney.com">travel@innerjourney.com</a>.
        </p>
      </form>
    </div>
  </section>
  <!-- ================= /BUILD YOUR ITINERARY FORM ================= -->
@endsection

@push('scripts')
  <script src="js/travel-page-js/custom-itinerary.js"></script>
  <script src="js/nav-dropdown.js"></script>
@endpush
