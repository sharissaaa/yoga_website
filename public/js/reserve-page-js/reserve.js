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

  var submitBtn = form.querySelector('.reserve-submit');

  /* Arriving via ?destination=<name> (e.g. from a destination-detail
     page's Reserve Your Spot button) pre-fills the field so the visitor
     doesn't have to retype it, and the reservation email reliably shows
     the correct destination. */
  var prefilledDestination = new URLSearchParams(window.location.search).get('destination');
  if (prefilledDestination && form.elements['destination']) {
    form.elements['destination'].value = prefilledDestination;
  }

  var get = function (name) {
    return form.elements[name].value.trim();
  };

  function showNote(message, isError) {
    if (!note) return;
    note.textContent = message;
    note.classList.toggle('reserve-note--error', !!isError);
    note.hidden = false;
  }

  function fallbackMailto(destination) {
    var lines = [
      'Name: ' + get('name'),
      'Email: ' + get('email'),
      'Phone: ' + (get('phone') || '-'),
      'Nationality: ' + get('nationality'),
      'Destination / Retreat: ' + destination,
      'Preferred Dates: ' + (get('dates') || '-'),
      'Travelers: ' + (get('travelers') || '-'),
      'Additional Notes: ' + (get('notes') || '-'),
    ];
    var subject = 'Reservation Request - ' + (destination || 'General Inquiry');
    return (
      'mailto:travel@innerjourney.com?subject=' +
      encodeURIComponent(subject) +
      '&body=' +
      encodeURIComponent(lines.join('\n'))
    );
  }

  form.addEventListener('submit', function (e) {
    e.preventDefault();
    if (!form.reportValidity()) return;

    var destination = get('destination');
    var payload = {
      name: get('name'),
      email: get('email'),
      phone: get('phone'),
      nationality: get('nationality'),
      destination: destination,
      dates: get('dates'),
      travelers: get('travelers'),
      notes: get('notes'),
    };

    if (submitBtn) submitBtn.disabled = true;

    var csrfMeta = document.querySelector('meta[name="csrf-token"]');

    fetch(form.action, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        Accept: 'application/json',
        'X-CSRF-TOKEN': csrfMeta ? csrfMeta.content : '',
      },
      body: JSON.stringify(payload),
    })
      .then(function (res) {
        return res.json().then(function (data) {
          return { ok: res.ok && data.ok, data: data };
        });
      })
      .then(function (result) {
        if (result.ok) {
          showNote(
            'Reservation request sent for ' + destination + '. We’ll be in touch shortly.',
            false,
          );
          form.reset();
        } else {
          window.location.href = fallbackMailto(destination);
          showNote(
            'We couldn’t send that automatically. Your email app should now be open instead — if nothing opened, please email us directly at travel@innerjourney.com.',
            true,
          );
        }
      })
      .catch(function () {
        window.location.href = fallbackMailto(destination);
        showNote(
          'We couldn’t send that automatically. Your email app should now be open instead — if nothing opened, please email us directly at travel@innerjourney.com.',
          true,
        );
      })
      .then(function () {
        if (submitBtn) submitBtn.disabled = false;
      });
  });
})();
