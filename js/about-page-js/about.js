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
               4c. STORY — "Read more" reveals the Bridge & Vision passages
               ---------------------------------------------------------- */
            const storyToggle = document.getElementById('storyToggle');
            const storyMore = document.getElementById('storyMore');
            if (storyToggle && storyMore) {
                storyToggle.addEventListener('click', () => {
                    const expanded = storyMore.classList.toggle('is-open');
                    storyToggle.textContent = expanded ? 'Read less' : 'Read more';
                    storyToggle.setAttribute('aria-expanded', String(expanded));
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
    