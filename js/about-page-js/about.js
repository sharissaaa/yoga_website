        (function () {
            var siteNav = document.getElementById('siteNav');
            var burger = document.getElementById('navBurger');
            var links = document.getElementById('navLinks');
            if (burger && links) {
                burger.addEventListener('click', function () {
                    var open = links.classList.toggle('is-open');
                    burger.classList.toggle('is-open', open);
                    burger.setAttribute('aria-expanded', open ? 'true' : 'false');
                });
                links.querySelectorAll('a').forEach(function (link) {
                    link.addEventListener('click', function () {
                        links.classList.remove('is-open');
                        burger.classList.remove('is-open');
                        burger.setAttribute('aria-expanded', 'false');
                    });
                });
            }
            if (siteNav) {
                var onScroll = function () {
                    siteNav.classList.toggle('site-nav--scrolled', window.scrollY > 10);
                };
                window.addEventListener('scroll', onScroll, { passive: true });
                onScroll();
            }

            document.querySelectorAll('.site-footer__col--collapsible').forEach(function (col) {
                var heading = col.querySelector('.site-footer__col-heading');
                if (!heading) return;
                heading.addEventListener('click', function () {
                    col.classList.toggle('is-open');
                });
            });
        })();
    
/* ============================================================
BHUMI MANTRA – About Page Script
(mobile-nav toggle and nav-scroll handling now live in the
shared script above, shared by every page)
============================================================ */

        document.addEventListener('DOMContentLoaded', () => {

            /* ----------------------------------------------------------
               1. SCROLL-REVEAL ANIMATIONS
               Sections with the `.reveal` class fade + slide up into view
               ---------------------------------------------------------- */
            const revealEls = document.querySelectorAll('.reveal');

            if ('IntersectionObserver' in window && revealEls.length) {
                const revealObserver = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('is-visible');
                            revealObserver.unobserve(entry.target);
                        }
                    });
                }, {
                    threshold: 0.15,
                    rootMargin: '0px 0px -60px 0px'
                });

                revealEls.forEach(el => revealObserver.observe(el));
            } else {
                // Fallback: just show everything if IntersectionObserver isn't supported
                revealEls.forEach(el => el.classList.add('is-visible'));
            }

            /* ----------------------------------------------------------
               2. ANIMATED STAT COUNTERS (5000+, 400+, 20+, 10+ etc.)
               Counts up from 0 to the target number once the stats
               section scrolls into view.
               ---------------------------------------------------------- */
            const statNumbers = document.querySelectorAll('.stat-item__number:not(.stat-item__number--text)');

            const animateCount = (el) => {
                const raw = el.textContent.trim();          // e.g. "5000+"
                const suffix = raw.replace(/[\d,]/g, '');     // "+"
                const target = parseInt(raw.replace(/[^\d]/g, ''), 10) || 0;

                const duration = 1400;
                const startTime = performance.now();

                const tick = (now) => {
                    const progress = Math.min((now - startTime) / duration, 1);
                    // easeOutCubic
                    const eased = 1 - Math.pow(1 - progress, 3);
                    const current = Math.floor(eased * target);
                    el.textContent = current.toLocaleString() + suffix;

                    if (progress < 1) {
                        requestAnimationFrame(tick);
                    } else {
                        el.textContent = target.toLocaleString() + suffix;
                    }
                };

                requestAnimationFrame(tick);
            };

            if ('IntersectionObserver' in window && statNumbers.length) {
                const statsSection = document.querySelector('.stats');
                let hasAnimated = false;

                const statsObserver = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting && !hasAnimated) {
                            hasAnimated = true;
                            statNumbers.forEach(animateCount);
                            statsObserver.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0.4 });

                if (statsSection) statsObserver.observe(statsSection);
            }

            /* ----------------------------------------------------------
               3. MOVING MANDALA — continuous rotation + subtle parallax
               The mandalas already spin via CSS (.mandala-spin keyframes).
               This adds a gentle parallax drift as the user scrolls, and
               respects prefers-reduced-motion.
               ---------------------------------------------------------- */
            const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
            const mandalas = document.querySelectorAll('.mandala-spin');

            if (!prefersReducedMotion && mandalas.length) {
                let ticking = false;

                const updateParallax = () => {
                    const scrollY = window.scrollY;
                    mandalas.forEach((el) => {
                        // hero mandala drifts slowly; both stats ornaments share
                        // the exact same speed so they stay mirrored on scroll
                        const speed = el.classList.contains('stats__ornament') ? 0.04 : -0.03;
                        const offset = scrollY * speed;
                        el.style.setProperty('--mandala-drift', `${offset}px`);
                        el.style.marginTop = `${offset}px`;
                    });
                    ticking = false;
                };

                window.addEventListener('scroll', () => {
                    if (!ticking) {
                        window.requestAnimationFrame(updateParallax);
                        ticking = true;
                    }
                }, { passive: true });
            }

            /* ----------------------------------------------------------
               4. MEET THE TEAM — expandable card previews
               ---------------------------------------------------------- */
            document.querySelectorAll('.team-card__toggle').forEach(btn => {
                btn.addEventListener('click', () => {
                    const desc = btn.previousElementSibling;
                    if (!desc || !desc.classList.contains('team-card__desc')) return;
                    const expanded = desc.classList.toggle('is-expanded');
                    btn.textContent = expanded ? 'Read less' : 'Read more';
                    btn.setAttribute('aria-expanded', String(expanded));
                });
            });

            /* ----------------------------------------------------------
               4b. ABOUT HERO — "Read More" expands the rest of the story
               ---------------------------------------------------------- */
            const aboutToggle = document.getElementById('aboutBodyToggle');
            const aboutMore = document.getElementById('aboutBodyMore');
            if (aboutToggle && aboutMore) {
                aboutToggle.addEventListener('click', () => {
                    const expanded = aboutMore.classList.toggle('is-open');
                    aboutToggle.setAttribute('aria-expanded', String(expanded));
                    aboutToggle.querySelector('span').textContent = expanded ? 'Read Less' : 'Read More';
                });
            }

            /* ----------------------------------------------------------
               5. NEWSLETTER FORM (placeholder submit handler)
               ---------------------------------------------------------- */
            const newsletterForm = document.querySelector('.site-newsletter-form');
            if (newsletterForm) {
                newsletterForm.addEventListener('submit', (e) => {
                    e.preventDefault();
                    const input = newsletterForm.querySelector('#newsletterEmail');
                    const email = input ? input.value.trim() : '';

                    if (!email) return;

                    // Replace this with your real subscribe endpoint / API call
                    console.log('Newsletter signup:', email);

                    const btn = newsletterForm.querySelector('button');
                    if (btn) {
                        const original = btn.textContent;
                        btn.textContent = '✓';
                        setTimeout(() => { btn.textContent = original; }, 1800);
                    }
                    input.value = '';
                });
            }

        });
    