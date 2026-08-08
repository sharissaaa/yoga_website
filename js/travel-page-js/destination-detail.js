/* Generic day-by-day template — cycled to fit any trip length. Illustrative
   only ("Sample Itinerary"), since we don't have a finalized day-by-day plan
   per destination yet; swap for real itinerary data once it exists. */
function buildItinerary(data) {
  const totalDays = parseInt(data.duration, 10) || 0;
  if (!totalDays) return [];

  const middleTemplates = [
    `Morning practice, then free time to explore ${data.destination}`,
    'Guided visit to a site central to this journey',
    'Rest & integration day — gentle, optional practice only',
    'Local culture, craft or community immersion',
    'Excursion suited to the surrounding landscape',
  ];

  const days = [];
  for (let i = 1; i <= totalDays; i++) {
    if (i === 1) {
      days.push('Arrival & welcome circle');
    } else if (i === totalDays) {
      days.push('Closing ceremony & departure');
    } else {
      days.push(middleTemplates[(i - 2) % middleTemplates.length]);
    }
  }
  return days;
}

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
      '.dest-expect', '.dest-itinerary', '.dest-pricing', '.dest-guides', '.dest-faq',
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

  const reserveSubject = (suffix) =>
    `mailto:travel@innerjourney.com?subject=${encodeURIComponent(`Reserve My Spot - ${data.title}${suffix ? ' (' + suffix + ')' : ''}`)}`;

  const reserveLink = document.getElementById('destReserveLink');
  if (reserveLink) reserveLink.href = reserveSubject();

  const pricingLink = document.getElementById('destPricingLink');
  if (pricingLink) pricingLink.href = reserveSubject();

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
      link.href = reserveSubject(dep.range);
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

  /* About-section portrait and mid-page immersive break reuse photos from
     the extra gallery shots (not the hero) so they don't repeat the top
     banner. With only one extra shot, that photo is already shown in the
     gallery grid above, so About falls back to the hero instead of showing
     the exact same tile again immediately below it; Break can still reuse
     the lone extra shot since it's much further down the page. */
  const extraPhotos = data.gallery || [];
  const heroPhoto = { src: data.image, alt: data.imageAlt };

  const aboutImg = document.getElementById('destAboutImg');
  if (aboutImg) {
    const photo = extraPhotos.length > 1 ? extraPhotos[0] : heroPhoto;
    aboutImg.src = photo.src;
    aboutImg.alt = photo.alt;
  }

  const breakImg = document.getElementById('destBreakImg');
  const breakQuote = document.getElementById('destBreakQuote');
  if (breakImg) {
    const photo = extraPhotos.length > 1 ? extraPhotos[1] : (extraPhotos[0] || heroPhoto);
    breakImg.src = photo.src;
    breakImg.alt = photo.alt;
  }
  if (breakQuote) {
    const source = data.whyText || data.description || '';
    const firstSentence = source.split(/(?<=[.!?])\s/)[0] || source;
    breakQuote.textContent = firstSentence;
  }

  /* Sample itinerary */
  const itineraryList = document.getElementById('destItineraryList');
  if (itineraryList) {
    itineraryList.innerHTML = '';
    buildItinerary(data).forEach((text, i) => {
      const li = document.createElement('li');
      li.className = 'dest-itinerary__item';

      const day = document.createElement('span');
      day.className = 'dest-itinerary__day';
      day.textContent = `Day ${i + 1}`;

      const label = document.createElement('span');
      label.className = 'dest-itinerary__text';
      label.textContent = text;

      li.append(day, label);
      itineraryList.appendChild(li);
    });
  }
});