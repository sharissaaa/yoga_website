@if(!empty($breathe['heading']) || !empty($breathe['steps']))
<section class="meditation-orb-section">

    <div class="orb-noise"></div>

    <div class="container">
        <div class="meditation-layout">

            <div class="meditation-copy reveal-left">
                @if(!empty($breathe['eyebrow']))
                <div class="orb-eyebrow">
                    <span class="orb-eyebrow__text">{{ $breathe['eyebrow'] }}</span>
                    <span class="orb-eyebrow__rule"></span>
                </div>
                @endif
                @if(!empty($breathe['heading']))
                <h2>{{ $breathe['heading'] }}</h2>
                <span class="orb-divider"></span>
                @endif
            </div>

            @if(!empty($breathe['steps']))
            <div class="orb-center reveal">
                <div class="center-glow"></div>
                <div class="orb-container" id="orbContainer"
                    data-steps='@json(collect($breathe['steps'])->map(fn ($s) => ["label" => $s['label'], "duration" => $s['durationSeconds']])->values())'>
                    <div class="outer-orbit"></div>
                    <div class="outer-orbit"></div>
                    <div class="outer-orbit"></div>
                    <div class="outer-orbit"></div>
                    <div class="outer-orbit"></div>
                    <div class="outer-orbit"></div>
                    <div class="orb-glow"></div>
                    <div class="breathing-ring" id="breathingRing">
                        <div class="ring-inner-accent"></div>
                        <div class="orb-content">
                            <span class="orb-label-top" id="orbPhaseLabel">{{ $breathe['steps'][0]['label'] ?? '' }}</span>
                            <div class="orb-number" id="orbNumber">{{ $breathe['steps'][0]['durationSeconds'] ?? '' }}</div>
                            <span class="orb-unit">SEC</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="orb-right reveal-right">
                <div class="breath-steps">
                    @foreach($breathe['steps'] as $i => $step)
                    <div class="step-item {{ strtolower($step['label'] ?? '') }}">
                        <span class="step-dot"></span>
                        <div>
                            @if(!empty($step['label']))<h5>{{ $step['label'] }}</h5>@endif
                            @if(!empty($step['durationSeconds']))<small>{{ $step['durationSeconds'] }} sec</small>@endif
                        </div>
                    </div>
                    @if(!$loop->last)
                    <div class="step-connector"></div>
                    @endif
                    @endforeach
                </div>
                <button class="btn-start-breathe" id="startBtn" onclick="toggleBreathing()">
                    <span class="bp" id="btnIcon">▶</span>
                    <span id="btnText">Begin Breathing</span>
                </button>
            </div>
            @endif

        </div>
    </div>

</section>

<script src="js/home-page-js/home-meditation-orb.js"></script>
@endif
