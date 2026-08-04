function escapeHtml(str) {
  const div = document.createElement('div');
  div.textContent = str;
  return div.innerHTML;
}

document.addEventListener('DOMContentLoaded', () => {
  const params = new URLSearchParams(window.location.search);
  const id = params.get('id');
  const part = PARTS_DATABASE.find(p => p.id === id) || PARTS_DATABASE[0];

  const layout = document.getElementById('detailLayout');
  const crumb = document.getElementById('crumbCurrent');
  if (crumb) crumb.textContent = part.name;
  document.title = `${part.name} — Hamza Enterprises`;

  const waMessage = encodeURIComponent(
    `Hi, I'm interested in the ${part.name} (Part No: ${part.partNo}, $${part.price.toLocaleString()}). Is it still available?`
  );
  const waLink = `https://wa.me/821064995384?text=${waMessage}`;
  const waLinkFatima = `https://wa.me/821080301614?text=${waMessage}`;

  // Falls back to a generated category diagram when no real photos have been uploaded.
  const hasRealPhoto = !!(part.images && part.images.length) || !!part.image;
  const images = hasRealPhoto
    ? (part.images && part.images.length ? part.images : [part.image])
    : [`data:image/svg+xml;utf8,${encodeURIComponent(getPartBlueprint(part.category))}`];
  const conditionClass = part.condition === 'New' ? 'badge-green' : (part.condition === 'Rebuilt' ? 'badge-blue' : 'badge-amber');

  layout.innerHTML = `
    <div class="detail-main">
      <div class="detail-gallery">
        <div class="detail-gallery-main">
          <div class="detail-gallery-track" id="galleryTrack">
            ${images.map((src, i) => `
              <div class="detail-gallery-slide">
                <img src="${src}" alt="${part.name}" class="detail-gallery-img" ${hasRealPhoto ? '' : 'style="object-fit:contain;background:#0f141d;"'} ${i === 0 ? '' : 'loading="lazy"'}>
              </div>
            `).join('')}
          </div>
          <span class="detail-gallery-badge"><svg width="16" height="16"><use href="#icon-shield"/></svg> ${part.condition}</span>
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
                <img src="${src}" alt="${part.name} photo ${i + 1}" loading="lazy">
              </button>
            `).join('')}
          </div>
        ` : ''}
      </div>

      <div class="detail-title-block">
        <h1>${part.name}</h1>
        <div class="detail-title-meta">
          <span><svg width="15" height="15"><use href="#icon-pin"/></svg> ${part.location || 'N/A'}</span>
          <span>Part No: <strong>${part.partNo || 'N/A'}</strong></span>
        </div>
      </div>

      <div class="detail-quick-specs">
        <div><svg width="18" height="18"><use href="#icon-gauge"/></svg><span>${part.category}</span></div>
        <div><svg width="18" height="18"><use href="#icon-badge"/></svg><span>${part.condition}</span></div>
        <div><svg width="18" height="18"><use href="#icon-tag"/></svg><span>${part.year || 'N/A'}</span></div>
        <div><svg width="18" height="18"><use href="#icon-fuel"/></svg><span>${part.hp || 'N/A'}</span></div>
      </div>

      ${part.description ? `
      <div class="detail-block">
        <h3>Description</h3>
        <p class="detail-description-text">${escapeHtml(part.description)}</p>
      </div>
      ` : ''}

      <div class="detail-block">
        <h3>Full specification</h3>
        <div class="detail-spec-grid">
          <div><span>Maker</span><strong>${part.maker}</strong></div>
          <div><span>Model</span><strong>${part.model || 'N/A'}</strong></div>
          <div><span>Category</span><strong>${part.category}</strong></div>
          <div><span>Condition</span><strong>${part.condition}</strong></div>
          <div><span>Year</span><strong>${part.year || 'N/A'}</strong></div>
          <div><span>Part No</span><strong>${part.partNo || 'N/A'}</strong></div>
          <div><span>OEM No</span><strong>${part.oemNo || 'N/A'}</strong></div>
          <div><span>Engine Type</span><strong>${part.engineType || 'N/A'}</strong></div>
          <div><span>Weight</span><strong>${part.weight || 'N/A'}</strong></div>
          <div><span>Horsepower</span><strong>${part.hp || 'N/A'}</strong></div>
          <div><span>Fits Models</span><strong>${part.fitsModels || 'N/A'}</strong></div>
          <div><span>Location</span><strong>${part.location || 'N/A'}</strong></div>
        </div>
      </div>

      <div class="detail-block">
        <h3>Why buy from Hamza Enterprises</h3>
        <div class="detail-why-grid">
          <div class="detail-why-item"><svg width="20" height="20"><use href="#icon-shield"/></svg><span>Quality-graded condition</span></div>
          <div class="detail-why-item"><svg width="20" height="20"><use href="#icon-truck"/></svg><span>Worldwide shipping, 7–14 days</span></div>
          <div class="detail-why-item"><svg width="20" height="20"><use href="#icon-badge"/></svg><span>Verified dealer network</span></div>
          <div class="detail-why-item"><svg width="20" height="20"><use href="#icon-users"/></svg><span>Direct WhatsApp support, no sign-up</span></div>
        </div>
      </div>
    </div>

    <aside class="detail-sidebar">
      <div class="detail-price-card">
        <span class="detail-price-label">Price</span>
        <div class="detail-price-usd">$${part.price.toLocaleString()} <small>USD</small></div>

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
          <span class="badge ${conditionClass}">${part.condition}</span>
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
      priceEl.innerHTML = `${HamzaCurrency.format(part.price, currencyCode, rates)}` +
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

  // Similar parts (same category, excluding current)
  const similar = PARTS_DATABASE.filter(p => p.category === part.category && p.id !== part.id).slice(0, 3);
  if (similar.length > 0) {
    const grid = document.getElementById('similarGrid');
    const section = document.getElementById('similarParts');
    grid.innerHTML = similar.map(p => {
      const img = p.image || `data:image/svg+xml;utf8,${encodeURIComponent(getPartBlueprint(p.category))}`;
      return `
      <div class="listing-card">
        <div class="listing-media" style="background:#0f141d;">
          <img src="${img}" alt="${p.name}" class="listing-img" style="object-fit:contain;" loading="lazy">
          <span class="listing-badge"><svg><use href="#icon-shield"/></svg> ${p.condition}</span>
        </div>
        <div class="listing-body">
          <h3>${p.name}</h3>
          <div class="listing-meta">${p.location || ''}</div>
          <div class="listing-specs">
            <span><svg width="14" height="14"><use href="#icon-gauge"/></svg>${p.category}</span>
            <span><svg width="14" height="14"><use href="#icon-fuel"/></svg>${p.hp || 'N/A'}</span>
          </div>
          <div class="listing-footer">
            <span class="listing-price">$${p.price.toLocaleString()}</span>
            <a href="part-detail?id=${p.id}" class="listing-link">View details <svg><use href="#icon-arrow"/></svg></a>
          </div>
        </div>
      </div>
    `;
    }).join('');
    section.style.display = '';
  }
});
