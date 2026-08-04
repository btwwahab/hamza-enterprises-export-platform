document.getElementById('year').textContent = new Date().getFullYear();

/* Header scroll shadow */
const header = document.getElementById('siteHeader');
function updateHeaderScrollState() {
  header.classList.toggle('scrolled', window.scrollY > 8);
}
updateHeaderScrollState();
window.addEventListener('scroll', updateHeaderScrollState, { passive: true });

/* Brand data (BRANDS injected server-side from the database) */
const wordmarkBrands = ['Samsung'];

const brandGrid = document.getElementById('brandGrid');
brandGrid.innerHTML = BRANDS.map(b => {
  const slug = b.logo;
  const isPath = slug && (slug.startsWith('/') || slug.startsWith('http'));
  const logoSrc = isPath ? slug : (slug ? `assets/img/brands/${slug}.svg` : null);
  const imgClass = wordmarkBrands.includes(b.name) ? 'brand-logo-img wordmark' : 'brand-logo-img';
  const logoHtml = logoSrc
    ? `<img src="${logoSrc}" alt="${b.name} logo" class="${imgClass}" loading="lazy">`
    : `<div class="brand-initial">${b.name.charAt(0)}</div>`;
  const logoClass = logoSrc ? 'brand-logo' : 'brand-logo brand-logo-placeholder';
  return `
    <div class="brand-card">
      <div class="${logoClass}">${logoHtml}</div>
      <h4>${b.name}</h4>
      <span>${b.count.toLocaleString()} listings</span>
    </div>
  `;
}).join('');

// Currency — prices render in the site-wide selected currency once live
// rates are loaded, and re-render whenever that selection changes.
let fxRates = null;
function priceLabel(amountUSD) {
  if (!fxRates || typeof HamzaCurrency === "undefined") return `$${amountUSD.toLocaleString()}`;
  return HamzaCurrency.format(amountUSD, HamzaCurrency.getSelectedCode(), fxRates);
}

function renderListingCard(v) {
  return `
  <div class="listing-card">
    <div class="listing-media">
      <img src="${v.image}" alt="${v.name}" class="listing-img" loading="lazy" decoding="async">
      <span class="listing-badge">
        <svg><use href="#icon-shield"/></svg> Inspected
      </span>
    </div>
    <div class="listing-body">
      <h3>${v.name}</h3>
      <div class="listing-meta">${v.location}</div>
      <div class="listing-specs">
        <span><svg width="14" height="14"><use href="#icon-gauge"/></svg>${v.mileage}</span>
        <span><svg width="14" height="14"><use href="#icon-fuel"/></svg>${v.fuel}</span>
      </div>
      <div class="listing-footer">
        <span class="listing-price">${priceLabel(v.price)}</span>
        <a href="car-detail?id=${v.id}" class="listing-link">View details <svg><use href="#icon-arrow"/></svg></a>
      </div>
    </div>
  </div>`;
}

function renderHomeListings() {
  document.getElementById('recommendationGrid').innerHTML = recommendation.map(renderListingCard).join('');
  document.getElementById('stockGrid').innerHTML = stock.map(renderListingCard).join('');
}

renderHomeListings();

if (typeof HamzaCurrency !== "undefined") {
  HamzaCurrency.getRates().then(({ rates }) => {
    fxRates = rates;
    renderHomeListings();
  });
  HamzaCurrency.onChange(renderHomeListings);
}

/* Animated stat counters */
function animateCount(el, target, duration = 1400) {
  const start = performance.now();
  function tick(now) {
    const progress = Math.min((now - start) / duration, 1);
    const eased = 1 - Math.pow(1 - progress, 3);
    el.textContent = Math.round(eased * target).toLocaleString();
    if (progress < 1) requestAnimationFrame(tick);
  }
  requestAnimationFrame(tick);
}

const statTargets = STAT_TARGETS;

function setGauge(fillId, needleId, fraction) {
  const fill = document.getElementById(fillId);
  const needle = document.getElementById(needleId);
  const arcLength = 110;
  if (fill) fill.style.strokeDashoffset = String(arcLength * (1 - fraction));

  if (needle) {
    const needleLength = 28;
    const angleDeg = 180 - 180 * fraction;
    const angleRad = (angleDeg * Math.PI) / 180;
    const x2 = 50 + needleLength * Math.cos(angleRad);
    const y2 = 50 - needleLength * Math.sin(angleRad);
    needle.setAttribute('x2', x2.toFixed(2));
    needle.setAttribute('y2', y2.toFixed(2));
  }
}

function animateGauges() {
  setGauge('gaugeVehicles', 'needleVehicles', 0.88);
  setGauge('gaugeDealers', 'needleDealers', 0.74);
  setGauge('gaugeCountries', 'needleCountries', 0.55);
}

let statsAnimated = false;
const statsSection = document.querySelector('.hero-stats');
const statsObserver = new IntersectionObserver(entries => {
  entries.forEach(entry => {
    if (entry.isIntersecting && !statsAnimated) {
      statsAnimated = true;
      Object.entries(statTargets).forEach(([id, target]) => {
        animateCount(document.getElementById(id), target);
      });
      animateGauges();
      statsObserver.disconnect();
    }
  });
}, { threshold: 0.4 });
if (statsSection) statsObserver.observe(statsSection);

