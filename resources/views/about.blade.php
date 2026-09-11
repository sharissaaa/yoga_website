@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="css/about.css" />
    <!-- Shared across every page: same nav + footer design, color set per page below -->
    <link rel="stylesheet" href="css/header-footer.css" />
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Cinzel:wght@400;500;600&family=Inter:wght@300;400;500;600&family=Noto+Serif+Devanagari:wght@400;500;600&display=swap"
        rel="stylesheet" />
@endpush

@section('content')

    <!-- ===== HERO ===== -->
    @if(!empty($hero['headline']) || !empty($hero['paragraphs']))
    <section class="hero about-hero">
        <div class="hero__left ah-left">

            @if(!empty($hero['headline']) || !empty($hero['headlineHighlight']))
            <h1 class="ah-headline">
                {{ $hero['headline'] ?? '' }}<br />
                @if(!empty($hero['headlineHighlight']))
                <em class="ah-headline--gold">{{ $hero['headlineHighlight'] }}</em>
                @endif
            </h1>
            @endif

            @if(!empty($hero['paragraphs']))
            <div class="ah-body">
                @foreach($hero['paragraphs'] as $paragraph)
                <p>{{ $paragraph }}</p>
                @endforeach
            </div>
            @endif
        </div>
        @if(!empty($hero['image']))
        <div class="hero__right">
            <img src="{{ $hero['image'] }}" alt="" class="hero__img" />
            <div class="hero__img-gradient" aria-hidden="true"></div>
        </div>
        @endif
    </section>
    @endif

    <!-- ===== MEET THE TEAM ===== -->
    @if(!empty($team['heading']) || !empty($team['members']))
    <section class="team" id="meet-the-team">
        @if(!empty($team['eyebrow']))
        <p class="eyebrow eyebrow--center">{{ $team['eyebrow'] }}</p>
        @endif
        @if(!empty($team['heading']))
        <h2 class="team__heading">{{ $team['heading'] }}</h2>
        @endif

        @if(!empty($team['members']))
        <div class="team__grid">
            @foreach($team['members'] as $member)
            <article class="team-card">
                @if(!empty($member['image']))
                <div class="team-card__media">
                    <img src="{{ $member['image'] }}" alt="{{ $member['name'] }}">
                </div>
                @endif
                @if(!empty($member['name']))
                <h4 class="team-card__title">{{ $member['name'] }}</h4>
                @endif
                @if(!empty($member['meta']))
                <p class="team-card__meta">{{ $member['meta'] }}</p>
                @endif
                @if(!empty($member['description']))
                <p class="team-card__desc">{{ $member['description'] }}</p>
                <button type="button" class="team-card__toggle" aria-expanded="false">Read more</button>
                @endif
            </article>
            @endforeach
        </div>
        @endif
    </section>
    @endif

    <!-- ===== STORY ===== -->
    @if(!empty($story['heading']) || !empty($story['paragraphs']))
    @php
        $mainParagraphs = collect($story['paragraphs'] ?? [])->where('isExtra', false);
        $extraParagraphs = collect($story['paragraphs'] ?? [])->where('isExtra', true);
    @endphp
    <section class="story">
        <div class="story__left">
            @if(!empty($story['heading']))
            <h2 class="story__heading">{!! $story['heading'] !!}</h2>
            @endif

            @foreach($mainParagraphs as $paragraph)
            <p class="story__text">{{ $paragraph['text'] }}</p>
            @endforeach

            @if($extraParagraphs->isNotEmpty())
            <div class="story__more" id="storyMore">
                @foreach($extraParagraphs as $paragraph)
                <p class="story__text">{{ $paragraph['text'] }}</p>
                @endforeach
            </div>
            <button type="button" class="btn btn--outline story__toggle" id="storyToggle" aria-expanded="false" aria-controls="storyMore">Read more</button>
            @endif
        </div>
        @if(!empty($story['image']))
        <div class="story__right">
            <img src="{{ $story['image'] }}" alt="" class="story__img" />
            <div class="story__img-gradient" aria-hidden="true"></div>
        </div>
        @endif
    </section>
    @endif

    <!-- ===== QUOTE ===== -->
    @if(!empty($quote['sanskrit']) || !empty($quote['translation']))
    <section class="quote">
        <img src="assets/gallery/home-image/logo.png" alt="" class="quote__mandala" aria-hidden="true">
        @if(!empty($quote['sanskrit']))
        <p class="quote__sanskrit">{{ $quote['sanskrit'] }}</p>
        @endif
        @if(!empty($quote['transliteration']))
        <p class="quote__translit">{{ $quote['transliteration'] }}</p>
        @endif
        @if(!empty($quote['translation']))
        <p class="quote__text"><em>{{ $quote['translation'] }}</em></p>
        @endif
    </section>
    @endif

@endsection

@push('scripts')
  <script src="js/about-page-js/about.js"></script>
  <script src="js/nav-dropdown.js"></script>
@endpush
