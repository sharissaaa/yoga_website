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

/* ── PAGINATION ──
   Paginates .retreat-card elements inside #retreatsList, 5 per page.
   Cards added later (e.g. via Strapi) just need to be in that list —
   no changes needed here as the count grows. */
document.addEventListener('DOMContentLoaded', () => {
  const CARDS_PER_PAGE = 5;
  const list = document.getElementById('retreatsList');
  const pagination = document.getElementById('retreatsPagination');
  const emptyMessage = document.getElementById('retreatsEmpty');
  if (!list || !pagination) return;

  const allCards = Array.from(list.querySelectorAll('.retreat-card'));
  let currentPage = 1;

  function render() {
    const totalPages = Math.max(1, Math.ceil(allCards.length / CARDS_PER_PAGE));
    if (currentPage > totalPages) currentPage = 1;

    allCards.forEach((card, i) => {
      const onPage = Math.floor(i / CARDS_PER_PAGE) + 1 === currentPage;
      card.style.display = onPage ? '' : 'none';
      if (onPage) card.classList.add('visible');
    });

    if (emptyMessage) emptyMessage.hidden = allCards.length !== 0;

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

  render();
});