/* Scroll reveal */
const revealObserver = new IntersectionObserver(entries => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('in-view');
      revealObserver.unobserve(entry.target);
    }
  });
}, { threshold: 0.15 });
document.querySelectorAll('.reveal').forEach(el => revealObserver.observe(el));

/* Testimonial carousel */
const track = document.getElementById('testimonialTrack');
const prevBtn = document.getElementById('testPrev');
const nextBtn = document.getElementById('testNext');
const cards = Array.from(track.children);
let index = 0;

function itemsPerView() {
  if (window.innerWidth <= 760) return 1;
  if (window.innerWidth <= 1024) return 2;
  return 3;
}

function maxIndex() {
  return Math.max(cards.length - itemsPerView(), 0);
}

function updateTrack() {
  const cardWidth = cards[0].getBoundingClientRect().width;
  const gap = 24;
  track.style.transform = `translateX(-${index * (cardWidth + gap)}px)`;
}

nextBtn.addEventListener('click', () => {
  index = index >= maxIndex() ? 0 : index + 1;
  updateTrack();
});
prevBtn.addEventListener('click', () => {
  index = index <= 0 ? maxIndex() : index - 1;
  updateTrack();
});
window.addEventListener('resize', () => {
  index = Math.min(index, maxIndex());
  updateTrack();
});

document.getElementById('searchForm').addEventListener('submit', e => {
  e.preventDefault();
  const make = document.getElementById('fMake').value;
  const model = document.getElementById('fModel').value;
  const body = document.getElementById('fBody').value;
  let url = 'cars?';
  if (make) url += `maker=${encodeURIComponent(make)}&`;
  if (model) url += `model=${encodeURIComponent(model)}&`;
  if (body) url += `body=${encodeURIComponent(body)}&`;
  window.location.href = url.slice(0, -1);
});


/* Export destinations carousel */
const destinations = [
  { name: 'Pakistan', code: 'pk' },
  { name: 'UAE', code: 'ae' },
  { name: 'Saudi Arabia', code: 'sa' },
  { name: 'Qatar', code: 'qa' },
  { name: 'Oman', code: 'om' },
  { name: 'Bahrain', code: 'bh' },
  { name: 'Kuwait', code: 'kw' },
  { name: 'Iraq', code: 'iq' },
  { name: 'Jordan', code: 'jo' },
  { name: 'Lebanon', code: 'lb' },
  { name: 'Syria', code: 'sy' },
  { name: 'Yemen', code: 'ye' },
  { name: 'Egypt', code: 'eg' },
  { name: 'South Africa', code: 'za' },
  { name: 'Tanzania', code: 'tz' },
  { name: 'Kenya', code: 'ke' },
  { name: 'Uganda', code: 'ug' },
  { name: 'Zambia', code: 'zm' },
  { name: 'Zimbabwe', code: 'zw' },
  { name: 'Malawi', code: 'mw' },
  { name: 'Mozambique', code: 'mz' },
  { name: 'Madagascar', code: 'mg' },
  { name: 'Chile', code: 'cl' },
  { name: 'Peru', code: 'pe' },
  { name: 'Bolivia', code: 'bo', ext: 'png' },
  { name: 'Paraguay', code: 'py' },
];

const destinationTrack = document.getElementById('destinationTrack');
destinationTrack.innerHTML = destinations.map(d => `
  <div class="destination-card">
    <img src="assets/img/flags/${d.code}.${d.ext || 'svg'}" alt="${d.name} flag" class="destination-flag" loading="lazy">
    <span>${d.name}</span>
  </div>
`).join('') + `
  <div class="destination-card destination-card-more">
    <span>+ many other<br>countries</span>
  </div>
`;

const destPrevBtn = document.getElementById('destPrev');
const destNextBtn = document.getElementById('destNext');
const destCards = Array.from(destinationTrack.children);
let destIndex = 0;

function destItemsPerView() {
  if (window.innerWidth <= 640) return 2;
  if (window.innerWidth <= 1024) return 3;
  return 4;
}

function destMaxIndex() {
  return Math.max(destCards.length - destItemsPerView(), 0);
}

function updateDestTrack() {
  const cardWidth = destCards[0].getBoundingClientRect().width;
  const gap = 16;
  destinationTrack.style.transform = `translateX(-${destIndex * (cardWidth + gap)}px)`;
}

function destNext() {
  destIndex = destIndex >= destMaxIndex() ? 0 : destIndex + 1;
  updateDestTrack();
}
function destPrev() {
  destIndex = destIndex <= 0 ? destMaxIndex() : destIndex - 1;
  updateDestTrack();
}

destNextBtn.addEventListener('click', () => { destNext(); resetDestAutoplay(); });
destPrevBtn.addEventListener('click', () => { destPrev(); resetDestAutoplay(); });
window.addEventListener('resize', () => {
  destIndex = Math.min(destIndex, destMaxIndex());
  updateDestTrack();
});

let destAutoplayTimer = null;
function startDestAutoplay() {
  destAutoplayTimer = setInterval(destNext, 3000);
}
function resetDestAutoplay() {
  clearInterval(destAutoplayTimer);
  startDestAutoplay();
}
const destinationSection = document.getElementById('destinations');
destinationSection.addEventListener('mouseenter', () => clearInterval(destAutoplayTimer));
destinationSection.addEventListener('mouseleave', startDestAutoplay);
startDestAutoplay();
