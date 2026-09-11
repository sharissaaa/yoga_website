(function () {
    var targets = document.querySelectorAll('.reveal-left, .reveal, .reveal-right');
    if (!('IntersectionObserver' in window)) {
        targets.forEach(function (t) { t.classList.add('in-view'); });
        return;
    }
    var obs = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) entry.target.classList.add('in-view');
        });
    }, { threshold: 0.2 });
    targets.forEach(function (t) { obs.observe(t); });
})();

var phases = [
    { label: 'Inhale', sec: 4, color: '#8FF2A9', ringClass: 'inhale-active' },
    { label: 'Hold',   sec: 4, color: '#13A832', ringClass: '' },
    { label: 'Exhale', sec: 6, color: '#076B1A', ringClass: 'exhale-active' }
];

var running = false;
var pi = 0;
var cnt = 4;
var timer = null;

var labelEl = document.getElementById('orbPhaseLabel');
var numEl   = document.getElementById('orbNumber');
var ringEl  = document.getElementById('breathingRing');
var biconEl = document.getElementById('btnIcon');
var btxtEl  = document.getElementById('btnText');
var orbContainerEl = document.getElementById('orbContainer');
var startBtnEl = document.getElementById('startBtn');

function applyPhase() {
    var p = phases[pi];
    labelEl.textContent = p.label;
    labelEl.style.color = p.color;
    numEl.textContent = cnt;
    ringEl.classList.remove('inhale-active', 'exhale-active');
    if (p.ringClass) ringEl.classList.add(p.ringClass);
}

function tick() {
    cnt--;
    if (cnt <= 0) {
        pi = (pi + 1) % phases.length;
        cnt = phases[pi].sec;
    }
    applyPhase();
}

function toggleBreathing() {
    running = !running;
    if (running) {
        // Hand control over from the slow idle "resting heartbeat" pulse
        // to the actual guided inhale/hold/exhale timing.
        ringEl.classList.add('is-running');
        pi = 0; cnt = phases[0].sec;
        applyPhase();
        timer = setInterval(tick, 1000);
        biconEl.textContent = '⏸';
        btxtEl.textContent = 'Pause';
    } else {
        clearInterval(timer);
        pi = 0; cnt = phases[0].sec;
        ringEl.classList.remove('inhale-active', 'exhale-active', 'is-running');
        labelEl.textContent = 'Inhale';
        labelEl.style.color = '#8FF2A9';
        numEl.textContent = '4';
        biconEl.textContent = '▶';
        btxtEl.textContent = 'Begin Breathing';
    }
}

/* ── Premium scroll-tied reveal ──────────────────────────────
   As the meditation section scrolls up from the bottom of the viewport
   into place, --orb-scroll-progress climbs from 0 → 1. CSS reads this
   variable to fade/lift the top glow and center halo, so the transition
   from the destinations section above feels like one continuous motion
   rather than a static handoff. Respects reduced-motion by no-op'ing. */
(function () {
    var prefersReduced = window.matchMedia &&
        window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (prefersReduced) return;

    var section = document.querySelector('.meditation-orb-section');
    if (!section) return;

    var ticking = false;

    function updateProgress() {
        var rect = section.getBoundingClientRect();
        var vh = window.innerHeight || document.documentElement.clientHeight;

        // progress 0: section top is at the bottom edge of the viewport
        // progress 1: section top has scrolled up to ~35% of viewport height
        var start = vh;
        var end = vh * 0.35;
        var raw = (start - rect.top) / (start - end);
        var progress = Math.min(1, Math.max(0, raw));

        document.documentElement.style.setProperty('--orb-scroll-progress', progress.toFixed(3));
        ticking = false;
    }

    function onScrollOrResize() {
        if (!ticking) {
            window.requestAnimationFrame(updateProgress);
            ticking = true;
        }
    }

    window.addEventListener('scroll', onScrollOrResize, { passive: true });
    window.addEventListener('resize', onScrollOrResize);
    updateProgress();
})();

/* ── Ripple helper — spawns a water-drop ripple centered on the click
   point inside a given container element ── */
function spawnRipple(container, evt, sizeMultiplier, bg) {
    var rect = container.getBoundingClientRect();
    var size = Math.max(rect.width, rect.height) * (sizeMultiplier || 1.6);
    var x = evt.clientX - rect.left - size / 2;
    var y = evt.clientY - rect.top - size / 2;

    var ripple = document.createElement('span');
    ripple.className = 'orb-ripple';
    ripple.style.width = size + 'px';
    ripple.style.height = size + 'px';
    ripple.style.left = x + 'px';
    ripple.style.top = y + 'px';
    if (bg) ripple.style.background = bg;

    container.appendChild(ripple);
    ripple.addEventListener('animationend', function () {
        ripple.remove();
    });
}

/* Clicking anywhere on the orb ring cluster ripples + toggles breathing */
orbContainerEl.addEventListener('click', function (e) {
    spawnRipple(orbContainerEl, e, 1.6);
    toggleBreathing();
});

/* Ripple on the "Begin Breathing" / "Pause" button, contained within it */
startBtnEl.addEventListener('click', function (e) {
    spawnRipple(
        startBtnEl,
        e,
        2,
        'radial-gradient(circle, rgba(95, 226, 122, 0.35) 0%, transparent 70%)'
    );
});
