// Part category helper maps
const CATEGORY_ICONS = {
  "Engine": "#icon-gauge",
  "Transmission": "#icon-grid",
  "Lighting": "#icon-bolt",
  "Body Parts": "#icon-car",
  "Suspension": "#icon-shield"
};

// State Variables
let currentFilters = {
  maker: "",
  model: "",
  year: "",
  price: "",
  location: "",
  category: ""
};

let currentLayout = "list"; // "list" or "grid"
let currentPage = 1;
const ITEMS_PER_PAGE = 6;

// DOM Elements
const makerSelect = document.getElementById("makerSelect");
const modelSelect = document.getElementById("modelSelect");
const yearSelect = document.getElementById("yearSelect");
const priceSelect = document.getElementById("priceSelect");
const locationSelect = document.getElementById("locationSelect");
const filterForm = document.getElementById("filterForm");
const resetBtn = document.getElementById("resetBtn");

const categoryGrid = document.getElementById("categoryGrid");
const sidebarBrandsList = document.getElementById("sidebarBrandsList");
const partsListContainer = document.getElementById("partsListContainer");
const resultSummaryText = document.getElementById("resultSummaryText");
const activeChipsBar = document.getElementById("activeChipsBar");
const paginationBar = document.getElementById("paginationBar");

const viewListBtn = document.getElementById("viewList");
const viewGridBtn = document.getElementById("viewGrid");

const mobileFilterTrigger = document.getElementById("mobileFilterTrigger");
const sidebarCloseBtn = document.getElementById("sidebarCloseBtn");
const partsSidebar = document.getElementById("partsSidebar");

function updateModelDropdown(maker) {
  if (!modelSelect) return;
  modelSelect.innerHTML = '<option value="">Model</option>';

  if (maker && MODEL_MAPPING[maker]) {
    MODEL_MAPPING[maker].forEach(model => {
      const opt = document.createElement("option");
      opt.value = model;
      opt.textContent = model;
      modelSelect.appendChild(opt);
    });
  }
}

// Currency — prices render in the site-wide selected currency once live
// rates are loaded, and re-render whenever that selection changes.
let fxRates = null;
function priceLabel(amountUSD) {
  if (!fxRates || typeof HamzaCurrency === "undefined") return `$${amountUSD.toLocaleString()}`;
  return HamzaCurrency.format(amountUSD, HamzaCurrency.getSelectedCode(), fxRates);
}

