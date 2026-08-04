function escapeHtml(str) {
  const div = document.createElement('div');
  div.textContent = str;
  return div.innerHTML;
}

document.addEventListener('DOMContentLoaded', () => {
  const params = new URLSearchParams(window.location.search);
  const id = params.get('id');
  const car = CAR_DATABASE.find(c => c.id === id) || CAR_DATABASE[0];

  const layout = document.getElementById('detailLayout');
  const crumb = document.getElementById('crumbCurrent');
  if (crumb) crumb.textContent = car.name;
  document.title = `${car.name} — Hamza Enterprises`;

  const waMessage = encodeURIComponent(
    `Hi, I'm interested in the ${car.name} (Item No: ${car.itemNo}, $${car.price.toLocaleString()}). Is it still available?`
  );
  const waLink = `https://wa.me/821064995384?text=${waMessage}`;
  const waLinkFatima = `https://wa.me/821080301614?text=${waMessage}`;

  // Falls back to the single stock photo until multiple angles are added per vehicle.
  const images = (car.images && car.images.length ? car.images : [car.image]);

  layout.innerHTML = `
    <div class="detail-main">
      <div class="detail-gallery">
        <div class="detail-gallery-main">
          <div class="detail-gallery-track" id="galleryTrack">
            ${images.map((src, i) => `
              <div class="detail-gallery-slide">
                <img src="${src}" alt="${car.name}" class="detail-gallery-img" ${i === 0 ? '' : 'loading="lazy"'}>
              </div>
            `).join('')}
          </div>
          <span class="detail-gallery-badge"><svg width="16" height="16"><use href="#icon-shield"/></svg> 200-Point Inspected</span>
          ${images.length > 1 ? `
            <button class="gallery-nav gallery-prev" id="galleryPrev" aria-label="Previous photo"><svg width="20" height="20" style="transform:scaleX(-1)"><use href="#icon-chevron"/></svg></button>
            <button class="gallery-nav gallery-next" id="galleryNext" aria-label="Next photo"><svg width="20" height="20"><use href="#icon-chevron"/></svg></button>
            <span class="gallery-counter" id="galleryCounter">1 / ${images.length}</span>
          ` : ''}
        </div>
        ${images.length > 1 ? `
          <div class="detail-gallery-thumbs" id="galleryThumbs">
            ${images.map((src, i) => `
              <button class="gallery-thumb ${i === 0 ? 'active' : ''}" data-index="${i}">
                <img src="${src}" alt="${car.name} photo ${i + 1}" loading="lazy">
              </button>
            `).join('')}
          </div>
        ` : ''}
      </div>

      <div class="detail-title-block">
        <h1>${car.name}</h1>
        <div class="detail-title-meta">
          <span><svg width="15" height="15"><use href="#icon-pin"/></svg> ${car.location}</span>
          <span>Item No: <strong>${car.itemNo}</strong></span>
        </div>
      </div>

      <div class="detail-quick-specs">
        <div><svg width="18" height="18"><use href="#icon-gauge"/></svg><span>${car.mileage.toLocaleString()} mi</span></div>
        <div><svg width="18" height="18"><use href="#icon-fuel"/></svg><span>${car.fuel}</span></div>
        <div><svg width="18" height="18"><use href="#icon-badge"/></svg><span>${car.transmission}</span></div>
        <div><svg width="18" height="18"><use href="#icon-tag"/></svg><span>${car.year}</span></div>
      </div>

      ${car.description ? `
      <div class="detail-block">
        <h3>Description</h3>
        <p class="detail-description-text">${escapeHtml(car.description)}</p>
      </div>
      ` : ''}

      <div class="detail-block">
        <h3>Full specification</h3>
        <div class="detail-spec-grid">
          <div><span>Maker</span><strong>${car.maker}</strong></div>
          <div><span>Model</span><strong>${car.model}</strong></div>
          <div><span>Year</span><strong>${car.year}</strong></div>
          <div><span>Body Type</span><strong>${car.body}</strong></div>
          <div><span>Fuel Type</span><strong>${car.fuel}</strong></div>
          <div><span>Transmission</span><strong>${car.transmission}</strong></div>
          <div><span>Engine</span><strong>${car.engine}</strong></div>
          <div><span>Drive</span><strong>${car.drive}</strong></div>
          <div><span>Seats</span><strong>${car.seats}</strong></div>
          <div><span>Mileage</span><strong>${car.mileage.toLocaleString()} mi</strong></div>
          <div><span>Location</span><strong>${car.location}</strong></div>
          <div><span>VIN</span><strong>${car.vinNo}</strong></div>
        </div>
      </div>

      <div class="detail-block">
        <h3>Inspection summary</h3>
        <p class="detail-block-sub">Every vehicle passes a 200-point inspection before export. Full report available on request.</p>
        <div class="detail-inspection-grid">
          ${['Engine', 'Transmission', 'Brakes', 'Electrical System', 'Air Conditioning', 'Body &amp; Frame'].map(item => `
            <div class="inspection-item">
              <svg width="16" height="16"><use href="#icon-check"/></svg>
              <span>${item}</span>
              <em>Passed</em>
            </div>
          `).join('')}
        </div>
      </div>

      <div class="detail-block">
        <h3>Why buy from Hamza Enterprises</h3>
        <div class="detail-why-grid">
          <div class="detail-why-item"><svg width="20" height="20"><use href="#icon-shield"/></svg><span>Certified 200-point inspection</span></div>
          <div class="detail-why-item"><svg width="20" height="20"><use href="#icon-truck"/></svg><span>Worldwide shipping, 7–14 days</span></div>
          <div class="detail-why-item"><svg width="20" height="20"><use href="#icon-badge"/></svg><span>Verified dealer network</span></div>
          <div class="detail-why-item"><svg width="20" height="20"><use href="#icon-users"/></svg><span>Direct WhatsApp support, no sign-up</span></div>
        </div>
      </div>
    </div>

    <aside class="detail-sidebar">
      <div class="detail-price-card">
        <span class="detail-price-label">Price</span>
        <div class="detail-price-usd">$${car.price.toLocaleString()} <small>USD</small></div>

        <div class="detail-currency-row">
          <label for="currencySelect">View price in</label>
          <select class="currency-select" id="currencySelect" data-width="100%"></select>
        </div>
        <div class="detail-converted-price" id="convertedPrice">Loading live rate…</div>

        <a href="${waLink}" class="btn btn-primary detail-cta-whatsapp" target="_blank" rel="noopener">
          <svg width="20" height="20"><use href="#icon-whatsapp"/></svg> Enquire on WhatsApp
        </a>
        <a href="tel:+821064995384" class="btn btn-outline detail-cta-call">
          <svg width="16" height="16"><use href="#icon-phone"/></svg> Call +82 10 6499 5384
        </a>
        <p class="detail-cta-note">No account or sign-up needed — message us directly and our team will respond.</p>

        <div class="detail-alt-contact">
          <span>Or reach Fatima Trading</span>
          <div class="detail-alt-contact-row">
            <a href="${waLinkFatima}" target="_blank" rel="noopener"><svg width="15" height="15"><use href="#icon-whatsapp"/></svg> WhatsApp</a>
            <a href="tel:+821080301614"><svg width="14" height="14"><use href="#icon-phone"/></svg> +82 10 8030 1614</a>
          </div>
        </div>

        <div class="detail-trust-row">
          <span><svg width="16" height="16"><use href="#icon-shield"/></svg> Inspected</span>
          <span><svg width="16" height="16"><use href="#icon-truck"/></svg> Ships worldwide</span>
        </div>
      </div>
    </aside>
  `;

  // Currency conversion — reacts to the globally selected currency, whether
  // changed from the navbar or this page's own selector.
  if (window.HamzaCurrencySelect) window.HamzaCurrencySelect.init();
  const priceEl = document.getElementById('convertedPrice');
  HamzaCurrency.getRates().then(({ rates, live }) => {
    function render(code) {
      const currencyCode = code || HamzaCurrency.getSelectedCode();
      priceEl.innerHTML = `${HamzaCurrency.format(car.price, currencyCode, rates)}` +
        (live ? '' : ' <em>(approx. rate)</em>');
    }
    render();
    HamzaCurrency.onChange(render);
  });

  // Gallery slider
  if (images.length > 1) {
    const track = document.getElementById('galleryTrack');
    const prevBtn = document.getElementById('galleryPrev');
    const nextBtn = document.getElementById('galleryNext');
    const counter = document.getElementById('galleryCounter');
    const thumbs = Array.from(document.querySelectorAll('.gallery-thumb'));
    let slide = 0;

    function goTo(i) {
      slide = (i + images.length) % images.length;
      track.style.transform = `translateX(-${slide * 100}%)`;
      counter.textContent = `${slide + 1} / ${images.length}`;
      thumbs.forEach((t, idx) => t.classList.toggle('active', idx === slide));
    }

    nextBtn.addEventListener('click', () => goTo(slide + 1));
    prevBtn.addEventListener('click', () => goTo(slide - 1));
    thumbs.forEach((t, i) => t.addEventListener('click', () => goTo(i)));
  }

  // Similar vehicles (same body type, excluding current)
  const similar = CAR_DATABASE.filter(c => c.body === car.body && c.id !== car.id).slice(0, 3);
  if (similar.length > 0) {
    const grid = document.getElementById('similarGrid');
    const section = document.getElementById('similarVehicles');
    grid.innerHTML = similar.map(c => `
      <div class="listing-card">
        <div class="listing-media">
          <img src="${c.image}" alt="${c.name}" class="listing-img" loading="lazy">
          <span class="listing-badge"><svg><use href="#icon-shield"/></svg> Inspected</span>
        </div>
        <div class="listing-body">
          <h3>${c.name}</h3>
          <div class="listing-meta">${c.location}</div>
          <div class="listing-specs">
            <span><svg width="14" height="14"><use href="#icon-gauge"/></svg>${c.mileage.toLocaleString()} mi</span>
            <span><svg width="14" height="14"><use href="#icon-fuel"/></svg>${c.fuel}</span>
          </div>
          <div class="listing-footer">
            <span class="listing-price">$${c.price.toLocaleString()}</span>
            <a href="car-detail?id=${c.id}" class="listing-link">View details <svg><use href="#icon-arrow"/></svg></a>
          </div>
        </div>
      </div>
    `).join('');
    section.style.display = '';
  }
});
