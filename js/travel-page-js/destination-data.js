/* Shared destination data — read by both travel.html (card → detail link)
   and destination-detail.html (populating the detail page by ?slug=).
   When Strapi is wired up later, this object is what gets replaced by a
   fetch() call; everything downstream (rendering) stays the same.
   Departure "spots" figures are placeholder demo numbers, same as the
   dates/duration on the cards — swap for real availability once it exists. */
const DESTINATIONS = {
  bali: {
    title: 'Bali Healing Retreat',
    image: 'assets/gallery/home-image/travel-bali.png',
    imageAlt: 'Bali temple gardens',
    aboutImage: { src: 'assets/gallery/home-image/pexels-marian-sol-miranda-32246321-14224708.jpg', alt: 'Headstand overlooking a coastal city' },
    destination: 'Indonesia',
    duration: '7 Days',
    level: 'Beginner',
    dates: '15–21 Aug 2026',
    description:
      'Experience deep healing through yoga, meditation, sacred temple visits, sound baths, and mindful living in the heart of Bali.',
    whyText:
      "Bali has long drawn seekers to its temple courtyards and rice-terrace stillness, and this retreat is built around that same quiet pull. Expect unhurried mornings of yoga and meditation, sound bath ceremonies, and visits to sacred temples woven gently into the pace of each day  a retreat, not a sightseeing itinerary.",
    highlights: [
      'Sacred temple visits',
      'Sound bath ceremonies',
      'Daily yoga & meditation',
      'Mindful, restorative pace',
    ],
    gallery: [
      { src: 'assets/gallery/home-image/pexels-tima-miroshnichenko-5928626.jpg', alt: 'Sunrise yoga practice on the beach' },
    ],
    departures: [
      { range: '15–21 Aug 2026', spots: 6 },
      { range: '10–16 Oct 2026', spots: 4 },
    ],
    itinerary: [
      { title: 'Arrival & Grounding', text: 'Arrive in Bali and settle in, followed by an evening welcome circle and orientation.' },
      { title: 'Morning Yoga & Rice Terraces', text: 'Sunrise yoga practice, then an unhurried walk through the rice terraces.' },
      { title: 'Sacred Temple Visit', text: 'A guided visit to a local temple, including a traditional water-blessing ceremony.' },
      { title: 'Sound Bath & Stillness', text: 'Deep meditation session followed by an evening sound bath ceremony.' },
      { title: 'Rest Day', text: 'Free time to rest, with an optional excursion to nearby waterfalls or the coast.' },
      { title: 'Closing Practices', text: 'A full immersive practice session, closing with a gratitude and integration circle.' },
      { title: 'Departure', text: 'Final morning meditation and breakfast together before farewells and departure.' },
    ],
  },
  rishikesh: {
    title: 'Rishikesh Yoga Retreat',
    image: 'assets/gallery/home-image/Rishikesh.jpg',
    imageAlt: 'Rishikesh on the Ganges',
    destination: 'India',
    duration: '6 Days',
    level: 'All Levels',
    dates: '10–15 Sep 2026',
    description:
      'Rejuvenate your body and mind with traditional yoga, meditation and Ayurvedic healing on the banks of the Ganges.',
    whyText:
      "Rishikesh is where much of modern yoga finds its roots, and this retreat keeps things close to that tradition — daily asana and pranayama with experienced teachers, Ayurvedic treatments, and evenings by the Ganges. Open to every experience level, from complete beginners to long-time practitioners.",
    highlights: [
      'Traditional yoga instruction',
      'Ayurvedic healing sessions',
      'Riverside meditation by the Ganges',
      'Open to all experience levels',
    ],
    gallery: [
      { src: 'assets/gallery/home-image/livepose.jpg', alt: 'Yoga teacher assisting a handstand at a Rishikesh studio' },
      { src: 'assets/gallery/home-image/yogavidyamandiram.jpg', alt: 'Group meditation by the river with the Himalayan foothills behind' },
    ],
    departures: [
      { range: '10–15 Sep 2026', spots: 8 },
      { range: '05–10 Nov 2026', spots: 5 },
    ],
    itinerary: [
      { title: 'Arrival in Rishikesh', text: 'Settle in, then join an evening Ganga Aarti ceremony by the river.' },
      { title: 'Foundations of Practice', text: 'Morning asana and pranayama session, with an introduction to Ayurveda.' },
      { title: 'Ayurvedic Treatments', text: 'A personalized Ayurvedic consultation and treatment, followed by evening meditation.' },
      { title: 'Riverside Immersion', text: 'Extended riverside meditation and a yoga philosophy talk.' },
      { title: 'Deepening Practice', text: 'An advanced asana session, with free time to explore Rishikesh.' },
      { title: 'Integration & Departure', text: 'A closing practice and breakfast together before departure.' },
    ],
  },
  'sri-lanka': {
    title: 'Sri Lanka Wellness Escape',
    image: 'assets/gallery/home-image/sri lanka.png',
    imageAlt: 'Sri Lanka rock fortress',
    aboutImage: { src: 'assets/gallery/home-image/thevision.jpg', alt: 'Headstand overlooking the sea and green hills' },
    destination: 'Sri Lanka',
    duration: '8 Days',
    level: 'Intermediate',
    dates: '05–12 Oct 2026',
    description:
      'A journey of wellness, nature and culture. Reconnect with yourself in serene beaches and lush tea country.',
    whyText:
      "This escape moves between two very different sides of Sri Lanka — quiet beach mornings and the cool green hush of tea country — with wellness practice as the thread running through both. Along the way there's space for the island's Buddhist heritage and its warm, unhurried culture.",
    highlights: [
      'Serene beach mornings',
      'Lush tea country excursions',
      'Buddhist heritage & culture',
      'Wellness-focused itinerary',
    ],
    gallery: [
      { src: 'assets/gallery/home-image/budha.png', alt: 'Buddha statue in a quiet forest setting' },
    ],
    departures: [
      { range: '05–12 Oct 2026', spots: 6 },
      { range: '07–14 Dec 2026', spots: 3 },
    ],
    itinerary: [
      { title: 'Arrival & Beachside Welcome', text: 'Arrive and settle in with an easy evening on the coast.' },
      { title: 'Beach Yoga & Ocean Meditation', text: 'Sunrise yoga on the sand, followed by an ocean-facing meditation session.' },
      { title: 'Journey to Tea Country', text: 'Travel inland to the cool green hills of tea country.' },
      { title: 'Tea Estate Walks & Wellness Rituals', text: 'A walk through the tea estates paired with traditional wellness rituals.' },
      { title: 'Buddhist Heritage Visit', text: 'A guided visit to a site of Buddhist heritage and quiet reflection.' },
      { title: 'Ayurvedic Wellness Day', text: 'A full day devoted to Ayurvedic treatments and gentle practice.' },
      { title: 'Return to the Coast', text: 'Travel back to the coast for a final stretch of beach mornings.' },
      { title: 'Closing Circle & Departure', text: 'A closing circle to reflect on the journey, followed by departure.' },
    ],
  },
  ladakh: {
    title: 'Ladakh Himalayan Retreat',
    image: 'assets/gallery/home-image/ladakh.jpg',
    imageAlt: 'Ladakh mountain monastery',
    aboutImage: { src: 'assets/gallery/home-image/pexels-anastasia-shuraeva-4945287.jpg', alt: 'Yoga pose against snow-capped mountains' },
    destination: 'India',
    duration: '7 Days',
    level: 'Intermediate',
    dates: '02–09 Nov 2026',
    description:
      'High-altitude stillness among ancient monasteries — a retreat of silence, breathwork and wide open skies.',
    whyText:
      "Ladakh's thin mountain air and centuries-old monasteries create a stillness that's hard to find elsewhere. This retreat leans into that — quiet monastery visits, guided breathwork suited to altitude, and long, unhurried skies. Some prior practice helps here, given the elevation and pace.",
    highlights: [
      'Ancient Himalayan monasteries',
      'Silent breathwork sessions',
      'High-altitude stillness',
      'Wide open mountain skies',
    ],
    gallery: [
      { src: 'assets/gallery/home-image/pexels-kundalini-yoga-ashram-324305954-14533456.jpg', alt: 'Meditating beside a quiet temple pond at sunrise' },
    ],
    departures: [
      { range: '02–09 Nov 2026', spots: 6 },
      { range: '04–11 Jan 2027', spots: 4 },
    ],
    itinerary: [
      { title: 'Arrival & Acclimatization', text: 'Arrive and rest as your body adjusts to the altitude.' },
      { title: 'Gentle Practice & Rest', text: 'A light practice session suited to the elevation, with plenty of rest.' },
      { title: 'Monastery Visit', text: 'A guided visit to an ancient Himalayan monastery.' },
      { title: 'Guided Breathwork at Altitude', text: 'A breathwork session adapted for high-altitude practice.' },
      { title: 'Silent Retreat Day', text: 'A full day of silence and inward reflection.' },
      { title: 'Mountain Meditation & Reflection', text: 'Meditation beneath wide open mountain skies, with closing reflection.' },
      { title: 'Departure', text: 'Final morning together before departure.' },
    ],
  },
  auroville: {
    title: 'Auroville Mindful Living',
    image: 'assets/gallery/home-image/Auroville.jpg',
    imageAlt: 'Auroville township gardens',
    aboutImage: { src: 'assets/gallery/home-image/thebridge.jpg', alt: 'Group meditation circle indoors' },
    destination: 'India',
    duration: '6 Days',
    level: 'Beginner',
    dates: '14–20 Dec 2026',
    description:
      "A quiet immersion in Auroville's community gardens — mindful living, meditation and conscious community practice.",
    whyText:
      "Auroville is an experiment in community as much as a place — gardens, shared meals and a slower, more intentional way of living. This retreat is a gentle introduction to that rhythm: daily meditation, time in the community gardens, and conversations about conscious, communal life.",
    highlights: [
      "Auroville's community gardens",
      'Daily mindfulness practice',
      'Conscious community living',
      'Gentle, beginner-friendly pace',
    ],
    gallery: [
      { src: 'assets/gallery/home-image/medation2.png.jpg', alt: 'Quiet journaling beside a lotus pond temple garden' },
    ],
    departures: [
      { range: '14–20 Dec 2026', spots: 7 },
      { range: '15–21 Feb 2027', spots: 5 },
    ],
    itinerary: [
      { title: 'Arrival & Community Welcome', text: 'Arrive and join a welcome circle with the Auroville community.' },
      { title: 'Garden Immersion & Meditation', text: 'Time in the community gardens followed by guided meditation.' },
      { title: 'Conscious Living Workshop', text: 'A workshop on conscious, communal ways of living.' },
      { title: 'Shared Meal & Community Circle', text: 'A shared community meal and open circle conversation.' },
      { title: 'Free Reflection Day', text: 'Unstructured time to rest and reflect at your own pace.' },
      { title: 'Closing Gathering & Departure', text: 'A closing gathering with the community before departure.' },
    ],
  },
  kerala: {
    title: 'Kerala Ayurveda Retreat',
    image: 'assets/gallery/home-image/kerala.jpg',
    imageAlt: 'Kerala backwaters',
    destination: 'India',
    duration: '7 Days',
    level: 'All Levels',
    dates: '10–17 Jan 2027',
    description:
      'Traditional Ayurvedic healing, gentle yoga and calm backwater days — restore body and mind at their own pace.',
    whyText:
      "Kerala's backwaters set a slower rhythm from the moment you arrive. Days here are built around traditional Ayurvedic treatments and gentle yoga, with plenty of unstructured time to simply rest by the water — a good fit whether it's your first retreat or your fifteenth.",
    highlights: [
      'Traditional Ayurvedic healing',
      'Calm backwater days',
      'Gentle, restorative yoga',
      'Open to all experience levels',
    ],
    gallery: [
      { src: 'assets/gallery/home-image/kerala1.jpg', alt: 'Kerala backwaters, second view' },
      { src: 'assets/gallery/home-image/kerala2.jpg', alt: 'Kerala backwaters, third view' },
    ],
    departures: [
      { range: '10–17 Jan 2027', spots: 8 },
      { range: '14–21 Mar 2027', spots: 6 },
    ],
    itinerary: [
      { title: 'Arrival & Backwater Welcome', text: 'Arrive to the calm of the backwaters and settle in for the evening.' },
      { title: 'Ayurvedic Consultation', text: 'A personal consultation to shape your treatments for the retreat.' },
      { title: 'Gentle Yoga by the Water', text: 'A gentle yoga session set beside the backwaters.' },
      { title: 'Traditional Treatments', text: 'A day of traditional Ayurvedic treatments and rest.' },
      { title: 'Backwater Boat Meditation', text: 'A quiet boat journey through the backwaters with guided meditation.' },
      { title: 'Rest & Restoration', text: 'Unstructured time to rest and let the treatments settle in.' },
      { title: 'Departure', text: 'A final gentle practice and breakfast before departure.' },
    ],
  },
  gujarat: {
    title: 'Gujarat Heritage Journey',
    image: 'assets/gallery/home-image/Gujarat.png',
    imageAlt: 'Gujarat heritage architecture',
    aboutImage: { src: 'assets/gallery/home-image/pexels-yogavidyamandiram-31742998.jpg', alt: 'Group forward-fold yoga practice' },
    destination: 'India',
    duration: '6 Days',
    level: 'Intermediate',
    dates: '08–14 Feb 2027',
    description:
      "Sacred stepwells, temple towns and mindful practice woven through Gujarat's timeless heritage landscape.",
    whyText:
      "Gujarat's heritage runs deep — carved stepwells, temple towns, and centuries of craftsmanship most travelers never see. This journey moves through that landscape at a mindful pace, pairing daily practice with time to actually take in the history rather than rush past it.",
    highlights: [
      'Sacred stepwells',
      'Historic temple towns',
      "Gujarat's living heritage",
      'Mindful daily practice',
    ],
    gallery: [
      { src: 'assets/gallery/home-image/pexels-balljinder-singh-666149-18364977.jpg', alt: 'Ancient temple ruins beside a lotus pond' },
    ],
    departures: [
      { range: '08–14 Feb 2027', spots: 6 },
      { range: '12–18 Apr 2027', spots: 4 },
    ],
    itinerary: [
      { title: 'Arrival & Orientation', text: 'Arrive and get oriented for the journey ahead.' },
      { title: 'Stepwell & Heritage Walk', text: 'A walk through Gujarat’s carved stepwells and heritage sites.' },
      { title: 'Temple Town Practice', text: 'Morning practice followed by time in a historic temple town.' },
      { title: 'Craft & Culture Immersion', text: 'Time with local artisans and centuries of craftsmanship.' },
      { title: 'Mindful Heritage Exploration', text: 'A slower, mindful day exploring more of the region’s heritage.' },
      { title: 'Closing Circle & Departure', text: 'A closing circle to reflect on the journey before departure.' },
    ],
  },
  'tamil-nadu': {
    title: 'Tamil Nadu Temple Trail',
    image: 'assets/gallery/home-image/TN.jpg',
    imageAlt: 'Tamil Nadu temple',
    aboutImage: { src: 'assets/gallery/home-image/pexels-yogavidyamandiram-31743034.jpg', alt: 'Group yoga practice with raised arms' },
    destination: 'India',
    duration: '8 Days',
    level: 'Beginner',
    dates: '05–13 Mar 2027',
    description:
      "Chant, ritual and stillness among South India's grand temple towns — a devotional path for body and spirit.",
    whyText:
      "South India's great temple towns move to their own rhythm — chant, ritual, incense, and centuries of devotion still very much alive. This trail moves gently between them, leaving room for daily practice alongside the temple visits rather than treating them as sightseeing stops.",
    highlights: [
      "South India's grand temple towns",
      'Chant & ritual practice',
      'A devotional, unhurried pace',
      'Beginner-friendly journey',
    ],
    gallery: [
      { src: 'assets/gallery/home-image/varnasi.jpg', alt: 'Candlelit temple pathway lined with statues and flowers' },
    ],
    departures: [
      { range: '05–13 Mar 2027', spots: 8 },
      { range: '09–17 May 2027', spots: 6 },
    ],
    itinerary: [
      { title: 'Arrival & Welcome', text: 'Arrive and settle in with an orientation for the trail ahead.' },
      { title: 'Temple Town Introduction', text: 'A first visit to one of South India’s grand temple towns.' },
      { title: 'Chant & Ritual Practice', text: 'A session on traditional chant and ritual practice.' },
      { title: 'Grand Temple Visit', text: 'A guided visit to a major temple, rich in centuries of devotion.' },
      { title: 'Devotional Practice Day', text: 'A full day woven around devotional practice rather than sightseeing.' },
      { title: 'Rest & Reflection', text: 'Unstructured time to rest and reflect on the journey so far.' },
      { title: 'Closing Temple Ceremony', text: 'A closing ceremony at a temple to mark the end of the trail.' },
      { title: 'Departure', text: 'Final morning together before departure.' },
    ],
  },
};