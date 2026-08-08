document.addEventListener('click', (e) => {
  const lessLink = e.target.closest('.retreat-card__less');
  if (!lessLink) return;

  e.preventDefault();
  const details = lessLink.closest('.retreat-card__more');
  if (details) details.removeAttribute('open');
});

/* ── CARD → DETAIL PAGE ──
   Clicking anywhere on a card opens its destination-detail.html page, except
   when the click lands on something already interactive inside the card
   (the More Information toggle, the email link, the reserve line) — those
   keep their own behavior instead of being hijacked by the card-level nav. */
document.addEventListener('click', (e) => {
  const card = e.target.closest('.retreat-card');
  if (!card) return;
  if (e.target.closest('a, button, summary')) return;

  const slug = card.dataset.slug;
  if (slug) window.location.href = `destination-detail.html?slug=${encodeURIComponent(slug)}`;
});

/* ── FILTER DROPDOWNS + CARD FILTERING + PAGINATION ──
   Each filterable dropdown carries data-filter="destination|duration|month|level"
   and its options carry a matching data-value. Selecting an option narrows
   the visible .retreat-card elements down to those whose own data-* attributes
   match every active filter, then paginates the filtered result (5 per page).
   Cards added later (e.g. via Strapi) just need the same data-* attributes —
   no changes needed here as the count grows. */
document.addEventListener('DOMContentLoaded', () => {
  const CARDS_PER_PAGE = 5;
  const dropdowns = Array.from(document.querySelectorAll('[data-dropdown]'));
  const list = document.getElementById('retreatsList');
  const pagination = document.getElementById('retreatsPagination');
  const emptyMessage = document.getElementById('retreatsEmpty');
  if (!list || !pagination) return;

  const allCards = Array.from(list.querySelectorAll('.retreat-card'));
  const filters = { destination: null, duration: null, month: null, level: null };
  let currentPage = 1;

  function closeAllDropdowns() {
    dropdowns.forEach((dropdown) => {
      const toggle = dropdown.querySelector('.filter-select__toggle');
      const menu = dropdown.querySelector('.filter-select__menu');
      dropdown.classList.remove('is-open');
      if (toggle) toggle.setAttribute('aria-expanded', 'false');
      if (menu) menu.hidden = true;
    });
  }

  function cardMatchesFilters(card) {
    return Object.keys(filters).every((key) => {
      const active = filters[key];
      return !active || card.dataset[key] === active;
    });
  }

  /* "All Destinations" is treated as a master reset — picking it clears every
     other filter too, so the full list shows regardless of duration/month/level. */
  function resetOtherDropdowns(exceptDropdown) {
    Object.keys(filters).forEach((key) => { filters[key] = null; });
    dropdowns.forEach((dropdown) => {
      if (dropdown === exceptDropdown) return;
      const options = dropdown.querySelectorAll('[role="option"]');
      const dropdownLabel = dropdown.querySelector('.filter-select__label');
      if (!options.length) return;
      options.forEach((o, i) => o.setAttribute('aria-selected', i === 0 ? 'true' : 'false'));
      if (dropdownLabel) dropdownLabel.textContent = options[0].textContent;
    });
  }

  function render() {
    const filtered = allCards.filter(cardMatchesFilters);
    const totalPages = Math.max(1, Math.ceil(filtered.length / CARDS_PER_PAGE));
    if (currentPage > totalPages) currentPage = 1;

    allCards.forEach((card) => { card.style.display = 'none'; });
    filtered.forEach((card, i) => {
      const onPage = Math.floor(i / CARDS_PER_PAGE) + 1 === currentPage;
      if (onPage) {
        card.style.display = '';
        card.classList.add('visible');
      }
    });

    if (emptyMessage) emptyMessage.hidden = filtered.length !== 0;

    pagination.innerHTML = '';
    if (totalPages > 1) {
      for (let page = 1; page <= totalPages; page++) {
        const btn = document.createElement('button');
        btn.type = 'button';
        btn.className = 'retreats-pagination__btn';
        btn.textContent = String(page);
        btn.setAttribute('aria-label', `Page ${page}`);
        if (page === currentPage) btn.classList.add('is-active');
        btn.addEventListener('click', () => {
          currentPage = page;
          render();
          list.scrollIntoView({ behavior: 'smooth', block: 'start' });
        });
        pagination.appendChild(btn);
      }
    }
  }

  dropdowns.forEach((dropdown) => {
    const toggle = dropdown.querySelector('.filter-select__toggle');
    const label = dropdown.querySelector('.filter-select__label');
    const menu = dropdown.querySelector('.filter-select__menu');
    const filterKey = dropdown.dataset.filter;
    if (!toggle || !menu) return;

    /* Clicking anywhere in the pill opens it — not just the label text —
       but a click on the menu itself is left to the option handler below. */
    dropdown.addEventListener('click', (e) => {
      if (menu.contains(e.target)) return;
      e.stopPropagation();
      const isOpen = dropdown.classList.contains('is-open');
      closeAllDropdowns();
      if (!isOpen) {
        dropdown.classList.add('is-open');
        toggle.setAttribute('aria-expanded', 'true');
        menu.hidden = false;
      }
    });

    menu.querySelectorAll('[role="option"]').forEach((option) => {
      option.addEventListener('click', (e) => {
        e.stopPropagation();
        menu.querySelectorAll('[role="option"]').forEach((o) => o.setAttribute('aria-selected', 'false'));
        option.setAttribute('aria-selected', 'true');
        if (label) label.textContent = option.textContent;
        closeAllDropdowns();
        toggle.focus();

        if (filterKey) {
          const value = option.dataset.value || null;
          filters[filterKey] = value;
          if (filterKey === 'destination' && !value) resetOtherDropdowns(dropdown);
          currentPage = 1;
          render();
        }
      });
    });
  });

  document.addEventListener('click', closeAllDropdowns);
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeAllDropdowns();
  });

  render();
});