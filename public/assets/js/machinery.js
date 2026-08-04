// State Variables
let currentFilters = {
  maker: "",
  model: "",
  fuel: "",
  location: "",
  yearMin: "",
  yearMax: "",
  category: ""
};

let currentLayout = "list"; // "list" or "grid"
let currentPage = 1;
const ITEMS_PER_PAGE = 6;

// DOM Elements
const makerSelect = document.getElementById("makerSelect");
const modelSelect = document.getElementById("modelSelect");
const fuelSelect = document.getElementById("fuelSelect");
const locationSelect = document.getElementById("locationSelect");
const yearMinInput = document.getElementById("yearMin");
const yearMaxInput = document.getElementById("yearMax");
const filterForm = document.getElementById("filterForm");
const resetBtn = document.getElementById("resetBtn");

const categoryGrid = document.getElementById("categoryGrid");
const carsListContainer = document.getElementById("carsListContainer");
const resultSummaryText = document.getElementById("resultSummaryText");
const activeChipsBar = document.getElementById("activeChipsBar");
const paginationBar = document.getElementById("paginationBar");

const viewListBtn = document.getElementById("viewList");
const viewGridBtn = document.getElementById("viewGrid");

const mobileFilterTrigger = document.getElementById("mobileFilterTrigger");
const sidebarCloseBtn = document.getElementById("sidebarCloseBtn");
const carsSidebar = document.getElementById("carsSidebar");

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

  // Populate Models based on Maker selection
  makerSelect.addEventListener("change", () => {
    populateModels(makerSelect.value);
  });

  // Layout View Toggles
  viewListBtn.addEventListener("click", () => setLayout("list"));
  viewGridBtn.addEventListener("click", () => setLayout("grid"));

  // Mobile Filter Drawer Toggles
  mobileFilterTrigger.addEventListener("click", () => {
    carsSidebar.classList.add("open");
  });
  sidebarCloseBtn.addEventListener("click", () => {
    carsSidebar.classList.remove("open");
  });

  // Filter Form Submit
  filterForm.addEventListener("submit", (e) => {
    e.preventDefault();
    currentFilters.maker = makerSelect.value;
    currentFilters.model = modelSelect.value;
    currentFilters.fuel = fuelSelect.value;
    currentFilters.location = locationSelect.value;
    currentFilters.yearMin = yearMinInput.value;
    currentFilters.yearMax = yearMaxInput.value;
    currentPage = 1;
    applyFiltersAndRender();
    carsSidebar.classList.remove("open");
  });

  // Reset Filters button
  resetBtn.addEventListener("click", () => {
    resetAllFilters();
  });

  // Category sidebar clicks
  const categoryButtons = categoryGrid.querySelectorAll(".body-type-btn");
  categoryButtons.forEach(btn => {
    btn.addEventListener("click", () => {
      const selectedCategory = btn.getAttribute("data-category");
      if (currentFilters.category === selectedCategory) {
        currentFilters.category = ""; // toggle off
        btn.classList.remove("active");
      } else {
        categoryButtons.forEach(b => b.classList.remove("active"));
        currentFilters.category = selectedCategory;
        btn.classList.add("active");
      }
      currentPage = 1;
      applyFiltersAndRender();
    });
  });

  // Sync initial parameters from URL
  syncUrlParameters();
});

// Dynamic models population
function populateModels(maker) {
  modelSelect.innerHTML = '<option value="">Select Model</option>';
  if (MAKER_MODELS[maker]) {
    MAKER_MODELS[maker].forEach(model => {
      const option = document.createElement("option");
      option.value = model;
      option.textContent = model;
      modelSelect.appendChild(option);
    });
  }
}

// Sync parameters from URL search
function syncUrlParameters() {
  const urlParams = new URLSearchParams(window.location.search);

  if (urlParams.has("maker")) {
    currentFilters.maker = urlParams.get("maker");
    makerSelect.value = currentFilters.maker;
    populateModels(currentFilters.maker);
  }
  if (urlParams.has("model")) {
    currentFilters.model = urlParams.get("model");
    setTimeout(() => {
      modelSelect.value = currentFilters.model;
    }, 50);
  }
  if (urlParams.has("category")) {
    currentFilters.category = urlParams.get("category");
    const categoryButtons = categoryGrid.querySelectorAll(".body-type-btn");
    categoryButtons.forEach(btn => {
      if (btn.getAttribute("data-category") === currentFilters.category) {
        btn.classList.add("active");
      }
    });
  }
  if (urlParams.has("fuel")) {
    currentFilters.fuel = urlParams.get("fuel");
    fuelSelect.value = currentFilters.fuel;
  }

  applyFiltersAndRender();
}

// Reset Filters
function resetAllFilters() {
  currentFilters = {
    maker: "",
    model: "",
    fuel: "",
    location: "",
    yearMin: "",
    yearMax: "",
    category: ""
  };

  makerSelect.value = "";
  modelSelect.innerHTML = '<option value="">Select Model</option>';
  fuelSelect.value = "";
  locationSelect.value = "";
  yearMinInput.value = "";
  yearMaxInput.value = "";

  categoryGrid.querySelectorAll(".body-type-btn").forEach(b => b.classList.remove("active"));

  currentPage = 1;
  applyFiltersAndRender();
  // Clear search URL
  window.history.pushState({}, document.title, window.location.pathname);
}

