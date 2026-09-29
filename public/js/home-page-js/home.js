      (function () {
        var siteNav = document.getElementById("siteNav");
        var burger = document.getElementById("navBurger");
        var links = document.getElementById("navLinks");
        if (!burger || !links) return;

        burger.addEventListener("click", function () {
          var open = links.classList.toggle("is-open");
          burger.classList.toggle("is-open", open);
          burger.setAttribute("aria-expanded", open ? "true" : "false");
        });

        links.querySelectorAll("a").forEach(function (link) {
          link.addEventListener("click", function () {
            links.classList.remove("is-open");
            burger.classList.remove("is-open");
            burger.setAttribute("aria-expanded", "false");
          });
        });

        if (siteNav) {
          var onScroll = function () {
            siteNav.classList.toggle("site-nav--scrolled", window.scrollY > 10);
          };
          window.addEventListener("scroll", onScroll, { passive: true });
          onScroll();
        }

        document
          .querySelectorAll(".site-footer__col--collapsible")
          .forEach(function (col) {
            var heading = col.querySelector(".site-footer__col-heading");
            if (!heading) return;
            heading.addEventListener("click", function () {
              col.classList.toggle("is-open");
            });
          });
      })();
    

      /* ── SCROLL REVEAL ── */
      var revealObserver = new IntersectionObserver(
        function (entries) {
          entries.forEach(function (e) {
            if (e.isIntersecting) {
              /* ✅ FIX: add both class names so all sections animate in */
              e.target.classList.add("visible", "is-visible");
              revealObserver.unobserve(e.target);
            }
          });
        },
        { threshold: 0.1, rootMargin: "0px 0px -36px 0px" },
      );

      function initReveal() {
        /* ✅ FIX: include .reveal-item used by the about section */
        document
          .querySelectorAll(
            ".reveal, .reveal-left, .reveal-right, .reveal-item",
          )
          .forEach(function (el) {
            revealObserver.observe(el);
          });
      }

      /* ── DESTINATIONS: clicking a card goes to the Destinations list
              (travel.html), landing on and highlighting that specific
              card there (see the ?highlight= handling in travel.js).
              Falls back to a plain trip for cards with no single
              destination, like the Tamil Nadu/Kerala carousel card ── */
      function initDestinationCards() {
        document.querySelectorAll(".dest-card").forEach(function (card) {
          card.addEventListener("click", function (e) {
            if (e.target.closest("a, button")) return;
            var slug = card.dataset.slug;
            window.location.href = slug
              ? "travel.html?highlight=" + encodeURIComponent(slug)
              : "travel.html";
          });
        });
      }

      /* ── OFFERINGS: clicking anywhere in the Courses block (heading,
              description, or any of the 4 course cards) goes to the
              full Courses page ── */
      function initOfferingsSection() {
        var section = document.querySelector(".exp-section");
        if (!section) return;
        section.style.cursor = "pointer";
        section.addEventListener("click", function (e) {
          if (e.target.closest("a, button")) return;
          window.location.href = "course.html";
        });
      }

      /* ── STORIES: prev/next arrows scroll the card grid ── */
      function initStoryArrows() {
        var grid = document.querySelector(".story-grid");
        var prevBtn = document.querySelector(
          '.story-arrow[aria-label="Previous story"]',
        );
        var nextBtn = document.querySelector(
          '.story-arrow[aria-label="Next story"]',
        );
        if (!grid || !prevBtn || !nextBtn) return;

        function scrollByCard(direction) {
          var card = grid.querySelector(".story-card-col");
          var gap = 24;
          var amount = card ? card.getBoundingClientRect().width + gap : 320;
          grid.scrollBy({ left: direction * amount, behavior: "smooth" });
        }

        prevBtn.addEventListener("click", function () {
          scrollByCard(-1);
        });
        nextBtn.addEventListener("click", function () {
          scrollByCard(1);
        });
      }

      /* ── STORY CARDS: measure every card's natural content height and
              apply the tallest one to all of them, so the row is always
              evenly sized — collapsed or expanded together ── */
      function syncStoryCardHeights() {
        var cards = document.querySelectorAll(".stories-section .story-card");
        if (!cards.length) return;
        cards.forEach(function (card) { card.style.height = "auto"; });
        var max = 0;
        cards.forEach(function (card) {
          max = Math.max(max, card.offsetHeight);
        });
        cards.forEach(function (card) { card.style.height = max + "px"; });
      }

      /* "Read more" expands every card's testimonial text together */
      function initStoryToggle() {
        var cards = document.querySelectorAll(".stories-section .story-card");
        var buttons = document.querySelectorAll(".stories-section .story-read");
        if (!buttons.length) return;
        var expanded = false;
        buttons.forEach(function (btn) {
          btn.addEventListener("click", function () {
            expanded = !expanded;
            cards.forEach(function (card) {
              card.classList.toggle("is-expanded", expanded);
            });
            buttons.forEach(function (b) {
              b.textContent = expanded ? "Read less" : "Read more";
            });
            syncStoryCardHeights();
          });
        });

        syncStoryCardHeights();
        if (document.fonts && document.fonts.ready) {
          document.fonts.ready.then(syncStoryCardHeights);
        }
        var resizeTimer;
        window.addEventListener("resize", function () {
          clearTimeout(resizeTimer);
          resizeTimer = setTimeout(syncStoryCardHeights, 150);
        });
      }

      /* Home sections are server-rendered Blade includes now (see
         resources/views/home.blade.php), so no client-side fetching is
         needed — just run each section's init once the DOM is ready. */
      initReveal();
      initDestinationCards();
      initOfferingsSection();
      initStoryArrows();
      initStoryToggle();
    