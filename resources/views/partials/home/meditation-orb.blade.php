<section class="meditation-orb-section">

    <div class="orb-noise"></div>

    <div class="container">
        <div class="meditation-layout">

            <div class="meditation-copy reveal-left">
                <div class="orb-eyebrow">
                    <span class="orb-eyebrow__text">PAUSE. BREATHE. BE.</span>
                    <span class="orb-eyebrow__rule"></span>
                </div>
                <h2>Return to Stillness</h2>
                <span class="orb-divider"></span>
            </div>

            <div class="orb-center reveal">
                <div class="center-glow"></div>
                <div class="orb-container" id="orbContainer">
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
                            <span class="orb-label-top" id="orbPhaseLabel">Inhale</span>
                            <div class="orb-number" id="orbNumber">4</div>
                            <span class="orb-unit">SEC</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="orb-right reveal-right">
                <div class="breath-steps">
                    <div class="step-item inhale">
                        <span class="step-dot"></span>
                        <div><h5>Inhale</h5><small>4 sec</small></div>
                    </div>
                    <div class="step-connector"></div>
                    <div class="step-item hold">
                        <span class="step-dot"></span>
                        <div><h5>Hold</h5><small>4 sec</small></div>
                    </div>
                    <div class="step-connector"></div>
                    <div class="step-item exhale">
                        <span class="step-dot"></span>
                        <div><h5>Exhale</h5><small>6 sec</small></div>
                    </div>
                </div>
                <button class="btn-start-breathe" id="startBtn" onclick="toggleBreathing()">
                    <span class="bp" id="btnIcon">▶</span>
                    <span id="btnText">Begin Breathing</span>
                </button>
            </div>

        </div>
    </div>

</section>

<script src="js/home-page-js/home-meditation-orb.js"></script>