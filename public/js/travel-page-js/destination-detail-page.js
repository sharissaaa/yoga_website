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

        /* Scroll-reveal: fades/slides .reveal, .reveal-left, .reveal-right
         elements into view once they enter the viewport (see header-footer.css) */
        var revealObserver = new IntersectionObserver(
          function (entries) {
            entries.forEach(function (entry) {
              if (entry.isIntersecting) {
                entry.target.classList.add("visible");
                revealObserver.unobserve(entry.target);
              }
            });
          },
          { threshold: 0.1, rootMargin: "0px 0px -36px 0px" },
        );
        document
          .querySelectorAll(".reveal, .reveal-left, .reveal-right")
          .forEach(function (el) {
            revealObserver.observe(el);
          });
      })();
    