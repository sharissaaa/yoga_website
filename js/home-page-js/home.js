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

      /* ── BREATHING ORB ── */
      var phases = [
        {
          label: "Inhale",
          count: 4,
          unit: "SEC",
          color: "#8FF2A9",
          ringClass: "inhale-active",
        },
        {
          label: "Hold",
          count: 4,
          unit: "SEC",
          color: "#13A832",
          ringClass: "",
        },
        {
          label: "Exhale",
          count: 6,
          unit: "SEC",
          color: "#076B1A",
          ringClass: "exhale-active",
        },
      ];
      var phaseIndex = 0,
        timer = null,
        current = 0,
        running = false;

      function initBreathing() {
        var orbLabel = document.querySelector(".orb-label-top");
        var orbNumber = document.querySelector(".orb-number");
        var orbUnit = document.querySelector(".orb-unit");
        var ringEl = document.getElementById("breathingRing");
        var startBtn = document.querySelector(".btn-start-breathe");
        var btnIcon = document.getElementById("btnIcon");
        var btnText = document.getElementById("btnText");
        if (!startBtn) return;

        function runBreath() {
          clearInterval(timer);
          var phase = phases[phaseIndex];
          current = phase.count;
          if (orbLabel) {
            orbLabel.textContent = phase.label;
            orbLabel.style.color = phase.color;
          }
          if (orbNumber) orbNumber.textContent = current;
          if (orbUnit) orbUnit.textContent = phase.unit;
          if (ringEl) {
            ringEl.classList.remove("inhale-active", "exhale-active");
            if (phase.ringClass) ringEl.classList.add(phase.ringClass);
          }
          timer = setInterval(function () {
            current--;
            if (orbNumber) orbNumber.textContent = current;
            if (current <= 0) {
              clearInterval(timer);
              phaseIndex = (phaseIndex + 1) % phases.length;
              setTimeout(runBreath, 400);
            }
          }, 1000);
        }

        startBtn.addEventListener("click", function () {
          if (!running) {
            running = true;
            if (btnText) btnText.textContent = "Pause";
            runBreath();
          } else {
            running = false;
            clearInterval(timer);
            phaseIndex = 0;
            current = 0;
            if (btnText) btnText.textContent = "Begin Breathing";
            if (ringEl)
              ringEl.classList.remove("inhale-active", "exhale-active");
            if (orbLabel) {
              orbLabel.textContent = "Inhale";
              orbLabel.style.color = phases[0].color;
            }
            if (orbNumber) orbNumber.textContent = "4";
            if (orbUnit) orbUnit.textContent = "SEC";
          }
        });
      }

      /* ── DESTINATIONS: clicking a card goes to the full Destinations page ── */
      function initDestinationCards() {
        document.querySelectorAll(".dest-card").forEach(function (card) {
          card.addEventListener("click", function (e) {
            if (e.target.closest("a, button")) return;
            window.location.href = "travel.html";
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

      /* ── LOAD HTML PARTIALS ── */
      var partials = [
        { id: "partial-experience", src: "partials/home-experience.html" },
        { id: "partial-about", src: "partials/home-about.html" },
        { id: "partial-destinations", src: "partials/home-destinations.html" },
        { id: "partial-meditation-orb", src: "partials/home-meditation-orb.html" },
        { id: "partial-stories", src: "partials/home-stories.html" },
      ];

      var loadPromises = partials.map(function (p) {
        return fetch(p.src)
          .then(function (r) {
            if (!r.ok) throw new Error("Not found: " + p.src);
            return r.text();
          })
          .then(function (html) {
            var el = document.getElementById(p.id);
            if (el) el.innerHTML = html;
          })
          .catch(function (err) {
            console.warn("Skipping partial —", err.message);
          });
      });

      Promise.all(loadPromises).then(function () {
        initReveal();
        initBreathing();
        initDestinationCards();
        initOfferingsSection();
        initStoryArrows();
        initStoryToggle();
      });
    