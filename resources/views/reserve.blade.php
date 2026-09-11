@extends('layouts.app')

@push('styles')
  <link rel="stylesheet" href="css/travel-page-css/travel.css" />
  <link rel="stylesheet" href="css/header-footer.css" />
  <link rel="stylesheet" href="css/reserve.css" />

  <link
    href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Inter:wght@300;400;500;600&family=Noto+Serif+Devanagari:wght@400;500;600&display=swap"
    rel="stylesheet" />
@endpush

@section('content')

  <!-- ===== RESERVE FORM ===== -->
  <section class="reserve-section">
    <div class="reserve-card">
      @if(!empty($eyebrow))
      <p class="eyebrow eyebrow--center">{{ $eyebrow }}</p>
      @endif
      @if(!empty($heading))
      <h1 class="reserve-heading">{{ $heading }}</h1>
      @endif
      @if(!empty($subText))
      <p class="reserve-sub">{{ $subText }}</p>
      @endif

      <form id="reserveForm" class="reserve-form" method="POST" action="{{ route('reservations.store') }}" novalidate>
        @csrf
        <div class="reserve-field">
          <label for="resName">Full Name</label>
          <input id="resName" name="name" type="text" placeholder="Your full name" autocomplete="name" required />
        </div>

        <div class="reserve-field">
          <label for="resEmail">Email</label>
          <input id="resEmail" name="email" type="email" placeholder="you@example.com" autocomplete="email" required />
        </div>

        <div class="reserve-field">
          <label for="resPhone">Phone <span class="optional">(optional)</span></label>
          <input id="resPhone" name="phone" type="tel" placeholder="+1 234 567 8900" autocomplete="tel" />
        </div>

        <div class="reserve-field">
          <label for="resNationality">Nationality</label>
          <input id="resNationality" name="nationality" type="text" placeholder="e.g. Indian" autocomplete="country-name" required />
        </div>

        <div class="reserve-field">
          <label for="resDestination">Destination / Retreat</label>
          <input id="resDestination" name="destination" type="text" placeholder="e.g. Bali Healing Retreat" required />
        </div>

        <div class="reserve-row">
          <div class="reserve-field">
            <label for="resDates">Preferred Dates <span class="optional">(optional)</span></label>
            <input id="resDates" name="dates" type="text" placeholder="e.g. 15–21 Aug 2026" />
          </div>

          <div class="reserve-field">
            <label for="resTravelers">Travelers <span class="optional">(optional)</span></label>
            <input id="resTravelers" name="travelers" type="number" min="1" placeholder="1" />
          </div>
        </div>

        <div class="reserve-field">
          <label for="resNotes">Additional Notes <span class="optional">(optional)</span></label>
          <textarea id="resNotes" name="notes" rows="4" placeholder="Anything else we should know?"></textarea>
        </div>

        <button type="submit" class="reserve-submit">Send Reservation Request &rarr;</button>

        <p class="reserve-note" id="reserveNote" hidden>
          @if(!empty($successNote))
          {{ $successNote }}
          @endif
          <a href="mailto:travel@innerjourney.com">travel@innerjourney.com</a>.
        </p>
      </form>
    </div>
  </section>
  <!-- ================= /RESERVE FORM ================= -->
@endsection

@push('scripts')
  <script src="js/reserve-page-js/reserve.js"></script>
  <script src="js/nav-dropdown.js"></script>
@endpush
