document.addEventListener('DOMContentLoaded', () => {
  /* Day-by-day itinerary: hidden until the toggle button is clicked
     (the itinerary items themselves are rendered server-side now). */
  const programToggle = document.getElementById('destProgramToggle');
  const programList = document.getElementById('destProgramList');
  if (programToggle && programList) {
    programToggle.addEventListener('click', () => {
      const expanded = programToggle.getAttribute('aria-expanded') === 'true';
      programToggle.setAttribute('aria-expanded', String(!expanded));
      programToggle.querySelector('span').textContent = expanded
        ? 'View the Full Itinerary'
        : 'Hide the Itinerary';
      programList.hidden = expanded;
    });
  }

  /* "Ready to Reserve Your Spot?" box: clicking anywhere on it (except
     the link itself, which already goes there) opens the reserve form. */
  const customBox = document.querySelector('.dest-custom__content');
  if (customBox) {
    const customLink = customBox.querySelector('.dest-custom__link');
    customBox.addEventListener('click', (e) => {
      if (e.target.closest('a')) return;
      if (customLink) window.location.href = customLink.href;
    });
  }
});