// Set layout view mode
function setLayout(layout) {
  currentLayout = layout;
  if (layout === "list") {
    viewListBtn.classList.add("active");
    viewGridBtn.classList.remove("active");
    carsListContainer.className = "cars-list-container list-view";
  } else {
    viewListBtn.classList.remove("active");
    viewGridBtn.classList.add("active");
    carsListContainer.className = "cars-list-container grid-view";
  }
  applyFiltersAndRender();
}

// Apply Filters & Render page
function applyFiltersAndRender() {
  // Filter inventory
  const filteredMachines = MACHINERY_DATABASE.filter(m => {
    if (currentFilters.maker && m.maker !== currentFilters.maker) return false;
    if (currentFilters.model && m.model !== currentFilters.model) return false;
    if (currentFilters.fuel && m.fuel !== currentFilters.fuel) return false;
    if (currentFilters.location && m.location !== currentFilters.location) return false;
    if (currentFilters.category && m.category !== currentFilters.category) return false;
    if (currentFilters.yearMin && m.year < parseInt(currentFilters.yearMin)) return false;
    if (currentFilters.yearMax && m.year > parseInt(currentFilters.yearMax)) return false;
    return true;
  });

  // Update counter
  resultSummaryText.textContent = `Search Result: 1 to ${Math.min(filteredMachines.length, ITEMS_PER_PAGE)} of total ${filteredMachines.length} unit's`;
  if (filteredMachines.length === 0) {
    resultSummaryText.textContent = "Search Result: 0 units found";
  }

  // Render chips
  renderActiveFilterChips();

  // Pagination logic
  const totalPages = Math.ceil(filteredMachines.length / ITEMS_PER_PAGE) || 1;
  if (currentPage > totalPages) currentPage = totalPages;

  const startIndex = (currentPage - 1) * ITEMS_PER_PAGE;
  const pageMachines = filteredMachines.slice(startIndex, startIndex + ITEMS_PER_PAGE);

  // Render machines
  renderMachineCards(pageMachines);

  // Render pagination bar
  renderPaginationBar(totalPages);
}

// Render active filter chips
function renderActiveFilterChips() {
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
    makerSelect.value = "";
    modelSelect.innerHTML = '<option value="">Select Model</option>';
  } else if (key === "model") {
    modelSelect.value = "";
  } else if (key === "fuel") {
    fuelSelect.value = "";
  } else if (key === "location") {
    locationSelect.value = "";
  } else if (key === "yearMin") {
    yearMinInput.value = "";
  } else if (key === "yearMax") {
    yearMaxInput.value = "";
  } else if (key === "category") {
    categoryGrid.querySelectorAll(".body-type-btn").forEach(btn => btn.classList.remove("active"));
  }
  currentPage = 1;
  applyFiltersAndRender();
};

// Render Paginated Machines
function renderMachineCards(machines) {
  carsListContainer.innerHTML = "";

  if (machines.length === 0) {
    carsListContainer.innerHTML = `
      <div class="no-results-msg">
        <svg width="48" height="48" style="color:var(--ink-faint);"><use href="#icon-truck"/></svg>
        <h4>No machinery matches your criteria</h4>
        <p>Try resetting some filters or adjusting your search parameters.</p>
        <button class="btn btn-outline" onclick="resetAllFilters()">Reset Filters</button>
      </div>
    `;
    return;
  }

  machines.forEach(m => {
    let cardHTML = "";

    if (currentLayout === "list") {
      cardHTML = `
        <div class="car-list-card">
          <div class="car-media">
            <img src="${m.image}" alt="${m.name}" loading="lazy">
            <span class="inspected-tag">INSPECTED</span>
          </div>
          <div class="car-info-body">
            <h3 class="car-title"><a href="machinery-detail?id=${m.id}">${m.name}</a></h3>
            <div class="car-ids">
              <span>Item No: <strong class="text-accent">${m.itemNo}</strong></span>
              <span class="divider">|</span>
              <span>Serial No: <strong class="text-accent">${m.serialNo}</strong></span>
            </div>
            <div class="car-property-tags">
              <span class="prop-badge">Used</span>
              <span class="prop-badge">${m.category}</span>
              <span class="prop-badge">${m.capacity || 'N/A'}</span>
              <span class="prop-badge">${m.fuel}</span>
              <span class="prop-badge">${m.location}</span>
            </div>
            <div class="car-action-row">
              <a href="machinery-detail?id=${m.id}" class="more-details-link">More details &gt;&gt;</a>
            </div>
          </div>
          <div class="car-price-block">
            <span class="reg-date">${m.hours.toLocaleString()} hrs</span>
            <div class="price-container">
              <span class="price-val">${priceLabel(m.price)}</span>
            </div>
          </div>
        </div>
      `;
    } else {
      // Grid view card
      cardHTML = `
        <div class="car-grid-card">
          <div class="car-media">
            <img src="${m.image}" alt="${m.name}" loading="lazy">
            <span class="inspected-tag">INSPECTED</span>
          </div>
          <div class="car-grid-content">
            <div class="car-grid-specs">
              <span>${m.year}</span>
              <span>${m.category}</span>
              <span>${m.engine || 'N/A'}</span>
            </div>
            <h3 class="car-grid-title"><a href="machinery-detail?id=${m.id}">${m.name}</a></h3>
            <div class="car-grid-price-bar">
              <span class="price-val">${priceLabel(m.price)}</span>
            </div>
          </div>
        </div>
      `;
    }

    carsListContainer.innerHTML += cardHTML;
  });
}

// Render pagination buttons
function renderPaginationBar(totalPages) {
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
