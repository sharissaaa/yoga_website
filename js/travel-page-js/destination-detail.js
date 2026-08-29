document.addEventListener('DOMContentLoaded', () => {
  const params = new URLSearchParams(window.location.search);
  const slug = params.get('slug');
  const data = typeof DESTINATIONS !== 'undefined' ? DESTINATIONS[slug] : null;

  if (!data) {
    document.title = 'Destination not found – Bhumi Mantra';
    const hero = document.querySelector('.dest-hero__content');
    if (hero) {
      hero.innerHTML =
        '<a href="travel.html" class="dest-hero__back">&larr; All Destinations</a>' +
        '<h1 class="dest-hero__heading">Destination not found</h1>' +
        '<p class="dest-hero__location">This journey may have been removed or renamed. Please choose another from All Destinations.</p>';
    }
    [
      '.dest-facts', '.dest-departures', '.dest-gallery', '.dest-about',
      '.dest-program', '#destProgramList', '.dest-expect', '.dest-pricing', '.dest-faq',
    ].forEach((selector) => {
      const el = document.querySelector(selector);
      if (el) el.hidden = true;
    });
    return;
  }

  document.title = `${data.title} – Bhumi Mantra`;

  const heroImg = document.getElementById('destHeroImg');
  if (heroImg) {
    heroImg.src = data.image;
    heroImg.alt = data.imageAlt;
  }

  const title = document.getElementById('destTitle');
  if (title) title.textContent = data.title;

  const location = document.getElementById('destLocation');
  if (location) location.textContent = data.destination;

  const duration = document.getElementById('destDuration');
  if (duration) duration.textContent = data.duration;

  const level = document.getElementById('destLevel');
  if (level) level.textContent = data.level;

  const dates = document.getElementById('destDates');
  if (dates) dates.textContent = data.dates;

  const description = document.getElementById('destDescription');
  if (description) description.textContent = data.whyText || data.description;

  const highlights = document.getElementById('destHighlights');
  if (highlights && Array.isArray(data.highlights)) {
    highlights.innerHTML = '';
    data.highlights.forEach((item) => {
      const li = document.createElement('li');
      li.textContent = item;
      highlights.appendChild(li);
    });
  }

  const RESERVE_URL = 'reserve.html';

  const heroReserveLink = document.getElementById('destHeroReserve');
  if (heroReserveLink) heroReserveLink.href = RESERVE_URL;

  const reserveLink = document.getElementById('destReserveLink');
  if (reserveLink) reserveLink.href = RESERVE_URL;

  const pricingLink = document.getElementById('destPricingLink');
  if (pricingLink) pricingLink.href = RESERVE_URL;

  /* Next departures */
  const departuresList = document.getElementById('destDeparturesList');
  if (departuresList && Array.isArray(data.departures)) {
    departuresList.innerHTML = '';
    data.departures.forEach((dep) => {
      const card = document.createElement('div');
      card.className = 'dest-departures__card';

      const range = document.createElement('p');
      range.className = 'dest-departures__range';
      range.textContent = dep.range;

      const meta = document.createElement('p');
      meta.className = 'dest-departures__meta';
      meta.textContent = `With Bhumi Mantra guides · ${dep.spots} spots left`;

      const link = document.createElement('a');
      link.className = 'dest-departures__link';
      link.href = RESERVE_URL;
      link.textContent = 'Reserve this date →';

      card.append(range, meta, link);
      departuresList.appendChild(card);
    });
  }

  /* Gallery: the hero image plus any extra photos for this destination.
     Section hides itself when there's nothing beyond the hero shot. The
     first tile is shown larger for a less uniform, more editorial grid. */
  const gallerySection = document.getElementById('destGallerySection');
  const galleryGrid = document.getElementById('destGalleryGrid');
  const galleryPhotos = [{ src: data.image, alt: data.imageAlt }].concat(data.gallery || []);
  if (galleryGrid && galleryPhotos.length > 1) {
    const hasFeatured = galleryPhotos.length > 2;
    galleryGrid.classList.toggle('has-featured', hasFeatured);
    galleryGrid.innerHTML = '';
    galleryPhotos.forEach((photo, i) => {
      const tile = document.createElement('div');
      tile.className = 'dest-gallery__tile';
      if (i === 0 && hasFeatured) tile.classList.add('is-featured');

      const img = document.createElement('img');
      img.src = photo.src;
      img.alt = photo.alt;
      img.loading = 'lazy';

      tile.appendChild(img);
      galleryGrid.appendChild(tile);
    });
  } else if (gallerySection) {
    gallerySection.hidden = true;
  }

  /* About-section portrait: uses data.aboutImage when the destination has
     one set (a photo distinct from the hero and every gallery tile above
     it) so nothing on the page repeats. Falls back to an extra gallery
     shot for destinations with enough of them to already avoid repeats. */
  const extraPhotos = data.gallery || [];
  const heroPhoto = { src: data.image, alt: data.imageAlt };

  const aboutImg = document.getElementById('destAboutImg');
  if (aboutImg) {
    const photo = data.aboutImage || (extraPhotos.length > 1 ? extraPhotos[0] : heroPhoto);
    aboutImg.src = photo.src;
    aboutImg.alt = photo.alt;
  }

  const programImg = document.getElementById('destProgramImg');
  if (programImg) {
    const photo = extraPhotos.length > 1 ? extraPhotos[1] : (extraPhotos[0] || heroPhoto);
    programImg.src = photo.src;
    programImg.alt = photo.alt;
  }

  /* Day-by-day itinerary: hidden until the toggle button is clicked,
     then rendered from data.itinerary (falls back to hiding the whole
     program section if a destination has none set). */
  const programToggle = document.getElementById('destProgramToggle');
  const programList = document.getElementById('destProgramList');
  if (programToggle && programList) {
    if (!Array.isArray(data.itinerary) || !data.itinerary.length) {
      programToggle.closest('.dest-program').hidden = true;
      programList.hidden = true;
    } else {
      programList.innerHTML = '';
      data.itinerary.forEach((day, i) => {
        const item = document.createElement('div');
        item.className = 'dest-program__day';

        const num = document.createElement('span');
        num.className = 'dest-program__day-num';
        num.textContent = `Day ${i + 1}`;

        const point = document.createElement('p');
        point.className = 'dest-program__day-point';
        point.textContent = day.text;

        item.append(num, point);
        programList.appendChild(item);
      });

      programToggle.addEventListener('click', () => {
        const expanded = programToggle.getAttribute('aria-expanded') === 'true';
        programToggle.setAttribute('aria-expanded', String(!expanded));
        programToggle.querySelector('span').textContent = expanded
          ? 'View the Full Itinerary'
          : 'Hide the Itinerary';
        programList.hidden = expanded;
      });
    }
  }

  /* "Design Your Own Journey" box: clicking anywhere on it (except the
     link itself, which already goes there) opens the personalized
     travel package page. */
  const customBox = document.querySelector('.dest-custom__content');
  if (customBox) {
    const customLink = customBox.querySelector('.dest-custom__link');
    customBox.addEventListener('click', (e) => {
      if (e.target.closest('a')) return;
      if (customLink) window.location.href = customLink.href;
    });
  }
});