// Initialize Application
document.addEventListener("DOMContentLoaded", () => {
  if (typeof HamzaCurrency !== "undefined") {
    HamzaCurrency.getRates().then(({ rates }) => {
      fxRates = rates;
      applyFiltersAndRender();
    });
    HamzaCurrency.onChange(() => applyFiltersAndRender());
  }
  // Mobile menu toggle
  const navToggle = document.getElementById("navToggle");
  const mainNav = document.getElementById("mainNav");
  if (navToggle && mainNav) {
    navToggle.addEventListener("click", () => {
      const expanded = navToggle.getAttribute("aria-expanded") === "true" || false;
      navToggle.setAttribute("aria-expanded", !expanded);
      mainNav.classList.toggle("open");
    });
  }

  // Layout Toggles
  if (viewListBtn) viewListBtn.addEventListener("click", () => setLayout("list"));
  if (viewGridBtn) viewGridBtn.addEventListener("click", () => setLayout("grid"));

  // Maker dynamic model select mapping
  if (makerSelect) {
    makerSelect.addEventListener("change", () => {
      updateModelDropdown(makerSelect.value);
    });
  }

  // Mobile Filter Drawer Toggles
  if (mobileFilterTrigger) {
    mobileFilterTrigger.addEventListener("click", () => {
      partsSidebar.classList.add("open");
    });
  }
  if (sidebarCloseBtn) {
    sidebarCloseBtn.addEventListener("click", () => {
      partsSidebar.classList.remove("open");
    });
  }

  // Filter Form Submit
  if (filterForm) {
    filterForm.addEventListener("submit", (e) => {
      e.preventDefault();
      currentFilters.maker = makerSelect.value;
      currentFilters.model = modelSelect.value;
      currentFilters.year = yearSelect.value;
      currentFilters.price = priceSelect.value;
      currentFilters.location = locationSelect.value;
      currentPage = 1;
      applyFiltersAndRender();
      if (partsSidebar) partsSidebar.classList.remove("open");
    });
  }

  // Reset Filters Button
  if (resetBtn) {
    resetBtn.addEventListener("click", () => {
      resetAllFilters();
    });
  }

  // Part Category sidebar clicks
  if (categoryGrid) {
    const catButtons = categoryGrid.querySelectorAll(".body-type-btn");
    catButtons.forEach(btn => {
      btn.addEventListener("click", () => {
        const selectedCat = btn.getAttribute("data-category");
        if (currentFilters.category === selectedCat) {
          currentFilters.category = ""; // toggle off
          btn.classList.remove("active");
        } else {
          catButtons.forEach(b => b.classList.remove("active"));
          currentFilters.category = selectedCat;
          btn.classList.add("active");
        }
        currentPage = 1;
        applyFiltersAndRender();
      });
    });
  }

  // Brand sidebar list clicks
  if (sidebarBrandsList) {
    const brandListItems = sidebarBrandsList.querySelectorAll("li");
    brandListItems.forEach(item => {
      item.addEventListener("click", () => {
        const brand = item.getAttribute("data-maker");
        if (currentFilters.maker === brand) {
          currentFilters.maker = "";
          item.classList.remove("active");
        } else {
          brandListItems.forEach(b => b.classList.remove("active"));
          currentFilters.maker = brand;
          item.classList.add("active");
        }
        if (makerSelect) {
          makerSelect.value = currentFilters.maker;
          updateModelDropdown(currentFilters.maker);
        }
        currentPage = 1;
        applyFiltersAndRender();
      });
    });
  }

  // Sync initial parameters from URL parameters
  syncUrlParameters();
});

// Sync parameters from URL
function syncUrlParameters() {
  const urlParams = new URLSearchParams(window.location.search);
  
  if (urlParams.has("maker")) {
    currentFilters.maker = urlParams.get("maker");
    if (makerSelect) {
      makerSelect.value = currentFilters.maker;
      updateModelDropdown(currentFilters.maker);
    }
    
    // highlight sidebar brand if active
    if (sidebarBrandsList) {
      sidebarBrandsList.querySelectorAll("li").forEach(li => {
        if (li.getAttribute("data-maker") === currentFilters.maker) {
          li.classList.add("active");
        }
      });
    }
  }

  if (urlParams.has("category")) {
    currentFilters.category = urlParams.get("category");
    
    // highlight sidebar category button
    if (categoryGrid) {
      categoryGrid.querySelectorAll(".body-type-btn").forEach(btn => {
        if (btn.getAttribute("data-category") === currentFilters.category) {
          btn.classList.add("active");
        }
      });
    }
  }

  applyFiltersAndRender();
}

// Reset Filters
function resetAllFilters() {
  currentFilters = {
    maker: "",
    model: "",
    year: "",
    price: "",
    location: "",
    category: ""
  };

  if (makerSelect) makerSelect.value = "";
  if (modelSelect) modelSelect.value = "";
  if (yearSelect) yearSelect.value = "";
  if (priceSelect) priceSelect.value = "";
  if (locationSelect) locationSelect.value = "";

  // Reset sidebars
  if (categoryGrid) {
    categoryGrid.querySelectorAll(".body-type-btn").forEach(b => b.classList.remove("active"));
  }
  if (sidebarBrandsList) {
    sidebarBrandsList.querySelectorAll("li").forEach(li => li.classList.remove("active"));
  }

  currentPage = 1;
  applyFiltersAndRender();
  // Clear search URL
  window.history.pushState({}, document.title, window.location.pathname);
}

