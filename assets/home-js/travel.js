document.addEventListener('click', (e) => {
  const lessLink = e.target.closest('.retreat-card__less');
  if (!lessLink) return;

  e.preventDefault();
  const details = lessLink.closest('.retreat-card__more');
  if (details) details.removeAttribute('open');
});