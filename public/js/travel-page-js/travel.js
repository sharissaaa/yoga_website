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

/* ── RETREAT LIST ──
   Shows every .retreat-card inside #retreatsList (no pagination). */
document.addEventListener('DOMContentLoaded', () => {
  const list = document.getElementById('retreatsList');
  const emptyMessage = document.getElementById('retreatsEmpty');
  if (!list) return;

  const allCards = Array.from(list.querySelectorAll('.retreat-card'));
  allCards.forEach((card) => card.classList.add('visible'));

  if (emptyMessage) emptyMessage.hidden = allCards.length !== 0;

  /* ── HIGHLIGHT ──
     Arriving via ?highlight=<slug> (e.g. from a homepage destination
     card) brightens that card's border and scrolls to it. */
  const highlightSlug = new URLSearchParams(window.location.search).get('highlight');
  const highlightIndex = highlightSlug
    ? allCards.findIndex((card) => card.dataset.slug === highlightSlug)
    : -1;

  if (highlightIndex !== -1) {
    const target = allCards[highlightIndex];
    target.classList.add('retreat-card--highlighted');
    /* Land right on the card instead of visibly sliding down the page —
       html has scroll-behavior: smooth for normal anchor links, so it's
       switched off just for this jump and restored right after. */
    const html = document.documentElement;
    const prevScrollBehavior = html.style.scrollBehavior;
    html.style.scrollBehavior = 'auto';
    target.scrollIntoView({ block: 'center' });
    html.style.scrollBehavior = prevScrollBehavior;
  }
});