// Set layout view mode
function setLayout(layout) {
  currentLayout = layout;
  if (layout === "list") {
    if (viewListBtn) viewListBtn.classList.add("active");
    if (viewGridBtn) viewGridBtn.classList.remove("active");
    partsListContainer.className = "cars-list-container list-view";
  } else {
    if (viewListBtn) viewListBtn.classList.remove("active");
    if (viewGridBtn) viewGridBtn.classList.add("active");
    partsListContainer.className = "cars-list-container grid-view";
  }
  applyFiltersAndRender();
}

// Apply Filters & Render page
function applyFiltersAndRender() {
  // Filter inventory
  const filteredParts = PARTS_DATABASE.filter(part => {
    if (currentFilters.maker && part.maker !== currentFilters.maker) return false;
    if (currentFilters.model && part.model !== currentFilters.model) return false;
    if (currentFilters.year && part.year !== parseInt(currentFilters.year)) return false;
    
    // Price range logic
    if (currentFilters.price) {
      if (currentFilters.price === "under-500" && part.price >= 500) return false;
      if (currentFilters.price === "500-1000" && (part.price < 500 || part.price > 1000)) return false;
      if (currentFilters.price === "1000-2000" && (part.price < 1000 || part.price > 2000)) return false;
      if (currentFilters.price === "over-2000" && part.price <= 2000) return false;
    }
    
    if (currentFilters.location && part.location !== currentFilters.location) return false;
    if (currentFilters.category && part.category !== currentFilters.category) return false;
    return true;
  });

  // Update counter
  if (resultSummaryText) {
    resultSummaryText.textContent = `Search Result: 1 to ${Math.min(filteredParts.length, ITEMS_PER_PAGE)} of total ${filteredParts.length} unit's`;
    if (filteredParts.length === 0) {
      resultSummaryText.textContent = "Search Result: 0 units found";
    }
  }

  // Render chips
  renderActiveFilterChips();

  // Pagination logic
  const totalPages = Math.ceil(filteredParts.length / ITEMS_PER_PAGE) || 1;
  if (currentPage > totalPages) currentPage = totalPages;

  const startIndex = (currentPage - 1) * ITEMS_PER_PAGE;
  const pageParts = filteredParts.slice(startIndex, startIndex + ITEMS_PER_PAGE);

  // Render parts
  renderPartCards(pageParts);

  // Render pagination bar
  renderPaginationBar(totalPages);
}

// Render active filter chips
function renderActiveFilterChips() {
  if (!activeChipsBar) return;
  activeChipsBar.innerHTML = "";
  
  let activeCount = 0;
  for (const [key, value] of Object.entries(currentFilters)) {
    if (value) {
      activeCount++;
      const chip = document.createElement("span");
      chip.className = "filter-chip";
      chip.innerHTML = `${key.toUpperCase()}: <strong>${value}</strong> <button onclick="removeFilterChip('${key}')">&times;</button>`;
      activeChipsBar.appendChild(chip);
    }
  }

  if (activeCount > 0) {
    const clearLink = document.createElement("button");
    clearLink.className = "clear-all-chips-btn";
    clearLink.textContent = "Clear All";
    clearLink.addEventListener("click", resetAllFilters);
    activeChipsBar.appendChild(clearLink);
  }
}

// Global chip remove handler
window.removeFilterChip = function(key) {
  currentFilters[key] = "";
  if (key === "maker") {
    if (makerSelect) makerSelect.value = "";
    if (modelSelect) modelSelect.value = "";
    if (sidebarBrandsList) sidebarBrandsList.querySelectorAll("li").forEach(li => li.classList.remove("active"));
  } else if (key === "model") {
    if (modelSelect) modelSelect.value = "";
  } else if (key === "year") {
    if (yearSelect) yearSelect.value = "";
  } else if (key === "price") {
    if (priceSelect) priceSelect.value = "";
  } else if (key === "location") {
    if (locationSelect) locationSelect.value = "";
  } else if (key === "category") {
    if (categoryGrid) categoryGrid.querySelectorAll(".body-type-btn").forEach(btn => btn.classList.remove("active"));
  }
  currentPage = 1;
  applyFiltersAndRender();
};

