/* ============================================================
   BHUMI MANTRA – Shared Nav Dropdown (mobile accordion)
   Include on every page, after the page's own nav-init script.
   Turns "Destinations" into an expand/collapse accordion inside
   the mobile full-screen menu panel (see header-footer.css,
   @media max-width:960px), matching the footer's +/- pattern.
   Desktop hover-dropdown behavior is untouched.
   ============================================================ */
(function () {
  document.querySelectorAll('.site-nav__item--dropdown').forEach(function (item) {
    var caret = item.querySelector('.site-nav__caret');
    if (!caret) return;

    caret.setAttribute('role', 'button');
    caret.setAttribute('tabindex', '0');
    caret.setAttribute('aria-expanded', 'false');
    caret.setAttribute('aria-label', 'Toggle submenu');

    var toggle = function (e) {
      if (!window.matchMedia('(max-width: 960px)').matches) return;
      e.preventDefault();
      e.stopPropagation();
      var open = item.classList.toggle('is-open');
      caret.setAttribute('aria-expanded', open ? 'true' : 'false');
    };

    caret.addEventListener('click', toggle);
    caret.addEventListener('keydown', function (e) {
      if (e.key === 'Enter' || e.key === ' ') toggle(e);
    });
  });
})();
