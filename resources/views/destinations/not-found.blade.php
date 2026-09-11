@extends('layouts.app')

@section('title', 'Destination not found – Bhumi Mantra')

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

    <section class="dest-hero">
      <div class="dest-hero__overlay" aria-hidden="true"></div>
      <div class="dest-hero__content">
        <a href="travel.html" class="dest-hero__back">&larr; All Destinations</a>
        <h1 class="dest-hero__heading">Destination not found</h1>
        <p class="dest-hero__location">This journey may have been removed or renamed. Please choose another from All Destinations.</p>
      </div>
    </section>

@endsection

@push('scripts')
  <script src="js/nav-dropdown.js"></script>
@endpush