// Render Paginated Parts
function renderPartCards(parts) {
  if (!partsListContainer) return;
  partsListContainer.innerHTML = "";

  if (parts.length === 0) {
    partsListContainer.innerHTML = `
      <div class="no-results-msg">
        <svg width="48" height="48" style="color:var(--ink-faint);"><use href="#icon-grid"/></svg>
        <h4>No parts match your criteria</h4>
        <p>Try resetting some filters or adjusting your search parameters.</p>
        <button class="btn btn-outline" onclick="resetAllFilters()">Reset Filters</button>
      </div>
    `;
    return;
  }

  parts.forEach(part => {
    let cardHTML = "";
    let imageSrc = part.image;
    if (!imageSrc) {
      const svgBlueprint = getPartBlueprint(part.category);
      imageSrc = `data:image/svg+xml;utf8,${encodeURIComponent(svgBlueprint)}`;
    }

    if (currentLayout === "list") {
      let actionBtnHTML = "";
      if (part.status === "Reserved") {
        actionBtnHTML = `<span class="part-status-btn reserved" style="display: inline-block; width: auto; padding: 8px 20px; font-size: 0.85rem;">Reserved</span>`;
      } else if (part.status === "Sold") {
        actionBtnHTML = `<span class="part-status-btn sold" style="display: inline-block; width: auto; padding: 8px 20px; font-size: 0.85rem;">Sold</span>`;
      } else {
        actionBtnHTML = `<span class="part-status-btn" style="display: inline-block; width: auto; padding: 8px 20px; font-size: 0.85rem;">${priceLabel(part.price)}</span>`;
      }

      cardHTML = `
        <div class="car-list-card">
          <div class="car-media" style="background:#0f141d;">
            <img src="${imageSrc}" alt="${part.name}" style="object-fit: contain; width: 100%; height: 100%;">
            <span class="inspected-tag" style="background:var(--accent);">${part.condition.toUpperCase()}</span>
          </div>
          <div class="car-info-body">
            <div class="part-specs-row" style="display: flex; gap: 15px; font-size: 0.8rem; color: var(--ink-faint); margin-bottom: 6px;">
              <span style="display: inline-flex; align-items: center; gap: 4px;">
                <svg width="12" height="12"><use href="#icon-clock"/></svg> ® ${part.year}
              </span>
              <span style="display: inline-flex; align-items: center; gap: 4px;">
                <svg width="12" height="12"><use href="#icon-gauge"/></svg> ® ${part.hp || '-'}
              </span>
            </div>
            <h3 class="car-title" style="margin-bottom: 8px;"><a href="part-detail?id=${part.id}">${part.name}</a></h3>
            <div class="car-ids" style="margin-bottom: 8px;">
              <span>Part No: <strong class="text-accent">${part.partNo}</strong></span>
              <span class="divider">|</span>
              <span>OEM No: <strong class="text-accent">${part.oemNo}</strong></span>
            </div>
            <div class="car-property-tags">
              <span class="prop-badge">${part.category}</span>
              <span class="prop-badge">${part.engineType || 'N/A'}</span>
              <span class="prop-badge">${part.weight || 'N/A'}</span>
              <span class="prop-badge">${part.location}</span>
              <span class="prop-badge" style="color:var(--accent); border-color:var(--accent);">Fits: ${part.fitsModels}</span>
            </div>
            <div class="car-action-row" style="margin-top: 10px;">
              <a href="part-detail?id=${part.id}" class="more-details-link">View Details &gt;&gt;</a>
            </div>
          </div>
          <div class="car-price-block" style="justify-content: center; gap: 12px;">
            <span class="reg-date">Manufacture: ${part.year}</span>
            <div class="price-container" style="margin: 0;">
              ${actionBtnHTML}
            </div>
          </div>
        </div>
      `;
    } else {
      let actionBtnHTML = "";
      if (part.status === "Reserved") {
        actionBtnHTML = `<span class="part-status-btn reserved">Reserved</span>`;
      } else if (part.status === "Sold") {
        actionBtnHTML = `<span class="part-status-btn sold">Sold</span>`;
      } else {
        actionBtnHTML = `<span class="part-status-btn">${priceLabel(part.price)}</span>`;
      }

      cardHTML = `
        <div class="car-grid-card part-grid-card">
          <div class="car-media" style="background:#0f141d; height: 180px; position: relative;">
            <img src="${imageSrc}" alt="${part.name}" style="object-fit: contain; width: 100%; height: 100%;">
            <span class="inspected-tag" style="background:var(--accent);">${part.condition.toUpperCase()}</span>
          </div>
          <div class="car-grid-content" style="text-align: center; padding: 15px 12px 0 12px;">
            <div class="part-specs-row" style="display: flex; justify-content: center; gap: 15px; font-size: 0.8rem; color: var(--ink-faint); margin-bottom: 8px;">
              <span style="display: inline-flex; align-items: center; gap: 4px;">
                <svg width="12" height="12"><use href="#icon-clock"/></svg> ® ${part.year}
              </span>
              <span style="display: inline-flex; align-items: center; gap: 4px;">
                <svg width="12" height="12"><use href="#icon-gauge"/></svg> ® ${part.hp || '-'}
              </span>
            </div>
            <h3 class="car-grid-title" style="min-height: 44px; font-size: 0.9rem; line-height: 1.3; margin: 0 auto 10px auto;"><a href="part-detail?id=${part.id}">${part.name}</a></h3>
            <div style="border: double var(--border); border-width: 3px 0 0 0; width: 50px; margin: 0 auto 12px auto; opacity: 0.6;"></div>
          </div>
          <div class="part-card-footer" style="padding: 0;">
            ${actionBtnHTML}
          </div>
        </div>
      `;
    }

    partsListContainer.innerHTML += cardHTML;
  });
}

