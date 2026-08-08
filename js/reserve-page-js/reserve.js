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
  }

  if (siteNav) {
    var onScroll = function () {
      siteNav.classList.toggle('site-nav--scrolled', window.scrollY > 10);
    };
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
  }

  var revealObserver = new IntersectionObserver(
    function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
          revealObserver.unobserve(entry.target);
        }
      });
    },
    { threshold: 0.1, rootMargin: '0px 0px -36px 0px' },
  );
  document.querySelectorAll('.reveal').forEach(function (el) {
    revealObserver.observe(el);
  });

  var form = document.getElementById('reserveForm');
  var note = document.getElementById('reserveNote');
  if (!form) return;

  form.addEventListener('submit', function (e) {
    e.preventDefault();
    if (!form.reportValidity()) return;

    var get = function (name) {
      var value = form.elements[name].value.trim();
      return value;
    };

    var destination = get('destination');
    var lines = [
      'Name: ' + get('name'),
      'Email: ' + get('email'),
      'Phone: ' + (get('phone') || '-'),
      'Destination / Retreat: ' + destination,
      'Preferred Dates: ' + (get('dates') || '-'),
      'Travelers: ' + (get('travelers') || '-'),
      'Additional Notes: ' + (get('notes') || '-'),
    ];

    var subject = 'Reservation Request - ' + (destination || 'General Inquiry');
    var body = lines.join('\n');
    var mailto =
      'mailto:travel@innerjourney.com?subject=' +
      encodeURIComponent(subject) +
      '&body=' +
      encodeURIComponent(body);

    window.location.href = mailto;
    if (note) note.hidden = false;
  });
})();
