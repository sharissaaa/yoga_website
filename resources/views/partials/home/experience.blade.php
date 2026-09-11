<!-- ══════════════════════════════════════════ -->
<!-- EXPERIENCES SECTION -->
<!-- ══════════════════════════════════════════ -->

@if(!empty($offerings['heading']) || !empty($offerings['cards']))
<section class="exp-section">
    <div class="container">

        <div class="exp-layout">

            <!-- LEFT CONTENT -->
            <div class="exp-left">
                @if(!empty($offerings['eyebrow']))
                <div class="exp-eyebrow">
                    <span>{{ $offerings['eyebrow'] }}</span>
                </div>
                @endif

                @if(!empty($offerings['heading']))
                <h2>
                    <a href="{{ $offerings['headingLink'] ?: '#' }}" class="exp-left__link">{{ $offerings['heading'] }}</a>
                </h2>
                @endif

                @if(!empty($offerings['description']))
                <p class="exp-left__desc">{{ $offerings['description'] }}</p>
                @endif
            </div>

            <!-- RIGHT CARDS -->
            @if(!empty($offerings['cards']))
            <div class="exp-right">

                <div class="exp-cards-row">
                    @foreach($offerings['cards'] as $card)
                    <div class="exp-card">
                        <span class="exp-card-divider exp-card-divider--top"></span>
                        @if(!empty($card['title']))
                        <h4 class="exp-card-title">{{ $card['title'] }}</h4>
                        @endif
                        <span class="exp-card-divider"></span>
                        @if(!empty($card['description']))
                        <p class="exp-card-tag">{{ $card['description'] }}</p>
                        @endif
                        <span class="exp-card-arrow" aria-hidden="true">
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="13 6 19 12 13 18"></polyline>
                            </svg>
                        </span>
                    </div>
                    @endforeach
                </div>

            </div>
            @endif

        </div>

    </div>
</section>
@endif
