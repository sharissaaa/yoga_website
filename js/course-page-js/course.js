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
       BHUMI MANTRA – Course Page Script
       (mobile-nav toggle and nav-scroll handling now live in the
       shared script above, shared by every page)
       ============================================================ */
    document.addEventListener('DOMContentLoaded', () => {

      /* 1. SCROLL-REVEAL ANIMATIONS */
      const revealEls = document.querySelectorAll('.reveal');

      if ('IntersectionObserver' in window && revealEls.length) {
        const revealObserver = new IntersectionObserver((entries) => {
          entries.forEach(entry => {
            if (entry.isIntersecting) {
              entry.target.classList.add('is-visible');
              revealObserver.unobserve(entry.target);
            }
          });
        }, { threshold: 0.12, rootMargin: '0px 0px -60px 0px' });

        revealEls.forEach(el => revealObserver.observe(el));
      } else {
        revealEls.forEach(el => el.classList.add('is-visible'));
      }

      /* 2. MOVING MANDALA — continuous rotation (CSS) + scroll
            parallax drift (JS), respects reduced-motion */
      const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
      const mandalas = document.querySelectorAll('.mandala-spin');

      if (!prefersReducedMotion && mandalas.length) {
        let ticking = false;

        const updateParallax = () => {
          const scrollY = window.scrollY;
          mandalas.forEach((el, i) => {
            const speed = (i % 2 === 0) ? 0.03 : -0.025;
            const offset = scrollY * speed;
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

      /* 3. SMOOTH SCROLL FOR IN-PAGE ANCHOR LINKS */
      document.querySelectorAll('a[href^="#"]').forEach(link => {
        link.addEventListener('click', (e) => {
          const targetId = link.getAttribute('href');
          if (targetId.length > 1) {
            const target = document.querySelector(targetId);
            if (target) {
              e.preventDefault();
              target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
          }
        });
      });

      /* 4. EXPANDABLE COURSE PREVIEWS */
      document.querySelectorAll('.hl-card__toggle').forEach(btn => {
        btn.addEventListener('click', () => {
          const desc = btn.previousElementSibling;
          if (!desc || !desc.classList.contains('hl-card__desc')) return;
          const expanded = desc.classList.toggle('is-expanded');
          btn.textContent = expanded ? 'Read less' : 'Read more';
          btn.setAttribute('aria-expanded', String(expanded));
        });
      });

      /* 4b. COURSE HIGHLIGHTS — carousel arrows scroll the track */
      const hlTrack = document.querySelector('.highlights__track');
      const hlPrev = document.querySelector('.highlights__arrow--prev');
      const hlNext = document.querySelector('.highlights__arrow--next');
      if (hlTrack && hlPrev && hlNext) {
        const scrollByCard = (dir) => {
          const card = hlTrack.querySelector('.hl-card');
          if (!card) return;
          const gap = parseFloat(getComputedStyle(hlTrack).columnGap) || 0;
          const amount = card.getBoundingClientRect().width + gap;
          hlTrack.scrollBy({ left: dir * amount, behavior: 'smooth' });
        };
        hlPrev.addEventListener('click', () => scrollByCard(-1));
        hlNext.addEventListener('click', () => scrollByCard(1));

        const updateArrowState = () => {
          const max = hlTrack.scrollWidth - hlTrack.clientWidth;
          hlPrev.disabled = hlTrack.scrollLeft <= 4;
          hlNext.disabled = hlTrack.scrollLeft >= max - 4;
        };
        hlTrack.addEventListener('scroll', updateArrowState, { passive: true });
        window.addEventListener('resize', updateArrowState);
        updateArrowState();
      }

    });
  