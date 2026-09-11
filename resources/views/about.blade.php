@extends('layouts.app')

@section('title', 'About Us – Bhumi Mantra')

@push('styles')
    <link rel="stylesheet" href="css/about.css" />
    <!-- Shared across every page: same nav + footer design, color set per page below -->
    <link rel="stylesheet" href="css/header-footer.css" />
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Cinzel:wght@400;500;600&family=Inter:wght@300;400;500;600&family=Noto+Serif+Devanagari:wght@400;500;600&display=swap"
        rel="stylesheet" />
@endpush

@section('content')

    <!-- ================= /HEADER ================= -->

    <!-- ===== HERO ===== -->
    <section class="hero about-hero">
        <div class="hero__left ah-left">
            

            <h1 class="ah-headline">
                Rooted in Ancient Wisdom.<br />
                <em class="ah-headline--gold">Guided by Love.</em>
            </h1>

            <div class="ah-body">
                <p>Bhoomi Mantra is a sanctuary for soul seekers, a space where ancient yogic traditions meet modern
                    understanding.</p>
                <p>We support you on your journey of healing, self-discovery and transformation.</p>
                <p>Through mindful teachings, immersive retreats and sacred practices, we help you reconnect with
                    your true essence and live a life of purpose, balance and harmony.</p>
                <p>Through Bhoomi Mantra, we aim to create opportunities for sincere seekers to experience the depth
                    of yoga, meditation, tantra, and the wisdom traditions of India through authentic practices,
                    guided courses, pilgrimages, expeditions, and immersive meditation retreats.</p>
            </div>
        </div>
        <div class="hero__right">
            <img src="assets/gallery/home-image/about.jpg" alt="" class="hero__img" />
            <div class="hero__img-gradient" aria-hidden="true"></div>
        </div>
    </section>

    <!-- ===== MEET THE TEAM ===== -->
    <section class="team" id="meet-the-team">
        <p class="eyebrow eyebrow--center">· Meet The Team ·</p>
        <h2 class="team__heading">The Teachers Guiding Your Practice</h2>

        <div class="team__grid">

            <article class="team-card">
                <div class="team-card__media">
                    <img src="assets/gallery/home-image/pexels-balljinder-singh-666149-18364977.jpg"
                        alt="Jeo Varghese guiding a meditation session at a mountain retreat"
                        style="object-position: 78% 62%;">
                </div>
                <h4 class="team-card__title">Jeo Varghese</h4>
                <p class="team-card__meta">Yoga Teacher &nbsp;|&nbsp; Researcher &nbsp;|&nbsp; Guide</p>
                <p class="team-card__desc">
                    Jeo has spent over a decade studying traditional Hatha and Ashtanga lineages across South
                    India, blending rigorous technique with a deeply personal, meditative teaching style. He
                    leads our retreat programs in Kerala and continues to research classical yogic texts.
                </p>
                <button type="button" class="team-card__toggle" aria-expanded="false">Read more</button>
            </article>

            <article class="team-card">
                <div class="team-card__media">
                    <img src="assets/gallery/home-image/pexels-yogavidyamandiram-31743034.jpg"
                        alt="Alice Avaldi guiding students through a standing pose" style="object-position: 58% 32%;">
                </div>
                <h4 class="team-card__title">Alice Avaldi</h4>
                <p class="team-card__meta">Yoga Educator &nbsp;|&nbsp; Holistic Guide</p>
                <p class="team-card__desc">
                    Alice bridges Western wellness training with time-honoured yogic philosophy, creating a
                    warm, holistic space for every student's practice. She is especially devoted to supporting
                    beginners through their first retreat experience.
                </p>
                <button type="button" class="team-card__toggle" aria-expanded="false">Read more</button>
            </article>

            <article class="team-card">
                <div class="team-card__media">
                    <img src="assets/gallery/home-image/pexels-kundalini-yoga-ashram-324305954-14533456.jpg"
                        alt="Nidish Nidhiri leading a seated meditation practice" style="object-position: 32% 48%;">
                </div>
                <h4 class="team-card__title">Nidish Nidhiri</h4>
                <p class="team-card__meta">Meditation Teacher &nbsp;|&nbsp; Facilitator</p>
                <p class="team-card__desc">
                    Nidish guides students into stillness through breath-centred meditation and sound practice,
                    drawing on years spent training in ashram settings across India. His sessions are known for
                    their gentle pace and quiet depth.
                </p>
                <button type="button" class="team-card__toggle" aria-expanded="false">Read more</button>
            </article>

        </div>
    </section>

    <!-- ===== STORY ===== -->
    <section class="story">
        <div class="story__left">
            <p class="eyebrow"><h2 class="story__heading">
                A journey of <em>devotion</em>and <em>discovery</em>
            </h2>
            
            <p class="story__text">
                Bhoomi Mantra Yoga &amp; Meditation Research Center was founded by Alice and Jeo with the vision of
                preserving and sharing authentic yogic traditions that support profound self-transformation, inner
                awareness, and holistic well-being.
            </p>
            <p class="story__text">
                Bhumi Mantra was born from a deep love for India and a longing to share its sacred traditions with the
                world.
            </p>
            <p class="story__text">
                After years of study, practice and exploration, we created a space where ancient wisdom is lived, shared
                and experienced in a meaningful way.
            </p>
            <p class="story__text">
                The project is now beginning to establish its own foundation in India, with the long-term vision of
                creating a dedicated center in the forests of Vagamon, Kerala. This space will become a place for
                community living, spiritual practice, education, and research&mdash;where people can learn, grow, and
                reconnect with the deeper dimensions of life in harmony with nature.
            </p>
            <p class="story__text">
                The offerings, course fees, and donations received through Bhoomi Mantra are dedicated to the
                development and sustainability of this vision, as well as supporting meaningful social initiatives. A
                part of our mission is to help provide educational opportunities for children who face financial
                barriers, supporting their learning, growth, and future possibilities.
            </p>
            <p class="story__text">
                Today, we are a team of yoga teachers, healers and travel curators dedicated to holding space for your
                transformation.
            </p>

            <div class="story__more" id="storyMore">
                <p class="story__text">
                    Bhoomi Mantra is a bridge between ancient wisdom and modern life&mdash;a place where
                    yoga becomes not only a personal practice, but a path of transformation, compassion,
                    and service.
                </p>
                <p class="story__text">
                    Our vision is to cultivate a conscious community where self-realization, knowledge,
                    nature, and humanitarian values come together.
                </p>
            </div>
            <button type="button" class="btn btn--outline story__toggle" id="storyToggle" aria-expanded="false" aria-controls="storyMore">Read more</button>
        </div>
        <div class="story__right">
            <img src="assets/gallery/home-image/varnasi.jpg" alt="" class="story__img" />
            <div class="story__img-gradient" aria-hidden="true"></div>
        </div>
    </section>


    <!-- ===== QUOTE ===== -->
    <section class="quote">
        <img src="assets/gallery/home-image/logo.png" alt="" class="quote__mandala" aria-hidden="true">
        <p class="quote__sanskrit">तदा द्रष्टुः स्वरूपेऽवस्थानम्</p>
        <p class="quote__translit">Tadā draṣṭuḥ svarūpe 'vasthānam</p>
        <p class="quote__text"><em>Then pure awareness is established in itself.</em></p>
    </section>

    <!-- ══════════════════════════════════════ -->
    <!-- SECTION: FOOTER (shared across site)   -->
    <!-- ══════════════════════════════════════ -->
@endsection

@push('scripts')
  <script src="js/about-page-js/about.js"></script>
  <script src="js/nav-dropdown.js"></script>
@endpush