// Render pagination buttons
function renderPaginationBar(totalPages) {
  if (!paginationBar) return;
  paginationBar.innerHTML = "";
  
  if (totalPages <= 1) return;

  const prevBtn = document.createElement("button");
  prevBtn.className = `pag-btn ${currentPage === 1 ? 'disabled' : ''}`;
  prevBtn.innerHTML = "&laquo; Previous";
  prevBtn.addEventListener("click", () => {
    if (currentPage > 1) {
      currentPage--;
      window.scrollTo({ top: 300, behavior: 'smooth' });
      applyFiltersAndRender();
    }
  });
  paginationBar.appendChild(prevBtn);

  for (let i = 1; i <= totalPages; i++) {
    const pageBtn = document.createElement("button");
    pageBtn.className = `pag-btn ${currentPage === i ? 'active' : ''}`;
    pageBtn.textContent = i;
    pageBtn.addEventListener("click", () => {
      currentPage = i;
      window.scrollTo({ top: 300, behavior: 'smooth' });
      applyFiltersAndRender();
    });
    paginationBar.appendChild(pageBtn);
  }

  const nextBtn = document.createElement("button");
  nextBtn.className = `pag-btn ${currentPage === totalPages ? 'disabled' : ''}`;
  nextBtn.innerHTML = "Next &raquo;";
  nextBtn.addEventListener("click", () => {
    if (currentPage < totalPages) {
      currentPage++;
      window.scrollTo({ top: 300, behavior: 'smooth' });
      applyFiltersAndRender();
    }
  });
  paginationBar.appendChild(nextBtn);
}
